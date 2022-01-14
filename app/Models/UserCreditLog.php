<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCreditLog extends Model
{
    const UPDATED_AT = null;


    public static function log(int $userId, string $actionCode, float $value): self
    {
        $obj = self::make([
            'user_id' => $userId,
            'action_code' => $actionCode,
            'value' => $value
        ]);
        $obj->save();

        return $obj;
    }
}
