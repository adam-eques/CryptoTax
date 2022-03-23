<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\CryptoAccount;

class TransactionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_last_send_transaction()
    {
        $id = 293;
        $account = CryptoAccount::find($id);
        $this->assertIsObject($account, 'Failed to get account by id '.$id);
        $lastSendTransactionId = $account->getLastSendTransactionId();
        $this->assertIsInt($lastSendTransactionId, 'Failed to get last send transaction real Id');
        var_dump($lastSendTransactionId);
    }
}
