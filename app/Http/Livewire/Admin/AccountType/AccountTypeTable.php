<?php

namespace App\Http\Livewire\Admin\AccountType;

use App\Http\Livewire\Admin\Resources\ResourceTable;
use Facade\Ignition\Tabs\Tab;
use Filament\Tables;

class AccountTypeTable extends ResourceTable
{
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make("name")
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make("duration")
                ->formatStateUsing(function($record) {
                    return $record->duration . " month" . ($record->duration > 1 ? "s" : "");
                })
                ->label("Duration"),
            Tables\Columns\TextColumn::make("included_credits")
                ->formatStateUsing(function($record) {
                    return number_format($record->included_credits);
                })
                ->label("Included credits"),
            Tables\Columns\BooleanColumn::make("active")
                ->label(__("Status"))
                ->sortable()
        ];
    }
}
