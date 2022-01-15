<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCreditAction extends Model
{
    const UPDATED_AT = null;
    protected $guarded = [];

    public function getName(): string
    {
        return $this->name;
    }
}
