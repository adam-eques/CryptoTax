<?php

namespace App\CaravelAdmin\Resources\UserCreditLog;

use App\CaravelAdmin\Resources\Customer\CustomerResource;
use App\CaravelAdmin\Resources\UserCreditAction\UserCreditActionResource;
use App\Tables\Columns\UserColumn;
use Filament\Tables\Filters\SelectFilter;
use WebCaravel\Admin\Resources\ResourceTable;
use App\Services\CreditCodeService;
use Filament\Tables\Columns\TextColumn;
use WebCaravel\Admin\Tables\Columns\BelongsToColumn;
use WebCaravel\Admin\Tables\Columns\HtmlColumn;
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
            TextColumn::make("id"),
            UserColumn::make(),
            HtmlColumn::make("action_code")
                ->subtitle(fn($record): string => CreditCodeService::getLabel($record->action_code))
                ->label("Action Code")
                ->sortable()
                ->searchable(),
            BelongsToColumn::make("action.name")
                ->subtitle(fn($record): ?string => optional($record->reference)->getName())
                ->resource(UserCreditActionResource::class),
            TextColumn::make("value")
                ->formatStateUsing(function($record) {
                    return moneyFormat($record->value);
                })
                ->label("Credits")
                ->sortable(),
            HtmlColumn::make('created_at')
                ->formatStateUsing(fn($record): string => $record->created_at->format("H:i:s"))
                ->subtitle(fn($record): string => $record->created_at->format("Y-m-d"))
                ->sortable()
        ];
    }


    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make("action_code")
                ->options(CreditCodeService::allActionsForSelect())
        ];
    }
}
