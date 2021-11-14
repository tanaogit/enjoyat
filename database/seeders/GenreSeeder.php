<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert(['name' => '和食']);
        DB::table('genres')->insert(['name' => '洋食']);
        DB::table('genres')->insert(['name' => '中華']);
        DB::table('genres')->insert(['name' => 'ラーメン']);
    }
}
