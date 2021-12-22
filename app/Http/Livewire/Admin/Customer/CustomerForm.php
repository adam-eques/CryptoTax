<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Forms\SidebarLayout;
use App\Http\Livewire\Admin\Resources\ResourceForm;
use Filament\Forms;

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
            ->toArray();
    }
}
