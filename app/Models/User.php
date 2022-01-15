<?php

namespace App\Models;

use App\Models\Traits\HasName;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @package App\Models
 *
 * @property int $user_account_type_id
 *
 *
 * @property \Illuminate\Support\Collection<CryptoExchangeAccount> $cryptoExchangeAccounts
 * @property \Illuminate\Support\Collection<Blockchain> $blockchains
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasName;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function (self $item) {
            if (! $item->user_account_type_id) {
                $item->user_account_type_id = UserAccountType::TYPE_CUSTOMER_FREE;
            }
        });

        static::deleting(function (self $item) {
            $item->blockchains()->delete();
            $item->cryptoExchangeAccounts()->delete();
        });
    }


    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCustomersOnly(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->whereIn('user_account_type_id', UserAccountType::customerTypes());
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userAccountType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserAccountType::class);
    }


    /**
     * @return HasMany
     */
    public function cryptoExchangeAccounts(): HasMany
    {
        return $this->hasMany(CryptoExchangeAccount::class);
    }


    /**
     * @return HasMany
     */
    public function blockchains(): HasMany
    {
        return $this->hasMany(Blockchain::class);
    }


    /**
     * @return HasManyThrough
     */
    public function blockchainAssets(): HasManyThrough
    {
        return $this->hasManyThrough(BlockchainAsset::class, Blockchain::class);
    }


    /**
     * @return HasManyThrough
     */
    public function cryptoExchangeTransactions(): HasManyThrough
    {
        return $this->hasManyThrough(CryptoExchangeTransaction::class, CryptoExchangeAccount::class);
    }


    /**
     * @return bool
     */
    public function isAdminAccount(): bool
    {
        return $this->user_account_type_id === UserAccountType::TYPE_ADMIN;
    }


    /**
     * @return bool
     */
    public function isCustomerAccount(): bool
    {
        return $this->userAccountType->is_customer;
    }


    /**
     * @return bool
     */
    public function isSupportAccount(): bool
    {
        return $this->user_account_type_id === UserAccountType::TYPE_SUPPORT;
    }


    /**
     * @return bool
     */
    public function isEditorAccount(): bool
    {
        return $this->user_account_type_id === UserAccountType::TYPE_EDITOR;
    }


    /**
     * @return bool
     */
    public function isTaxAdvisorAccount(): bool
    {
        return $this->user_account_type_id === UserAccountType::TYPE_TAX_ADVISOR;
    }


    public function creditAction(string|UserCreditAction $actionOrActionCode, ?float $value = null): self
    {
        // Get action and value
        if(is_string($actionOrActionCode)) {
            $action = UserCreditAction::query()
                ->where("action_code", $actionOrActionCode)
                ->firstOrFail();
        }
        else {
            $action = $actionOrActionCode;
        }
        $value = !is_null($value) ? $value : $action->value;

        // Log it and add it to user table
        UserCreditLog::log($this->id, $value, $action->action_code, $action->id);
        $this->credits += $value;
        $this->save();

        return $this;
    }
}
