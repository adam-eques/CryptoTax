<?php

namespace Database\Seeders;

use App\Models\BlockchainAccount;
use Illuminate\Database\Seeder;

class BlockchainSeeder extends Seeder
{
    public function run()
    {
        collect([
            [
                'name' => "bscscan",
                "class" => "BscScanBlockChainApi"
            ],
            [
                'name' => "cronos",
                "class" => "CronosBlockChainApi"
            ],
        ])->each(function($data){
            BlockchainAccount::upsert($data, []);
        });
    }
}
