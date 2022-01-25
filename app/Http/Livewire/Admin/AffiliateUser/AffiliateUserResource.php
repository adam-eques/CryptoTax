<?php

namespace App\Http\Livewire\Admin\AffiliateUser;

use App\Http\Livewire\Admin\Resources\Resource;
use App\Models\User;

class AffiliateUserResource extends Resource
{
    protected string $model = User::class;
    protected string $icon = "fas-hand-holding-usd";


    public function label(): string
    {
        return __("Affiliate User");
    }


    public function labelPlural(): string
    {
        return __("Affiliate Users");
    }
}
