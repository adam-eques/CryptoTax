<?php

namespace App\CaravelAdmin\Resources\CryptoAccount;

use App\CaravelAdmin\Resources\CryptoSource\CryptoSourceResource;
use WebCaravel\Admin\Resources\ResourceTable;
use Filament\Tables;
use WebCaravel\Admin\Tables\Columns\BelongsToColumn;

class CryptoAccountTable extends ResourceTable
{
    public string $resourceClass = CryptoAccountResource::class;


    protected function getTableColumns(): array
    {
        return [
            BelongsToColumn::make("cryptoSource.name")
                ->resource(CryptoSourceResource::class),
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
