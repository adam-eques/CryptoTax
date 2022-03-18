<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Blockchains\CoingeckoAPI;
use App\Helpers\TestHelper;

class CoinGeckoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $api = CoingeckoAPI::make();
        var_dump($api->history());
    }
}
