<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\OrderItems;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('type', 'customer')->get();

        foreach ($users as $user) {
            Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'status' => collect(['pending', 'processing', 'shipped', 'delivered'])->random(),
                'total_price' => 0,
            ]);
        }
    }
}
