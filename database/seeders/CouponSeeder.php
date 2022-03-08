<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use App\Models\Product;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            Coupon::factory()
                ->hasAttached(Product::all()->random(rand(1, 4)), ['created_at' => now(), 'updated_at' => now()])
                ->create();
        }
    }
}
