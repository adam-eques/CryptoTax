<?php

namespace App\Http\Livewire\Customer\Transaction;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\CryptoTransaction;
use App\Models\CryptoSource;

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
                ['label' => 'Deposit', 'value' => 'D'],
                ['label' => 'Trade', 'value' => 'T'],
                ['label' => 'Withdrawal', 'value' => 'W'],
                ['label' => 'Exchange', 'value' => 'E'],
            ],
            'category' => CryptoSource::query()->get()->toArray(),
            'exchange' => [
                ['label' => 'Exchange', 'value' => 'E'],
                ['label' => 'Blockchain', 'value' => 'B']
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
