<?php

namespace App\Resources;


use App\Models\Role;

class RoleResource extends Resource
{
    protected string $model = Role::class;
    protected string $icon = "fas-shield-alt";


    public function label(): string
    {
        return __("Rechte & Rolle");
    }


    public function labelPlural(): string
    {
        return __("Rechte & Rollen");
    }
}
