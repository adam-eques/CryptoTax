<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserAffiliate;
use App\Settings\AffiliateSetting;

class AffiliateService
{
    const COOKIE_NAME = "mycrypto_tax_affiliate";

    protected static self $_instance;

    protected AffiliateSetting $settings;


    public static function instance(): self
    {
        if(empty(static::$_instance)) {
            static::$_instance = new static();
            static::$_instance->settings = app(AffiliateSetting::class);
        }

        return static::$_instance;
    }


    public function redirect(UserAffiliate $userAffiliate)
    {
        return redirect($this->settings->redirect_url)
            ->cookie(self::COOKIE_NAME, $userAffiliate->hash, $this->settings->cookie_lifetime);
    }


    public function getAffiliateUser(): ?User
    {
        $hash = $this->getCookieAffiliateHash();

        return $hash ? User::query()->whereHas("userAffiliate", function ($query) use ($hash) {
            return $query->where("hash", $hash);
        })->first() : null;
    }


    public function getCookieAffiliateHash(): ?string
    {
        $hash = trim(request()->cookie(self::COOKIE_NAME));

        return $hash && strlen($hash) > 32 ? $hash : null;
    }
}
