<?php

namespace Database\Seeders;
use App\Models\Expense;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestExpencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        collect([
            [
                'amount' => 15123,
                'type' => "Sep11",
                'description' => ""
            ],
            [
                'amount' => 13245,
                'type' => "Sep12",
                'description' => ""
            ],
            [
                'amount' => 12032,
                'type' => "Sep13",
                'description' => ""
            ],
            [
                'amount' => 16123,
                'type' => "Sep14",
                'description' => ""
            ],
            [
                'amount' => 12345,
                'type' => "Sep15",
                'description' => ""
            ],
            [
                'amount' => 18123,
                'type' => "Sep16",
                'description' => ""
            ],
            [
                'amount' => 12545,
                'type' => "Sep17",
                'description' => ""
            ],
           
        ])->each(function($data){
            DB::table('expenses')->insert($data);
        });
    }
}
