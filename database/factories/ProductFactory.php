<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = $this->faker->numberBetween(1000, 10000);
        $store_id = Store::all()->random(1)[0]->id;

        return [
            'name' => $this->faker->realtext(10),
            'price' => $price,
            'unitprice' => $price / 4,
            'description' => $this->faker->realtext(30),
            'image' => $this->faker->image(),
            'store_id' => $store_id,
            'created_at' => $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
