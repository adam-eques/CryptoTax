<?php

namespace App\Http\Livewire\Customer\Account;

use Livewire\Component;

use App\Jobs\CryptoAccountFetchJob;
use App\Models\CryptoAccount;
use App\Models\BlockchainAccount;
use Filament\Forms;
use WireUi\Traits\Actions;

class Accounts extends Component implements Forms\Contracts\HasForms
{
    use Actions;
    use Forms\Concerns\InteractsWithForms;

    public ?CryptoAccount $exchange = null;
    public ?BlockchainAccount $blockchain = null;


    public function mount()
    {
        $this->blockchain = null;
        $this->exchange = CryptoAccount::query()
            ->where('user_id', auth()->user()->id)
            ->whereJsonLength('credentials', '>', 0)
            ->first();
        $this->edit_exchange();
    }


    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('apiKey')
                ->visible(fn($livewire) => $livewire->isRequiredField('apiKey'))
                ->label(__("Key"))
                ->required()
                ->placeholder(__("Your API key")),
            Forms\Components\TextInput::make('secret')
                ->visible(fn($livewire) => $livewire->isRequiredField('secret'))
                ->label(__("Secret"))
                ->required()
                ->password()
                ->placeholder(__("Your API secret")),
            Forms\Components\TextInput::make('password')
                ->visible(fn($livewire) => $livewire->isRequiredField('password'))
                ->label(__("Passphrase"))
                ->required()
                ->password()
                ->placeholder(__("Your API passphrase")),
        ];
    }


    public function isRequiredField(string $fieldName): bool
    {
        if ($this->exchange) {
            $api = $this->exchange->getApi();
            $requiredCredentials = $api->getRequiredCredentials();

            return $requiredCredentials[$fieldName];
        }

        return false;
    }


    // exchange
    public function save_exchange()
    {
        $data = $this->form->getState();
        $this->exchange->credentials = $data;
        $this->exchange->save();
    }


    public function edit_exchange()
    {
        if ($this->exchange) {
            $this->form->fill($this->exchange->credentials);
        }
    }


    public function delete_exchange(CryptoAccount $exchange)
    {
        if ($this->exchange && $this->exchange->id == $exchange->id) {
            $this->exchange = null;
        }
        $exchange->delete();

        // Update table
        $this->emit("transactionTable.updateTable");

        // Notify
        $this->notification()->success(
            $title = __('Successfully deleted'),
            $description = ''
        );
    }


    public function fetch_exchange(CryptoAccount $exchange)
    {
        try {
            $exchange->fetching_scheduled_at = now();
            $exchange->save();
            CryptoAccountFetchJob::dispatch($exchange);
            $this->notification()->info(
                __("Fetching :name is now scheduled", ["name" => $exchange->getName()]),
                "Please check transactions in a couple of minutes"
            );
        } catch (\Exception $e) {
            $this->notification()->error(__("An error occured"), $e->getMessage());
        }
    }


    public function get_selected_account(CryptoAccount $exchange)
    {
        $this->exchange = $exchange;
        $this->blockchain = null;
    }


    // blockchains
    public function delete_blockchain(BlockchainAccount $blockchainAccount)
    {
        if ($this->blockchain && $this->blockchain->id == $blockchainAccount->id) {
            $this->blockchain = null;
        }
        $blockchainAccount->delete();

        // Update table
        $this->emit("transactionTable.updateTable");

        // Notify
        $this->notification()->success(
            $title = __('Successfully deleted'),
            $description = ''
        );
    }


    public function fetch_blockchain(BlockchainAccount $blockchainAccount)
    {
        try {
            $blockchainAccount->fetching_scheduled_at = now();
            $blockchainAccount->save();
            CryptoAccountFetchJob::dispatch($blockchainAccount);
            $this->notification()->info(
                __("Fetching :name is now scheduled", ["name" => $blockchainAccount->getName()]),
                "Please check blockchain transactions in a couple of minutes"
            );
        } catch (\Exception $e) {
            $this->notification()->error(__("An error occured"), $e->getMessage());
        }
    }


    public function get_selected_blockchain(BlockchainAccount $blockchainAccount)
    {
        $this->blockchain = $blockchainAccount;
        $this->exchange = null;
    }


    //frontend action
    public function sync()
    {
        if ($this->exchange) {
            if ($this->exchange->hasAllCredentials()) {
                $this->fetch_exchange($this->exchange);
            }
        } elseif ($this->blockchain) {
            $this->fetch_blockchain($this->blockchain);
        }
    }


    public function delete()
    {
        if ($this->exchange) {
            $this->delete_exchange($this->exchange);
        } elseif ($this->blockchain) {
            $this->delete_blockchain($this->blockchain);
        }
    }


    //Rendering
    public function render()
    {

        $cryptoAccounts = CryptoAccount::query()
            ->where('user_id', auth()->user()->id)
            ->whereJsonLength('credentials', '>', 0)
            ->get();

        $blockchainAccounts = BlockchainAccount::query()
            ->where('user_id', auth()->user()->id)
            ->get();

        $rows = [
            ["id" => 1, "label" => "Exchanges", "items" => $cryptoAccounts],
            ["id" => 2, "label" => "Wallets", "items" => []],
            ["id" => 3, "label" => "Blockchain", "items" => $blockchainAccounts],
            ["id" => 4, "label" => "Others", "items" => []],
        ];

        // $balances = $cryptoAccounts[0]->cryptoExchangeAssets()->get()[0]->cryptoCurrency()->get();

        return view('livewire.customer.account.accounts', [
            "cryptoAccounts" => $cryptoAccounts,
            "blockchainAccounts" => $blockchainAccounts,
            "rows" => $rows,
        ]);
    }
}
