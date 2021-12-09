<?php

namespace App\Http\Livewire\Portfolio;

use App\Models\Expense;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

use Livewire\Component;

class Linechart extends Component
{
    public $types = ['Sep 11', 'Sep 12', 'Sep 13', 'Sep 14', 'Sep 15'];

    public $firstRun = true;

    public $showDataLabels = false;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
    ];

    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }
    public function render()
    {
        $expenses = Expense::whereIn('type', $this->types)->get();
        $lineChartModel = $expenses
        ->reduce(function ($lineChartModel, $data) use ($expenses) {
            $index = $expenses->search($data);

            $amountSum = $expenses->take($index + 1)->sum('amount');

            if ($index == 6) {
                $lineChartModel->addMarker(7, $amountSum);
            }

            if ($index == 11) {
                $lineChartModel->addMarker(12, $amountSum);
            }

            return $lineChartModel->addPoint($index, $data->amount, ['id' => $data->id]);
        }, LivewireCharts::lineChartModel()
            //->setTitle('Expenses Evolution')
            ->setAnimated($this->firstRun)
            ->withOnPointClickEvent('onPointClick')
            ->setSmoothCurve()
            ->setXAxisVisible(true)
            ->setDataLabelsEnabled($this->showDataLabels)
            ->sparklined()
            ->withGrid()
        );

        $this->firstRun = false;

        return view('livewire.portfolio.linechart')-> with([
            'lineChartModel' => $lineChartModel,
        ]);
    }
}
