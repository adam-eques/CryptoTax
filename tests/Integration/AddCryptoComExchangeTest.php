<?php

namespace Tests\Integration;


use App\Models\CryptoSource;

class AddCryptoComExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_CRYPTOCOM;
    protected array $credentials = [
        "apiKey" => "vJwZWxTPFAEXQqREpNXaGL",
        "secret" => "cbNwm8cEfYW7DYuKknDVKv"
    ];
}
