<?php

namespace App\Http\Livewire\Customer\Portfolio;

use Livewire\Component;

class CryptoPortfolio extends Component
{
    public function render()
    {
        $portfolios = auth()->user()->myCryptoPortfolio();

        return view('livewire.customer.portfolio.crypto-portfolio', [
            'portfolios' => $portfolios
        ]);
    }
}
