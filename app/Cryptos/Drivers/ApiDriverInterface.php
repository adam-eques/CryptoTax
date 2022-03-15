<?php

namespace App\Cryptos\Drivers;

use App\Models\CryptoAccount;

interface ApiDriverInterface
{
    /**
     * Create a new instance
     *
     * @param \App\Models\CryptoAccount $account
     * @return static
     */
    public static function make(CryptoAccount $account): self;


    /**
     * @return array Array of required credentials
     */
    public function getRequiredCredentials(): array;


    /**
     * Updates the linked account
     *
     * @return $this
     */
    public function update(): self;


    /**
     * Get the api interface of the driver
     *
     * @return api
     */
    public function getApi();


    /**
     * Check if the driver is connected
     *
     * @return bool
     */
    public function isConnected() : bool;
}