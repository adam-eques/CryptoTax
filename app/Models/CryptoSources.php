<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Blockchains\CryptoAPI;

class CryptoSources extends Model
{

    public static function updateFromApi() {
        try {
            $cryptoApi = new CryptoAPI();
            $limit = 50;
            $offset = 0;
            $total = 0;
            $cryptos = [];
            do {
                $result = $cryptoApi->get_supported_cryptoAssets($limit, $offset);
                $items = $result['data']['items'];
                $total = $result['data']['total'];
                $offset += $limit;
                foreach ($items as $item) {
                    // $cryto = new CryptoSources();

                    $tmp = array(
                        'id' => $item["asset_id"],
                        'name' => $item["asset_name"],
                        'symbol' => $item["asset_symbol"],
                        'original_symbol' => $item["original_symbol"],
                    );
                    array_push($cryptos, $tmp);
                }
            } while ($offset < $total);
            
            var_dump($cryptos);
        } catch (Exception $e) {
            echo 'Exception when calling App\Models\CryptoSource->updateFromApi(): ', $e->getMessage(), PHP_EOL;
        }
    }
}
