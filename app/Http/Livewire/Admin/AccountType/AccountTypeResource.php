<?php

namespace App\Http\Livewire\Admin\AccountType;

use App\Http\Livewire\Admin\Resources\Resource;
use App\Models\AccountType;
use App\Models\CryptoExchange;

class AccountTypeResource extends Resource
{
    protected string $model = AccountType::class;
    protected string $icon = "fas-user-circle";


    public function label(): string
    {
        return __("Account Type");
    }


    public function labelPlural(): string
    {
        return __("Account Types");
    }
}
