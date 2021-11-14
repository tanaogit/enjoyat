<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GenreSeeder::class,
            PaymentSeeder::class,
            OwnerSeeder::class,
            StoreSeeder::class,
            ProductSeeder::class,
            StoreImageSeeder::class,
            CouponSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
        ]);
    }
}
