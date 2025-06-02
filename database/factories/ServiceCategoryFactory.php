<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceCategory>
 */
class ServiceCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = strtoupper(str()->ulid()->toBase58()) . '.png';
        $targetPath = "thumbnail/service-category/{$filename}";
        $name = $this->faker->unique()->words(2, true);

        Storage::disk('public')->put(
            $targetPath,
            Storage::disk('public')->get('placeholder/600x400.png')
        );

        return [
            'thumbnail' => $targetPath,
            'name' => ucfirst($name),
            'slug' => str()->slug($name),
            'description' => $this->faker->paragraph(4),
        ];
    }
}
