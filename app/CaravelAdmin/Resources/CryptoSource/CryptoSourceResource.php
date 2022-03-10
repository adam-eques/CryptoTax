<?php

namespace App\CaravelAdmin\Resources\CryptoSource;

use App\Models\CryptoSource;
use WebCaravel\Admin\Resources\Resource;


class CryptoSourceResource extends Resource
{
    protected string $model = CryptoSource::class;
    protected string $icon = "fas-shield-alt";


    public function label(): string
    {
        return __("Crypo Source");
    }


    public function labelPlural(): string
    {
        return __("Crypo Sources");
    }
}
