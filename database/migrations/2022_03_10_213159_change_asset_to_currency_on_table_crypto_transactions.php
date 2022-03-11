<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('crypto_transactions', function (Blueprint $table) {
            $table->dropColumn("crypto_asset_id");
            $table->foreignId("currency_id")->after("crypto_account_id");
            $table->dropColumn("executed_at");
        });
    }


    public function down()
    {
        Schema::table('crypto_transactions', function (Blueprint $table) {
            $table->dropColumn("currency_id");
        });
    }
};
