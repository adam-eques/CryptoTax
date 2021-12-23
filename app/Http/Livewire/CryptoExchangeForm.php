<?php

namespace App\Http\Livewire;

use App\Models\CryptoExchange;
use App\Models\CryptoExchangeAccount;
use Livewire\Component;
use Filament\Forms;
use WireUi\Traits\Actions;

class CryptoExchangeForm extends Component implements Forms\Contracts\HasForms
{
    use Actions;
    use Forms\Concerns\InteractsWithForms;

    public ?CryptoExchangeAccount $account = null;
    public ?int $newAccountId = null;


    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('key')
                ->visible(fn ($livewire) => $livewire->isRequiredField('apiKey'))
                ->label(__("Key"))
                ->required()
                ->placeholder(__("Your API key")),
            Forms\Components\TextInput::make('secret')
                ->visible(fn ($livewire) => $livewire->isRequiredField('secret'))
                ->label(__("Secret"))
                ->required()
                ->placeholder(__("Your API secret")),
            Forms\Components\TextInput::make('passphrase')
                ->visible(fn ($livewire) => $livewire->isRequiredField('password'))
                ->label(__("Passphrase"))
                ->required()
                ->placeholder(__("Your API passphrase"))
        ];
    }


    public function render()
    {
        $cryptoExchangeAccounts = auth()->user()->cryptoExchangeAccounts;
        $exchanges = CryptoExchange::query()
            ->where("active", true)
            ->whereNotIn("id", $cryptoExchangeAccounts->pluck("crypto_exchange_id")->toArray())
            ->get();

        return view('livewire.crypto-exchange-form', [
            "exchanges" => $exchanges,
            "cryptoExchangeAccounts" => $cryptoExchangeAccounts,
        ]);
    }


    public function delete(CryptoExchangeAccount $account)
    {
        if ($this->account && $this->account->id == $account->id) {
            $this->account = null;
        }
        $account->delete();

        $this->notification()->success(
            $title = 'Successfully deleted',
            $description = ''
        );
    }


    public function save()
    {
        $data = $this->form->getState();
        $this->account->credentials = $data;
        $this->account->save();
    }


    public function edit(CryptoExchangeAccount $account)
    {
        $this->account = $account;
        $this->form->fill($account->credentials);
    }

    public function isRequiredField(string $fieldName)
    {
        if ($this->account) {
            $api = $this->account->getApi();
            $requiredCredentials = $api->getRequiredCredentials();

            return $requiredCredentials[$fieldName];
        }

        return false;
    }


    public function add()
    {
        $user = auth()->user();

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

        $this->edit($account);
    }
}
