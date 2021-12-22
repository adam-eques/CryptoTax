<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Http\Livewire\Admin\Resources\Resource;
use App\Models\User;

class CustomerResource extends Resource
{
    protected string $model = User::class;
    protected string $icon = "fas-users";


    public function label(): string
    {
        return __("Customer");
    }


    public function labelPlural(): string
    {
        return __("Customers");
    }
}
