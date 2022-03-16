<?php

namespace Tests\Integration;


use App\Models\CryptoSource;

class AddHitBtcExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_HITBTC;
    protected array $credentials = [
        "apiKey" => "XnDHZ6n5ernQ6WuGy5iMuqKqDFlSyLdB",
        "secret" => "Vbxrl5JX-uIcS8RtF6r4lzoRNM2fLXdX"
    ];
}
