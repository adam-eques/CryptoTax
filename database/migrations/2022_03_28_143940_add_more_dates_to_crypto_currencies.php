<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $table->renameColumn("fetched_history_date", "fetched_history_date_till");
            $table->date("fetched_history_date_from")->nullable()->after("fetched_history_date");
            $table->boolean("fetch_history")->default(false);
        });
    }
};
