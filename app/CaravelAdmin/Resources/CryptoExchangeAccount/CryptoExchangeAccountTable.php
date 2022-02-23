<?php

namespace App\CaravelAdmin\Resources\CryptoExchangeAccount;

use App\Tables\Columns\BelongsToColumn;
use WebCaravel\Admin\Resources\ResourceTable;
use Filament\Tables;


class CryptoExchangeAccountTable extends ResourceTable
{
    public string $resourceClass = CryptoExchangeAccountResource::class;


    protected function getTableColumns(): array
    {
        return [
            BelongsToColumn::make("cryptoExchange.name"),
            Tables\Columns\TextColumn::make("fetching_scheduled_at")
                ->date("Y-m-d H:i")
                ->sortable(),
            Tables\Columns\TextColumn::make("fetched_at")
                ->date("Y-m-d H:i")
                ->sortable(),
            Tables\Columns\TextColumn::make("created_at")
                ->date("Y-m-d H:i")
                ->sortable(),
        ];
    }
}
