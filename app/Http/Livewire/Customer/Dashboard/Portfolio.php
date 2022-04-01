<?php

namespace App\Http\Livewire\Customer\Dashboard;

use Livewire\Component;

class Portfolio extends Component
{
    public function render()
    {
        $portfolio = auth()->user()->myCryptoPortfolio();
        
        return view('livewire.customer.dashboard.portfolio', [
            'portfolio' => $portfolio
        ]);
    }
}
