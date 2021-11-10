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
        
        return [
            'prefecture' => $this->faker->realtext(10), //APIから正式なデータを取得し挿入予定(一旦githubにアップするため保留)
            'line' => $this->faker->realtext(10), //APIから正式なデータを取得し挿入予定(一旦githubにアップするため保留)
            'station_name' => $this->faker->realtext(10), //APIから正式なデータを取得し挿入予定(一旦githubにアップするため保留)
            'walking_time' => rand(1,30),
            'store_id' => $store_id,
            'created_at' => $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
