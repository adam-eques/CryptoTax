<?php

namespace App\CaravelAdmin\Resources\CryptoAccount;

use App\Models\CryptoAccount;
use WebCaravel\Admin\Resources\Resource;


class CryptoAccountResource extends Resource
{
    protected string $model = CryptoAccount::class;
    protected string $icon = "fas-shield-alt";


    public function label(): string
    {
        return __("Crypo exchange account");
    }


    public function labelPlural(): string
    {
        return __("Crypo exchange accounts");
    }
}
