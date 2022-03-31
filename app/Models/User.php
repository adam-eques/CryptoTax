<?php

namespace App\Models;

use App\Models\Traits\HasName;
use App\Services\CreditCodeService;
use App\Settings\AffiliateSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
use Carbon\Carbon;
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
 * @property \Illuminate\Support\Collection<CryptoAccount> $cryptoAccounts
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
            $item->cryptoAccounts()->cascadeDelete();
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


    public function cryptoAccounts(): HasMany
    {
        return $this->hasMany(CryptoAccount::class);
    }


    public function cryptoTransactions(): HasManyThrough
    {
        return $this->hasManyThrough(CryptoTransaction::class, CryptoAccount::class);
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


    protected function giveAffiliateRecruiterCredits(UserCreditLog $log, int $level = 1): self
    {
        if(optional($this->userAffiliate)->recruitedBy) {
            $recruitedBy = $this->userAffiliate->recruitedBy;
            $settings = app(AffiliateSetting::class);
            $lifetime = $level === 1 ? $settings->first_level_lifetime : $settings->second_level_lifetime;

            if($this->created_at->addMonths($lifetime)->isFuture()) {
                $actionCode = $level === 1 ? CreditCodeService::ACTION_AFFILIATE_L1 : CreditCodeService::ACTION_AFFILIATE_L2;
                $action = UserCreditAction::findAction($actionCode);
                $credits = round($log->value * $action->value / 100, 2);
                $recruitedBy->creditAction($actionCode, $log, $credits);
            }

            // Also give level 2 recruiter credits
            if($level === 1) {
                $recruitedBy->giveAffiliateRecruiterCredits($log, 2);
            }
        }

        return $this;
    }


    public function buyCredits(string|UserCreditAction $actionOrActionCode): self
    {
        // Get action and value
        if(is_string($actionOrActionCode)) {
            $action = UserCreditAction::findAction($actionOrActionCode);
        }
        else {
            $action = $actionOrActionCode;
        }

        // Credits action and affiliate stuff
        \DB::beginTransaction();
        $log = $this->creditAction($action);
        $this->giveAffiliateRecruiterCredits($log);
        \DB::commit();

        return $this;
    }


    public function creditAction(string|UserCreditAction $actionOrActionCode, ?Model $reference = null, ?float $value = null): UserCreditLog
    {
        // Get action and value
        if(is_string($actionOrActionCode)) {
            $action = UserCreditAction::findAction($actionOrActionCode);
        }
        else {
            $action = $actionOrActionCode;
        }

        // Get value
        $value = !is_null($value) ? $value : $action->value;

        // Log it and add it to user table
        $log = UserCreditLog::log($this->id, $value, $action->action_code, $action->id, $reference);

        // Add credits and save
        $this->credits += $value;
        $this->save();

        return $log;
    }

    public function getPortfolioData($fiat="USD") {
        $accounts = $this->cryptoAccounts()->get(["id"]);
        $accountIds = [];
        foreach ($accounts as $account) {
            array_push($accountIds, $account->id);
        }
        return CryptoTransaction::getTotal($accountIds, Carbon::now(), $fiat);
    }

    public function getPortfolioLineChart($type=CryptoTransaction::LINE_CHART_YEAR, $fiat="EUR") {
        $accounts = $this->cryptoAccounts()->get(["id"]);
        $accountIds = [];
        foreach ($accounts as $account) {
            array_push($accountIds, $account->id);
        }
        return CryptoTransaction::getLineChartData($accountIds, $type, $fiat);
    }

    public function processFIFO($fiat="USD") {
        $accounts = $this->cryptoAccounts()->get(["id"]);
        foreach ($accounts as $account) {
            $account->processFIFO($fiat);
        }
    }

    public function myCryptoPortfolio($fiat="USD") {
        $decnum = CryptoTransaction::DECIMAL_NUMBER;
        $date = Carbon::now();
        $date = Carbon::create(2022, 3, 18);
        bcscale($decnum);
        $holding = [];
        $accounts = $this->cryptoAccounts()->get();
        foreach ($accounts as $account) {
            $assets = $account->cryptoAssets;
            foreach ($assets as $asset) {
                $balance = $asset->balance;
                if ($balance <= 0) {
                    continue;
                }
                $symbol = $asset->cryptoCurrency->short_name;
                if (array_key_exists($symbol, $holding)) {
                    $holding[$symbol]['balance'] = bcadd(
                        $holding[$symbol]['balance'],
                        number_format($balance, $decnum, '.', '')
                    );
                } else {
                    $holding[$symbol] = [
                        'balance' => number_format($balance, $decnum, '.', ''),
                        'cryptoCurrency' => $asset->cryptoCurrency
                    ];
                }
            }
        }
        $total_balance = '0';
        foreach ($holding as $symbol => $data) {
            $total_balance = bcadd(
                $total_balance,
                number_format($data['cryptoCurrency']->convertTo($data['balance'], $fiat, $date), $decnum, '.', '')
            );
        }

        // var_dump($holding);
        $ret = [];
        foreach ($holding as $symbol => $data) {
            $tmp['name'] = $data['cryptoCurrency']->name;
            $tmp['symbol'] = $symbol;
            $tmp['price'] = $data['cryptoCurrency']->convertTo(1, $fiat, $date);
            $tmp['last7'] = [];
            $startDate = Carbon::createFromTimestamp($date->timestamp);
            $startDate->addDays(-7);
            while($startDate < $date) {
                array_push($tmp['last7'], $data['cryptoCurrency']->convertTo(1, $fiat, $startDate));
                $startDate->addDays(1);
            }
            $tmp['holding_cc'] = $data['balance'];
            $tmp['holding_fiat'] = $data['cryptoCurrency']->convertTo($data['balance'], $fiat, $date);
            $tmp['percent'] = bcmul(bcdiv(
                number_format($tmp['holding_fiat'], $decnum, '.', ''),
                $total_balance
            ), '100');
            $yesterday_fiat = $data['cryptoCurrency']->convertTo($data['balance'], $fiat, $date->addDays(-1));
            $tmp['pnl'] = bcsub($tmp['holding_fiat'], $yesterday_fiat);
            $tmp['pnl_percent'] = bcmul(bcdiv(
                number_format($tmp['pnl'], $decnum, '.', ''),
                $yesterday_fiat
            ), '100');
            // $ret['last7'] = $last7;
            array_push($ret, $tmp);
        }
        var_dump($total_balance);
        return $ret;
    }

    public function getTotalBalance($fiat) {
        $total_balance = '0';
        $decnum = CryptoTransaction::DECIMAL_NUMBER;
        $date = Carbon::now();
        bcscale($decnum);
        $accounts = $this->cryptoAccounts()->get();
        foreach ($accounts as $account) {
            $assets = $account->cryptoAssets;
            foreach ($assets as $asset) {
                $balance = $asset->balance;
                $total_balance = bcadd(
                    $total_balance,
                    number_format($asset->cryptoCurrency->convertTo($balance, $fiat, $date), $decnum, '.', '')
                );
            }
        }
        return $total_balance;
    }
}
