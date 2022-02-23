<?php

namespace App\CaravelAdmin\Resources\UserCreditAction;

use Closure;
use WebCaravel\Admin\Resources\ResourceForm;
use WebCaravel\Admin\Forms\SidebarLayout;
use App\Services\CreditCodeService;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;


class UserCreditActionForm extends ResourceForm
{
    public function getFormSchema(): array
    {
        return SidebarLayout::make()
            ->addTab([
                TextInput::make('name')
                    ->label(__("Name"))
                    ->required(),
                TextInput::make('name_public')
                    ->label(__("Name Public"))
                    ->required(),
                Forms\Components\Select::make("action_code")
                    ->options(CreditCodeService::allActionsForSelect())
                    ->required()
                    ->label("Action")
                    ->reactive(),
                TextInput::make('value')
                    ->label(__("Credits (negativ = cost; positiv = reward); If affilate action, its a percentage"))
                    ->nullable(true)
                    ->numeric(),
                TextInput::make('price')
                    ->label(__("Price in $"))
                    ->postfix("$")
                    ->visible(fn(Closure $get) => $get('action_code') == CreditCodeService::ACTION_BUY_CREDITS)
                    ->nullable(true)
                    ->numeric(),
                DateTimePicker::make('valid_from')
                    ->withoutSeconds()
                    ->nullable(),
                DateTimePicker::make('valid_till')
                    ->withoutSeconds()
                    ->placeholder('Leave empty if it has no end (yet)')
                    ->nullable(),
            ])
            ->toArray();
    }
}
