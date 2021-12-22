<?php

namespace App\Http\Livewire\Admin\CryptoExchange;

use App\Forms\SidebarLayout;
use App\Http\Livewire\Admin\Resources\Resource;
use App\Models\CryptoExchange;
use Filament\Forms;
use Filament\Tables;

class CryptoExchangeResource extends Resource
{
    protected string $model = CryptoExchange::class;
    protected string $icon = "fas-shield-alt";


    public function label(): string
    {
        return __("Crypo exchange");
    }


    public function labelPlural(): string
    {
        return __("Crypo exchanges");
    }


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


    public function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make("name")
                ->sortable()
                ->searchable(),
        ];
    }
}
