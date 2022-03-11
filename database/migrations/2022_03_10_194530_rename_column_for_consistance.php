<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('crypto_accounts', function (Blueprint $table) {
            $table->renameColumn("fetched_scheduled_at", "fetching_scheduled_at");
        });
    }


    public function down()
    {
        Schema::table('crypto_accounts', function (Blueprint $table) {
            $table->renameColumn("fetching_scheduled_at", "fetched_scheduled_at");
        });
    }
};
