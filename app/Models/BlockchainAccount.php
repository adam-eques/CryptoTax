<?php

namespace App\Models;

use App\Helpers\BlockchainHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $user_id
 * @property int $blockchain_id
 * @property string $address
 * @property float $balance
 * @property \Carbon\Carbon $fetched_at
 * @property \Carbon\Carbon $fetching_scheduled_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property Blockchain $blockchain
 * @property User $user
 * @property \Illuminate\Support\Collection<\App\Models\BlockchainTransaction> $blockchainTransactions
 */
class BlockchainAccount extends Model
{
    protected $guarded = [];

    protected $casts = [
        'fetched_at' => 'datetime',
        'fetching_scheduled_at' => 'datetime',
    ];


    public static function boot()
    {
        parent::boot();

        static::deleting(function (self $item) {
            $item->blockchainTransactions()->delete();
        });
    }


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function blockchain(): BelongsTo
    {
        return $this->belongsTo(Blockchain::class);
    }


    public function blockchainTransactions(): HasMany
    {
        return $this->hasMany(BlockchainTransaction::class);
    }


    public function getName(): string
    {
        return $this->blockchain->getName() . ": " . $this->address;
    }


    public function fetchApi()
    {
        /**
         * @var \App\Blockchains\BscScanBlockChainApi $api
         */
        // Create api
        $class = "\\App\\Blockchains\\" . $this->blockchain->class;
        $api = new $class();
        $api->setAddress($this->address);
        $now = now();

        // Start transaction
        \DB::beginTransaction();

        // Get Balance
        $this->balance = $api->getBalance(true);

        // Get Transactions
        $userId = $this->user_id;
        $blockchainAccountId = $this->id;
        $lastEntry = $this->blockchainTransactions()
            ->orderBy("time_stamp", "desc")
            ->first();
        $lastTimeStamp = $lastEntry?->time_stamp; // 1639314121
        $transactions = $api->getTransactionsSince($lastTimeStamp + 1);
        $data = collect($transactions)->map(function($item) use ($blockchainAccountId, $userId) {
            return [
                "blockchain_account_id" => $blockchainAccountId,
                "user_id" => $userId,
                "block_hash" => $item["blockHash"],
                "block_number" => $item["blockNumber"],
                "confirmations" => $item["confirmations"],
                "contract_address" => $item["contractAddress"],
                "cumulative_gas_used" => BlockchainHelper::convertToDecimalString($item["cumulativeGasUsed"]),
                "from" => $item["from"],
                "gas" => BlockchainHelper::convertToDecimalString($item["gas"]),
                "gas_price" => BlockchainHelper::convertToDecimalString($item["gasPrice"]),
                "gas_used" => BlockchainHelper::convertToDecimalString($item["gasUsed"]),
                "hash" => $item["hash"],
                "input" => $item["input"],
                "is_error" => $item["isError"],
                "nonce" => $item["nonce"],
                "time_stamp" => $item["timeStamp"],
                "to" => $item["to"],
                "transaction_index" => $item["transactionIndex"],
                "txreceipt_status" => $item["txreceipt_status"],
                "value" => BlockchainHelper::convertToDecimalString($item["value"])
            ];
        });
        BlockchainTransaction::insert($data->toArray());

        // Save fetch staties
        $this->fetched_at = $now;
        $this->fetching_scheduled_at = null;
        $this->save();

        // End Transaction
        \DB::commit();

        return $this;
    }
}
