<?php

namespace App\CaravelAdmin\Resources\Customer;

use WebCaravel\Admin\Resources\ResourceForm;
use App\CaravelAdmin\Resources\UserCreditLog\UserCreditLogResource;
use WebCaravel\Admin\Forms\Components\HasManyRelationField;
use WebCaravel\Admin\Forms\SidebarLayout;
use Filament\Forms;

use function moneyFormat;

class CustomerForm extends ResourceForm
{
    protected function getFormSchema(): array
    {
        return SidebarLayout::make()
            ->addTab([
                Forms\Components\TextInput::make('name')
                    ->label(__("Name"))
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email(),
            ])
            ->addTab([
                HasManyRelationField::make('creditLogs')
                    ->resource(UserCreditLogResource::make())
            ], "Credit Logs")
            ->addCard([
                Forms\Components\Placeholder::make("id")->label(__("ID"))
                    ->content(fn ($record): string => $record ? $record->id : '-'),
                Forms\Components\Placeholder::make("id")->label(__("Credits"))
                    ->content(fn ($record): string => moneyFormat($record->credits)),
                Forms\Components\Placeholder::make("id")->label(__("Registered at"))
                    ->content(fn ($record): string => $record ? $record->created_at : '-'),
            ])
            ->toArray();
    }
}
