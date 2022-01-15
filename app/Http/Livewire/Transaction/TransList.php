<?php

namespace App\Http\Livewire\Transaction;

use App\Models\BlockchainTransaction;
use App\Models\CryptoExchangeTransaction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Carbon\Carbon;
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

    protected function getTableColumns(): array 
    {
        return [
            ViewColumn::make('cryptoExchangeAccount.cryptoExchange.name')
                ->view('tables.columns.status-switcher')
                ->searchable()
                ->label('Exchange'),
            TextColumn::make('executed_at')
                ->formatStateUsing(fn($state): string => (new Carbon($state / 1000))->format("Y-m-d H:i:s"))
                ->sortable(),
            TextColumn::make('side')
                ->sortable(),
            TextColumn::make('amount')
                ->sortable(),
            TextColumn::make('cost')
                ->sortable(),
            TextColumn::make('fee_currency')
                ->sortable(),
            TextColumn::make('fee_cost')
                ->sortable(),
            TextColumn::make('fee_rate')
                ->sortable(),
        ];
    }

    public function render()
    {
        return view('livewire.transaction.trans-list');
    }
}
