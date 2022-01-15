<?php

namespace App\Http\Livewire\Admin\UserCreditLog;

use App\Http\Livewire\Admin\Customer\CustomerResource;
use App\Http\Livewire\Admin\Resources\ResourceTable;
use App\Services\CreditCodeService;
use App\Tables\Columns\BelongsToColumn;
use Filament\Tables\Columns\TextColumn;

class UserCreditLogTable extends ResourceTable
{
    protected function getTableColumns(): array
    {
        return [
            BelongsToColumn::make("user.name")
                ->resource(CustomerResource::class),
            TextColumn::make("action_code")
                ->label("Action")
                ->formatStateUsing(function($record) {
                    return CreditCodeService::getLabel($record->action_code);
                })
                ->sortable()
                ->searchable(),
            TextColumn::make("value")
                ->formatStateUsing(function($record) {
                    return moneyFormat($record->value);
                })
                ->label("Credits")
                ->sortable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
        ];
    }


    protected function getTableFilters(): array
    {
        return [

        ];
    }
}
