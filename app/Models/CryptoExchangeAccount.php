<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoExchangeAccount extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'credentials' => 'json'
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

}
