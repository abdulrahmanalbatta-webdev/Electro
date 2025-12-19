<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use Faker\Factory as Faker;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                Order::create([
                    'user_id' => $user->id,
                    'status' => $faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
                    'total' => $faker->randomFloat(2, 50, 500),
                ]);
            }
        }
    }
}
