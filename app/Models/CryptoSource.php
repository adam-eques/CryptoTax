<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoSource extends Model
{
    // Source types
    const SOURCE_TYPE_EXCHANGE = "E";
    const SOURCE_TYPE_BLOCKCHAIN = "B";
    const SOURCE_TYPE_WALLET = "W";
    // Sources
    // Exchanges
    const SOURCE_EXCHANGE_KUCOIN =              100001;
    const SOURCE_EXCHANGE_HITBTC =              100002;
    const SOURCE_EXCHANGE_BINANCE =             100003;
    const SOURCE_EXCHANGE_CRYPTOCOM =           100004;
    const SOURCE_EXCHANGE_HUOBI =               100005;
    const SOURCE_EXCHANGE_KRAKEN =              100006;

    // Blockchains
    const SOURCE_BLOCKCHAIN_ETHEREUM =          1;
    const SOURCE_BLOCKCHAIN_LITECOIN =          2;
    const SOURCE_BLOCKCHAIN_BITCOIN =           3;
    const SOURCE_BLOCKCHAIN_BITCOINCASH =       4;
    const SOURCE_BLOCKCHAIN_DASH =              5;
    const SOURCE_BLOCKCHAIN_DOGE =              6;
    const SOURCE_BLOCKCHAIN_ETHEREUMCLASSIC =   7;
    const SOURCE_BLOCKCHAIN_ZCASH =             8;
    const SOURCE_BLOCKCHAIN_ZILLIQA =           9;
    const SOURCE_BLOCKCHAIN_XRP =               10;
    const SOURCE_BLOCKCHAIN_CRONOS =            11;


    public function getName(): string
    {
        return $this->name;
    }


    public function scopeActiveExchanges($query)
    {
        return $query
            ->where("active", true)
            ->where("type", static::SOURCE_TYPE_EXCHANGE);
    }


    public function scopeActiveBlockchains($query)
    {
        return $query
            ->where("active", true)
            ->where("type", static::SOURCE_TYPE_BLOCKCHAIN);
    }


    public function isExchangeType(): bool
    {
        return  $this->type == static::SOURCE_TYPE_EXCHANGE;
    }


    public function isWalledType(): bool
    {
        return  $this->type == static::SOURCE_TYPE_WALLET;
    }


    public function isBlockchainType(): bool
    {
        return  $this->type == static::SOURCE_TYPE_BLOCKCHAIN;
    }
}
