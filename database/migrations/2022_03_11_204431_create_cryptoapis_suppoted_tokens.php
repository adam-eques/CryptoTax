<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoapisSuppotedTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptoapis_supported_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id');
            $table->string('name');
            $table->string('symbol');
            $table->string('type');
            $table->string('original_symbol');
            $table->json('raw_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cryptoapis_supported_tokens');
    }
}
