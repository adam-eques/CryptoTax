<?php

namespace App\CaravelAdmin\Resources\CryptoExchangeAccount;

use App\Models\CryptoExchangeAccount;
use WebCaravel\Admin\Resources\Resource;


class CryptoExchangeAccountResource extends Resource
{
    protected string $model = CryptoExchangeAccount::class;
    protected string $icon = "fas-shield-alt";


    public function label(): string
    {
        return __("Crypo exchange");
    }


    public function labelPlural(): string
    {
        return __("Crypo exchanges");
    }
}
