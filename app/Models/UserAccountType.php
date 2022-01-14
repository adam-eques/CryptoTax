<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccountType extends Model
{
    const TYPE_ADMIN = 1;
    const TYPE_CUSTOMER_FREE = 2;
    const TYPE_TAX_ADVISOR = 3;
    const TYPE_SUPPORT = 4;
    const TYPE_EDITOR = 5;
    const TYPE_CUSTOMER_PREMIUM = 6;

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }


    /**
     * @return int[]
     */
    public static function customerTypes(): array
    {
        return [
            self::TYPE_CUSTOMER_FREE,
            self::TYPE_CUSTOMER_PREMIUM,
        ];
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
