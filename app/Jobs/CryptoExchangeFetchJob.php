<?php

namespace App\Jobs;

use App\Models\CryptoExchangeAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CryptoExchangeFetchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public CryptoExchangeAccount $account;

    public function __construct(CryptoExchangeAccount $account)
    {
        $this->account = $account;
    }

    public function handle()
    {
        $this->account->getApi()->updateTransactions();
    }
}
