<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Genre;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            Product::factory()
                ->hasAttached(Genre::all()->random(rand(1, 4)), ['created_at' => now(), 'updated_at' => now()])
                ->create();
        }
    }
}
