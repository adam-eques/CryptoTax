<?php

namespace App\CaravelAdmin\Resources\Customer;

use WebCaravel\Admin\Resources\ResourceForm;
use App\CaravelAdmin\Resources\UserCreditLog\UserCreditLogResource;
use App\Forms\Components\HasManyRelationField;
use App\Forms\Components\StaticField;
use App\Forms\SidebarLayout;
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
                StaticField::make(__("ID"), modelValue: "id"),
                StaticField::make(__("Credits"),callback: function($record){
                    return moneyFormat($record->credits);
                }),
                StaticField::make(__("Registered at"), callback: function($record){
                    return $record->created_at
                        ? __(":date at :time" , ["date" => $record->created_at->format("Y-m-d"), "time" => $record->created_at->format("H:i")])
                        : "";
                }),
            ])
            ->toArray();
    }
}
