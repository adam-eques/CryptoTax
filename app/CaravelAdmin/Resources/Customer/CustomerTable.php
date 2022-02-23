<?php

namespace App\CaravelAdmin\Resources\Customer;

use WebCaravel\Admin\Resources\ResourceTable;
use App\CaravelAdmin\Resources\UserAccountType\UserAccountTypeResource;
use App\Models\User;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use WebCaravel\Admin\Tables\Columns\BelongsToColumn;

class CustomerTable extends ResourceTable
{
    public string $resourceClass = CustomerResource::class;


    protected function getTableQuery(): Builder
    {
        return User::query()->customersOnly();
    }


    public function getDefaultTableSortColumn(): ?string
    {
        return "created_at";
    }


    public function getDefaultTableSortDirection(): ?string
    {
        return "desc";
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
            Tables\Columns\TextColumn::make("created_at")
                ->label("Registered")
                ->date("Y-m-d H:i:s")
                ->searchable()
                ->sortable(),
        ];
    }
}
