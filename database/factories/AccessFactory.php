<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

class AccessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $store_id = Store::all()->random(1)[0]->id;
        $stationInfo = explode(',', $this->faker->randomElement(['東京都,JR山手線,新宿', '東京都,JR山手線,渋谷', '東京都,JR山手線,原宿', '大阪府,阪急京都本線,茨木市駅']));
        
        return [
            'prefecture' => $stationInfo[0],
            'line' => $stationInfo[1],
            'station_name' => $stationInfo[2],
            'walking_time' => rand(1,30),
            'store_id' => $store_id,
            'created_at' => $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
