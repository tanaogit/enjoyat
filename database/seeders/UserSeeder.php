<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\User;
use App\Models\Product;
use App\Models\Genre;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            User::factory()
                ->hasAttached(Product::all()->random(rand(0, 4)), ['category' => 'register'])
                ->hasAttached(Genre::all()->random(rand(0, 4)))
                ->create();
        }

        //product_userテーブルの「category」属性をランダムに「'bookmark'」に更新
        $allUsers = User::all();
        $users = $allUsers->random(rand(1, $allUsers->count()));
        foreach ($users as $user) {
            if ($user->products->count() > 0) {
                $product = $user->products->random();
                $product->pivot->category = 'bookmark';
                $product->pivot->save();
            }
        }
    }
}
