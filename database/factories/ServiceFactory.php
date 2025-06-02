<?php

namespace Database\Factories;

use App\Models\ServiceCategory;
use App\Models\ServiceUnit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = strtoupper(str()->ulid()->toBase58()) . '.png';
        $targetPath = "thumbnail/service/{$filename}";
        $name = $this->faker->unique()->words(2, true);

        Storage::disk('public')->put(
            $targetPath,
            Storage::disk('public')->get('placeholder/400x400.png')
        );

        return [
            'service_category_id' => ServiceCategory::inRandomOrder()->first()->id,
            'service_unit_id' => ServiceUnit::inRandomOrder()->first()->id,
            'thumbnail' => $targetPath,
            'name' => ucfirst($name),
            'slug' => str()->slug($name),
            'price' => $this->faker->numberBetween(100000, 2500000),
            'is_outside_area' => $this->faker->boolean(),
            'description' => $this->faker->paragraph(4),
        ];
    }
}
