<?php

namespace App\Http\Livewire\Customer\Portfolio;

use Livewire\Component;

class Overview extends Component
{
    public function render()
    {

        $total_return = [ 'total_return_percent' => 117.94, 'total_return_amount' => \number_format(2080, 0, '.', ','), 'line' => [30,50,35,50,49,20,70,30,50] ];
        $past_day = [ 'past_day_percent' => 117.94, 'past_day_amount' => \number_format(2080, 0, '.', ','), 'line' => [30,50,12,50,42,31,12,70,11] ];
        $net_deposite = [ 'net_deposite_percent' => 117.94, 'net_deposite_amount' => \number_format(12586, 0, '.', ',') ];
        $net_proceed = [ 'net_proceed_percent' => 117.94, 'net_proceed_amount' => \number_format(256569, 0, '.', ',') ];

        return view('livewire.customer.portfolio.overview', [
            'total_return' => $total_return,
            'past_day' => $past_day,
            'net_deposite' => $net_deposite,
            'net_proceed' => $net_proceed
        ]);
    }
}
