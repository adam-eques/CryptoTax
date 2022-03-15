<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('crypto_transactions', function (Blueprint $table) {
            $table->json("raw_data")->nullable()->after("fee");
        });
    }


    public function down()
    {
        Schema::table('crypto_transactions', function (Blueprint $table) {
            $table->dropColumn("raw_data");
        });
    }
};
