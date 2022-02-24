<?php

namespace App\Models;

use App\Models\Traits\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 * @property int $blockchain_account_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 *
 * @property BlockchainAccount $blockchain
 * @property User $user
 */
class BlockchainTransaction extends Model
{
    use BelongsToUserTrait;

    const UPDATED_AT = null;


    public function blockchainAccount(): BelongsTo
    {
        return $this->belongsTo(BlockchainAccount::class);
    }
}
