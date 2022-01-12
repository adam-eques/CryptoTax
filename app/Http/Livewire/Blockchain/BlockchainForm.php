<?php

namespace App\Http\Livewire\Blockchain;

use App\Jobs\BlockchainFetchJob;
use App\Models\Blockchain;
use Livewire\Component;
use WireUi\Traits\Actions;

class BlockchainForm extends Component
{
    use Actions;

    public ?Blockchain $blockchain = null;
    public ?string $newBlockchainAddress = null;


    public function render()
    {
        $blockchains = auth()->user()->blockchains;

        return view('livewire.blockchain.blockchain-form', [
            "blockchains" => $blockchains,
        ]);
    }


    public function delete(Blockchain $blockchain)
    {
        if ($this->blockchain && $this->blockchain->id == $blockchain->id) {
            $this->blockchain = null;
        }
        $blockchain->delete();

        // Update table
        $this->emit("transactionTable.updateTable");

        // Notify
        $this->notification()->success(
            $title = __('Successfully deleted'),
            $description = ''
        );
    }


    public function fetch(Blockchain $blockchain)
    {
        try {
            $blockchain->fetching_scheduled_at = now();
            $blockchain->save();
            BlockchainFetchJob::dispatch($blockchain);
            $this->notification()->info(
                __("Fetching :name is now scheduled", ["name" => $blockchain->getName()]),
                "Please check blockchain transactions in a couple of minutes"
            );
        }
        catch (\Exception $e) {
            $this->notification()->error(__("An error occured"), $e->getMessage());
        }
    }


    public function add()
    {
        $user = auth()->user();

        if (! $this->newBlockchainAddress) {
            $this->notification()->info(__("Please enter a blockchain address"));

            return;
        }

        if (! $user->blockchains()->where("address", $this->newBlockchainAddress)->first()) {
            $blockchain = new Blockchain();
            $blockchain->address = $this->newBlockchainAddress;
            $blockchain->user_id = $user->id;
            $blockchain->save();

            $this->fetch($blockchain);
        }
        else {
            $this->notification()->info(__("Blockchain address already exists"));
            return;
        }
    }
}
