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
            ->whereIn("crypto_account_id", auth()->user()->cryptoAccounts->pluck("id"));
    }


    protected function getTableFilters(): array
    {
        $accountOptions = auth()->user()->cryptoAccounts->pluck("cryptoSource.name", "id");

        return [
            SelectFilter::make('crypto_account_id')
                ->label(__("Account"))
                ->query(function (Builder $query, array $data): Builder {
                    return ! empty($data["value"]) ? $query->where("crypto_account_id", $data["value"]) : $query;
                })
                ->options($accountOptions),
            SelectFilter::make('trade_type')
                ->options([
                    'S' => 'Sell',
                    'B' => 'Buy',
                ]),
            SelectFilter::make('type')
                ->options([
                    'limit' => 'limit',
                ]),
        ];
    }


    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('executed_at')
                ->sortable(),
            TextColumn::make('cryptoAccount.cryptoSource.name')->label('Source')->sortable()->searchable(),
            TextColumn::make('cryptoCurrency.short_name')->label('Currency')->sortable()->searchable(),
            TextColumn::make('trade_type')->sortable()->searchable(),
            TextColumn::make('amount')->sortable()->searchable(),
            TextColumn::make('price'),
            TextColumn::make('priceCurrency.short_name')->sortable(),
            TextColumn::make('fee')->sortable(),
            TextColumn::make('feeCurrency.short_name')->sortable(),
            TextColumn::make('from_addr')->sortable()->searchable(),
            TextColumn::make('to_addr')->sortable()->searchable(),
        ];
    }


    public function updateTable()
    {
        $this->notification()->success("Refresh");
        $this->updated_at = now()->timestamp;
    }


    public function render()
    {
        return view('livewire.crypto-account.transaction-table');
    }
}
