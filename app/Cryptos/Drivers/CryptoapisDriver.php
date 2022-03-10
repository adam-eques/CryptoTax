<?php

namespace App\Cryptos\Drivers;

use App\Models\CryptoAccount;

class CryptoapisDriver implements ApiDriverInterface
{
    public static function make(CryptoAccount $account): ApiDriverInterface
    {
        // TODO: Implement make() method.
    }


    public function getRequiredCredentials(): array
    {
        // TODO: Implement getRequiredCredentials() method.
    }


    public function updateTransactions(): ApiDriverInterface
    {
        // TODO: Implement updateTransactions() method.
    }
}
