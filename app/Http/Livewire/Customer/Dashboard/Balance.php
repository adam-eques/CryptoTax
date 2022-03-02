<?php

namespace App\Http\Livewire\Customer\Dashboard;

use Livewire\Component;

class Balance extends Component
{
    public function render()
    {

        $situation = [
            [ 'category' => 'Total Balance', 'amount' => number_format(123456000, 2, '.', ','), 'percent' => 30],
            [ 'category' => 'Your Tax', 'amount' => number_format(123456000, 2, '.', ','), 'percent' => 96],
        ];

        return view('livewire.customer.dashboard.balance', [
            'situation' => $situation
        ]);
    }
}
