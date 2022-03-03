<?php

namespace App\Http\Livewire\Customer\Dashboard;

use Livewire\Component;

class Performance extends Component
{
    public ?string $selected_category = null;
    public ?int $selected_top_coin = null;

    function mount(){
        $this->selected_category = 'year';
        $this->selected_top_coin = 5;
    }

    public function select_category($item)
    {
        $this->selected_category = $item;
    }

    public function render()
    {
        $line_chart = [
            'year' => [
                'label' => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
                'value' => array(30, 50, 67, 23, 45, 78, 123, 56, 23, 102, 34, 78)
            ],
            'month' => [
                'label' => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18' ),
                'value' => array(30, 50, 67, 23, 45, 78, 123, 56, 23, 102, 34, 78, 103, 234, 34, 23, 45, 56)
            ],
            'week' => [
                'label' => array( 'Mon', 'Tue', 'Thu', 'Wed', 'Fri', 'Sat', 'Sun' ),
                'value' => array(30, 50, 67, 23, 45, 78, 123)
            ],
            'day' => [
                'label' => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24' ),
                'value' => array(30, 50, 67, 23, 45, 78, 123, 56, 23, 102, 34, 78, 103, 234, 34, 23, 45, 56, 78, 123, 56, 23, 102, 34)
            ],
        ];

        //Over View Section
        $over_view = [
            [ 'id' => 'status_1', 'category' => '24h Portfolio Change', 'balance' => number_format(1254, 0, '.', ','), 'increase' => false, 'incdec_percent' => 2.4, 'line' => [143,24,34,123,23,25,100,91,23, 129] ],
            [ 'id' => 'status_2', 'category' => 'Total profit loss', 'balance' => number_format(1342, 0, '.', ','), 'increase' => true, 'incdec_percent' => 0.6, 'line' => [23,124,32,32,56,25,12,91,23]  ],
            [ 'id' => 'status_3', 'category' => '24h Portfolio Change', 'balance' => number_format(3452, 0, '.', ','), 'increase' => false, 'incdec_percent' => 1.4, 'line' => [143,13,45,28,23,25,46,123,23]  ],
        ];

        //Top coins
        $top_coin = [     
            'label' => ['Litecoin', 'Bitcoin', 'Ripple', 'Kraken', 'Kucoin', 'Litecoin', 'Bitcoin', 'Ripple', 'Kraken', 'Kucoin'], 
            'value' => [213.3, 123.1, 154.0, 234.1, 312.0, 123.1, 154.0, 234.1, 312.0, 234.3] 
        ];
        
        $this->emit("refresh-line-chart", [ 
            'line_chart' => $line_chart[$this->selected_category],
            'top_coins' => [
                'label' => array_slice($top_coin['label'], 0, $this->selected_top_coin, true),
                'value' => array_slice($top_coin['value'], 0, $this->selected_top_coin, true)
            ] 
        ]);


        return view('livewire.customer.dashboard.performance', [
            'line_chart' => $line_chart[$this->selected_category],
            'over_view' => $over_view,
            'top_coins' => [
                'label' => array_slice($top_coin['label'], 0, 5, true),
                'value' => array_slice($top_coin['value'], 0, 5, true)
            ] 
        ]);
    }
}
