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

    public function mount(){
        $this->order = 'DESC';
    }

    public function refresh_filter()
    {
        $this->type = null;
        $this->search = null;
        $this->wallet = null;
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
                ['label' => 'Trade', 'value' => 'T'],
                ['label' => 'Exchange', 'value' => 'E'],
            ],
            'category' => CryptoSource::query()->get()->toArray(),
            'exchange' => [
                ['label' => 'Exchange', 'value' => 'E'],
                ['label' => 'Blockchain', 'value' => 'B']
            ]
        ];
        $transactions = CryptoTransaction::query()
            ->whereIn("crypto_account_id", auth()->user()->cryptoAccounts->pluck("id"))
            ->orderBy('executed_at', $this->order);
        
        $transactions = $transactions
            ->whereHas( 'cryptoCurrency', function($q){
                $q->where('short_name', 'like', '%'. $this->search .'%');
            } );

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
