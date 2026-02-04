<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Akun Merchant
    \App\Models\User::create([
        'name' => 'Budi Catering',
        'email' => 'merchant@gmail.com',
        'password' => bcrypt('password'),
        'role' => 'merchant',
    ]);

    // Akun Customer
    \App\Models\User::create([
        'name' => 'Admin Kantor ABC',
        'email' => 'customer@gmail.com',
        'password' => bcrypt('password'),
        'role' => 'customer',
    ]);
}
}
