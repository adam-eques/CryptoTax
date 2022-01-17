<?php

namespace App\Http\Livewire\AccountNew;

use App\Models\CryptoExchange;
use App\Models\CryptoExchangeAccount;
use App\Jobs\CryptoExchangeFetchJob;
use App\Jobs\BlockchainFetchJob;
use App\Models\Blockchain;
use WireUi\Traits\Actions;
use Filament\Forms;

use Livewire\Component;

class AddNewCryptoExchange extends Component implements Forms\Contracts\HasForms
{
    use Actions;
    use Forms\Concerns\InteractsWithForms;
    
    public ?string $search = null;
    
    public ?CryptoExchangeAccount $account = null;
    public ?int $newAccountId = null;

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
    public function save_exchange()
    {
        $data = $this->form->getState();
        $this->account->credentials = $data;
        $this->account->save();
        $this->notification()->info(__("Exchange Account is added successfully"));
    }

    public function get_new_account_id( int $id )
    {
        $user = auth()->user();
        $this->newAccountId = $id;

        if (! $user->cryptoExchangeAccounts()->where("crypto_exchange_id", $this->newAccountId)->first()) {
            $account = new CryptoExchangeAccount();
            $account->crypto_exchange_id = $this->newAccountId;
            $account->user_id = $user->id;
            $account->credentials = [];
            $account->save();
            $this->edit_exchange($account);
        }
        else {
            $this->edit_exchange($user->cryptoExchangeAccounts()->where("crypto_exchange_id", $this->newAccountId)->first());
        }
    }

    public function edit_exchange( CryptoExchangeAccount $account )
    {
        $this->account = $account;
        $this->form->fill($account->credentials);
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $cryptoExchangeAccounts = auth()->user()->cryptoExchangeAccounts->where("name", "like", $search);
        $exchanges = CryptoExchange::query()
            ->where("active", true)
            ->where("name", "like", $search)
            ->whereNotIn("id", $cryptoExchangeAccounts->pluck("crypto_exchange_id")->toArray())
            ->get();
        return view('livewire.account-new.add-new-crypto-exchange', [
            "exchanges" => $exchanges,
            "cryptoExchangeAccounts" => $cryptoExchangeAccounts
        ]);
    }
}
