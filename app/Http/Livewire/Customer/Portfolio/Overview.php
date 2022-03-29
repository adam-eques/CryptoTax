<?php

namespace App\Http\Livewire\Customer\Portfolio;

use Livewire\Component;

class Overview extends Component
{
    public function render()
    {
        $total_values = \App\Models\CryptoTransaction::getCurrentTotal('USD');

        $total_return = [ 'total_return_percent' => number_format($total_values['mwr'], 2), 'total_return_amount' => number_format($total_values['total_return'], 0, '.', ','), 'line' => [30,50,35,50,49,20,70,30,50] ];
        $past_day = [ 'past_day_percent' => number_format($total_values['past_mwr'], 2), 'past_day_amount' => number_format($total_values['past_day'], 0, '.', ','), 'line' => [30,50,12,50,42,31,12,70,11] ];
        $net_deposite = ['net_deposite_amount' => number_format($total_values['net_deposits'], 0, '.', ',') ];
        $net_proceed = [ 'net_proceed_amount' => number_format($total_values['net_proceeds'], 0, '.', ',') ];

        return view('livewire.customer.portfolio.overview', [
            'total_return' => $total_return,
            'past_day' => $past_day,
            'net_deposite' => $net_deposite,
            'net_proceed' => $net_proceed
        ]);
    }
}
