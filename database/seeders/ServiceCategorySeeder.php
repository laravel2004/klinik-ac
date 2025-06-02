<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         * Membuat 5 data kategori layanan menggunakan factory model `ServiceCategory`.
         */
        ServiceCategory::factory()->count(5)->create();
    }
}
