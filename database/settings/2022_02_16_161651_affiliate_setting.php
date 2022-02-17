<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AffiliateSetting extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('affiliate.first_level_lifetime', 12);
        $this->migrator->add('affiliate.second_level_lifetime', 36);
        $this->migrator->add('affiliate.first_level_percentage', 15);
        $this->migrator->add('affiliate.second_level_percentage', 5);
        $this->migrator->add('affiliate.min_payout_value', 20);
        $this->migrator->add('affiliate.conversion_rate', 0.04);
        $this->migrator->add('affiliate.cookie_lifetime', 43200);
        $this->migrator->add('affiliate.redirect_url', "/register");
    }
}
