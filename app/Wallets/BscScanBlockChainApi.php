<?php

namespace App\Wallets;

class BscScanBlockChainApi extends BlockChainApi
{
    // See https://docs.bscscan.com/api-endpoints/accounts

    public function __construct()
    {
        $this->baseUrl = config("wallets.blockchains.bscscan.url");
        $this->extraParams["apiKey"] = config("wallets.blockchains.bscscan.apiKey");
    }
}
