<?php

namespace App\Http\Livewire\Admin\UserCreditAction;

use App\Http\Livewire\Admin\Resources\ResourceTable;
use Facade\Ignition\Tabs\Tab;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class UserCreditActionTable extends ResourceTable
{
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make("name")
                ->sortable()
                ->searchable(),
        ];
    }


    protected function getTableFilters(): array
    {
        return [
            Tables\Filters\Filter::make("is_customer")
                ->label("Only Customers")
                ->query(fn (Builder $query): Builder => $query->where('is_customer', true))
        ];
    }
}
