<?php

namespace App\Http\Livewire\Admin\UserCreditAction;

use App\Forms\SidebarLayout;
use App\Http\Livewire\Admin\Resources\ResourceForm;
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
                    ->required()
                    ->columnSpan(2),
                TextInput::make('name_public')
                    ->label(__("Name Public"))
                    ->required()
                    ->columnSpan(2),
                Forms\Components\Select::make("action_code")
                    ->options(CreditCodeService::allActionsForSelect())
                    ->label("Action"),
                TextInput::make('value')
                    ->label(__("Credits (negativ = cost; positiv = reward)"))
                    ->postfix("Credits")
                    ->nullable(true)
                    ->numeric(),
                DateTimePicker::make('valid_from')
                    ->nullable(true),
                DateTimePicker::make('valid_till')
                    ->placeholder('Leave empty if it has no end (yet)')
                    ->nullable(true),

            ], columns: 2)
            ->toArray();
    }
}
