<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         * Membuat Pengguna Eksternal Default sebagai "Customer"
         *
         * Kode berikut membuat dua pengguna default menggunakan factory model `User`.
         * Setiap pengguna memiliki atribut `name` dan `email` yang telah ditentukan.
         *
         * Penggunaan `User::factory()->create([...])` memastikan bahwa pengguna
         * dibuat dengan data yang diberikan.
         */
        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'role' => UserRole::CUSTOMER,
            'password' => Hash::make('password'),
        ]);
    }
}
