<?php

namespace App\Http\Livewire\Customer\Portfolio;

use Livewire\Component;

class CryptoPortfolio extends Component
{
    public function render()
    {

        $portfolios = [ 
            [ 'name' => 'Bitcoin', 'short_name' => 'BTC', 'holding_price' => '$1663', 'holding_amount' => '0.2261929', 'price' => '$3156.85', 'unrealized' => '$699.12', 'unrealized_percent' => '23%' ],
            [ 'name' => 'Ethereum 2', 'short_name' => 'ETH2', 'holding_price' => '$1663', 'holding_amount' => '0.2261929', 'price' => '$3156.85', 'unrealized' => '$699.12', 'unrealized_percent' => '23%' ],
            [ 'name' => 'Ethereum', 'short_name' => 'ETH', 'holding_price' => '$1663', 'holding_amount' => '0.2261929', 'price' => '$3156.85', 'unrealized' => '$699.12', 'unrealized_percent' => '23%' ],
            [ 'name' => 'Ethereum 2', 'short_name' => 'ETH2', 'holding_price' => '$1663', 'holding_amount' => '0.2261929', 'price' => '$3156.85', 'unrealized' => '$699.12', 'unrealized_percent' => '23%' ]
        ];

        return view('livewire.customer.portfolio.crypto-portfolio', [
            'portfolios' => $portfolios
        ]);
    }
}
