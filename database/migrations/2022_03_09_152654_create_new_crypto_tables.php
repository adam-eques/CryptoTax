<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::create('crypto_sources', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("icon");
            $table->char("type");
            $table->string("driver");
            $table->timestamps();
        });

        Schema::create('crypto_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("crypto_source_id");
            $table->foreignId("user_id");
            $table->json("credentials")->nullable();
            $table->timestamp("fetched_at")->nullable();
            $table->timestamp("fetched_scheduled_at")->nullable();
            $table->timestamps();
        });

        Schema::create('crypto_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId("crypto_account_id");
            $table->foreignId("crypto_currency_id");
            $table->unsignedDecimal("balance", 20, 10);
            $table->timestamps();
        });

        Schema::create('crypto_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("crypto_asset_id");
            $table->foreignId("fee_currency_id");
            $table->char("trade_type", 1);
            $table->string("from_addr")->nullable();
            $table->string("to_addr")->nullable();
            $table->unsignedDecimal("amount", 20, 10);
            $table->unsignedDecimal("price", 20, 10);
            $table->unsignedDecimal("fee", 20, 10);
            $table->timestamp("executed_at");
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('crypto_sources');
        Schema::dropIfExists('crypto_accounts');
        Schema::dropIfExists('crypto_assets');
        Schema::dropIfExists('crypto_transactions');
    }
};
