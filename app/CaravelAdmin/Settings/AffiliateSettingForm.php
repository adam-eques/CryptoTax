<?php

namespace App\CaravelAdmin\Settings;

use App\Settings\AffiliateSetting;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use WebCaravel\Admin\Settings\SettingsForm;

class AffiliateSettingForm extends SettingsForm
{
    public string $settingClass = AffiliateSetting::class;
    public string $title = "Affiliate Setting";


    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make([
                Fieldset::make('General')
                    ->schema([
                        Forms\Components\TextInput::make('redirect_url')
                            ->required()
                            ->helperText("Url after the redirect cookie was set"),
                        Forms\Components\TextInput::make('cookie_lifetime')
                            ->label('Cookie lifetime')
                            ->helperText('Lifetime in minutes. 1440 = 1d; 43200 = 30d')
                            ->postfix("minutes")
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(99999),
                    ]),

                Fieldset::make("Affiliate Lifetime")
                    ->schema([
                        Forms\Components\TextInput::make('first_level_lifetime')
                            ->label('First level lifetime')
                            ->helperText('Lifetime in months')
                            ->postfix("months")
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(999),
                    Forms\Components\TextInput::make('second_level_lifetime')
                        ->label('Second level lifetime')
                        ->helperText('Lifetime in months')
                        ->postfix("months")
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(999),
                ]),

                Fieldset::make('Payout')->schema([
                    Forms\Components\TextInput::make('min_payout_value')
                        ->label('Min payout value')
                        ->helperText('Minimum $ value for payout')
                        ->postfix("$")
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(999),
                    Forms\Components\TextInput::make('conversion_rate')
                        ->label('Conversion rate')
                        ->helperText('How much $ will you get for 1 Credit')
                        ->postfix("$")
                        ->required()
                        ->numeric()
                        ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                        ->minValue(0.01)
                        ->maxValue(999),
                ]),
            ]),
        ];
    }
}
