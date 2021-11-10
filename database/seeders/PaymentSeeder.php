<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert(['method' => '現金',]);
        DB::table('payments')->insert(['method' => 'クレジットカード',]);
        DB::table('payments')->insert(['method' => 'デビットカード',]);
    }
}
