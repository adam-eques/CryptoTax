<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserCreditLog;
use ReflectionClass;

class CreditCodeService
{
    const ACTION_REGISTER = "REGI";
    const ACTION_ADD_PREMIUM_MONTH = "PREM";
    const ACTION_ADD_PREMIUM_YEAR = "PREY";
    const ACTION_BUY_CREDITS = "BUYC";
    const ACTION_AFFILIATE_L1 = "AFF1";
    const ACTION_AFFILIATE_L2 = "AFF2";


    public static function allActions(): array
    {
        $ref = new ReflectionClass(self::class);
        $array = $ref->getConstants();

        return array_filter($array, function ($val) {
            return str_starts_with($val, "ACTION_");
        }, ARRAY_FILTER_USE_KEY);
    }


    public static function allActionsForSelect(): array
    {
        $array = array_flip(static::allActions());
        array_walk($array, function(&$val, $key) {
            $val = str_replace("_", " ", \Str::title(substr($val, 7)));
        });
        asort($array);

        return $array;
    }


    public static function getLabel(string $action_code)
    {
        $array = static::allActionsForSelect();

        return $array[$action_code];
    }
}
