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

    public function test_static_functions() {
        $fiat = 'USD';
        $result = CryptoTransaction::getTotalDeposits(Carbon::create(2022, 3, 28));
        $this->assertIsArray($result, 'getTotalDeposits Failed');
        echo "\ntotal transactions" . count($result);
        var_dump($result);

        // $total_deposits = CryptoTransaction::$total_deposits;
        // $total_proceeds = CryptoTransaction::$total_proceeds;
        // $fiat_reinvested = CryptoTransaction::$fiat_reinvested;
        // $this->assertIsFloat($total_deposits, 'getTotalDeposits Failed');
        // $this->assertIsFloat($total_proceeds, 'getTotalDeposits Failed');
        // $this->assertIsFloat($fiat_reinvested, 'getTotalDeposits Failed');
        // $net_deposits = $total_deposits - $fiat_reinvested;
        // $net_proceeds = $total_proceeds - $fiat_reinvested;
        // echo "\nTotal deposits: " . $total_deposits . " " . $fiat;
        // echo "\nTotal proceeds: " . $total_proceeds . " " . $fiat;
        // echo "\nFiat reinvested: " . $fiat_reinvested . " " . $fiat;
        // echo "\nNet Proceeds: " . $net_proceeds . " " . $fiat;
        // echo "\nNet Deposits: " . $net_deposits . " " . $fiat . "\n";

        // $unsupported_ccs = CryptoTransaction::$unsupported;
        // $this->assertIsArray($unsupported_ccs, 'get unsupported symbols Failed');
        // var_dump(CryptoTransaction::$holding);
        // var_dump($unsupported_ccs);
    }
}
