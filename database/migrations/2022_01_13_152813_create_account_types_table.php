<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->unsignedInteger("duration");
            $table->unsignedSmallInteger("included_credits");
            $table->smallInteger("max_csv_upload");
            $table->smallInteger("max_backups");
            $table->unsignedDecimal("price_per_year", 6, 2);
            $table->boolean("active")->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('account_types');
    }
};
