<?php

namespace App\Http\Livewire\CryptoExchangeAccounts;

use App\Models\CryptoExchangeAccount;
use Livewire\Component;
use Filament\Forms;

class KucoinForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    public CryptoExchangeAccount $account;

    public string $key = "";
    public string $passphrase = "";
    public string $secret = "";


    public function mount(): void
    {
        $cred = $this->account->credentials;

        if($cred) {
            $this->form->fill([
                'key' => $cred["key"],
                'secret' => $cred["secret"],
                'passphrase' => $cred["passphrase"],
            ]);
        }
    }


    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('key')
                ->label(__("Key"))
                ->required()
                ->placeholder(__("Your Kucoin API key")),
            Forms\Components\TextInput::make('secret')
                ->label(__("Secret"))
                ->required()
                ->placeholder(__("Your Kucoin API secret")),
            Forms\Components\TextInput::make('passphrase')
                ->label(__("Passphrase"))
                ->required()
                ->placeholder(__("Your Kucoin API passphrase")),
        ];
    }


    public function submit()
    {
        $this->account->credentials = $this->form->getState();
        $this->account->save();
    }


    public function render()
    {
        return view('livewire.crypto-exchange-accounts.kucoin-form');
    }
}
