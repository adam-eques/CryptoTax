<?php

namespace App\Http\Livewire\AccountNew;

use App\Jobs\BlockchainFetchJob;
use App\Models\Blockchain;
use WireUi\Traits\Actions;

use Livewire\Component;

class AccountNew extends Component 
{

    use Actions;

    
    public ?int $selected = 1;

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
        return view('livewire.account-new.account-new');
    }
}

