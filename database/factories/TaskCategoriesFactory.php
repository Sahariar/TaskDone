<?php

namespace Database\Factories;

use App\Models\TaskCategories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskCategories>
 */
class TaskCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = TaskCategories::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'color' => $this->faker->hexColor(),
            'description' => $this->faker->sentence(),
        ];
    }
    /**
     * Configure the model factory to create predefined categories.
     */
    public function predefined(int $index = 0): static
    {
        $categories = [
            [
                'name' => 'Development',
                'color' => '#4A6FDC',
                'description' => 'Tasks related to software development and programming.'
            ],
            [
                'name' => 'Design',
                'color' => '#F5A623',
                'description' => 'Tasks related to UI/UX design, graphics, and visual elements.'
            ],
            [
                'name' => 'Content',
                'color' => '#7ED321',
                'description' => 'Tasks related to content creation, writing, and editing.'
            ],
            [
                'name' => 'QA',
                'color' => '#9013FE',
                'description' => 'Quality assurance, testing, and bug fixing tasks.'
            ],
            [
                'name' => 'Documentation',
                'color' => '#50E3C2',
                'description' => 'Tasks related to documentation, manuals, and guides.'
            ],
            [
                'name' => 'Meeting',
                'color' => '#B8E986',
                'description' => 'Meetings, calls, and discussions.'
            ],
            [
                'name' => 'Research',
                'color' => '#D0021B',
                'description' => 'Research, analysis, and exploration tasks.'
            ],
            [
                'name' => 'Planning',
                'color' => '#BD10E0',
                'description' => 'Planning, strategy, and preparation tasks.'
            ],
            [
                'name' => 'Deployment',
                'color' => '#4A90E2',
                'description' => 'Tasks related to deployment, release, and launch.'
            ],
            [
                'name' => 'Maintenance',
                'color' => '#F5A623',
                'description' => 'Maintenance, support, and upkeep tasks.'
            ]
        ];

        $index = min($index, count($categories) - 1);

        return $this->state(function (array $attributes) use ($categories, $index) {
            return $categories[$index];
        });
    }
}
