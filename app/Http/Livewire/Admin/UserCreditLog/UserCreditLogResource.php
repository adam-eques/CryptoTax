<?php

namespace App\Http\Livewire\Admin\UserCreditLog;

use App\Http\Livewire\Admin\Resources\Resource;
use App\Models\UserCreditLog;

class UserCreditLogResource extends Resource
{
    protected string $model = UserCreditLog::class;
    protected string $icon = "fas-money-bill-alt";


    public function label(): string
    {
        return __("Credit action");
    }


    public function labelPlural(): string
    {
        return __("Credit actions");
    }
}
