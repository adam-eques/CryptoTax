<?php

namespace App\Services;

use ReflectionClass;

class CreditCodeService
{
    const ACTION_REGISTER = "REGI";
    const ACTION_SUBSCRIBE_ACCOUNT_TYPE = "SUBA";


    public static function allActions(): array
    {
        $ref = new ReflectionClass(self::class);
        $array = $ref->getConstants();

        return array_filter($array, function ($val) {
            return str_starts_with($val, "ACTION_");
        }, ARRAY_FILTER_USE_KEY);
    }
}
