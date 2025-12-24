<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => json_encode(['en' => 'MacBook Pro M2', 'ar' => 'ماك بوك برو M2']),
                'description' => json_encode(['en' => 'Apple MacBook Pro M2 with Retina display and powerful performance.', 'ar' => 'جهاز Apple MacBook Pro M2 بشاشة Retina وأداء قوي.']),
                'price' => 2200,
                'quantity' => 15,
                'category' => 'Laptops',
                'images' => [
                    ['path' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8', 'type' => 'main'],
                    ['path' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085', 'type' => 'gallery'],
                    ['path' => 'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2', 'type' => 'gallery'],
                ],
            ],
            [
                'name' => json_encode(['en' => 'iPhone 14 Pro', 'ar' => 'آيفون 14 برو']),
                'description' => json_encode(['en' => 'iPhone 14 Pro with A16 chip and Pro camera system.', 'ar' => 'آيفون 14 برو بشريحة A16 ونظام كاميرا Pro.']),
                'price' => 1200,
                'quantity' => 30,
                'category' => 'Smartphones',
                'images' => [
                    ['path' => 'https://images.unsplash.com/photo-1661961112951-f2bfd6f0f5c7', 'type' => 'main'],
                    ['path' => 'https://images.unsplash.com/photo-1609692814857-d66803d4c0cb', 'type' => 'gallery'],
                ],
            ],
        ];

        foreach ($products as $item) {

            $category = Category::where('name->en', $item['category'])->first();

            $product = Product::create([
                'category_id' => $category->id,
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);

            foreach ($item['images'] as $img) {
                if ($img['type'] === 'main') {
                    $product->image()->create($img);
                } elseif ($img['type'] === 'gallery') {
                    $product->gallery()->create($img);
                }
            }
        }
    }
}
