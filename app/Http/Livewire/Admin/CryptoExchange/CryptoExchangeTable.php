<?php

namespace App\Http\Livewire\Admin\CryptoExchange;

use App\Http\Livewire\Admin\Resources\ResourceTable;

class CryptoExchangeTable extends ResourceTable
{
    public string $resourceClass = CryptoExchangeResource::class;
}
