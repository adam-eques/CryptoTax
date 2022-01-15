<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Http\Livewire\Admin\Resources\ResourceTable;
use App\Http\Livewire\Admin\UserAccountType\UserAccountTypeResource;
use App\Models\User;
use App\Models\UserAccountType;
use App\Tables\Columns\BelongsToColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;

class CustomerTable extends ResourceTable
{
    public string $resourceClass = CustomerResource::class;


    protected function getTableQuery(): Builder
    {
        return User::query()->customersOnly();
    }


    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make("name")
                ->sortable()
                ->searchable(),
            BelongsToColumn::make("userAccountType.name")
                ->resource(UserAccountTypeResource::class),
            Tables\Columns\TextColumn::make("credits")
                ->sortable(),
            Tables\Columns\TextColumn::make("email")
                ->label("E-Mail")
                ->searchable()
                ->sortable(),
        ];
    }
}
