<?php

namespace App\Http\Livewire\Admin\UserCreditAction;

use App\Http\Livewire\Admin\Resources\Resource;
use App\Models\UserCreditAction;

class UserCreditActionResource extends Resource
{
    protected string $model = UserCreditAction::class;
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
