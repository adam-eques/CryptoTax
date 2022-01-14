<?php

namespace App\Http\Livewire\Account;

use App\Models\CryptoExchange;
use App\Models\CryptoExchangeAccount;
use App\Jobs\CryptoExchangeFetchJob;
use App\Jobs\BlockchainFetchJob;
use App\Models\Blockchain;
use WireUi\Traits\Actions;
use Filament\Forms;

use Livewire\Component;

class AccountNew extends Component implements Forms\Contracts\HasForms
{

    use Actions;
    use Forms\Concerns\InteractsWithForms;

    public ?CryptoExchangeAccount $account = null;
    public ?int $newAccountId = null;
    public ?Blockchain $blockchain = null;
    public ?string $newBlockchainAddress = null;

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

    public function render()
    {
        $cryptoExchangeAccounts = auth()->user()->cryptoExchangeAccounts;

        $exchanges = CryptoExchange::query()
            ->where("active", true)
            ->whereNotIn("id", $cryptoExchangeAccounts->pluck("crypto_exchange_id")->toArray())
            ->get();

        $blockchains = auth()->user()->blockchains;

        return view('livewire.account.account-new', [
            "exchanges" => $exchanges,
            "cryptoExchangeAccounts" => $cryptoExchangeAccounts,
            "blockchains" => $blockchains
        ]);
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

    //Functions for Exchange
    public function fetch_excahange(CryptoExchangeAccount $account)
    {
        try {
            $account->fetching_scheduled_at = now();
            $account->save();
            CryptoExchangeFetchJob::dispatch($account);
            $this->notification()->info(
                __("Fetching :name is now scheduled", ["name" => $account->getName()]),
                "Please check transactions in a couple of minutes"
            );
        }
        catch (\Exception $e) {
            $this->notification()->error(__("An error occured"), $e->getMessage());
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

    public function save_exchange()
    {
        $data = $this->form->getState();
        $this->account->credentials = $data;
        $this->account->save();
        $this->fetch_excahange($this->account);
    }

    public function add_exchange( int $selected )
    {
        $user = auth()->user();
        $this->newAccountId = $selected;

        if (! $this->newAccountId) {
            $this->notification()->info(__("Please select an exchange"));

            return;
        }

        if (! $user->cryptoExchangeAccounts()->where("crypto_exchange_id", $this->newAccountId)->first()) {
            $account = new CryptoExchangeAccount();
            $account->crypto_exchange_id = $this->newAccountId;
            $account->user_id = $user->id;
            $account->credentials = [];
            $account->save();
        }

        $this->edit_exchange($account);
    }

    public function edit_exchange(CryptoExchangeAccount $account)
    {
        $this->account = $account;
        $this->form->fill($account->credentials);
    }

    //Functions for Blockchain
    public function add_blockchain()
    {
        $user = auth()->user();

        if (! $this->newBlockchainAddress) {
            $this->notification()->info(__("Please enter a blockchain address"));

            return;
        }

        if (! $user->blockchains()->where("address", $this->newBlockchainAddress)->first()) {
            $blockchain = new Blockchain();
            $blockchain->address = $this->newBlockchainAddress;
            $blockchain->user_id = $user->id;
            $blockchain->save();

            $this->fetch_blockchain($blockchain);
        }
        else {
            $this->notification()->info(__("Blockchain address already exists"));
            return;
        }
    }
    public function delete_blockchain(Blockchain $blockchain)
    {
        if ($this->blockchain && $this->blockchain->id == $blockchain->id) {
            $this->blockchain = null;
        }
        $blockchain->delete();

        // Update table
        $this->emit("transactionTable.updateTable");

        // Notify
        $this->notification()->success(
            $title = __('Successfully deleted'),
            $description = ''
        );
    }


    public function fetch_blockchain(Blockchain $blockchain)
    {
        try {
            $blockchain->fetching_scheduled_at = now();
            $blockchain->save();
            BlockchainFetchJob::dispatch($blockchain);
            $this->notification()->info(
                __("Fetching :name is now scheduled", ["name" => $blockchain->getName()]),
                "Please check blockchain transactions in a couple of minutes"
            );
        }
        catch (\Exception $e) {
            $this->notification()->error(__("An error occured"), $e->getMessage());
        }
    }
}
