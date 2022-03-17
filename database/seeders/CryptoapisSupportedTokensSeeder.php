<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Blockchains\CryptoAPI;
use App\Models\CryptoapisSupportedToken;

class CryptoapisSupportedTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CryptoapisSupportedToken::truncate();
        //
        $cryptoApi = new CryptoAPI();
        $limit = 50;
        $offset = 0;
        $total = 0;
        do {
            $result = $cryptoApi->get_supported_cryptoAssets($limit, $offset);
            foreach($result['data']['items'] as $item) {
                $token = new CryptoapisSupportedToken();
                $token->asset_id = $item["asset_id"];
                $token->name = $item["asset_name"];
                $token->symbol = $item["asset_symbol"];
                $token->type = $item["asset_type"];
                $token->original_symbol = $item["original_symbol"];
                $token->raw_data = json_encode($item);
                $token->save();
            }
            $total = $result['data']['total'];
            $offset += $limit;
        } while ($offset < $total);
        var_dump($result);
    }
}
