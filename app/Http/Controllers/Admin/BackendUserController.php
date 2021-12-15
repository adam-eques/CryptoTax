<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserAccountType;

class BackendUserController extends UserController
{
    protected string $routeSlug = "backenduser";
    protected string $label = "Backenduser";
    protected string $labelPlural = "Backendusers";

    protected function getAccountTypeIds(): array
    {
        return [
            UserAccountType::TYPE_ADMIN,
            UserAccountType::TYPE_EDITOR,
            UserAccountType::TYPE_SUPPORT,
        ];
    }
}
