<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('user_credit_actions', function (Blueprint $table) {
            $table->decimal("price", 8, 2)->nullable(true)->after("value");
        });
    }


    public function down()
    {
        Schema::table('user_credit_actions', function (Blueprint $table) {
            $table->dropColumn("price");
        });
    }
};
