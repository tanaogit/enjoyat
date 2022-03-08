<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

class HolidayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sunday' => $this->faker->boolean(50),
            'monday' => $this->faker->boolean(50),
            'tuesday' => $this->faker->boolean(50),
            'wednesday' => $this->faker->boolean(50),
            'thursday' => $this->faker->boolean(50),
            'friday' => $this->faker->boolean(50),
            'saturday' => $this->faker->boolean(50),
            'created_at' => $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
