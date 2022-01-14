<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCreditActionsTable extends Migration
{
    public function up()
    {
        Schema::create('user_credit_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(\App\Models\UserAccountType::class)->nullable(true);
            $table->char("action_code", 4);
            $table->string("name");
            $table->decimal("value", 8, 2);
            $table->timestamp("valid_from")->nullable();
            $table->timestamp("valid_till")->nullable();
            $table->timestamp("created_at")->useCurrent();

            // Index
            $table->index(["user_account_type_id", "action_code"]);
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_credit_actions');
    }
}
