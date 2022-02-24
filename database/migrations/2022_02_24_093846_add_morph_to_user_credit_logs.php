<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::table('user_credit_logs', function (Blueprint $table) {
            $table->unsignedInteger("reference_id")->after('value')->nullable();
            $table->string("reference_type")->after('value')->nullable();
            $table->index(["reference_id", "reference_type"], "morph_reference_index");
        });
    }


    public function down()
    {
        Schema::table('user_credit_logs', function (Blueprint $table) {
            $table->dropMorphs("reference", "morph_reference_index");
        });
    }
};
