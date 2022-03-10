<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration{
    public function up()
    {
        $seeder = new \Database\Seeders\UserAccountTypeSeeder();
        $seeder->run();
    }
};
