<?php

namespace App\Models;

use App\CryptoExchangeDrivers\Driver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CryptoExchangeAccount extends Model
{
    /**
     * @var \App\CryptoExchangeDrivers\Driver|null
     */
    protected ?Driver $api = null;
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

    protected $guarded = [];


    public static function boot() {
        parent::boot();

        static::deleting(function (self $item) {
            $item->exchangeTransactions()->cascadeDelete();
            $item->balances()->cascadeDelete();
        });
    }


    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return BelongsTo
     */
    public function cryptoExchange(): BelongsTo
    {
        return $this->belongsTo(CryptoExchange::class);
    }


    /**
     * @return HasMany
     */
    public function exchangeTransactions(): HasMany
    {
        return $this->hasMany(CryptoExchangeTransaction::class);
    }


    /**
     * @return HasMany
     */
    public function balances(): HasMany
    {
        return $this->hasMany(CryptoExchangeBalance::class);
    }


    public function getName(): string
    {
        return $this->cryptoExchange ? $this->cryptoExchange->getName() : "";
    }


    public function getBalanceSum(string $currency = "USD"): float
    {
        $sum = 0;

        $this->balances->each(function(CryptoExchangeBalance $balance) use (&$sum, $currency) {
            if($balance->balance) {
                $sum+= $balance->cryptoCurrency->convertTo($balance->balance, $currency);
            }
        });

        return $sum;
    }


    public function hasAllCredentials(): bool
    {
        $api = $this->getApi();
        $requiredCredentials = $api->getRequiredCredentials();

        foreach($requiredCredentials AS $cred => $required) {
            if($required && empty($this->credentials[$cred])) {
                return false;
            }
        }

        return true;
    }


    /**
     * @param bool $forceReload
     * @return \App\CryptoExchangeDrivers\Driver
     */
    public function getApi(bool $forceReload = false): Driver
    {
        if (! $this->api || $forceReload) {
            $driverClass = $this->cryptoExchange->driver;
            $this->api = $driverClass::make($this);
        }

        return $this->api;
    }
}
