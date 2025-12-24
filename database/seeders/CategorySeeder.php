<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => json_encode(['en' => 'Laptops', 'ar' => 'الحواسيب المحمولة']),
                'description' => json_encode(['en' => 'High-performance laptops for work and gaming.', 'ar' => 'أجهزة كمبيوتر محمولة عالية الأداء للعمل والألعاب.'])
            ],
            [
                'name' => json_encode(['en' => 'Smartphones', 'ar' => 'الهواتف الذكية']),
                'description' => json_encode(['en' => 'Latest smartphones with advanced features.', 'ar' => 'أحدث الهواتف الذكية بميزات متطورة.'])
            ],
            [
                'name' => json_encode(['en' => 'Headphones', 'ar' => 'سماعات الرأس']),
                'description' => json_encode(['en' => 'Quality headphones for music and calls.', 'ar' => 'جودة سماعات للرأس للموسيقى والمكالمات.'])
            ],
            [
                'name' => json_encode(['en' => 'Accessories', 'ar' => 'الملحقات']),
                'description' => json_encode(['en' => 'Essential accessories for your devices.', 'ar' => 'الملحقات الأساسية لأجهزتك.'])
            ],
            [
                'name' => json_encode(['en' => 'Gaming', 'ar' => 'أجهزة الألعاب']),
                'description' => json_encode(['en' => 'Gaming consoles and accessories.', 'ar' => 'أجهزة الألعاب والملحقات.'])
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
