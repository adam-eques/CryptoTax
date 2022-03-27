<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $table->dropColumn("currency_eth");
            $table->dropColumn("currency_btc");
            $table->dropColumn("currency_gbp");
            $table->dropColumn("currency_cny");
            $table->dropColumn("currency_rub");
            $table->dropColumn("currency_jpy");
            $table->dropColumn("currency_cad");
            $table->dropColumn("currency_aud");
            $table->dropColumn("currency_chf");
            $table->dropColumn("currency_usd");
            $table->dropColumn("currency_eur");
            $table->dropColumn("icon");
            $table->unsignedBigInteger("market_cap")->after("coingecko_id")->nullable();
        });

        Schema::table('crypto_currency_conversions', function (Blueprint $table) {
            $table->timestamp("price_timestamp")->after("price_date")->nullable();
        });
    }
};
