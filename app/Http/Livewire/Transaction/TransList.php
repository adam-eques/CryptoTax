<?php

namespace App\Http\Livewire\Transaction;

use App\Models\BlockchainTransaction;
use App\Models\CryptoExchangeTransaction;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class TransList extends Component
{
    public function render()
    {
        $exchange_transactions = CryptoExchangeTransaction::query()
            ->whereIn("crypto_exchange_account_id", auth()->user()->cryptoExchangeAccounts->pluck("id"))
            ->paginate(10);
        return view('livewire.transaction.trans-list', [
            "exchange_transactions" => $exchange_transactions
        ]);
    }
}
