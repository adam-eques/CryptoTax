<?php

namespace App\CaravelAdmin\Resources\Customer;

use App\CaravelAdmin\Resources\Customer\Modals\AddCreditModal;
use App\Models\CryptoAccount;
use App\Models\User;
use App\Models\UserCreditLog;
use WebCaravel\Admin\Forms\Components\ButtonField;
use WebCaravel\Admin\Forms\Components\ButtonModalField;
use WebCaravel\Admin\Forms\Components\RelatedTableField;
use WebCaravel\Admin\Resources\ResourceForm;
use WebCaravel\Admin\Forms\SidebarLayout;
use Filament\Forms;

use function moneyFormat;

class CustomerForm extends ResourceForm
{
    protected function getActionButtons(): array
    {
        return array_merge([
            ButtonModalField::make("add credits")
                ->modalFormClass(AddCreditModal::class)
                ->title(__("Add Credits"))
                ->visible(fn(): bool => auth()->user()->isAdminAccount())
                ->buttonLabel(__("Add credits"))
        ], parent::getActionButtons());
    }


    protected function getFormSchema(): array
    {
        return SidebarLayout::make()
            // General tab
            ->addTab(Forms\Components\Tabs\Tab::make(__('General'))->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__("Name"))
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email(),
            ]))

            // Credit logs
            ->addTab(Forms\Components\Tabs\Tab::make("Credit Logs")->schema([
                RelatedTableField::make(RelatedUserCreditLogTable::class)
            ])->visible(fn($record) => $record->exists && auth()->user()->can("viewAny", UserCreditLog::class)))

            // Exchange accounts
            ->addTab(Forms\Components\Tabs\Tab::make("Exchange Accounts")->schema([
                RelatedTableField::make(RelatedCryptoAccountTable::class)
            ])->visible(fn($record) => $record->exists && auth()->user()->can("viewAny", CryptoAccount::class)))

            // Recruited user
            ->addTab(Forms\Components\Tabs\Tab::make("Recruited Users")->schema([
                RelatedTableField::make(RelatedRecruitedUserTable::class)
            ]))

            // Info card
            ->addCard([
                Forms\Components\Placeholder::make("id")->label(__("ID"))
                    ->content(fn ($record): string => $record ? $record->id : '-'),
                Forms\Components\Placeholder::make("credits")->label(__("Credits"))
                    ->content(fn ($record): string => moneyFormat($record->credits)),
                Forms\Components\Placeholder::make("created_at")->label(__("Registered at"))
                    ->content(fn ($record): string => $record ? $record->created_at : '-'),
                Forms\Components\Placeholder::make("email_verified_at")->label(__("E-Mail verified"))
                    ->content(fn ($record): string => $record && $record->email_verified_at ? $record->email_verified_at : __("unverified")),
                Forms\Components\Placeholder::make("account_type_id")->label(__("Account type"))
                    ->content(fn (User $record): string => $record->userAccountType->getName()),
                ButtonField::make(__("Affiliate Url"))
                    ->href(fn (User $record): ?string => $record->getAffiliateUrl())
                    ->hidden(fn(User $record): bool => !$record->hasVerifiedEmail())
                    ->targetBlank(),
                ButtonField::make(__("Recruited by"))
                    ->href(fn (User $record): string => CustomerResource::make()->getRoute("show", $record->userAffiliate->recruitedBy))
                    ->content(fn (User $record): string => optional($record->userAffiliate)->recruitedBy->email)
                    ->hidden(fn(User $record): bool => !$record->hasVerifiedEmail() || !optional($record->userAffiliate)->recruitedBy),
            ])
            ->toArray();
    }
}
