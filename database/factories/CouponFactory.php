<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'クーポン名' . $this->faker->text(5),
            'description' => $this->faker->realtext(10),
            'code' => $this->faker->iban(10),
            'created_at' => $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
