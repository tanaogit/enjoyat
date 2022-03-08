<?php

namespace Database\Seeders;

use App\Models\Genre;
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
        Genre::create(['name' => '和食']);
        Genre::create(['name' => '洋食']);
        Genre::create(['name' => '中華']);
        Genre::create(['name' => 'ラーメン']);
    }
}
