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

        //中間テーブルの「category」カラムをランダムに「'bookmark'」に更新(一旦githubにアップするため保留)
        // $users = User::all()->random(rand(1, 80));
        // foreach ($users as $user) {
        //     foreach ($user->products as $product) {
        //         $product->pivot->category;
        //     }
        // }
    }
}
