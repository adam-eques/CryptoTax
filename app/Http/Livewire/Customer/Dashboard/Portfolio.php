<?php

namespace App\Http\Livewire\Customer\Dashboard;

use Livewire\Component;

class Portfolio extends Component
{
    public function render()
    {
        $portfolio = [
            [
                'id' => 1, 'icon' => 'coins.btc', 'name' => 'Bitcoin', 'type' => 'BIT', 'lineColor' =>'#FF0303', 'price' => '$69,729.64',
                'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '4,886.64' ], 'percentage' => 56,
                'pnl' => [ 'price' => '$89,402.19', 'percent' => 10 ], 
                'line' => [10,30,12, 56,10,34,70,30,50,123,89,70,231,110,50],
                'child' => [
                    [
                        'id' => 3, 'icon' => 'coins.eth', 'name' => 'Bitcoin', 'type' => 'BIT', 'lineColor' =>'#FF0303', 'price' => '$69,729.64',
                        'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '4,886.64' ], 'percentage' => 56,
                        'pnl' => [ 'price' => '$89,402.19', 'percent' => 10 ],
                        'line' => [10,23,67, 22,4,24,12,34,12,123,32,70,125,235,50]
                    ]
                ]
            ],
            [
                'id' => 2, 'icon' => 'coins.anc', 'name' => 'Bitcoin', 'type' => 'BIT', 'lineColor' =>'#1DB737', 'price' => '$69,729.64',
                'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '4,886.64' ], 'percentage' => 56,
                'pnl' => [ 'price' => '$89,402.19', 'percent' => 10 ], 
                'line' => [10,30,12, 24,56,34,124,30,231,123,89,12,35,23,50],
                'child' => []
            ]
        ];
        return view('livewire.customer.dashboard.portfolio', [
            'portfolio' => $portfolio
        ]);
    }
}
