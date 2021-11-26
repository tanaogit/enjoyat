<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

class StoreImageFactory extends Factory
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
            'image' => 'storage/storeimages/default.png',
            'category' => $this->faker->randomElement(['foods', 'drinks', 'others']),
            'store_id' => $store_id,
            'created_at' => $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
