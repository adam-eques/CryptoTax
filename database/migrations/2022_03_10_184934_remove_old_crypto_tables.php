<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::dropIfExists("blockchains");
        Schema::dropIfExists("blockchain_accounts");
        Schema::dropIfExists("blockchain_assets");
        Schema::dropIfExists("blockchain_transactions");
        Schema::dropIfExists("crypto_exchanges");
        Schema::dropIfExists("crypto_exchange_accounts");
        Schema::dropIfExists("crypto_exchange_assets");
        Schema::dropIfExists("crypto_exchange_transactions");
    }
};
