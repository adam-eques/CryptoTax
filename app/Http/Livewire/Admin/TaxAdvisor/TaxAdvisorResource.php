<?php

namespace App\Http\Livewire\Admin\TaxAdvisor;

use App\Http\Livewire\Admin\Resources\Resource;
use App\Models\User;

class TaxAdvisorResource extends Resource
{
    protected string $model = User::class;
    protected string $icon = "advisor";


    public function label(): string
    {
        return __("Tax Advisor");
    }


    public function labelPlural(): string
    {
        return __("Tax Advisors");
    }
}
