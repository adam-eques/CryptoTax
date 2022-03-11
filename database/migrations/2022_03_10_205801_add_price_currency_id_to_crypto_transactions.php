<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('crypto_transactions', function (Blueprint $table) {
            $table->foreignId("price_currency_id")->after("crypto_asset_id")->nullable();
        });
    }


    public function down()
    {
        Schema::table('crypto_transactions', function (Blueprint $table) {
            $table->dropColumn("price_currency_id");
        });
    }
};
