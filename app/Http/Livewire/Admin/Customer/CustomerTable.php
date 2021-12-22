<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Http\Livewire\Admin\Resources\ResourceTable;
use App\Models\User;
use App\Models\UserAccountType;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;

class CustomerTable extends ResourceTable
{
    public string $resourceClass = CustomerResource::class;


    protected function getTableQuery(): Builder
    {
        return User::query()->where("user_account_type_id", UserAccountType::TYPE_CUSTOMER);
    }


    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make("name")
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make("email")
                ->label("E-Mail")
                ->searchable()
                ->sortable(),
        ];
    }
}
