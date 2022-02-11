<?php

use Database\Seeders\CryptoExchangeSeeder;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration{
    public function up()
    {
        $seeder = new CryptoExchangeSeeder();
        $seeder->run();
    }


    public function down()
    {
    }
};
