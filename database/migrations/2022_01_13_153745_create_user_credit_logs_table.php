<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::create('user_credit_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(\App\Models\User::class);
            $table->decimal("value", 8, 2);
            $table->string("description", 100);
            $table->timestamp("created_at")->useCurrent();
        });

        Schema::table("users", function (Blueprint $table) {
            $table->decimal("credits", 8, 2)->default(0)->after("email");
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_credit_logs');

        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn("credits");
        });
    }
};
