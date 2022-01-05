<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\BlockchainHelper;
use App\Http\Controllers\Controller;
use App\Models\WalletAsset;
use App\Wallets\BlockChainApi;
use function view;

class TransactionController extends Controller
{
    public function index()
    {
        return view("pages.customer.transactions.index");
    }
}
