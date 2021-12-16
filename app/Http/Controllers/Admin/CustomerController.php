<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserAccountType;

class CustomerController extends UserController
{
    protected string $routeSlug = "customers";
    protected string $label = "Customer";
    protected string $labelPlural = "Customers";

    protected function getAccountTypeIds(): array
    {
        return [
            UserAccountType::TYPE_CUSTOMER,
        ];
    }
}
