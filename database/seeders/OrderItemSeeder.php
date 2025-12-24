<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach (Order::all() as $order) {

            $total = 0;
            $items = $products->random(rand(1, min(3, $products->count())));

            foreach ($items as $product) {
                $qty = rand(1, 3);
                $subtotal = $qty * $product->price;

                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'user_id' => $order->user_id,
                    'quantity' => $qty,
                    'price' => $product->price,
                    'total' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $order->update([
                'total_price' => $total
            ]);
        }
    }
}
