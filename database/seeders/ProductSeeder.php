<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();   // مهم جداً
        $suppliers  = Supplier::all();

        $products = [
            'Paracetamol','Ibuprofen','Aspirin','Amoxicillin','Cough Syrup',
            'Vitamin C','Omega 3','Calcium Tablets','Iron Supplement','Multivitamin',
            'Baby Shampoo','Baby Lotion','Baby Diapers','Baby Oil','Baby Wipes',
            'Face Wash','Sunscreen','Moisturizer','Acne Cream','Anti-aging Cream',
            'Hair Oil','Hair Shampoo','Hair Conditioner','Hair Serum','Hair Mask',
            'Toothpaste','Mouthwash','Dental Floss','Whitening Kit','Toothbrush',
            'Blood Pressure Monitor','Thermometer','Nebulizer','Glucose Meter','Pulse Oximeter',
            'Bandages','Antiseptic','Medical Gloves','Alcohol Pads','First Aid Kit',
            'Body Wash','Deodorant','Hand Sanitizer','Wet Wipes','Shaving Cream',
            'Insulin','Diabetic Strips','Sugar Tablets','Foot Cream','Sugar Monitor'
        ];

        foreach ($products as $name) {

            Product::create([
                'name' => $name,
                'description' => "High quality {$name} available in our pharmacy.",
                'price' => rand(20,150),
                'cost_price' => rand(10,80),

                // 🔥 أهم سطرين
                'category_id' => $categories->random()->id,
                'supplier_id' => $suppliers->random()->id,

                'expiry_date' => now()->addMonths(rand(6,24)),
                'barcode' => rand(100000000000,999999999999),
            ]);
        }
    }
}
