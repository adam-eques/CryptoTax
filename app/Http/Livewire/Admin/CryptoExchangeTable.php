<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Admin\Resources\ResourceTable;
use App\Resources\CryptoExchangeResource;

class CryptoExchangeTable extends ResourceTable
{
    public string $resourceClass = CryptoExchangeResource::class;
}
