<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserAccountType;

class TaxAdvisorsController extends UserController
{
    protected string $routeSlug = "tax-advisor";
    protected string $label = "Advisor";
    protected string $labelPlural = "Advisors";

    protected function getAccountTypeIds(): array
    {
        return [
            UserAccountType::TYPE_TAX_ADVISOR,
        ];
    }
}
