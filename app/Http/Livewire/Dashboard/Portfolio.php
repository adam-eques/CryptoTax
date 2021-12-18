<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Portfolio extends Component
{
    public function render()
    {
        $portfolio = [
            [
                'id' => 'bitcoin',
                'name' => 'Bitcoin',
                'type' => 'BIT',
                'price' => '$ 69,729.64',
                'line' => [],
                'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '$ 4,886.64' ],
                'percentage' => 56,
                'pnl' => [ 'price' => '$ 89,402.19', 'percent' => 10 ],
                'child' => [
                    [
                        'id' => 'bitcoin_1',
                        'name' => 'Bitcoin',
                        'type' => 'BIT',
                        'price' => '$ 69,729.64',
                        'line' => [],
                        'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '$ 4,886.64' ],
                        'percentage' => 56,
                        'pnl' => [ 'price' => '$ 89,402.19', 'percent' => 10 ],
                    ],
                    [
                        'id' => 'bitcoin_2',
                        'name' => 'Bitcoin',
                        'type' => 'BIT',
                        'price' => '$ 69,729.64',
                        'line' => [],
                        'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '$ 4,886.64' ],
                        'percentage' => 56,
                        'pnl' => [ 'price' => '$ 89,402.19', 'percent' => 10 ],
                    ],

                ]
            ],
            [
                'id' => 'litecoin',
                'name' => 'Lite Coin',
                'type' => 'BIT',
                'price' => '$ 69,729.64',
                'line' => [],
                'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '$ 4,886.64' ],
                'percentage' => 56,
                'pnl' => [ 'price' => '$ 89,402.19', 'percent' => 10 ],
                'child' => []
            ],
            [
                'id' => 'tether',
                'name' => 'Tether',
                'type' => 'USDT',
                'price' => '$ 69,729.64',
                'line' => [],
                'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '$ 4,886.64' ],
                'percentage' => 56,
                'pnl' => [ 'price' => '$ 89,402.19', 'percent' => 10 ],
                'child' => []
            ],
            [
                'id' => 'ethereum',
                'name' => 'Ethereum',
                'type' => 'BIT',
                'price' => '$ 69,729.64',
                'line' => [],
                'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '$ 4,886.64' ],
                'percentage' => 56,
                'pnl' => [ 'price' => '$ 89,402.19', 'percent' => 10 ],
                'child' => []
            ],
        ];
        return view('livewire.dashboard.portfolio') -> with( 'portfolio', $portfolio );
    }
}
