<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AffiliateSetting extends Settings
{
    // Lifetime in months for the first level
    public int $first_level_lifetime;
    // Lifetime in months for the second level
    public int $second_level_lifetime;
    // Minimum Dollar value for payout
    public int $min_payout_value;
    // Conversion rate how much an affiliate will get per credit
    public float $conversion_rate;
    // Cookie lifetime in minutes
    public int $cookie_lifetime;
    // Url to redirect after
    public string $redirect_url;


    public static function group(): string
    {
        return 'affiliate';
    }
}
