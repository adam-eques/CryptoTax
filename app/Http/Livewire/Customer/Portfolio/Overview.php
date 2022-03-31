<?php

namespace App\Http\Livewire\Customer\Portfolio;

use Livewire\Component;
use \App\Models\CryptoTransaction;

class Overview extends Component
{

    public function render()
    {
        $data = auth()->user()->getPortfolioData();
        // dd($data);

        $total_return = [ 'total_return_percent' => 112.12, 'total_return_amount' => number_format($data['total_return'], 2, '.', ','), 'line' => [30,50,35,50,49,20,70,30,50] ];
        $past_day = [ 'past_day_percent' => 98.34, 'past_day_amount' => number_format($data['day_return'], 2, '.', ','), 'line' => [30,50,12,50,42,31,12,70,11] ];
        $net_deposite = ['net_deposite_amount' => number_format($data['net_deposits'], 2, '.', ',') ];
        $net_proceed = [ 'net_proceed_amount' => number_format($data['net_proceeds'], 2, '.', ',') ];

        return view('livewire.customer.portfolio.overview', [
            'total_return' => $total_return,
            'past_day' => $past_day,
            'net_deposite' => $net_deposite,
            'net_proceed' => $net_proceed
        ]);
    }
}
