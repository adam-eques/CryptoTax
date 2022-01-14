<?php

namespace App\Http\Livewire\Admin\UserAccountType;

use App\Http\Livewire\Admin\Resources\ResourceTable;
use Facade\Ignition\Tabs\Tab;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class UserAccountTypeTable extends ResourceTable
{
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make("name")
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make("duration_in_months")
                ->formatStateUsing(function($record) {
                    return $record->duration_in_months ?
                        $record->duration_in_months . " month" . ($record->duration_in_months > 1 ? "s" : "") :
                        "-";
                })
                ->label("Duration"),
            Tables\Columns\TextColumn::make("included_credits")
                ->formatStateUsing(function($record) {
                    return number_format($record->included_credits);
                })
                ->label("Included credits"),
            Tables\Columns\BooleanColumn::make("is_customer")
                ->label(__("Customers"))
                ->sortable(),
            Tables\Columns\BooleanColumn::make("active")
                ->label(__("Status"))
                ->sortable()
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
