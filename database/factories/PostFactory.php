<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Store;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = User::all()->random(1)[0]->id;
        $store_id = Store::all()->random(1)[0]->id;

        return [
            'title' => $this->faker->realtext(10),
            'message' => $this->faker->realtext(20),
            'evaluation1' => $this->faker->numberBetween(0, 5),
            'evaluation2' => $this->faker->numberBetween(0, 5),
            'evaluation3' => $this->faker->numberBetween(0, 5),
            'evaluation4' => $this->faker->numberBetween(0, 5),
            'evaluation5' => $this->faker->numberBetween(0, 5),
            'user_id' => $user_id,
            'store_id' => $store_id,
            'created_at' => $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
