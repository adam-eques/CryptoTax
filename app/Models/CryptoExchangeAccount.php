<?php

namespace App\Models;

use App\CryptoExchangeDrivers\Driver;
use Illuminate\Database\Eloquent\Model;
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
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function cryptoExchange(): \Illuminate\Database\Eloquent\Relations\belongsTo
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
