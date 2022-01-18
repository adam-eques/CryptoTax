<?php

namespace App\Http\Livewire\AccountNew;

use App\Jobs\BlockchainFetchJob;
use App\Models\Blockchain;
use App\Models\CryptoExchange;
use App\Models\CryptoExchangeAccount;
use WireUi\Traits\Actions;

use Livewire\Component;

class AccountNew extends Component 
{

    use Actions;

    
    public ?int $selected = null;
    public ?string $search = null;

    public ?array $buttons = [
        [ 'id' => 1, 'icon' => 'exchange-1', 'name' => 'Exchange' ],
        [ 'id' => 2, 'icon' => 'wallet-1', 'name' => 'Wallets' ],
        [ 'id' => 3, 'icon' => 'blockchain', 'name' => 'Blockchains' ],
        [ 'id' => 4, 'icon' => 'others', 'name' => 'Others' ],
    ];

    public function get_selected_item( $id ){
        $this->selected = $id;
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $exchanges = CryptoExchange::query()
            ->where("active", true)
            ->where("name", "like", $search)
            ->get();

        $exchanges_array = $exchanges->toArray();

        $exchanges_array = array_filter($exchanges_array, function($exchange){
            $cryptoExchangeAccounts = auth()->user()->cryptoExchangeAccounts->toArray();
            foreach ($cryptoExchangeAccounts as $account) {
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
        
        $filtered_account_array = [];
        if ($this->selected == 1) {
            $filtered_account_array = $exchanges_array;
        }
        elseif ($this->selected == 3) {
            $filtered_account_array = $blockchains;
        }

        return view('livewire.account-new.account-new', [
            "exchanges_array" => $exchanges_array,
            "blockchains" => $blockchains,
            "filtered_account_array" => $filtered_account_array
        ]);
    }
}

