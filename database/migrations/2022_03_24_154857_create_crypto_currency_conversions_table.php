<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::create('crypto_currency_conversions', function (Blueprint $table) {
            $currencies = [
                "usd", "eur", "chf", "aud", "cad", "jpy", "cny", "gbp", "btc"
            ];

            $table->id();
            $table->foreignId("crypto_currency_id");
            $table->date("price_date");
            foreach($currencies AS $currency) {
                $table->decimal("currency_" . $currency, 32, 12)->nullable();
            }
            $table->timestamp("created_at")->useCurrent();

            // Add index
            $table->unique(["crypto_currency_id", "price_date"]);
        });
    }


    public function down()
    {
        Schema::dropIfExists('crypto_currency_conversions');
    }
};
