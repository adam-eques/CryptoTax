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
    public ?string $newWalletAddress = null;


    public function render()
    {
        $wallets = auth()->user()->wallets;

        return view('livewire.blockchain.blockchain-form', [
            "wallets" => $wallets,
        ]);
    }


    public function delete(Blockchain $blockchain)
    {
        if ($this->wallet && $this->wallet->id == $blockchain->id) {
            $this->wallet = null;
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
                "Please check wallet transactions in a couple of minutes"
            );
        }
        catch (\Exception $e) {
            $this->notification()->error(__("An error occured"), $e->getMessage());
        }
    }


    public function add()
    {
        $user = auth()->user();

        if (! $this->newWalletAddress) {
            $this->notification()->info(__("Please enter a wallet address"));

            return;
        }

        if (! $user->wallets()->where("address", $this->newWalletAddress)->first()) {
            $blockchain = new Blockchain();
            $blockchain->address = $this->newWalletAddress;
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
