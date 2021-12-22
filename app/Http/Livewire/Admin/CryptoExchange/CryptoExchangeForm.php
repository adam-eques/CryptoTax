<?php

namespace App\Http\Livewire\Admin\CryptoExchange;

use App\Forms\SidebarLayout;
use App\Http\Livewire\Admin\Resources\ResourceForm;
use Filament\Forms;

class CryptoExchangeForm extends ResourceForm
{


    public function getFormSchema(): array
    {
        return SidebarLayout::make()
            ->addTab([
                Forms\Components\TextInput::make('name')
                    ->label(__("Name"))
                    ->required(),
            ])
            ->toArray();
    }
}
