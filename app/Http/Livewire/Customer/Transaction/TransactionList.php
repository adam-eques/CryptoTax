<?php

namespace App\Http\Livewire\Customer\Transaction;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\CryptoExchangeTransaction;

class TransactionList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public?string $search = null;

    public function render()
    {
        $filter = [
            'order' => [ 
                ['label' =>'Newest', 'value' => 'newest'], 
                ['label' => 'Oldest', 'value' => 'oldest'] 
            ],
            'type' => [ 
                ['label' => 'Transfer', 'value' => 'transfer'], 
                ['label' => 'Trade', 'value' => 'trade'], 
                ['label' => 'Bought', 'value' => 'buy'], 
                ['label' => 'Sold', 'value' => 'sell'], 
                ['label' => 'Received', 'value' => 'receive'], 
                ['label' => 'Sent', 'value' => 'send'], 
                ['label' => 'Mint', 'value' => 'mint'] 
            ],
            'category' => [
                ['label' => 'Kucoin', 'value' => 'kucoin'],
                ['label' => 'Solana', 'value' => 'Solana']
            ],
            'exchange' => [
                ['label' => 'Kucoin', 'value' => 'kucoin'],
                ['label' => 'Solana', 'value' => 'Solana']
            ]
        ];

        $search = '%' . $this->search . '%';
        $exchange_transactions = CryptoExchangeTransaction::query()
            ->whereIn("crypto_exchange_account_id", auth()->user()->cryptoExchangeAccounts->pluck("id"))
            ->where("symbol", "like", $search)
            ->paginate(10);

        return view('livewire.customer.transaction.transaction-list', [
            "exchange_transactions" => $exchange_transactions,
            'filter' => $filter
        ]);
    }
}
