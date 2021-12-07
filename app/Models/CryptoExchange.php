<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoExchange extends Model
{
    const EXCHANGE_KUCOIN = 1;
    const EXCHANGE_HITBTC = 2;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cryptoExchangeAccounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CryptoExchangeAccount::class);
    }
}
