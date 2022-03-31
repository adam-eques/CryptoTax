<?php

namespace App\Models;

use App\Cryptos\Drivers\ApiDriverInterface;
use App\Jobs\CryptoAccountFetchJob;
use App\Models\Traits\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property \App\Models\CryptoSource $cryptoSource
 * @property \Illuminate\Database\Eloquent\Collection<CryptoAsset> $cryptoAssets
 * @property \Illuminate\Database\Eloquent\Collection<CryptoTransaction> $cryptoTransactions
 */
class CryptoAccount extends Model
{
    use BelongsToUserTrait;

    public ?ApiDriverInterface $api = null;
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'credentials' => 'json',
        'fetched_at' => 'datetime',
        'fetching_scheduled_at' => 'datetime',
    ];
    /**
     * @var null|float
     */
    protected $cachedSum = null;


    public static function boot()
    {
        parent::boot();

        static::deleting(function (self $item) {
            $item->cryptoAssets()->cascadeDelete();
            $item->cryptoTransactions()->cascadeDelete();
        });
    }


    public function cryptoSource(): BelongsTo
    {
        return $this->belongsTo(CryptoSource::class);
    }


    public function cryptoAssets(): HasMany
    {
        return $this->hasMany(CryptoAsset::class);
    }


    public function cryptoTransactions(): HasMany
    {
        return $this->hasMany(CryptoTransaction::class);
    }


    public function getName(): string
    {
        return $this->cryptoSource ? $this->cryptoSource->getName() : "";
    }


    public function getBalanceSum(string $currency = "USD"): float
    {
        if($this->cachedSum === null) {
            $sum = 0;
            $assets = $this->cryptoAssets()
                ->with("cryptoCurrency")
                ->where("balance", ">", 0)
                ->get(["balance", "crypto_currency_id"]);

            $assets->each(function (CryptoAsset $asset) use (&$sum, $currency) {
                $sum += $asset->convertTo($currency);
            });
            $this->cachedSum = $sum;
        }

        return $this->cachedSum;
    }


    public function getSortedCryptoAssetRows(): Collection
    {
        return $this
            ->cryptoAssets()
            ->withCount("cryptoTransactions")
            ->where(function($q){
                $q->where("balance", ">", 0)
                    ->orHas("cryptoTransactions");
            })
            ->get()
            ->sortByDesc(function($assest){
                return $assest->convertTo();
            });
    }


    public function hasAllCredentials(): bool
    {
        $api = $this->getApi();
        $requiredCredentials = $api->getRequiredCredentials();

        foreach ($requiredCredentials as $key) {
            if (empty($this->credentials[$key])) {
                return false;
            }
        }

        return true;
    }


    public function getApi(bool $forceReload = false): ApiDriverInterface
    {
        if (! $this->api || $forceReload) {
            $driverClass = $this->cryptoSource->driver;
            $this->api = $driverClass::make($this);
        }

        return $this->api;
    }


    public function requestUpdate(): self
    {
        $this->fetching_scheduled_at = now();
        $this->save();
        CryptoAccountFetchJob::dispatch($this);

        return $this;
    }

    public function getLastSendTransactionId() : int
    {
        $id = 1;
        $lastSendTransaction =  $this->hasMany(CryptoTransaction::class)
        ->where('trade_type', CryptoTransaction::TRAN_TYPE_SEND)
        ->orderBy('executed_at', 'DESC')
        ->first();
        if ($lastSendTransaction != null) {
            $transaction = json_decode($lastSendTransaction->raw_data);
            $id = $transaction->id;
        }
        return $id;
    }

    public function getLastReceiveTransactionId() : int
    {
        $id = 1;
        $lastReceiveTransaction =  $this->hasMany(CryptoTransaction::class)
        ->where('trade_type', CryptoTransaction::TRAN_TYPE_RECEIVE)
        ->orderBy('executed_at', 'DESC')
        ->first();
        if ($lastReceiveTransaction != null) {
            $transaction = json_decode($lastReceiveTransaction->raw_data);
            $id = $transaction->id;
        }
        return $id;
    }

    public function processFIFO($fiat="USD") {
        CryptoTransaction::processFIFO($this->account_id, $fiat);
    }
}
