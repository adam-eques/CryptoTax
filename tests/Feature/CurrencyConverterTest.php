<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\CryptoCurrency;
use Carbon\Carbon;

class CurrencyConverterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $currency = CryptoCurrency::findByShortName("ATOM");
        $fiat_EUR = $currency->convertTo(14.03, "EUR", Carbon::create(2020, 5, 30, 12, 34, 36));
        $fiat_USD = $currency->convertTo(14.03, "USD", Carbon::create(2020, 5, 30, 12, 34, 36));
        // $this->assertIsFloat($fiat_value);
        // var_dump($fiat_value);
        // $this->assertGreaterThan($fiat_value, 0, 'Failed to get correct fiat value');
    }
}
