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
        return $this->user_account_type_id === UserAccountType::TYPE_CUSTOMER;
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

    /**
     * @return string
     */
    public function getRouteSlug(): string
    {
        switch($this->user_account_type_id) {
            case UserAccountType::TYPE_ADMIN:
            case UserAccountType::TYPE_SUPPORT:
            case UserAccountType::TYPE_EDITOR:
                return 'backenduser';
            case UserAccountType::TYPE_TAX_ADVISOR:
                return 'tax-advisors';
            default:
            case UserAccountType::TYPE_CUSTOMER:
                return 'customers';
        }
    }
}
