<?php

namespace App\CaravelAdmin\Resources\UserCreditLog;

use WebCaravel\Admin\Resources\ResourceForm;
use WebCaravel\Admin\Forms\SidebarLayout;

class UserCreditLogForm extends ResourceForm
{
    public function getFormSchema(): array
    {
        return SidebarLayout::make()
            ->addTab([
                //TextInput::make('name')
                //    ->label(__("Name"))
                //    ->required(),
                //TextInput::make('name_public')
                //    ->label(__("Name Public"))
                //    ->required(),
                //Forms\Components\Select::make("action_code")
                //    ->options(CreditCodeService::allActionsForSelect())
                //    ->label("Action"),
                //TextInput::make('value')
                //    ->label(__("Credits (negativ = cost; positiv = reward)"))
                //    ->postfix("Credits")
                //    ->nullable(true)
                //    ->numeric(),
                //DateTimePicker::make('valid_from')
                //    ->nullable(true),
                //DateTimePicker::make('valid_till')
                //    ->placeholder('Leave empty if it has no end (yet)')
                //    ->nullable(true),

            ], columns: 2)
            ->toArray();
    }
}
