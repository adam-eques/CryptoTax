<?php

namespace App\Models\Traits;

use App\Models\UserCreditLog;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property UserCreditLog $userCreditLog
 */
trait CreditActionMorphTrait
{
    public function userCreditLog(): MorphOne
    {
        return $this->morphOne(UserCreditLog::class, 'reference');
    }
}
