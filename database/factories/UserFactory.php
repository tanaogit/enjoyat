<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dt = $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d H:i:s');

        return [
            'username' => $this->faker->realtext(10),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $dt,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'name' => $this->faker->name(),
            'tel' => $this->faker->phoneNumber(),
            'zipcode' => $this->faker->postcode(),
            'prefecture' => $this->faker->prefecture(),
            'city' => $this->faker->city(),
            'street_address' => $this->faker->streetAddress(),
            'gender' => $this->faker->numberBetween(0, 1),
            'birthday' => $this->faker->dateTimeBetween('-80 years', '-15years'),
            'social_login' => $this->faker->boolean(50),
            'created_at' => $dt,
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
