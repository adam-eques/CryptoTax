<?php

namespace App\Http\Livewire\Customer\Dashboard;

use Livewire\Component;

class Performance extends Component
{
    public ?string $selected_category = null;

    function mount(){
        $this->selected_category = 'year';
    }

    public function select_category($item)
    {
        $this->selected_category = $item;
    }

    public function render()
    {
        $label = [
            'year' => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
            'month' => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18' ),
            'week' => array( 'Mon', 'Tue', 'Thu', 'Wed', 'Fri', 'Sat', 'Sun' ),
            'day' => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24' ),
        ];

        $this->emit("refresh-line-chart", [ 'label' => $label[$this->selected_category] ]);

        return view('livewire.customer.dashboard.performance', [
            'label' => $label[$this->selected_category]
        ]);
    }
}
