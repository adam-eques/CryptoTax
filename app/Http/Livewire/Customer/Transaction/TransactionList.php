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

    public?CryptoTransaction $selectedTransaction = null;
    public?int $method = null;

    protected $queryString = [
        'search' => ['except' => '0'],
        'order' => ['except' => '0'],
        'type' => ['except' => '0'],
        'wallet' => ['except' => '0'],
    ];

    public function mount(){
        $this->order = 'DESC';
    }

    public function setSelectedTrans($method, $transaction)
    {
        $this->selectedTransaction = CryptoTransaction::query()
            ->where('id', $transaction)->first();
        $this->method = $method;
    }

    public function searchByItem($type)
    {
        $this->type = $type;
    }

    public function fileExport() 
    {
        return Excel::download(new TransactionExport, 'transactions.xlsx');
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
        $transactions = auth()->user()->cryptoTransactions()
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
            if($this->type == "T"){
                $transactions = $transactions->where('trade_type', 'B')
                    ->orWhere('trade_type', 'S');
            } else {
                $transactions = $transactions->where('trade_type', $this->type);
            }
        }


        $transactions = $transactions ->paginate(10);

        $trades_num = auth()->user()->cryptoTransactions()->where('trade_type', 'B')->orWhere('trade_type', 'S')->count();
        $deposits_num = auth()->user()->cryptoTransactions()->where('trade_type', 'R')->count();
        $withdrawal_num = auth()->user()->cryptoTransactions()->where('trade_type', 'G')->count();
        $reviews_num = auth()->user()->cryptoTransactions()->where('trade_type', 'C')->count();
        $exchange_num = auth()->user()->cryptoTransactions()->where('trade_type', 'E')->count();

        return view('livewire.customer.transaction.transaction-list', [
            "transactions" => $transactions,
            'filter' => $filter,
            'trades_num' => $trades_num,
            'deposits_num' => $deposits_num,
            'withdrawal_num' => $withdrawal_num,
            'reviews_num' => $reviews_num,
            'exchange_num' => $exchange_num
        ]);
    }
}
