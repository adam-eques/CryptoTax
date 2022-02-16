<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AffiliateSetting extends Settings
{
     // Lifetime in months for the first level
    public int $first_level_lifetime;
     // Lifetime in months for the second level
    public int $second_level_lifetime;
     // Percentage for the first level
    public float $first_level_percentage;
     // Percentage for the second level
    public float $second_level_percentage;
     // Minimum Dollar value for payout
    public int $min_payout_value;
     // Conversion rate how much an affiliate will get per credit
    public float $conversion_rate;


    public static function group(): string
    {
        return 'affiliate';
    }
}
