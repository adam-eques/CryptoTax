<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CryptoExchange;
use function view;

class TransactionController extends Controller
{
    public function index()
    {
        return view("pages.customer.transactions.index");
    }
}
