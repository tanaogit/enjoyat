<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Owner;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dt = $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d H:i:s');
        $owner_id = Owner::all()->random(1)[0]->id;

        return [
            'name' => $this->faker->realtext(10) . '店',
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $dt,
            'image' => $this->faker->image(),
            'tel' => $this->faker->phoneNumber(),
            'introduction' => $this->faker->realtext(50),
            'zipcode' => $this->faker->postcode(),
            'prefecture' => $this->faker->prefecture(),
            'city' => $this->faker->city(),
            'street_address' => $this->faker->streetAddress(),
            'business_time' => "月曜日 ◯時〜◯時\n火曜日 ◯時〜◯時\n水曜日 ◯時〜◯時\n木曜日 ◯時〜◯時\n金曜日 ◯時〜◯時",
            'owner_id' => $owner_id,
            'created_at' => $dt,
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
