<?php

namespace App\Http\Livewire\Portfolio;

use App\Models\Expense;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

use Livewire\Component;

class Allocation extends Component
{
    public $types = ['Sep12', 'Sep13', 'Sep14', 'Sep15'];

    public $colors = [
        'Sep12' => '#da31ca',
        'Sep13' => '#2c98d6',
        'Sep14' => '#5a5a5a',
        'Sep15' => '#ffab2e',
    ];

    public $firstRun = true;

    public $showDataLabels = false;

    public function render()
    {
        $expenses = Expense::whereIn('type', $this->types)->get();
        $pieChartModel = $expenses->groupBy('type')
            ->reduce(function ($pieChartModel, $data) {
                $type = $data->first()->type;
                $value = $data->sum('amount');

                return $pieChartModel->addSlice($type, $value, $this->colors[$type]);
            }, LivewireCharts::pieChartModel()
                ->setTitle('Expenses by Type')
                ->setAnimated($this->firstRun)
                ->withLegend()
                ->legendPositionRight()
                ->legendHorizontallyAlignedCenter()
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors(['#da31ca', '#2c98d6', '#5a5a5a', '#ffab2e'])
            );
        return view('livewire.portfolio.allocation')->with([
            'pieChartModel' => $pieChartModel
        ]);
    }
}
