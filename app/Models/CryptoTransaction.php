<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property CryptoAccount $cryptoAccount
 * @property CryptoCurrency $cryptoCurrency
 * @property CryptoCurrency $feeCurrency
 * @property CryptoCurrency $priceCurrency
 */
class CryptoTransaction extends Model
{
    // transaction types
    const TRAN_TYPE_SEND =       'G';    // send (trade and blockchain transaction)
    const TRAN_TYPE_RECEIVE =    'R';    // receive ((trade and blockchain transaction))
    const TRAN_TYPE_SELL =       'S';    // sell (trade)
    const TRAN_TYPE_BUY =        'B';    // buy (trade)

    public function cryptoAccount(): BelongsTo
    {
        return $this->belongsTo(CryptoAccount::class);
    }

    public function costCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, "cost_currency_id");
    }

    public function cryptoCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, "currency_id");
    }


    public function feeCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, 'fee_currency_id');
    }


    public function priceCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, 'price_currency_id');
    }
}
