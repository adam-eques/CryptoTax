<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoCurrency extends Model
{
    protected $guarded = [];


    public function cryptoExchangeBalances()
    {
        return $this->hasMany(CryptoExchangeBalance::class);
    }


    public function getName(): string
    {
        return $this->name;
    }


    public static function findByShortName(string $shortName)
    {
        return static::query()
            ->where("short_name", $shortName)
            ->first();
    }
}
