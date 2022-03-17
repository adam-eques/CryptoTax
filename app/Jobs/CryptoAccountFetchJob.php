<?php

namespace App\Jobs;

use App\Models\CryptoAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CryptoAccountFetchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout = 240;
    public CryptoAccount $account;


    public function __construct(CryptoAccount $account)
    {
        $this->account = $account;
    }


    public function handle()
    {
        $api = $this->account->getApi();
        $api->update();
        $this->account->fetching_scheduled_at = null;
        $this->account->save();
    }
}
