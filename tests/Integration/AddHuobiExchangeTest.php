<?php

namespace Tests\Integration;


use App\Models\CryptoSource;

class AddHuobiExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_HUOBI;
    protected array $credentials = [
        "apiKey" => "37bb62cf-5bb54675-20451a74-ed2htwf5tf",
        "secret" => "c5c993f0-d051315a-1ce0b748-99eb2"
    ];
}
