<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserAccountTypeToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('user_account_type_id')
                ->default(\App\Models\UserAccountType::TYPE_CUSTOMER)
                ->after('id');
        });
    }

    public function down()
    {
    }
}
