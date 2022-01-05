<?php

namespace App\Http\Livewire\Wallet;

use App\Jobs\WalletFetchJob;
use App\Models\Wallet;
use Livewire\Component;
use WireUi\Traits\Actions;

class WalletForm extends Component
{
    use Actions;

    public ?Wallet $wallet = null;
    public ?string $newWalletAddress = null;


    public function render()
    {
        $wallets = auth()->user()->wallets;

        return view('livewire.wallet.wallet-form', [
            "wallets" => $wallets,
        ]);
    }


    public function delete(Wallet $wallet)
    {
        if ($this->wallet && $this->wallet->id == $wallet->id) {
            $this->wallet = null;
        }
        $wallet->delete();

        // Update table
        $this->emit("transactionTable.updateTable");

        // Notify
        $this->notification()->success(
            $title = __('Successfully deleted'),
            $description = ''
        );
    }


    public function fetch(Wallet $wallet)
    {
        try {
            $wallet->fetching_scheduled_at = now();
            $wallet->save();
            WalletFetchJob::dispatch($wallet);
            $this->notification()->info(
                __("Fetching :name is now scheduled", ["name" => $wallet->getName()]),
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
            $wallet = new Wallet();
            $wallet->address = $this->newWalletAddress;
            $wallet->user_id = $user->id;
            $wallet->save();

            $this->fetch($wallet);
        }
        else {
            $this->notification()->info(__("Wallet address already exists"));
            return;
        }
    }
}
