<?php

namespace App\CryptoExchangeDrivers;


use KuCoin\SDK\Auth;
use KuCoin\SDK\KuCoinApi;
use KuCoin\SDK\PrivateApi\Account;
use KuCoin\SDK\PrivateApi\Fill;
use KuCoin\SDK\PrivateApi\Order;

/**
 * Class KucoinDriver
 *
 * @package App\CryptoExchangeDrivers
 *
 * @property Auth $connection
 */
class KucoinDriver extends Driver
{

    /**
     * @return $this
     * @throws \Exception
     */
    public function connect(): self
    {
        $credentials = $this->getCredentials();
        if(!$credentials || !isset($credentials["key"])) {
            throw new \Exception("Missing credentials for KucoinDriver");
        }

        // Set Prod or Sandbox
        KuCoinApi::setBaseUri(config("crypto-exchanges.kucoin.url"));

        // Debug mode
        //KuCoinApi::setDebugMode(true);
        //KuCoinApi::setLogPath(__DIR__ . "/kucoin.log");

        // Auth version v2 (recommend)
        $this->connection = new Auth(
            \Arr::get($credentials, "key"),
            \Arr::get($credentials, "secret"),
            \Arr::get($credentials, "passphrase"),
            Auth::API_KEY_VERSION_V2
        );

        return $this;
    }

    /**
     * @return \KuCoin\SDK\PrivateApi\Account
     */
    public function queryAccount()
    {
        return new Account($this->connection);
    }

    /**
     * @return \KuCoin\SDK\PrivateApi\Order
     */
    protected function queryOrder()
    {
        return new Order($this->connection);
    }

    /**
     * @return array
     * @throws \KuCoin\SDK\Exceptions\BusinessException
     * @throws \KuCoin\SDK\Exceptions\HttpException
     * @throws \KuCoin\SDK\Exceptions\InvalidApiUriException
     */
    public function getHoldings(): array
    {
        return $this->queryAccount()->getList();
    }

    /**
     * @return array
     * @throws \KuCoin\SDK\Exceptions\BusinessException
     * @throws \KuCoin\SDK\Exceptions\HttpException
     * @throws \KuCoin\SDK\Exceptions\InvalidApiUriException
     */
    public function getOrders()
    {
        return $this->getHoldings();

        return (new Transaction($this->connection))->getDetail();


        return (new Fill($this->connection))->getList([
                "startAt" => mktime(0, 0, 0, 1, 1, 2010),
                "endAt" => mktime(23, 59, 59, 12, 31, 2021),
            ]

        );
        return $this->queryOrder()->getV1List([
            "startAt" => mktime(0, 0, 0, 1, 1, 2010),
            "endAt" => mktime(23, 59, 59, 12, 31, 2099),
        ]);
    }
}
