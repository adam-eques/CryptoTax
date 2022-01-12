<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateblockchainAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('wallet_assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(\App\Models\Blockchain::class);
            $table->string("blockchain_name", 20);
            $table->unsignedDecimal("balance", 30, 18)->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('wallet_assets');
    }
}
