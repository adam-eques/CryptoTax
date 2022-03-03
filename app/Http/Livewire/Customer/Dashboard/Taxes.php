<?php

namespace App\Http\Livewire\Customer\Dashboard;

use Livewire\Component;

class Taxes extends Component
{
    public function render()
    {
        $table = [
            [ 'year' => '2021', 'gains' => number_format(2456.00, 2, '.', ','), 'income' => number_format(16593.00, 2, '.', ',') ],
            [ 'year' => '2020', 'gains' => number_format(1234.00, 2, '.', ','), 'income' => number_format(16722.00, 2, '.', ',') ],
            [ 'year' => '2019', 'gains' => number_format(5432.00, 2, '.', ','), 'income' => number_format(13234.00, 2, '.', ',') ],
        ];

        return view('livewire.customer.dashboard.taxes', [
            'table' => $table
        ]);
    }
}
