<?php

namespace App\Http\Livewire\Wallet;

use App\Models\WalletTransaction;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use WireUi\Traits\Actions;

class WalletTable extends Component implements Tables\Contracts\HasTable
{
    use Actions;
    use Tables\Concerns\InteractsWithTable;

    protected $listeners = ['walletTable.updateTable' => '$refresh'];
    public ?int $updated_at = null;


    protected function getTableQuery(): Builder
    {
        return WalletTransaction::query();
        // TODO: Only current user
            // ->whereIn("wallet_asset_id", auth()->user()->wallets()->pluck("id"));
    }


    protected function getTableFilters(): array
    {
        return [

        ];
    }


    protected function getTableColumns(): array
    {
        return [
            TextColumn::make("confirmations")->sortable(true),
            TextColumn::make("value")->sortable(true),
            TextColumn::make("contract_address")->sortable(true),
            TextColumn::make("cumulative_gas_used")->sortable(true),
            TextColumn::make("from")->sortable(true),
            TextColumn::make("gas")->sortable(true),
            TextColumn::make("gas_price")->sortable(true),
            TextColumn::make("gas_used")->sortable(true),
            TextColumn::make("hash")->sortable(true),
            TextColumn::make("is_error")->sortable(true),
            TextColumn::make("nonce")->sortable(true),
            TextColumn::make("time_stamp")->sortable(true),
            TextColumn::make("to")->sortable(true),
            TextColumn::make("transaction_index")->sortable(true),
            TextColumn::make("txreceipt_status")->sortable(true),
            TextColumn::make("walletAsset.wallet.address")->sortable(true),
            TextColumn::make("block_hash")->sortable(true),
            TextColumn::make("block_number")->searchable(true),
            TextColumn::make("input")->sortable(true),
        ];
    }


    public function updateTable()
    {
        $this->notification()->success("Refresh");
        $this->updated_at = now();
    }


    public function render()
    {
        return view('livewire.wallet.wallet-table');
    }
}
