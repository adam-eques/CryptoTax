<?php

use App\Models\User;
use App\Models\UserAccountType;
use App\Models\UserAffiliate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::create('user_affiliates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("user_id");
            $table->string("hash", 40);
            $table->foreignId("recruited_by")->index()->nullable();
            $table->timestamps();
        });

        // Update existing users
        $users = User::query()
            ->whereIn("user_account_type_id", UserAccountType::customerPanelTypes())
            ->doesntHave("userAffiliate")
            ->get();
        $users->each(function (User $item){
            $item->userAffiliate()->save(new UserAffiliate([
                "user_id" => $item->id
            ]));
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_affiliates');
    }
};
