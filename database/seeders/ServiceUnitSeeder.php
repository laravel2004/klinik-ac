<?php

namespace Database\Seeders;

use App\Models\ServiceUnit;
use Illuminate\Database\Seeder;

class ServiceUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         * Membuat 10 data satuan layanan menggunakan factory model `ServiceUnit`.
         */
        ServiceUnit::factory()->count(10)->create();
    }
}
