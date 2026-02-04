<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat Merchant
        $merchantUser = \App\Models\User::create([
            'name' => 'Budi Catering',
            'email' => 'merchant@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'merchant',
        ]);

        // Membuat Profil Merchant (Relasi ke tabel merchants)
        \App\Models\Merchant::create([
            'user_id' => $merchantUser->id,
            'company_name' => 'PT Lezat Mantap',
            'address' => 'Jl. Makanan No. 10',
            'contact' => '0812345678',
        ]);

        // Membuat Customer
        \App\Models\User::create([
            'name' => 'Admin Kantor ABC',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);
    }
}
