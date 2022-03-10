<?php

namespace App\Http\Livewire\CryptoAccount;

use App\Models\CryptoTransaction;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use WireUi\Traits\Actions;

class TransactionsTable extends Component implements Tables\Contracts\HasTable
{
    use Actions;
    use Tables\Concerns\InteractsWithTable;

    protected $listeners = ['transactionTable.updateTable' => '$refresh'];
    public ?int $updated_at = null;


    protected function getTableQuery(): Builder
    {
        return CryptoTransaction::query()
            ->whereIn("crypto_exchange_account_id", auth()->user()->cryptoAccounts->pluck("id"));
    }


    protected function getTableFilters(): array
    {
        $accountOptions = auth()->user()->cryptoAccounts->pluck("cryptoExchange.name", "id");

        return [
            SelectFilter::make('crypto_exchange_account_id')
                ->label(__("Exchange"))
                ->query(function (Builder $query, array $data): Builder {
                    return ! empty($data["value"]) ? $query->where("crypto_exchange_account_id", $data["value"]) : $query;
                })
                ->options($accountOptions),
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
                ->formatStateUsing(fn($state): string => (new Carbon($state / 1000))->format("Y-m-d H:i:s"))
                ->sortable(),
            TextColumn::make('cryptoAccount.cryptoExchange.name')->label('Exchange')->sortable()->searchable(),
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


    public function updateTable()
    {
        $this->notification()->success("Refresh");
        $this->updated_at = now();
    }


    public function render()
    {
        return view('livewire.crypto-account.transaction-table');
    }
}
