<?php

namespace App\Http\Livewire\UserSetting;

use Livewire\Component;

use App\Models\Timezone;
use App\Models\TaxCountry;
use App\Models\TaxCurrency;
use App\Models\TaxCostModel;
use App\Models\User;

use WireUi\Traits\Actions;

class Tax extends Component
{
    use Actions;

    public?int $timezone_id = null;
    public?int $tax_country_id = null;
    public?int $tax_currency_id = null;
    public?int $tax_cost_model_id = null;

    protected $rules = [
        'timezone_id' => ['required', "regex:/^[1-9]\d*$/"],
        'tax_country_id' => ['required', "regex:/^[1-9]\d*$/"],
        'tax_currency_id' => ['required', "regex:/^[1-9]\d*$/"],
        'tax_cost_model_id' => ['required', "regex:/^[1-9]\d*$/"],
    ];

    public function mount()
    {
        $this->timezone_id = auth()->user()->timezone ? auth()->user()->timezone->id:0;
        $this->tax_country_id = auth()->user()->taxCountry ? auth()->user()->taxCountry->id:0;
        $this->tax_currency_id = auth()->user()->taxCountry ? auth()->user()->taxCurrency->id:0;
        $this->tax_cost_model_id = auth()->user()->taxCostModel ? auth()->user()->taxCostModel->id:0;
    }

    public function submit()
    {
        $this->validate();
        $user = auth()->user();
        if( $this->timezone_id && $this->tax_country_id && $this->tax_currency_id && $this->tax_cost_model_id )   
        {
            $user-> timezone_id = $this->timezone_id;
            $user-> tax_country_id = $this->tax_country_id;
            $user-> tax_currency_id = $this->tax_currency_id;
            $user-> tax_cost_model_id = $this->tax_cost_model_id;
            $user->save();
            $this->notification()->success(
                $title = __('Successfully Saved'),
                $description = ''
            );
        }
        else
        {
            $this->notification()->success(
                $title = __('Please select all options'),
                $description = ''
            );
        }
    }

    public function render()
    {
        $timezone = Timezone::query() -> get();
        $tax_countries = TaxCountry::query() -> get();
        $basic_currency = TaxCurrency::query() -> get();
        $basic_cost_method = TaxCostModel::query() -> get();

        return view('livewire.user-setting.tax', [
            'timezone' => $timezone,
            'tax_countries' => $tax_countries,
            'basic_currency' => $basic_currency,
            'basic_cost_method' => $basic_cost_method
        ]);
    }
}
