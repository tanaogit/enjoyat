<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreImage;

class StoreImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreImage::factory()->count(100)->create();
    }
}
