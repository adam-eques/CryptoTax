<?php

namespace App\Models;

use App\Helpers\BlockchainHelper;
use App\Blockchains\BlockChainApi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 //* @property Collection<BlockChainAccount> $blockchainAccounts
 //* @property \App\Models\Blockchain $blockchain
 *
 * @property string $name
 * @property string $description
 * @property string $class
 * @property string $icon
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property Collection<BlockChainAccount> $blockchainAccounts
 */
class Blockchain extends Model
{
    protected $guarded = [];


    public static function boot()
    {
        parent::boot();

        static::deleting(function (self $item) {
            $item->blockchainAccounts->each(function($row){
                $row->delete();
            });
        });
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blockchainAccounts(): HasMany
    {
        return $this->hasMany(BlockchainAccount::class);
    }


    public function getName(): string
    {
        return $this->name;
    }


    //
    //
    //public static function boot()
    //{
    //    parent::boot();
    //
    //    static::deleting(function (self $item) {
    //        $item->blockchainTransactions()->delete();
    //    });
    //}
    //
    //public function blockchain(): BelongsTo
    //{
    //    return $this->belongsTo(Blockchain::class);
    //}
    //
    //
    //public function blockchainTransactions(): HasMany
    //{
    //    return $this->hasMany(BlockchainTransaction::class);
    //}
    //
    //
    //public function updateTransactions(BlockChainApi $api): self
    //{
    //    $assetId = $this->id;
    //    $lastEntry = $this->blockchainTransactions()
    //        ->orderBy("time_stamp", "desc")
    //        ->first();
    //    $lastTimeStamp = $lastEntry?->time_stamp; // 1639314121
    //
    //    // TODO: Paging, etc.
    //    $transactions = $api->getTransactionsSince($lastTimeStamp + 1);
    //    $data = collect($transactions)->map(function($item) use ($assetId) {
    //        return [
    //            "blockchain_asset_id" => $assetId,
    //            "block_hash" => $item["blockHash"],
    //            "block_number" => $item["blockNumber"],
    //            "confirmations" => $item["confirmations"],
    //            "contract_address" => $item["contractAddress"],
    //            "cumulative_gas_used" => BlockchainHelper::convertToDecimalString($item["cumulativeGasUsed"]),
    //            "from" => $item["from"],
    //            "gas" => BlockchainHelper::convertToDecimalString($item["gas"]),
    //            "gas_price" => BlockchainHelper::convertToDecimalString($item["gasPrice"]),
    //            "gas_used" => BlockchainHelper::convertToDecimalString($item["gasUsed"]),
    //            "hash" => $item["hash"],
    //            "input" => $item["input"],
    //            "is_error" => $item["isError"],
    //            "nonce" => $item["nonce"],
    //            "time_stamp" => $item["timeStamp"],
    //            "to" => $item["to"],
    //            "transaction_index" => $item["transactionIndex"],
    //            "txreceipt_status" => $item["txreceipt_status"],
    //            "value" => BlockchainHelper::convertToDecimalString($item["value"])
    //        ];
    //    });
    //
    //    BlockchainTransaction::insert($data->toArray());
    //
    //    return $this;
    //}
}
