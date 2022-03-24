<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $table->date("fetched_history_date")->nullable()->after("currency_usd");
        });
    }


    public function down()
    {
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $table->dropColumn("fetched_history_date");
        });
    }
};
