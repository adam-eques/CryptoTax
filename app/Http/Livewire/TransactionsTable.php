<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Filament\Tables\Columns\TextColumn;
use Livewire\Component;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;



class TransactionsTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return auth()
            ->user()
            ->cryptoExchangeTransactions()
            ->with('cryptoExchangeAccount.cryptoExchange')
            ->getQuery();
    }


    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('side')
                ->options([
                    'sell' => 'Sell',
                    'buy' => 'Buy',
                ]),
            SelectFilter::make('taker_or_maker')
                ->options([
                    'taker' => 'taker',
                    'maker' => 'maker',
                ]),
            SelectFilter::make('type')
                ->options([
                    'limit' => 'limit',
                ]),
            SelectFilter::make('fee_currency')
                ->options([
                    'USDT' => 'USDT',
                    'ETH' => 'ETH',
                    'BTC' => 'BTC',
                ]),
        ];
    }


    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('executed_at')
                ->formatStateUsing(fn ( $state): string => (new Carbon($state / 1000))->format("Y-m-d H:i:s"))
                ->sortable(),
            TextColumn::make('cryptoExchangeAccount.cryptoExchange.name')->label('Exchange')->searchable(),
            TextColumn::make('external_id')->sortable()->searchable(),
            TextColumn::make('order')->sortable()->searchable(),
            TextColumn::make('symbol')->sortable()->searchable(),
            TextColumn::make('type')->sortable()->searchable(),
            TextColumn::make('taker_or_maker'),
            TextColumn::make('side')->sortable(),
            TextColumn::make('price')->sortable(),
            TextColumn::make('amount')->sortable(),
            TextColumn::make('cost')->sortable(),
            TextColumn::make('fee_cost')->sortable(),
            TextColumn::make('fee_rate')->sortable(),
            TextColumn::make('fee_currency')->sortable()->searchable(),
        ];
    }

    public function render()
    {
        return view('livewire.transactions-table');
    }
}
