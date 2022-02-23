<?php

namespace App\CaravelAdmin\Resources\CryptoExchangeAccount;

use App\CaravelAdmin\Resources\CryptoExchange\CryptoExchangeResource;
use WebCaravel\Admin\Resources\ResourceTable;
use Filament\Tables;
use WebCaravel\Admin\Tables\Columns\BelongsToColumn;

class CryptoExchangeAccountTable extends ResourceTable
{
    public string $resourceClass = CryptoExchangeAccountResource::class;


    protected function getTableColumns(): array
    {
        return [
            BelongsToColumn::make("cryptoExchange.name")
                ->resource(CryptoExchangeResource::class),
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
