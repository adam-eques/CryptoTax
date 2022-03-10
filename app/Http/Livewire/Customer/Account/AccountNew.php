<?php

namespace App\Http\Livewire\Customer\Account;

use App\Jobs\CryptoAccountFetchJob;
use App\Models\BlockchainAccount;
use App\Models\Blockchain;
use App\Models\CryptoExchange;
use App\Models\CryptoAccount;
use WireUi\Traits\Actions;
use Filament\Forms;

use ccxt;

use Livewire\Component;

class AccountNew extends Component implements Forms\Contracts\HasForms
{

    use Actions;
    use Forms\Concerns\InteractsWithForms;

    public ?int $selected = null;
    public ?string $search = null;



    public ?array $buttons = [
        [ 'id' => 1, 'icon' => 'ri-exchange-dollar-line', 'name' => 'Exchange' ],
        [ 'id' => 2, 'icon' => 'carbon-wallet', 'name' => 'Wallets' ],
        [ 'id' => 3, 'icon' => 'iconpark-blockchain', 'name' => 'Blockchains' ],
        [ 'id' => 4, 'icon' => 'tabler-dots-circle-horizontal', 'name' => 'Others' ],
    ];

    public function get_selected_item( $id ){
        $this->selected = $id;
        $this->newBlockchainId= null;
        $this->newAccountId = null;
        $this->exchange_account = null;
    }

    // For Blockchain Account==================================================================================
    public ?BlockchainAccount $blockchainAccount = null;
    public ?string $newBlockchainAddress = null;
    public ?int $newBlockchainId= null;

    public function get_new_blockchain_id( int $id ){
        $this->newAccountId = null;
        $this->exchange_account = null;
        $this->newBlockchainId = $id;
    }
    public function add_blockchain()
    {
        $user = auth()->user();

        if (! $this->newBlockchainId) {
            $this->notification()->info(__("Please select a blockchain"));
            return;
        }
        if (! $this->newBlockchainAddress) {
            $this->notification()->info(__("Please enter a blockchain address"));

            return;
        }

        // Check
        $exists = $user
            ->blockchainAccounts()
            ->where("blockchain_id", $this->newBlockchainId)
            ->where("address", $this->newBlockchainAddress)
            ->first();

        // Create it
        if (!$exists) {
            $blockchainAccount = new BlockchainAccount([
                "user_id" => $user->id,
                "blockchain_id" => $this->newBlockchainId,
                "address" => $this->newBlockchainAddress
            ]);
            $blockchainAccount->save();
            $this->fetch_blockchain($blockchainAccount);
            $this->newBlockchainAddress = null;
            $this->newBlockchainId = null;
            $this->notification()->info(__("Exchange Account is added successfully"));
            redirect()->route('customer.account');
        }
        else {
            $this->notification()->info(__("Blockchain address already exists in your account"));
            redirect()->route('customer.account');
            return;
        }
    }

    public function fetch_blockchain(BlockchainAccount $blockchainAccount)
    {
        try {
            $blockchainAccount->fetching_scheduled_at = now();
            $blockchainAccount->save();
            CryptoAccountFetchJob::dispatch($blockchainAccount);
            $this->notification()->info(
                __("Fetching :name is now scheduled", ["name" => $blockchainAccount->getName()]),
                "Please check blockchain transactions in a couple of minutes"
            );
        }
        catch (\Exception $e) {
            $this->notification()->error(__("An error occured"), $e->getMessage());
        }
    }

    // For Exchange Account---------------------------------------------------------------------------------------------------------------------
    public ?CryptoAccount $exchange_account = null;
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
        if ($this->exchange_account) {
            $api = $this->exchange_account->getApi();
            $requiredCredentials = $api->getRequiredCredentials();

            return $requiredCredentials[$fieldName];
        }

        return false;
    }

    public function save_exchange()
    {
        $data = $this->form->getState();
        $this->exchange_account->credentials = $data;
        $this->exchange_account->save();
        $this->notification()->info(__("Exchange Account is added successfully"));
        redirect()->route('customer.account');
    }

    public function edit_exchange( CryptoAccount $account )
    {
        $this->exchange_account = $account;
        $this->form->fill($account->credentials);
    }

    public function get_new_exchange_id( int $id )
    {
        $this->newBlockchainId = null;
        $user = auth()->user();
        $this->newAccountId = $id;

        if (! $user->cryptoAccounts()->where("crypto_exchange_id", $this->newAccountId)->first()) {
            $account = new CryptoAccount();
            $account->crypto_exchange_id = $this->newAccountId;
            $account->user_id = $user->id;
            $account->credentials = [];
            $account->save();
            $this->edit_exchange($account);
        }
        else {
            $this->edit_exchange($user->cryptoAccounts()->where("crypto_exchange_id", $this->newAccountId)->first());
        }
    }

    // Rendering---------------------------------------------------------------------------------------------------------------------------------------------
    public function render()
    {
        $search = '%' . $this->search . '%';
        $exchanges = CryptoExchange::query()
            ->where("active", true)
            ->where("name", "like", $search)
            ->get();

        $exchanges_array = $exchanges->toArray();

        $exchanges_array = array_filter($exchanges_array, function($exchange){
            $cryptoAccounts = auth()->user()->cryptoAccounts->toArray();
            foreach ($cryptoAccounts as $account) {
                if($account['crypto_exchange_id'] == $exchange['id']){
                    if(array_key_exists("apiKey", $account['credentials'])){
                        return false;
                    }
                }
            }
            return true;
        });

        $blockchains = Blockchain::query()
            ->where("name","like",'%'.$this->search.'%')
            ->get()
            ->toArray();
        $blockchains_array = array_filter($blockchains, function($blockchain){
            $blockchainAccounts = auth()->user()->blockchainAccounts->toArray();
            foreach ($blockchainAccounts as $account) {
                if($account['blockchain_id'] == $blockchain['id']){
                    return false;
                }
            }
            return true;
        });

        return view('livewire.customer.account.account-new', [
            "exchanges_array" => $exchanges_array,
            "blockchains" => $blockchains_array,
        ]);
    }
}

