<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Forms\Components\StaticField;
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
            ->addCard([
                StaticField::make(__("ID"), modelValue: "id"),
                //StaticField::make(__("Created at"), callback: function($record){
                //    return $record->created_at
                //        ? __(":date at :time" , ["date" => $record->created_at->format("Y-m-d"), "time" => $record->created_at->format("H:i")])
                //        : "";
                //}),
            ])
            ->toArray();
    }
}
