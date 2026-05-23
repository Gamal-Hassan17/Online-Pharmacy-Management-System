<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Medicines',
            'Vitamins & Supplements',
            'Baby Care',
            'Skin Care',
            'Hair Care',
            'Oral Care',
            'Medical Devices',
            'First Aid',
            'Personal Care',
            'Diabetic Care'
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name), // تحويل الاسم لرابط SEO
                'description' => $name . ' products available in our pharmacy',
                'is_active' => true,
            ]);
        }
    }
}
