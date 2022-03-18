<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $short_name
 * @property string $icon
 * @property string $coingecko_id
 * @property \Carbon\Carbon $fetched_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 */
class CryptoCurrency extends Model
{
    public function cryptoAssets()
    {
        return $this->hasMany(CryptoAsset::class);
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function convertTo(float $value, string $otherCurrency): float
    {
        // First check age of last fetch; 35 Minutes, because the scheduled job runs every 15min
        $lifetime = config("app.cryptos.coingecko.prices_lifetime");
        if(!$this->fetched_at || $this->fetched_at < now()->addMinutes(-$lifetime)) {
            $this->updateRowFromApi();
        }

        // Get var name
        $var = "currency_" . strtolower($otherCurrency);

        return $this->$var * $value;
    }


    public static function findByShortName(string $shortName)
    {
        return static::query()
            ->where("short_name", $shortName)
            ->first();
    }


    protected function updateRowFromApi(): self
    {
        $client = new \Codenixsv\CoinGeckoApi\CoinGeckoClient();
        $vsCurrencies = join(",", CoingeckoSupportedVsCurrencies::getCurrencies());
        $result = [];

        // get price data from coingecko
        try {
            $client->simple()->getPrice($this->coingecko_id, $vsCurrencies);
        } catch (\Throwable $th) {
            throw $th;
        }

        foreach($result[$this->coingecko_id] AS $currency => $value) {
            $var = "currency_" . strtolower($currency);
            $this->$var = $value;
        }

        // Set fetched_at
        $this->fetched_at = now();
        $this->save();

        return $this;
    }


    /**
     * Update ALL rows
     *
     * @return void
     * @throws \Exception
     */
    public static function updateAllRowsFromApi(): void
    {
        $limit = 300;
        $offset = 0;
        $loopCounter = 0;

        while($currencies = static::query()->limit($limit)->offset($offset)->pluck("coingecko_id")->toArray()) {
            $currencies = join(",", $currencies);
            $offset += $limit;
            $loopCounter++;
            static::updateRowsFromApi($currencies);

            if($loopCounter == 40) { // so that we do not get a timeout after 50 requests
                sleep(30);
            }
        }
    }


    /**
     * Updates all provided coingecko rows
     *
     * @param string $coingeckoCurrencyCsv
     * @return void
     * @throws \Exception
     */
    public static function updateRowsFromApi(string $coingeckoCurrencyCsv): void
    {
        $client = new \Codenixsv\CoinGeckoApi\CoinGeckoClient();
        $vsCurrencies = join(",", CoingeckoSupportedVsCurrencies::getCurrencies());
        $result = [];

        // get price data from coingecko
        try {
            $result = $client->simple()->getPrice($coingeckoCurrencyCsv, $vsCurrencies);
        } catch (\Throwable $th) {
            throw $th;
        }
        $updates = [];

        foreach($result AS $key => $conversions) {
            $update = "UPDATE crypto_currencies SET ";
            foreach($conversions AS $cur => $val) {
                $update.= "currency_" . strtolower($cur) . " = " . number_format($val, 10, ".", "") . ", ";
            }
            $update.= "fetched_at = '" . now() . "' WHERE coingecko_id = '$key'";
            $updates[] = $update;
        }

        // Run query
        \DB::unprepared(implode(";\n\n", $updates));
    }


    /**
     * This methods updates the list of coins, not the corresponding rates
     * @return void
     * @throws \Exception
     */
    public static function updateListFromApi(): void
    {
        $client = new \Codenixsv\CoinGeckoApi\CoinGeckoClient();
        $coinList = $client->coins()->getList();
        $formated = collect($coinList)->map(function ($item) {
            return [
                'name' => $item["name"],
                'short_name' => strtoupper($item["symbol"]),
                'coingecko_id' => $item["id"],
            ];
        });

        $formated->each(function ($data) {
            CryptoCurrency::updateOrCreate([
                "short_name" => $data["short_name"],
            ], $data);
        });
    }
}
