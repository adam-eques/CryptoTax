<?php

namespace App\Http\Livewire\Customer\Account;

use WireUi\Traits\Actions;
use Filament\Forms;

use App\Jobs\CryptoAccountFetchJob;
use App\Cryptos\Drivers\CryptoapisDriver;
use App\Cryptos\Drivers\CcxtDriver;
use App\Models\CryptoAccount;
use App\Models\CryptoSource;

use Livewire\Component;
use Carbon\Carbon;

class AccountNew extends Component implements Forms\Contracts\HasForms
{

    use Actions;
    use Forms\Concerns\InteractsWithForms;

    public ?CryptoAccount $selected_account = null;
    public ?int $selected_account_id = null;
    public ?int $selected_category = null;
    public ?string $search = null;

    /*
    * Setup Form Schema
    */
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

    /*
    * Get Required Credentials from Crypto API
    */
    public function isRequiredField(string $fieldName): bool
    {
        if ($this->selected_account) {
            $api = $this->selected_account->getApi();
            $requiredCredentials = $api->getRequiredCredentials();
            return in_array($fieldName, $requiredCredentials);
        }
        return false;
    }

    /*
    * Get Selected Category ID
    */
    public function get_selected_category($id)
    {
        $this->selected_category = $id;
        $this->selected_account_id = null;
        $this->selected_account = null;
    }   
    
    /*
    * add default Query for new accounts list 
    */
    protected function default_query($query)
    {
        return $query
            ->whereNotIn('id', CryptoAccount::whereJsonDoesntContain('credentials', [])
                ->where('user_id', auth()->user()->id)
                ->pluck("crypto_source_id")
                ->toArray()
            )
            ->where('active', 1)
            ->where('name', 'LIKE', '%'. $this->search . '%')
            ->get();
    }

    /**
     *  CURD New Account
     */
    public function add($id)
    {
        $this->selected_account_id = $id;

        $user = auth()->user();

        if (! $this->selected_account_id) {
            $this->notification()->info(__("Please select an account"));
            return;
        }

        if (! $user->cryptoAccounts()->where("crypto_source_id", $this->selected_account_id)->first()) {
            $account = new CryptoAccount();
            $account->crypto_source_id = $this->selected_account_id;
            $account->user_id = $user->id;
            $account->credentials = [];
            $account->save();
        }
        $this->selected_account = $user->cryptoAccounts()->where("crypto_source_id", $this->selected_account_id)->first();
        $this->form->fill($this->selected_account->credentials);
    }

    public function save()
    {
        try {
            //code...
            $data = $this->form->getState();
            $this->selected_account->credentials = $data;
            $this->selected_account->save();
            $this->notification()->info(
                __("Successfully Added")
            );
            return redirect()->route('customer.account');
        } catch (\Exception $e) {
            $this->notification()->error(__("An error occured"), $e->getMessage());
        }
    }

     

    /**
     * Rendering
     */
    public function render()
    {
        //Category Item Resource
        $categories = [
            [ 'id' => 1, 'icon' => 'ri-exchange-dollar-line', 'name' => 'Exchange' ],
            [ 'id' => 2, 'icon' => 'carbon-wallet', 'name' => 'Wallets' ],
            [ 'id' => 3, 'icon' => 'iconpark-blockchain', 'name' => 'Blockchains' ],
            [ 'id' => 4, 'icon' => 'tabler-dots-circle-horizontal', 'name' => 'Others' ],
        ];

        //Added Crypto source
        $cryptoAccounts = auth()->user()->cryptoAccounts;

        //All actived Crypto Resources
        switch ($this->selected_category) {
            case '1':
                $crypto_resources = $this->default_query(CryptoSource::activeExchanges());
                break;
            case '2':
                $crypto_resources = [];
                break;
            case '3':
                $crypto_resources = $this->default_query(CryptoSource::activeBlockchains());
                break;
            case '4':
                $crypto_resources = [];
                break;
            default:
                $crypto_resources = $this->default_query(CryptoSource::query());
                break;
        }

        return view('livewire.customer.account.account-new', [
            'categories' => $categories,
            'crypto_resources' => $crypto_resources
        ]);
    }
}

