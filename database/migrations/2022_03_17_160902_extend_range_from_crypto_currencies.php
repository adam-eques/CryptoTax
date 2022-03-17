<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $currencies = [
                "usd", "eur", "chf", "aud", "cad", "jpy", "rub", "cny", "gbp", "btc", "eth"
            ];

            foreach($currencies AS $currency) {
                $table->decimal("currency_" . $currency, 32, 12)
                    ->nullable(true)->change();
            }
        });
    }


    public function down()
    {
        Schema::table('crypto_currencies', function (Blueprint $table) {
            //
        });
    }
};
