<?php

namespace App\Http\Livewire\Admin\AffiliateUser;

use App\Http\Livewire\Admin\Resources\ResourceTable;
use App\Models\User;
use App\Models\UserAccountType;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;

class AffiliateUserTable extends ResourceTable
{
    protected function getTableQuery(): Builder
    {
        return User::query()->where("user_account_type_id", UserAccountType::TYPE_AFFILIATE);
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
