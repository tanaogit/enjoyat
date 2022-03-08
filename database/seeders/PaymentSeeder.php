<?php

namespace Database\Seeders;

use App\Models\Payment;
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
        Payment::create(['method' => '現金']);
        Payment::create(['method' => 'クレジットカード']);
        Payment::create(['method' => 'デビットカード']);
        Payment::create(['method' => 'PayPay']);
    }
}
