<?php

namespace App\Http\Livewire\Customer\Transaction;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\CryptoExchangeTransaction;

class TransactionList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $exchange_transactions = CryptoExchangeTransaction::query()
        ->whereIn("crypto_exchange_account_id", auth()->user()->cryptoExchangeAccounts->pluck("id"))
        ->paginate(10);

        return view('livewire.customer.transaction.transaction-list', [
            "exchange_transactions" => $exchange_transactions
        ]);
    }
}
