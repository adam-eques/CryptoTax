<?php

namespace App\Http\Livewire\Customer\Portfolio;

use Livewire\Component;
use \App\Models\CryptoTransaction;

class LineChart extends Component
{

    public?string $selected = null;
    public?array $lineYear = null;
    public?array $lineMonth = null;
    public?array $lineWeek = null;
    public?array $lineDay = null;

    public function mount()
    {
        $this->selected = 5;
        $this->lineYear = CryptoTransaction::getLineChartData('LINE_CHART_YEAR', 'USD');
        $this->lineMonth = CryptoTransaction::getLineChartData('LINE_CHART_MONTH', 'USD');
        $this->lineWeek = CryptoTransaction::getLineChartData('LINE_CHART_WEEK', 'USD');
        $this->lineDay = CryptoTransaction::getLineChartData('LINE_CHART_DAY', 'USD');
    }

    public function get_selected($id)
    {
        $this->selected = $id;
    }

    public function render()
    {
        $buttons = [
            [ 'id' => 0, 'name' => '1D' ],
            [ 'id' => 1, 'name' => '1W' ],
            [ 'id' => 2, 'name' => '1M' ],
            [ 'id' => 3, 'name' => '3M' ],
            [ 'id' => 4, 'name' => '1Y' ],
            [ 'id' => 5, 'name' => 'ALL' ],
        ];

        $line_data = [
            [
                'label' => array_keys($this->lineDay),
                'value' => array_values($this->lineDay),
            ],
            [
                'label' => array_keys($this->lineWeek),
                'value' => array_values($this->lineWeek),
            ],
            [
                'label' => array_keys($this->lineMonth),
                'value' => array_values($this->lineMonth),
            ],
            [
                'label' => ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
                'value' => [2341, 1242, 1542, 124, 1542, 5432, 1254, 6523, 2341, 1242, 1542, 124, 1542, 5432, 1254, 6523, 1542, 5432, 1254, 6523, 1254, 6523, 1542, 5432, 5432, 1254, 6523, 1254, 6523, 1542],

            ],
            [
                'label' => array_keys($this->lineYear),
                'value' => array_values($this->lineYear),
            ],
            [
                'label' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'value' => [2341, 1242, 1542, 124, 1542, 5432, 1254, 6523, 2341, 1242, 1542, 124],
            ]
        ];

        $this->emit("refresh-line-chart", [ 
            'line_data' => $line_data[$this->selected]
        ]);

        return view('livewire.customer.portfolio.line-chart', [
            'buttons' => $buttons,
            'line_data' => $line_data[$this->selected]
        ]);
    }
}
