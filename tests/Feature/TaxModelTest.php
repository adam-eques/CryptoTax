<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\CryptoTransaction;

class TaxModelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fifo() {
        $accountId = 660;
        $transactions = CryptoTransaction::processFIFO($accountId);
        var_dump(count($transactions));
        // var_dump($transactions[0]);
        $this->assertNotEquals(count($transactions), 0, 'Failed to get transaction by account id');
    }
}
