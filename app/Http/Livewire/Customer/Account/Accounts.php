<?php

namespace App\Http\Livewire\Customer\Account;

use Livewire\Component;

use App\Cryptos\Drivers\CryptoapisDriver;
use App\Cryptos\Drivers\CcxtDriver;
use App\Jobs\CryptoAccountFetchJob;
use App\Models\CryptoAccount;
use App\Models\BlockchainAccount;
use Filament\Forms;
use WireUi\Traits\Actions;

use Carbon\Carbon;

class Accounts extends Component implements Forms\Contracts\HasForms
{
    use Actions;
    use Forms\Concerns\InteractsWithForms;

    public ?CryptoAccount $selected_account = null;

    public function mount()
    {
        $this->selected_account = auth()->user()->cryptoAccounts()->first();
        $this->edit();
    }


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
        if ($this->selected_account) {
            $api = $this->selected_account->getApi();
            $requiredCredentials = $api->getRequiredCredentials();

            return in_array($fieldName, $requiredCredentials);
        }

        return false;
    }

    /**
     * Get Selected Account ID
     */

    public function get_selected_account_id($id)
    {
        $this->selected_account = auth()->user()->cryptoAccounts()->where('id', $id)->first();
    }

    /**
     * Edit Account
     */

    public function edit()
    {
        if(!$this->selected_account)
        {
            $this->notification()->info(__("Please select an account"));
            return;
        }
        $this->form->fill($this->selected_account->credentials);
    }

    /**
     * Save Account
     */

    public function save()
    {
        if(!$this->selected_account)
        {
            $this->notification()->info(__("Please select an account"));
            return;
        }
        $data = $this->form->getState();
        $this->selected_account->credentials = $data;
        $this->selected_account->save();
    }

    /**
     * Delete Account
     */

    public function delete()
    {
        if(!$this->selected_account)
        {
            $this->notification()->info(__("Please select an account"));
            return;
        }

        $this->selected_account->delete();

        // Update table
        $this->emit("transactionTable.updateTable");

        // Notify
        $this->notification()->success(
            $title = __('Successfully deleted'),
            $description = ''
        );
        
    }

    /**
     * Fetch Transaction Account
     */

    public function sync()
    {
        if(!$this->selected_account)
        {
            $this->notification()->info(__("Please select an account"));
            return;
        }
        if( $this->selected_account->cryptoSource->type == 'E' ){
            try {

                $driver = CcxtDriver::make($this->selected_account);
                $driver->update();

                $this->notification()->info(
                    __("Fetched Successfully"),
                    "Please check transactions"
                );
            }
            catch (\Exception $e) {
                $this->notification()->error(__("An error occured"), $e->getMessage());
            }
        }
        elseif($this->selected_account->cryptoSource->type == 'B')
        {
            try {
                $driver = CryptoapisDriver::make($this->selected_account);
                $driver->update();

                $this->notification()->info(
                    __("Fetched Successfully"),
                    "Please check transactions"
                );
            } catch (\Exception $e) {
                $this->notification()->error(__("An error occured"), $e->getMessage());
            }
        }
        
    }

    /**
     * Rendering
     */
    public function render()
    {

        // $crypto_accounts = auth()->user()->cryptoAccounts;
        $crypto_accounts = CryptoAccount::query()
            ->where('user_id', auth()->user()->id)
            ->whereJsonDoesntContain('credentials', [])
            ->get();

        $rows = [
            ["id" => 1, "label" => "Exchanges"],
            ["id" => 2, "label" => "Wallets"],
            ["id" => 3, "label" => "Blockchain"],
            ["id" => 4, "label" => "Others"],
        ];

        return view('livewire.customer.account.accounts', [
            "rows" => $rows,
            "crypto_accounts" => $crypto_accounts
        ]);
    }
}
