<?php

namespace App\CaravelAdmin\Resources\UserCreditLog;

use App\CaravelAdmin\Resources\Customer\CustomerResource;
use App\CaravelAdmin\Resources\UserCreditAction\UserCreditActionResource;
use WebCaravel\Admin\Resources\ResourceTable;
use App\Services\CreditCodeService;
use Filament\Tables\Columns\TextColumn;
use WebCaravel\Admin\Tables\Columns\BelongsToColumn;
use function moneyFormat;

class UserCreditLogTable extends ResourceTable
{
    public string $resourceClass = UserCreditLogResource::class;


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
            BelongsToColumn::make("user.name")
                ->resource(CustomerResource::class),
            TextColumn::make("action_code")
                ->label("Action Code")
                ->formatStateUsing(function($record) {
                    return CreditCodeService::getLabel($record->action_code);
                })
                ->sortable()
                ->searchable(),
            BelongsToColumn::make("action.name")
                ->resource(UserCreditActionResource::class),
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
    //
    //
    //protected function getTableFilters(): array
    //{
    //    return [
    //
    //    ];
    //}
}
