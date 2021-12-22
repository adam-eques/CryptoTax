<?php

namespace App\Http\Livewire\Admin\BackendUser;

use App\Http\Livewire\Admin\Resources\ResourceTable;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;

class BackendUserTable extends ResourceTable
{
    public string $resourceClass = BackendUserResource::class;


    protected function getTableQuery(): Builder
    {
        return User::query()->whereIn("user_account_type_id", $this->resource->typesArray);
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
            Tables\Columns\TextColumn::make("userAccountType.name")
                ->label("Type"),
        ];
    }
}
