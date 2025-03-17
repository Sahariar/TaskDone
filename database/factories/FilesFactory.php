<?php

namespace Database\Factories;

use App\Models\Files;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Files>
 */
class FilesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Files::class;
    public function definition(): array
    {
        $fileTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'text/plain' => 'txt',
            'application/zip' => 'zip'
        ];

        $fileType = $this->faker->randomElement(array_keys($fileTypes));
        $extension = $fileTypes[$fileType];
        $fileName = $this->faker->word . '-' . $this->faker->numberBetween(1, 1000) . '.' . $extension;

        return [
            'name' => $fileName,
            'path' => 'files/' . $this->faker->date('Y/m') . '/' . $fileName,
            'size' => $this->faker->numberBetween(10000, 5000000), // 10KB to 5MB
            'mime_type' => $fileType,
            'fileable_id' => null, // Will be set in seeder
            'fileable_type' => null, // Will be set in seeder
            'uploaded_by' => null, // Will be set in seeder
        ];
    }

    /**
     * Configure the model factory to create a task attachment.
     */
    public function taskAttachment(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'fileable_type' => 'App\\Models\\Tasks',
            ];
        });
    }

    /**
     * Configure the model factory to create a project attachment.
     */
    public function projectAttachment(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'fileable_type' => 'App\\Models\\Projects',
            ];
        });
    }
}
