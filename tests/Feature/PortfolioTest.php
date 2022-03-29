<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\CryptoTransaction;
use Carbon\Carbon;

use function Ramsey\Uuid\v1;

class PortfolioTest extends TestCase
{
    // // Receive transaction
    // public function test_CryptoTransaction_deposits() {
    //     // BTC
    //     $fiat = 'USD';
    //     $transaction = CryptoTransaction::find(28770);
    //     echo "\nid: " . $transaction->id;
    //     echo "\ncost: " . $transaction->cost . ' ' . $transaction->costCurrency->short_name;
    //     $this->assertIsFloat($transaction->deposits($fiat), 'deposits is returned as a wrong type');
    //     echo "\ndeposits: " . $transaction->deposits($fiat) . " " . $fiat . "\n";
    // }

    // // Send transaction
    // public function test_CryptoTransaction_proceeds() {
    //     // BTC
    //     $fiat = 'USD';
    //     $transaction = CryptoTransaction::find(27696);
    //     echo "\nid: " . $transaction->id;
    //     echo "\ncost: " . $transaction->cost . ' ' . $transaction->costCurrency->short_name;
    //     $this->assertIsFloat($transaction->deposits($fiat), 'deposits is returned as a wrong type');
    //     echo "\nproceeds: " . $transaction->proceeds($fiat) . " " . $fiat . "\n";
    // }

    // public function test_static_functions() {
    //     $fiat = 'USD';
    //     $result = CryptoTransaction::getTotal(Carbon::create(2022, 3, 28));
    //     $this->assertIsArray($result, 'getTotalDeposits Failed');
    //     echo "\ntotal transactions" . count($result);
    //     var_dump($result);
    // }

    public function test_getCurrentTotal() {
        $fiat = 'USD';
        $result = CryptoTransaction::getCurrentTotal();
        $this->assertIsArray($result, 'getTotalDeposits Failed');
        // echo "\ntotal transactions" . count($result);
        // var_dump($result);
    }
}
