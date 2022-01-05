<?php

namespace App\Jobs;

use App\Helpers\BlockchainHelper;
use App\Models\Wallet;
use App\Models\WalletAsset;
use App\Wallets\BlockChainApi;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class WalletFetchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 240;
    public Wallet $wallet;


    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }


    public function handle()
    {
        // Wallet update
        $wallet = $this->wallet;
        BlockchainHelper::loopOverChains(function(BlockChainApi $api, string $chainName) use ($wallet) {
            // set address
            $api->setAddress($wallet->address);

            // Get balance
            $balance = $api->getBalance(true);

            // Upsert Asset
            /**
             * @var WalletAsset $asset
             */
            $asset = WalletAsset::updateOrCreate(
                ["wallet_id" => $wallet->id, "blockchain_name" => $chainName],
                ["balance" => $balance]
            );

            // Get/Update transactions
            $asset->updateTransactions($api);
        });

        // Update timestamps
        $wallet->fetching_scheduled_at = null;
        $wallet->fetched_at = now();
        $wallet->save();
    }
}
