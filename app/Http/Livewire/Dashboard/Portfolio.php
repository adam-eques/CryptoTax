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
                'icon' => [ 'color' => '#F4942D' ],
                'child' => [
                    [
                        'id' => 'kraken',
                        'name' => 'Kraken',
                        'type' => 'KCS',
                        'price' => '$ 36,729.64',
                        'line' => [],
                        'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '$ 4,886.64' ],
                        'percentage' => 26,
                        'pnl' => [ 'price' => '$ 9,402.19', 'percent' => 10 ],
                        'icon' => [ 'color' => '#5841D8' ]
                    ],
                    [
                        'id' => 'binance',
                        'name' => 'Binance coin',
                        'type' => 'BNB',
                        'price' => '$ 36,729.64',
                        'line' => [],
                        'holding' => [ 'btc' => '0.1002365 BTC', 'usd' => '$ 4,886.64' ],
                        'percentage' => 56,
                        'pnl' => [ 'price' => '$ 9,402.19', 'percent' => 10 ],
                        'icon' => [ 'color' => '#E79934' ],
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
                'icon' => [ 'color' => '#C1C1C1' ],
                'child' => [
                  
                ]
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
                'icon' => [ 'color' => '#3DA479' ],
                'child' => [
                  
                ]
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
                'icon' => [ 'color' => '#F4942D' ],
                'child' => [
                    
                ]
            ],
        ];
        return view('livewire.dashboard.portfolio') -> with( 'portfolio', $portfolio );
    }
}
