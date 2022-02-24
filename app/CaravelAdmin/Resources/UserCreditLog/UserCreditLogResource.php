<?php

namespace App\CaravelAdmin\Resources\UserCreditLog;

use WebCaravel\Admin\Resources\Resource;
use App\Models\UserCreditLog;


class UserCreditLogResource extends Resource
{
    protected string $model = UserCreditLog::class;
    protected string $icon = "fas-table";


    public function label(): string
    {
        return __("Credit log");
    }


    public function labelPlural(): string
    {
        return __("Credit logs");
    }
}
