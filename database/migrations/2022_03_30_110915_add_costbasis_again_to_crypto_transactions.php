<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostbasisAgainToCryptoTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crypto_transactions', function (Blueprint $table) {
            $table->unsignedDecimal("from_cost_basis", 20, 10)->after('cost')->default(0);
            $table->unsignedDecimal("to_cost_basis", 20, 10)->after('from_cost_basis')->default(0);
            $table->unsignedDecimal("gain", 20, 10)->after('to_cost_basis')->default(0);
            $table->string("fiat", 20)->after('gain')->default("");
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
