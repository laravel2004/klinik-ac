<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         * Membuat 7 data FAQ menggunakan factory model `Faq`.
         */
        Faq::factory()->count(7)->create();
    }
}
