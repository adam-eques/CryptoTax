<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \App\Models\User $user
 */
class UserAffiliate extends Model
{

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $item) {
            $item->hash = $item->hash ?: \Str::uuid()->toString();
        });
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
