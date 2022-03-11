<?php

namespace App\Http\Livewire\Customer\Transaction;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\CryptoTransaction;

class TransactionList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public?string $search = null;
    public?string $order = null;

    public function mount(){
        $this->order = 'desc';
    }

    public function render()
    {
        $filter = [
            'order' => [
                ['label' =>'Newest', 'value' => 'desc'],
                ['label' => 'Oldest', 'value' => 'asc']
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
        $transactions = CryptoTransaction::query()
            ->whereIn("crypto_account_id", auth()->user()->cryptoAccounts->pluck("id"))
            // ->where("symbol", "like", $search)
            ->orderBy('executed_at', $this->order)
            ->paginate(10);

        return view('livewire.customer.transaction.transaction-list', [
            "transactions" => $transactions,
            'filter' => $filter
        ]);
    }
}
