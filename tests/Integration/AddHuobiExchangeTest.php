<?php

namespace Tests\Integration;


use App\Models\CryptoSource;

class AddHuobiExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_HUOBI;
    protected array $credentials = [
        "apiKey" => "71d998dc-1ad8c118-c9e1d2b0-mjlpdje3ld",
        "secret" => "5873bb35-4e28d50b-aa4b4c1d-9adc9"
    ];
}
