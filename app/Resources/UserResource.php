<?php

namespace App\Resources;

use App\Http\Livewire\Admin\Resources\Resource;
use App\Models\User;

class UserResource extends Resource
{
    protected string $model = User::class;
    protected string $icon = "fas-user-tie";


    public function label(): string
    {
        return __("Benutzer");
    }


    public function labelPlural(): string
    {
        return __("Benutzer");
    }
}
