<?php

namespace App\CaravelAdmin\Resources\CryptoExchangeAccount;

use WebCaravel\Admin\Resources\ResourceForm;
use WebCaravel\Admin\Forms\SidebarLayout;
use Filament\Forms;


class CryptoExchangeAccountForm extends ResourceForm
{
    public function getFormSchema(): array
    {
        return SidebarLayout::make()
            ->addTab([
                Forms\Components\TextInput::make('name')
                    ->label(__("Name"))
                    ->required(),
                Forms\Components\TextInput::make('website')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required(),
                Forms\Components\Toggle::make("active")
                    ->label(__("Status"))
            ])
            ->toArray();
    }
}
