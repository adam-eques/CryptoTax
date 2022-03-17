<?php

namespace App\Http\Livewire\Customer\Dashboard;

use Livewire\Component;

class Transaction extends Component
{
    public function render()
    {
        $transactios = auth()->user()->cryptoTransactions()->orderBy('executed_at', 'DESC')->get()->take(3);
        
        return view('livewire.customer.dashboard.transaction', [
            'transactios' => $transactios
        ]);
    }
}
