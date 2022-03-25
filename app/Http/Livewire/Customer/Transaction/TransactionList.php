<?php

namespace App\Http\Livewire\Customer\Transaction;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\CryptoTransaction;
use App\Models\CryptoSource;
use App\Models\CryptoAccount;
use App\Models\CryptoCurrency;

class TransactionList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public?string $search = null;
    public?string $order = null;
    public?string $type = null;
    public?string $wallet = null;

    protected $queryString = [
        'search' => ['except' => '0'],
        'order' => ['except' => '0'],
        'type' => ['except' => '0'],
        'wallet' => ['except' => '0'],
    ];

    public function mount(){
        $this->order = 'DESC';
    }

    public function refresh_filter()
    {
        $this->type = null;
        $this->search = null;
        $this->wallet = null;
    }

    public function mark_ignore($id)
    {
        $selected_transaction = CryptoTransaction::query()
            ->where('id', $id)
            ->first();
        $selected_transaction->ignored = true;
        $selected_transaction->save();
    }

    public function mark_active($id)
    {
        $selected_transaction = CryptoTransaction::query()
            ->where('id', $id)
            ->first();
        $selected_transaction->ignored = false;
        $selected_transaction->save();
    }

    public function render()
    {
        $filter = [
            'order' => [
                ['label' =>'Newest', 'value' => 'DESC'],
                ['label' => 'Oldest', 'value' => 'ASC']
            ],
            'type' => [
                ['label' => 'Bought', 'value' => 'B'],
                ['label' => 'Sold', 'value' => 'S'],
                ['label' => 'Received', 'value' => 'R'],
                ['label' => 'Sent', 'value' => 'G'],
            ],
            'category' => CryptoSource::query()->get()->toArray(),
            'tag' => [
                ['label' => 'Gift', 'value' => 'E'],
                ['label' => 'Lost', 'value' => 'B'],
                ['label' => 'Mined', 'value' => 'E'],
                ['label' => 'Airdrop', 'value' => 'B'],
                ['label' => 'Payment', 'value' => 'E'],
                ['label' => 'fork', 'value' => 'B'],
                ['label' => 'Donation', 'value' => 'E'],
                ['label' => 'Staked', 'value' => 'B'],
                ['label' => 'Interest', 'value' => 'E'],
            ]
        ];
        $transactions = CryptoTransaction::query()
            ->whereIn("crypto_account_id", auth()->user()->cryptoAccounts->pluck("id"))
            ->orderBy('executed_at', $this->order);
        
        $transactions = $transactions
            ->whereHas( 'cryptoCurrency', function($q){
                $q->where('short_name', 'like', '%'. $this->search .'%');
            });

        if ($this->wallet) {
            $transactions = $transactions->whereHas('cryptoAccount', function($q){
                $q->where('crypto_source_id', $this->wallet);
            });
        }

        if ($this->type) {
            $transactions = $transactions->where('trade_type', $this->type);
        }


        $transactions = $transactions ->paginate(10);

        return view('livewire.customer.transaction.transaction-list', [
            "transactions" => $transactions,
            'filter' => $filter
        ]);
    }
}
