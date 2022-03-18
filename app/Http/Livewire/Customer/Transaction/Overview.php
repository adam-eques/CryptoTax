<?php

namespace App\Http\Livewire\Customer\Transaction;

use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TransactionImport;
use App\Exports\TransactionExport;

class Overview extends Component
{
    public function fileExport() 
    {
        return Excel::download(new TransactionExport, 'transactions.xlsx');
    }   

    public function render()
    {
        $trades_num = auth()->user()->cryptoTransactions()->where('trade_type', 'B')->orWhere('trade_type', 'S')->get()->count();
        $deposits_num = auth()->user()->cryptoTransactions()->where('trade_type', 'D')->get()->count();
        $withdrawal_num = auth()->user()->cryptoTransactions()->where('trade_type', 'W')->get()->count();
        $reviews_num = auth()->user()->cryptoTransactions()->where('trade_type', 'R')->get()->count();
        $exchange_num = auth()->user()->cryptoTransactions()->where('trade_type', 'E')->get()->count();
        return view('livewire.customer.transaction.overview', [
            'trades_num' => $trades_num,
            'deposits_num' => $deposits_num,
            'withdrawal_num' => $withdrawal_num,
            'exchange_num' => $exchange_num,
            'reviews_num'=> $reviews_num
        ]);
    }
}
