<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCostbasisToCryptoTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crypto_transactions', function (Blueprint $table) {
            $table->dropColumn("from_cost_basis");
            $table->dropColumn("to_cost_basis");
            $table->dropColumn("gain");
            $table->dropColumn("fiat");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crypto_transactions', function (Blueprint $table) {
            //
        });
    }
}
