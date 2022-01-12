<?php

namespace App\Jobs;

use App\Helpers\BlockchainHelper;
use App\Models\Blockchain;
use App\Models\BlockchainAsset;
use App\Blockchains\BlockChainApi;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BlockchainFetchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 240;
    public Blockchain $blockchain;


    public function __construct(Blockchain $blockchain)
    {
        $this->blockchain = $blockchain;
    }


    public function handle()
    {
        // Blockchain update
        $blockchain = $this->blockchain;
        BlockchainHelper::loopOverChains(function(BlockChainApi $api, string $chainName) use ($blockchain) {
            // set address
            $api->setAddress($blockchain->address);

            // Get balance
            $balance = $api->getBalance(true);

            // Upsert Asset
            /**
             * @var BlockchainAsset $asset
             */
            $asset = BlockchainAsset::updateOrCreate(
                ["blockchain_id" => $blockchain->id, "blockchain_name" => $chainName],
                ["balance" => $balance]
            );

            // Get/Update transactions
            $asset->updateTransactions($api);
        });

        // Update timestamps
        $blockchain->fetching_scheduled_at = null;
        $blockchain->fetched_at = now();
        $blockchain->save();
    }
}
