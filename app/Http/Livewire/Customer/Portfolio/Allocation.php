<?php

namespace App\Http\Livewire\Customer\Portfolio;

use Livewire\Component;

class Allocation extends Component
{
    public function render()
    {
        $chart_data = [
            'label' => [ 'Bitcoin', 'Ethereum ', 'Ripple', 'Litecoin', 'Ethereum', 'Ripple' ],
            'value' => [ 44, 12, 13, 24, 32, 45 ]
        ];

        return view('livewire.customer.portfolio.allocation', [
            'chart_data' => $chart_data
        ]);
    }
}
