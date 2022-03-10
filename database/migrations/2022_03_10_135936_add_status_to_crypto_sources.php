<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('crypto_sources', function (Blueprint $table) {
            $table->boolean("active")->default(0)->after("driver");
        });

        $seeder = new \Database\Seeders\CryptoSourceSeeder();
        $seeder->run();
    }


    public function down()
    {
        Schema::table('crypto_sources', function (Blueprint $table) {
            $table->dropColumn("active");
        });
    }
};
