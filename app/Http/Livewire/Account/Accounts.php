<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

use App\Jobs\CryptoExchangeFetchJob;
use App\Models\CryptoExchange;
use App\Models\CryptoExchangeAccount;
use App\Jobs\BlockchainAccountFetchJob;
use App\Models\BlockchainAccount;
use Filament\Forms;
use WireUi\Traits\Actions;

class Accounts extends Component implements Forms\Contracts\HasForms
{
    use Actions;
    use Forms\Concerns\InteractsWithForms;

    public ?CryptoExchangeAccount $account = null;
    public ?BlockchainAccount $blockchain = null;
    public ?int $selected_category = null;

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
                ->placeholder(__("Your API secret")),
            Forms\Components\TextInput::make('password')
                ->visible(fn($livewire) => $livewire->isRequiredField('password'))
                ->label(__("Passphrase"))
                ->required()
                ->placeholder(__("Your API passphrase")),
        ];
    }

    public function get_selected_category(int $id){
        $this->selected_category = $id;
    }

    public function isRequiredField(string $fieldName): bool
    {
        if ($this->account) {
            $api = $this->account->getApi();
            $requiredCredentials = $api->getRequiredCredentials();

            return $requiredCredentials[$fieldName];
        }

        return false;
    }

    public function save_exchange()
    {
        $data = $this->form->getState();
        $this->account->credentials = $data;
        $this->account->save();
        // $this->fetch($this->account);
    }

    public function get_selected_account(CryptoExchangeAccount $account){
        $this->account = $account;
    }

    public function get_selected_blockchain(BlockchainAccount $blockchainAccount){
        $this->blockchain = $blockchainAccount;
    }

    public function edit_exchange()
    {
        if ($this->account) {
            # code...
            $this->form->fill($this->account->credentials);
        }
    }
    public function delete_exchange(CryptoExchangeAccount $account)
    {
        if ($this->account && $this->account->id == $account->id) {
            $this->account = null;
        }
        $account->delete();

        // Update table
        $this->emit("transactionTable.updateTable");

        // Notify
        $this->notification()->success(
            $title = __('Successfully deleted'),
            $description = ''
        );
    }

    public function render()
    {
        $cryptoExchangeAccounts = auth()->user()->cryptoExchangeAccounts;
        $blockchainAccounts = auth()->user()->blockchainAccounts;
        return view('livewire.account.accounts', [
            "cryptoExchangeAccounts" => $cryptoExchangeAccounts,
            "blockchainAccounts" => $blockchainAccounts
        ]);
    }
}
