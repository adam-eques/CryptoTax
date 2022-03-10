<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('crypto_exchange_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json("credentials")->nullable();
            $table->timestamp("fetched_at")->nullable(true);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('crypto_exchange_accounts');
    }
};
