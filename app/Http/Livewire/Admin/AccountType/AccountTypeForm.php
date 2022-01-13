<?php

namespace App\Http\Livewire\Admin\AccountType;

use App\Forms\SidebarLayout;
use App\Http\Livewire\Admin\Resources\ResourceForm;
use Filament\Forms;

class AccountTypeForm extends ResourceForm
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
