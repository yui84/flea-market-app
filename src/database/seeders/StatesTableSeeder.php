<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            "良好",
            "目立った傷や汚れなし",
            "やや傷や汚れあり",
            "状態が悪い"
        ];

        foreach ($contents as $content){
            DB::table('states')->insert([
                'content' => $content
            ]);
        }
    }
}
