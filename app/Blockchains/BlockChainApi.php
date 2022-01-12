<?php

namespace App\Blockchains;

use GuzzleHttp\Client;

abstract class BlockChainApi
{
    protected ?string $address = null;
    protected array $extraParams = [];
    protected string $baseUrl;


    /**
     * @param string $address
     * @return static
     */
    public static function make(?string $address = null): self
    {
        $obj = new static();
        $obj->setAddress($address);

        return $obj;
    }


    public function getTransactionsSince(int $startTimeStamp = 0): array
    {
        return $this->getTransactions([
            "starttimestamp" => $startTimeStamp,
            "sort" => "asc"
        ]);
    }


    public function getTransactions(array $params = []): array
    {
        // Cronos: Will get only 10.000 transaction - need to use paging if you need more - see https://cronos.crypto.org/explorer/api-docs#account-txlist
        $result = $this->callAccount("txlist", true, $params);

        return $result["result"] ?: [];
    }


    /**
     * Returns the balance as int (with 20 decimals moved to right). This means you have to
     *
     * @param bool $convertToDecimal
     * @return int|float
     * @throws \Exception
     */
    public function getBalance(bool $convertToDecimal = false): int|float
    {
        $result = $this->callAccount("balance", true);
        $balance = (int) $result["result"];

        return $convertToDecimal ? $balance / 1000000000000000000 : $balance;
    }


    protected function callAccount(string $action, bool $includeAddress = false, array $params = []): array
    {
        if ($includeAddress) {
            $params["address"] = $this->address;
        }

        $result = $this->call('account', $action, $params);

        return $result;
    }


    protected function call(string $module, string $action, array $params = []): array
    {
        // Preparing request
        $client = new Client();
        $params = array_merge([
            "module" => $module,
            "action" => $action,
        ], $this->extraParams, $params);

        // Request
        $response = $client->request('GET', $this->baseUrl."?".http_build_query($params), [
            'verify' => false,
        ]);

        return json_decode($response->getBody(), true);
    }


    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }


    /**
     * @param string $address
     * @return self
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
