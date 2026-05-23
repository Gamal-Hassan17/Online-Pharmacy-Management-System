<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Seed base data أولاً
        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
        ]);

        // 2️⃣ Create Admin
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL')],
            [
                'username' => env('ADMIN_NAME'),
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'role' => 'admin'
            ]
        );
    }
}
