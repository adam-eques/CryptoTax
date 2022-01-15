<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCreditLog extends Model
{
    const UPDATED_AT = null;


    public static function log(int $userId, float $value, string $actionCode, ?int $actionId = null): self
    {
        $obj = self::make([
            'user_id' => $userId,
            'user_credit_action_id' => $actionId,
            'action_code' => $actionCode,
            'value' => $value
        ]);
        $obj->save();

        return $obj;
    }
}
