<?php

namespace App\Http\Livewire\Portfolio;

use App\Models\Expense;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

use Livewire\Component;

class Situation extends Component
{
    public $types = ['Sep11', 'Sep12', 'Sep13', 'Sep14', 'Sep15'];    

    public $firstRun = true;

    public $showDataLabels = false;
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
                ->setAnimated($this->firstRun)
                ->setSmoothCurve()
                ->setXAxisVisible(true)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->sparklined()
            );
        $this->firstRun = false;
        return view('livewire.portfolio.situation')
        ->with([
            'lineChartModel' => $lineChartModel,
        ]);;
    }
}
