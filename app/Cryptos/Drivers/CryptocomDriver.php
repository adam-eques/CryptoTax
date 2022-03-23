<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;
use Carbon\Carbon;
use App\Helpers\TestHelper;


/**
 * Class Cryptocom
 *
 *
 */
class CryptocomDriver extends CcxtDriver
{
    /**
     * @return $this
     */
    public function update() : self {
        $balance = $this->fetchBalances();
        $this->saveBalances($balance);
        $since = Carbon::create(2016, 1, 1);
        $account = $this->account;
        if ( $account->fetched_at != NULL && $account->fetched_at->timestamp > $since->timestamp )
        {
            $since = $account->fetched_at;
        }
        $exchange = $this->api->exchange;

        
        
        // testing
        $data = $exchange->fetchMarkets();
        // TestHelper::save2file('../test_markets.php', $exchange->markets);
  //      TestHelper::save2file('../test_fetchmarkets.php', $data);
        
        $data = $exchange->fetchMyTrades(NULL, $since->timestamp*1000);
        // while($since->isPast()) {
        //     $this->saveTransactions($data);
        //     sleep(1);
        //     $since->addDays(1);
        // }

        $this->account->update(['fetched_at' => now()]);

        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    protected function connect(): self
    {
        $this->api = new CCXTAPI();
        $exchange_id = 'cryptocom';
        $credentials = $this->getCredentials();
        $this->connected = $this->api->loadExchange($exchange_id, [
            'apiKey' => $credentials['apiKey'],
            'secret' => $credentials['secret']
        ]);
        return $this;
    }

    /**
     * @return array
     */
    public function getRequiredCredentials(): array
    {
        return ['apiKey', 'secret'];
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTransactions(Carbon $from = null): array
    {
        return [];
    }
}
