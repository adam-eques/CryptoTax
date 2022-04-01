<?php

namespace App\Http\Livewire\Customer\Portfolio;

use Livewire\Component;

class Allocation extends Component
{
    public function render()
    {
        $portfolio = auth()->user()->myCryptoPortfolio();
        $data_name = array_column($portfolio, 'name');
        $data_percent = array_column($portfolio, 'percent');
        // dd(array_map(function($val) { return intval($val); }, $data_percent) );
        $chart_data = [
            'label' => $data_name,
            'value' => array_map(function($val) { return intval($val); }, $data_percent)
        ];

        return view('livewire.customer.portfolio.allocation', [
            'chart_data' => $chart_data
        ]);
    }
}
