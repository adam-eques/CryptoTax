<?php

namespace Tests\Integration;


use App\Models\CryptoSource;

class AddBinanceExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_BINANCE;
    protected array $credentials = [
        "apiKey" => "OxUHNMyYuIoIgoyjp8QCEnw4j3C3Yxuu157tYVfrUfPj3lnCsKBZcjxbt3pLToL2",
        "secret" => "zBPfdJqCZZXHoHj8Bnm5ItDib02RvZ5wYk57OWDOC9StFsxBJv9cczLbap7gSK5C"
    ];
}
