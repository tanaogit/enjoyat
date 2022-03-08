<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\Access;
use App\Models\Holiday;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Sequence;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations = array('東京都,JR山手線,新宿', '東京都,JR山手線,渋谷', '東京都,JR山手線,原宿', '大阪府,阪急京都本線,茨木市駅');

        for ($i = 0; $i < 100; $i++) {
            shuffle($stations);
            $station1_info = explode(',', $stations[0]);
            $station2_info = explode(',', $stations[1]);
            $station3_info = explode(',', $stations[2]);

            Store::factory()
                ->has(Access::factory()
                        ->state(new Sequence(
                            ['prefecture' => $station1_info[0], 'line' => $station1_info[1], 'station_name' => $station1_info[2]],
                            ['prefecture' => $station2_info[0], 'line' => $station2_info[1], 'station_name' => $station2_info[2]],
                            ['prefecture' => $station3_info[0], 'line' => $station3_info[1], 'station_name' => $station3_info[2]],
                        ))
                        ->count(rand(1, 3))
                )
                ->hasHolidays()
                ->hasAttached(Payment::all()->random(rand(1, 3)), ['created_at' => now(), 'updated_at' => now()])
                ->create();
        }
    }
}
