<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\Access;
use App\Models\Holiday;
use App\Models\Payment;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            Store::factory()
                ->has(Access::factory()->count(rand(1, 3)))
                ->has(Holiday::factory())
                ->hasAttached(Payment::all()->random(rand(1, 3)))
                ->create();
        }
    }
}
