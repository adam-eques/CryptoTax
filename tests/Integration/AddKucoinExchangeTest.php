<?php

namespace Tests\Integration;


use App\Models\CryptoSource;

class AddKucoinExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_KUCOIN;
    protected array $credentials = [
        "apiKey" => "60042ffdad62470006b584d9",
        "secret" => "6588acc4-057a-43bb-9659-9a9afce88b89",
        "password" => "pt83144789"
    ];
}
