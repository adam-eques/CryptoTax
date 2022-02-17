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
    public function CryptoExchangeAssets()
    {
        return $this->hasMany(CryptoExchangeAsset::class);
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function convertTo(float $value, string $otherCurrency): float
    {
        // Get var name
        $var = "currency_" . strtolower($otherCurrency);
        $data = \Cache::get($this->getCacheKey());

        // Get from cache
        if($data) {
            return $data[$var] * $value;
        }
        else {
            // First check age of last fetch
            if(!$this->fetched_at || $this->fetched_at < now()->addMinutes(-15)) {
                $this->updateRowFromApi();
            }

            return $this->$var * $value;
        }
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
        $result = $client->simple()->getPrice($this->coingecko_id, $vsCurrencies);
        $data = [];

        foreach($result[$this->coingecko_id] AS $currency => $value) {
            $var = "currency_" . strtolower($currency);
            $data[$var] = $value;
            $this->$var = $value;
        }

        // Set fetched_at
        $this->fetched_at = now();
        $this->save();

        // Save to cache
        \Cache::put($this->getCacheKey(), $data, 60 * 15);

        return $this;
    }


    public function getCacheKey(): string
    {
        return "cryptocurrency_conversionrate_" . $this->id;
    }


    public static function updateFromApi()
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
