<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         * Membuat 35 data layanan menggunakan factory model `Service`.
         */
        Service::factory()->count(35)->create();
    }
}
