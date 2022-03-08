<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = $this->faker->boolean(50) ? $this->faker->dateTimeBetween('-1 years', '+1 years') : null;

        return [
            'name' => 'クーポン名' . $this->faker->text(5),
            'description' => $this->faker->realtext(10),
            'code' => $this->faker->boolean(50) ? $this->faker->iban(10) : null,
            'start' => is_null($start_date) ? null : $start_date->format('Y-m-d'),
            'end' => is_null($start_date) ? null : $start_date->modify(rand(1, 12) . ' months')->format('Y-m-d'),
            'created_at' => $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
