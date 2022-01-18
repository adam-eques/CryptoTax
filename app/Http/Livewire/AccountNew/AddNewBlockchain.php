<?php

namespace App\Http\Livewire\AccountNew;

use Livewire\Component;

use App\Jobs\BlockchainAccountFetchJob;
use App\Models\BlockchainAccount;
use App\Models\Blockchain;
use WireUi\Traits\Actions;

class AddNewBlockchain extends Component
{
    use Actions;

    public ?BlockchainAccount $blockchainAccount = null;
    public ?string $search = null;
    public ?string $newBlockchainAddress = null;
    public ?int $newBlockchainId= null;

    public function add()
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
            $this->fetch($blockchainAccount);
            $this->newBlockchainAddress = null;
            $this->newBlockchainId = null;
        }
        else {
            $this->notification()->info(__("Blockchain address already exists in your account"));
            return;
        }
    }

    public function fetch(BlockchainAccount $blockchainAccount)
    {
        try {
            $blockchainAccount->fetching_scheduled_at = now();
            $blockchainAccount->save();
            BlockchainAccountFetchJob::dispatch($blockchainAccount);
            $this->notification()->info(
                __("Fetching :name is now scheduled", ["name" => $blockchainAccount->getName()]),
                "Please check blockchain transactions in a couple of minutes"
            );
        }
        catch (\Exception $e) {
            $this->notification()->error(__("An error occured"), $e->getMessage());
        }
    }

    public function get_new_blockchain_id( int $id ){
        $this->newBlockchainId = $id;
    }

    public function render()
    {
        return view('livewire.account-new.add-new-blockchain', [
            "blockchainAccounts" => auth()->user()->blockchainAccounts,
            "blockchains" => Blockchain::query()->where('name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
