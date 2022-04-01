<?php

namespace App\Http\Livewire\Customer\Portfolio;

use Livewire\Component;
use \App\Models\CryptoTransaction;

class LineChart extends Component
{
    public?array $lineData = null;
    public?string $selected = null;
    public function mount()
    {
        $this->lineData = auth()->user()->getPortfolioLineChart(CryptoTransaction::LINE_CHART_YEAR);
        $this->selected = 4;
    }

    public function get_selected($id)
    {
        $this->selected = $id;
    } 

    public function sec_to_date($miliSec, $type): string
    {
        $seconds = $miliSec/1000;
        $output = '';
        switch ($type) {
            case CryptoTransaction::LINE_CHART_DAY:
                $output = date("h", $seconds);
                break;
            case CryptoTransaction::LINE_CHART_WEEK:
                $output = date("d", $seconds);
                break;
            case CryptoTransaction::LINE_CHART_MONTH:
                $output = date("d", $seconds);
                break;
            case CryptoTransaction::LINE_CHART_YEAR:
                $output = date("m", $seconds);
                break;
            default:
                break;
        }
        return($output);
    }

    public function render()
    {
        $buttons = [
            [ 'id' => 0, 'name' => '1D', 'line' => CryptoTransaction::LINE_CHART_DAY],
            [ 'id' => 1, 'name' => '1W', 'line' => CryptoTransaction::LINE_CHART_WEEK ],
            [ 'id' => 2, 'name' => '1M', 'line' => CryptoTransaction::LINE_CHART_MONTH ],
            [ 'id' => 3, 'name' => '1Y', 'line' => CryptoTransaction::LINE_CHART_YEAR ],
            [ 'id' => 4, 'name' => 'ALL', 'line' => CryptoTransaction::LINE_CHART_YEAR ],
        ];

        $this->sec_to_date(162341345, "LINE_CHART_DAY");

        $this->lineData = auth()->user()->getPortfolioLineChart($buttons[$this->selected]['line']);


        $this->emit("refresh-line-chart", [ 
            'line_data' => [
                'label' => array_map(
                    function($val) use($buttons) 
                    { 
                        return $this->sec_to_date(intVal($val), $buttons[$this->selected]['line']) - 1; 
                    }, array_keys($this->lineData)
                ),
                'value' => array_values($this->lineData)
            ]
        ]);

        return view('livewire.customer.portfolio.line-chart', [
            'total_income' => number_format(auth()->user()->getPortfolioData()['total_income'], 2, '.', ','),
            'buttons' => $buttons,
            'line_data' =>  [
                'label' => array_map(
                    function($val) use($buttons) 
                    { 
                        return $this->sec_to_date(intVal($val), $buttons[$this->selected]['line']) - 1; 
                    }, array_keys($this->lineData)
                ),
                'value' =>  array_values($this->lineData)
            ]
        ]);
    }
}
