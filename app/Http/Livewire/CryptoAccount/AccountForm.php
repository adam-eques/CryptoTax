<?php

namespace App\Http\Livewire\CryptoAccount;

use App\Http\Livewire\Traits\DemoUserTrait;
use App\Models\CryptoAccount;
use App\Models\CryptoSource;
use Filament\Forms;
use Livewire\Component;
use WireUi\Traits\Actions;

class AccountForm extends Component implements Forms\Contracts\HasForms
{
    use Actions;
    use DemoUserTrait;
    use Forms\Concerns\InteractsWithForms;

    public ?CryptoAccount $account = null;
    public ?int $newAccountId = null;


    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('apiKey')
                ->visible(fn($livewire) => $livewire->isRequiredField('apiKey'))
                ->label(__("Key"))
                ->required()
                ->placeholder(__("Your API key")),
            Forms\Components\TextInput::make('address')
                ->visible(fn($livewire) => $livewire->isRequiredField('address'))
                ->label(__("Address"))
                ->required()
                ->placeholder(__("Your Address here")),
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
        $cryptoAccounts = auth()->user()->cryptoAccounts;

        return view('livewire.crypto-account.account-form', [
            "exchanges" => CryptoSource::activeExchanges()
                ->whereNotIn("id", $cryptoAccounts->pluck("crypto_source_id")->toArray())
                ->get(),
            "blockchains" => CryptoSource::activeBlockchains()
                ->whereNotIn("id", $cryptoAccounts->pluck("crypto_source_id")->toArray())
                ->get(),
            "cryptoAccounts" => $cryptoAccounts,
        ]);
    }


    public function delete(CryptoAccount $account)
    {
        if($this->preventDemoUser()) return;

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


    public function save()
    {
        if($this->preventDemoUser()) return;
        $data = $this->form->getState();
        $this->account->credentials = $data;
        $this->account->save();
        $this->fetch($this->account);
    }


    public function edit(CryptoAccount $account)
    {
        $this->account = $account;
        $this->form->fill($account->credentials);
    }


    public function isRequiredField(string $fieldName): bool
    {
        if ($this->account) {
            $api = $this->account->getApi();
            $requiredCredentials = $api->getRequiredCredentials();

            return in_array($fieldName, $requiredCredentials);
        }

        return false;
    }


    public function fetch(CryptoAccount $account)
    {
        if($this->preventDemoUser()) return;

        try {
            $account->requestUpdate();
            $this->notification()->info(
                __("Fetching :name is now scheduled", ["name" => $account->getName()]),
                "Please check transactions in a couple of minutes"
            );
        }
        catch (\Exception $e) {
            $this->notification()->error(__("An error occured"), $e->getMessage());
        }
    }


    public function add()
    {
        if($this->preventDemoUser()) return;
        $user = auth()->user();

        if (! $this->newAccountId) {
            $this->notification()->info(__("Please select an account"));

            return;
        }

        if (! $user->cryptoAccounts()->where("crypto_source_id", $this->newAccountId)->first()) {
            $account = new CryptoAccount();
            $account->crypto_source_id = $this->newAccountId;
            $account->user_id = $user->id;
            $account->credentials = [];
            $account->save();
        }

        $this->edit($account);
    }
}
