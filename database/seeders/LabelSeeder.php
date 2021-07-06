<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<15;$i++){
            DB::table('label')->insert([
                'name' => Str::random(10),
                'icon' => Str::random(10),
                'title' => Str::random(10),
                'url' =>'http://'. Str::random(10)
            ]);
        }


    }
}
