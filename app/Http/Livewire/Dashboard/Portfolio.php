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
                'icon' => 'bitcoin',
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
                        'icon' => 'karaken',
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
                        'icon' => 'binance',
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
                'icon' => 'litecoin',
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
                'icon' => 'tether',
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
                'icon' => 'ethereum',
                'child' => [
                    
                ]
            ],
        ];
        return view('livewire.dashboard.portfolio') -> with( 'portfolio', $portfolio );
    }
}
