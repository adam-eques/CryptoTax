<?php

namespace App\Http\Livewire\Transaction;

use App\Models\BlockchainTransaction;
use App\Models\CryptoExchangeTransaction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use WireUi\Traits\Actions;

class TransList extends Component implements Tables\Contracts\HasTable
{
    use Actions;
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return CryptoExchangeTransaction::query()
            ->whereIn("crypto_exchange_account_id", auth()->user()->cryptoExchangeAccounts->pluck("id"));
    }

    public function render()
    {
        return view('livewire.transaction.trans-list');
    }
}
