<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $short_name
 * @property string $icon
 * @property string $coingecko_id
 * @property string $fetched_history_date_from
 * @property string $fetched_history_date_till
 * @property bool   $fetch_history
 * @property \Carbon\Carbon $fetched_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 *
 * @property \Illuminate\Database\Eloquent\Collection<CryptoAsset> $cryptoAssets
 * @property \Illuminate\Database\Eloquent\Collection<CryptoCurrencyConversion> $cryptoCurrencyConversions
 */
class CryptoCurrency extends Model
{
    public function cryptoAssets(): HasMany
    {
        return $this->hasMany(CryptoAsset::class);
    }


    public function cryptoCurrencyConversions(): HasMany
    {
        return $this->hasMany(CryptoCurrencyConversion::class);
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function convertTo(float $value, string $otherCurrency = "USD", string|int|null|Carbon $dateOrTimestamp = null): float|null
    {
        if(!$value) {
            return 0;
        }

        $otherCurrency = "currency_" . strtolower($otherCurrency);
        $query = CryptoCurrencyConversion::query()
            ->where("crypto_currency_id", $this->id);

        if($dateOrTimestamp) {
            // For now: Just use date:
            if($dateOrTimestamp instanceof Carbon) {
                $date = $dateOrTimestamp;
            }
            elseif(is_int($dateOrTimestamp)) {
                $date = Carbon::createFromTimestamp($dateOrTimestamp);
            }
            else {
                $date = Carbon::make($dateOrTimestamp);
            }

            $query->where("price_date", $date->format("Y-m-d"));
        }
        else { // Get latest value
            $query->orderBy("price_date", "DESC");
        }

        $fiat_value = $query->first($otherCurrency)?->$otherCurrency * $value;

        if ($fiat_value <= 0) {
            $query1 = CryptoCurrencyConversion::query()
                ->where("crypto_currency_id", $this->id)
                ->orderBy("price_date", "DESC");
            $fiat_value = $query1->first($otherCurrency)?->$otherCurrency * $value;
        }

        return $fiat_value;
    }


    public static function findByShortName(string $shortName): ?static
    {
        return static::query()
            ->where("short_name", $shortName)
            ->first();
    }


    /**
     * This methods updates the list of coins, not the corresponding rates
     *
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


    // IMPORTANT: This command is currently not used to save the API Request limits of Coingecko, but prepared for later
    //public function convertTo(float $value, string $otherCurrency): float
    //{
    //    // First check age of last fetch; 35 Minutes, because the scheduled job runs every 15min
    //    $lifetime = config("app.cryptos.coingecko.prices_lifetime");
    //    if(!$this->fetched_at || $this->fetched_at < now()->addMinutes(-$lifetime)) {
    //        $this->updateRowFromApi();
    //    }
    //
    //    // Get var name
    //    $var = "currency_" . strtolower($otherCurrency);
    //
    //    return $this->$var * $value;
    //}


    // IMPORTANT: This command is currently not used to save the API Request limits of Coingecko, but prepared for later
    //protected function updateRowFromApi(): self
    //{
    //    $client = new \Codenixsv\CoinGeckoApi\CoinGeckoClient();
    //    $vsCurrencies = join(",", CoingeckoSupportedVsCurrencies::getCurrencies());
    //    $result = [];
    //
    //    // get price data from coingecko
    //    try {
    //        $client->simple()->getPrice($this->coingecko_id, $vsCurrencies);
    //    } catch (\Throwable $th) {
    //        throw $th;
    //    }
    //
    //    foreach($result[$this->coingecko_id] AS $currency => $value) {
    //        $var = "currency_" . strtolower($currency);
    //        $this->$var = $value;
    //    }
    //
    //    // Set fetched_at
    //    $this->fetched_at = now();
    //    $this->save();
    //
    //    return $this;
    //}


    /**
     * Update ALL rows
     * IMPORTANT: This command is currently not used to save the API Request limits of Coingecko, but prepared for later
     *
     * @return void
     * @throws \Exception
     */
    //public static function updateAllRowsFromApi(): void
    //{
    //    $limit = 300;
    //    $offset = 0;
    //    $loopCounter = 0;
    //
    //    while($currencies = static::query()->limit($limit)->offset($offset)->pluck("coingecko_id")->toArray()) {
    //        $currencies = join(",", $currencies);
    //        $offset += $limit;
    //        $loopCounter++;
    //        static::updateRowsFromApi($currencies);
    //
    //        if($loopCounter == 40) { // so that we do not get a timeout after 50 requests
    //            sleep(30);
    //        }
    //    }
    //}


    /**
     * Updates all provided coingecko rows
     * IMPORTANT: This command is currently not used to save the API Request limits of Coingecko, but prepared for later
     *
     * @param string $coingeckoCurrencyCsv
     * @return void
     * @throws \Exception
     */
    //public static function updateRowsFromApi(string $coingeckoCurrencyCsv): void
    //{
    //    $client = new \Codenixsv\CoinGeckoApi\CoinGeckoClient();
    //    $vsCurrencies = join(",", CoingeckoSupportedVsCurrencies::getCurrencies());
    //    $result = [];
    //
    //    // get price data from coingecko
    //    try {
    //        $result = $client->simple()->getPrice($coingeckoCurrencyCsv, $vsCurrencies);
    //    } catch (\Throwable $th) {
    //        throw $th;
    //    }
    //    $updates = [];
    //
    //    foreach($result AS $key => $conversions) {
    //        $update = "UPDATE crypto_currencies SET ";
    //        foreach($conversions AS $cur => $val) {
    //            $update.= "currency_" . strtolower($cur) . " = " . number_format($val, 10, ".", "") . ", ";
    //        }
    //        $update.= "fetched_at = '" . now() . "' WHERE coingecko_id = '$key'";
    //        $updates[] = $update;
    //    }
    //
    //    // Run query
    //    \DB::unprepared(implode(";\n\n", $updates));
    //}
}
