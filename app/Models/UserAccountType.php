<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccountType extends Model
{
    const TYPE_ADMIN = 1;
    const TYPE_CUSTOMER = 2;
    const TYPE_TAX_ADVISOR = 3;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }
}
