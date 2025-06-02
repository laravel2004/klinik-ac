<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         * Membuat Pengguna Internal Default sebagai "Administrator"
         *
         * Kode berikut membuat dua pengguna default menggunakan factory model `User`.
         * Setiap pengguna memiliki atribut `name` dan `email` yang telah ditentukan.
         *
         * Penggunaan `User::factory()->create([...])` memastikan bahwa pengguna
         * dibuat dengan data yang diberikan.
         */
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'administrator@gmail.com',
            'role' => UserRole::ADMIN,
            'password' => Hash::make('password'),
        ]);
    }
}
