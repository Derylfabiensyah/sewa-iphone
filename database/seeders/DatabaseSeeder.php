<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Iphone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sewaiphone.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Customer
        User::create([
            'name' => 'Customer Satu',
            'email' => 'customer@sewaiphone.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Create iPhones
        Iphone::create([
            'name' => 'iPhone 13 Pro',
            'storage' => '256GB',
            'color' => 'Sierra Blue',
            'price_per_day' => 150000,
            'description' => 'Mulus 99%, battery health 95%.',
            'status' => 'available'
        ]);

        Iphone::create([
            'name' => 'iPhone 14',
            'storage' => '128GB',
            'color' => 'Midnight',
            'price_per_day' => 200000,
            'description' => 'Seperti baru, garansi aktif.',
            'status' => 'available'
        ]);

        Iphone::create([
            'name' => 'iPhone 15 Pro Max',
            'storage' => '512GB',
            'color' => 'Natural Titanium',
            'price_per_day' => 450000,
            'description' => 'Kondisi prima, layar no scratch.',
            'status' => 'available'
        ]);
    }
}
