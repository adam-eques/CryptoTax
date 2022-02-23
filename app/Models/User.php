<?php

namespace App\Models;

use App\Models\Traits\HasName;
use App\Services\CreditCodeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spark\Billable;
use Str;

/**
 * Class User
 *
 * @package App\Models
 *
 * @property int $user_account_type_id
 * @property int $datacenter_id
 * @property int $tax_year
 * @property string|null $fb_id
 * @property string|null $google_id
 *
 * @property \Illuminate\Support\Collection<CryptoExchangeAccount> $cryptoExchangeAccounts
 * @property \Illuminate\Support\Collection<BlockchainAccount> $blockchainAccounts
 * @property \Illuminate\Support\Collection<UserCreditLog> $creditLogs
 * @property \App\Models\UserAccountType $userAccountType
 * @property \App\Models\Datacenter $datacenter
 * @property \App\Models\Timezone $timezone
 * @property \App\Models\TaxCountry $taxCountry
 * @property \App\Models\TaxCurrency $taxCurrency
 * @property \App\Models\TaxCostModel $taxCostModel
 * @property \App\Models\UserAffiliate $userAffiliate
 * @property \Illuminate\Support\Collection<UserAffiliate> $userAffiliateRecruits
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasName;
    use Billable;

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
        'trial_ends_at' => 'datetime',
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

        static::created(function( self $item){
            // Add Register credits
            if($item->userAccountType->is_customer) {
                $item->creditAction(CreditCodeService::ACTION_REGISTER);
            }

            // Add user affiliate
            if (! $item->userAffiliate && in_array($item->user_account_type_id, UserAccountType::customerPanelTypes())) {
                $item->userAffiliate()->create([
                    "user_id" => $item->id
                ]);
            }
        });

        static::deleting(function (self $item) {
            $item->blockchainAccounts()->cascadeDelete();
            $item->cryptoExchangeAccounts()->cascadeDelete();
            $item->creditLogs()->cascadeDelete();
            $item->userAffiliate()->delete();
        });
    }


    public function scopeCustomersOnly(Builder $query): Builder
    {
        return $query->whereIn('user_account_type_id', UserAccountType::customerTypes());
    }


    public function userAccountType(): BelongsTo
    {
        return $this->belongsTo(UserAccountType::class);
    }


    public function creditLogs(): HasMany
    {
        return $this->hasMany(UserCreditLog::class);
    }


    public function userAffiliate(): HasOne
    {
        return $this->hasOne(UserAffiliate::class);
    }


    public function userAffiliateRecruits(): HasMany
    {
        return $this->hasMany(UserAffiliate::class, "recruited_by")->with("user");
    }


    public function datacenter(): BelongsTo
    {
        return $this->belongsTo(Datacenter::class);
    }


    public function cryptoExchangeAccounts(): HasMany
    {
        return $this->hasMany(CryptoExchangeAccount::class);
    }


    public function blockchainAccounts(): HasMany
    {
        return $this->hasMany(BlockchainAccount::class);
    }


    public function cryptoExchangeTransactions(): HasManyThrough
    {
        return $this->hasManyThrough(CryptoExchangeTransaction::class, CryptoExchangeAccount::class);
    }


    public function blockchainTransactions(): HasManyThrough
    {
        return $this->hasManyThrough(BlockchainTransaction::class, BlockchainAccount::class);
    }


    public function taxCostModel(): BelongsTo
    {
        return $this->belongsTo(TaxCostModel::class);
    }


    public function taxCurrency(): BelongsTo
    {
        return $this->belongsTo(TaxCurrency::class);
    }


    public function taxCountry(): BelongsTo
    {
        return $this->belongsTo(TaxCountry::class);
    }


    public function timezone(): BelongsTo
    {
        return $this->belongsTo(Timezone::class);
    }


    public function isAdminPanelAccount(): bool
    {
        return in_array($this->user_account_type_id, UserAccountType::adminPanelTypes());
    }


    public function isCustomerPanelAccount(): bool
    {
        return in_array($this->user_account_type_id, UserAccountType::customerPanelTypes());
    }


    public function isAdminAccount(): bool
    {
        return $this->user_account_type_id === UserAccountType::TYPE_ADMIN;
    }


    public function isCustomerAccount(): bool
    {
        return $this->userAccountType->is_customer;
    }


    public function isSupportAccount(): bool
    {
        return $this->user_account_type_id === UserAccountType::TYPE_SUPPORT;
    }


    public function isEditorAccount(): bool
    {
        return $this->user_account_type_id === UserAccountType::TYPE_EDITOR;
    }


    public function isTaxAdvisorAccount(): bool
    {
        return $this->user_account_type_id === UserAccountType::TYPE_TAX_ADVISOR;
    }


    public function isAffiliateAccount(): bool
    {
        return $this->user_account_type_id === UserAccountType::TYPE_AFFILIATE;
    }


    /**
     * Checks if the user has filled out all necessary data
     *
     * @return bool
     */
    public function setupFinished(): bool
    {
        return $this->timezone_id && $this->tax_cost_model_id && $this->tax_currency_id && $this->tax_country_id;
    }


    public function getName(): ?string
    {
        return $this->name . " (ID=" . $this->id . ")";
    }


    public function getAffiliateUrl(): ?string
    {
        return $this->userAffiliate?->getUrl();
    }


    public function creditAction(string|UserCreditAction $actionOrActionCode, ?float $value = null): self
    {
        // Get action and value
        if(is_string($actionOrActionCode)) {
            $action = UserCreditAction::findAction($actionOrActionCode);
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
