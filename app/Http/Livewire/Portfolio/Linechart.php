<?php

namespace App\Http\Livewire\Portfolio;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Linechart extends Component
{
    public function render()
    {  
        return view('livewire.portfolio.linechart');
    }
}
