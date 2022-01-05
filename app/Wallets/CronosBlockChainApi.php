<?php

namespace App\Wallets;

class CronosBlockChainApi extends BlockChainApi
{
    // See https://cronos.crypto.org/explorer/api-docs

    public function __construct()
    {
        $this->baseUrl = config("wallets.blockchains.cronos.url");
    }
}
