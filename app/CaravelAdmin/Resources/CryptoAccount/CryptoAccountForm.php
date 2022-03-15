<?php

namespace App\CaravelAdmin\Resources\CryptoAccount;

use WebCaravel\Admin\Resources\ResourceForm;
use WebCaravel\Admin\Forms\SidebarLayout;
use Filament\Forms;


class CryptoAccountForm extends ResourceForm
{
    public function getFormSchema(): array
    {
        return SidebarLayout::make()
            ->addTab([
                Forms\Components\TextInput::make('name')
                    ->label(__("Name"))
                    ->required(),
                Forms\Components\Toggle::make("active")
                    ->label(__("Status"))
            ])
            ->toArray();
    }
}
