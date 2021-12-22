<?php

namespace App\Http\Livewire\Admin\CryptoExchange;

use App\Http\Livewire\Admin\Resources\Resource;
use App\Models\CryptoExchange;

class CryptoExchangeResource extends Resource
{
    protected string $model = CryptoExchange::class;
    protected string $icon = "fas-shield-alt";


    public function label(): string
    {
        return __("Crypo exchange");
    }


    public function labelPlural(): string
    {
        return __("Crypo exchanges");
    }
}
