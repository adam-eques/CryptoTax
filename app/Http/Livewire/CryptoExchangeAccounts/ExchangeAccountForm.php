<?php

namespace App\Http\Livewire\CryptoExchangeAccounts;

use App\Jobs\CryptoExchangeFetchJob;
use App\Models\CryptoExchange;
use App\Models\CryptoExchangeAccount;
use Livewire\Component;
use Filament\Forms;

class ExchangeAccountForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public int $cryptoExchangeId;
    public ?string $key = null;
    public ?string $passphrase = null;
    public ?string $secret = null;
    protected CryptoExchange $cryptoExchange;
    protected CryptoExchangeAccount $account;


    public function mount(): void
    {
        $this->cryptoExchange = CryptoExchange::query()->where("id", $this->cryptoExchangeId)->first();
        $this->account = $this->getOrCreateAccount();
        $cred = $this->account->credentials ?: [];

        if($cred) {
            $this->form->fill([
                'key' => \Arr::get($cred, "key"),
                'secret' => \Arr::get($cred, "secret"),
                'passphrase' => \Arr::get($cred, "passphrase"),
            ]);
        }
    }

    /**
     * @return \App\Models\CryptoExchangeAccount
     */
    private function getOrCreateAccount(): CryptoExchangeAccount
    {
        $user = request()->user();
        $account = $user->cryptoExchangeAccounts()->whereBelongsTo($this->cryptoExchange)->first();

        // Just for presentation purpose
        if(!$account) {
            $account = new CryptoExchangeAccount();
            $account->crypto_exchange_id = $this->cryptoExchange->id;
            $account->user_id = $user->id;
            $account->credentials = [];
            $account->save();
        }

        return $account;
    }


    protected function getFormSchema(): array
    {
        $schema = [];
        $api = $this->account->getApi();
        $requiredCredentials = $api->getRequiredCredentials();

        if($requiredCredentials["apiKey"]) {
            $schema[] = Forms\Components\TextInput::make('key')
                ->label(__("Key"))
                ->required()
                ->placeholder(__("Your API key"));
        }
        if($requiredCredentials["secret"]) {
            $schema[] = Forms\Components\TextInput::make('secret')
                ->label(__("Secret"))
                ->required()
                ->placeholder(__("Your API secret"));
        }
        if($requiredCredentials["password"]) {
            $schema[] = Forms\Components\TextInput::make('passphrase')
                ->label(__("Passphrase"))
                ->required()
                ->placeholder(__("Your API passphrase"));
        }

        return $schema;
    }


    public function submit()
    {
        $this->cryptoExchange = CryptoExchange::query()->where("id", $this->cryptoExchangeId)->first();
        $this->account = $this->getOrCreateAccount();
        $this->account->credentials = $this->form->getState();
        $this->account->save();

        // Add job
        CryptoExchangeFetchJob::dispatch($this->account);

        // Notification
        $this->emitTo('livewire-toast', 'show', 'Exchange settings updated. It will need some time to fetch updates from exchange.');
    }


    public function render()
    {
        return view('livewire.crypto-exchange-accounts.exchange-account-form');
    }
}
