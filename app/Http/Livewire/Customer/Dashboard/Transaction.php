<?php

namespace App\Http\Livewire\Customer\Dashboard;

use Livewire\Component;

class Transaction extends Component
{
    public function render()
    {
        $transactios = [
            [
                'name' => 'Binance Coin', 'type' => 'Buy', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => 'coins.btc'
            ],
            [
                'name' => 'Lite Coin', 'type' => 'Sell', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => 'coins.eth'
            ],
            [
                'name' => 'Tether', 'type' => 'Buy', 'balance' => '$2356', 'time' => 'Today 13,59 pm', 'icon' => 'coins.cro'
            ],
        ];
        
        return view('livewire.customer.dashboard.transaction', [
            'transactios' => $transactios
        ]);
    }
}
