<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            'Pharma Egypt',
            'Global Medical',
            'El Ezaby Suppliers',
            'Cairo Pharma',
            'Delta Medical',
        ];

        foreach ($suppliers as $name) {
            Supplier::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '', $name)).'@mail.com',
                'phone' => '010'.rand(10000000,99999999),
                'address' => 'Egypt'
            ]);
        }
    }
}
