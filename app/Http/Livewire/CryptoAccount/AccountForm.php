<?php

namespace App\Http\Livewire\CryptoAccount;

use App\Jobs\CryptoAccountFetchJob;
use App\Models\CryptoAccount;
use App\Models\CryptoSource;
use Filament\Forms;
use Livewire\Component;
use WireUi\Traits\Actions;

class AccountForm extends Component implements Forms\Contracts\HasForms
{
    use Actions;
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
        $exchanges = CryptoSource::query()
            ->where("active", true)
            ->whereNotIn("id", $cryptoAccounts->pluck("crypto_exchange_id")->toArray())
            ->get();

        return view('livewire.crypto-account.account-form', [
            "exchanges" => $exchanges,
            "cryptoAccounts" => $cryptoAccounts,
        ]);
    }


    public function delete(CryptoAccount $account)
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


    public function save()
    {
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

            return $requiredCredentials[$fieldName];
        }

        return false;
    }


    public function fetch(CryptoAccount $account)
    {
        try {
            $account->fetching_scheduled_at = now();
            $account->save();
            CryptoAccountFetchJob::dispatch($account);
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
        $user = auth()->user();

        if (! $this->newAccountId) {
            $this->notification()->info(__("Please select an exchange"));

            return;
        }

        if (! $user->cryptoAccounts()->where("crypto_exchange_id", $this->newAccountId)->first()) {
            $account = new CryptoAccount();
            $account->crypto_exchange_id = $this->newAccountId;
            $account->user_id = $user->id;
            $account->credentials = [];
            $account->save();
        }

        $this->edit($account);
    }
}
