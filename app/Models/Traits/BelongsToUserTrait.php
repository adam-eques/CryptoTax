<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User $user
 */
trait BelongsToUserTrait
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
