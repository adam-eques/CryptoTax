<?php

namespace App\Models;

use App\Models\Traits\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \App\Models\User $recruitedBy
 */
class UserAffiliate extends Model
{
    use BelongsToUserTrait;


    public static function boot()
    {
        parent::boot();

        static::creating(function (self $item) {
            $item->hash = $item->hash ?: \Str::uuid()->toString();
        });
    }


    public function recruitedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "recruited_by");
    }


    public function getUrl(): string
    {
        return url('affili', $this->hash);
    }
}
