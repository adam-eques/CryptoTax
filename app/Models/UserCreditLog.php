<?php

namespace App\Models;

use App\Models\Traits\BelongsToUserTrait;
use App\Models\Traits\CreditActionMorphTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property UserCreditAction $action
 * @property Model $reference
 */
class UserCreditLog extends Model
{
    use BelongsToUserTrait, CreditActionMorphTrait;

    const UPDATED_AT = null;


    public function action(): BelongsTo
    {
        return $this->belongsTo(UserCreditAction::class, "user_credit_action_id");
    }


    public function reference(): MorphTo
    {
        return $this->morphTo();
    }


    public function getName(): string
    {
        return "#" . $this->id . ": "  . $this->action_code . " " . $this->created_at->format("Y-m-d H:i:s");
    }


    public static function log(int $userId, float $value, string $actionCode, ?int $actionId, ?Model $reference, Carbon|null $createdAt = null): self
    {
        $createdAt = $createdAt ?: now();
        $obj = self::make([
            'user_id' => $userId,
            'user_credit_action_id' => $actionId,
            'action_code' => $actionCode,
            'value' => $value,
            'reference_id' => optional($reference)->id,
            'reference_type' => optional($reference)->getMorphClass(),
            'created_at' => $createdAt
        ]);
        $obj->save();

        return $obj;
    }
}
