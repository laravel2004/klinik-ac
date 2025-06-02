<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CustomerSeeder::class,
//            ServiceCategorySeeder::class,
//            ServiceUnitSeeder::class,
//            ServiceSeeder::class,
            FaqSeeder::class,
        ]);
    }
}
