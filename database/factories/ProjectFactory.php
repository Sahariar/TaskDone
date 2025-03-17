<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Project::class;
    public function definition(): array
    {
        $projectNames = [
            'Website Redesign',
            'Mobile App Development',
            'E-commerce Platform',
            'CRM Implementation',
            'Brand Identity',
            'Digital Marketing Campaign',
            'Content Management System',
            'API Integration',
            'Database Migration',
            'Security Audit',
            'Cloud Migration',
            'Search Engine Optimization',
            'Customer Portal',
            'Payment Gateway Integration',
            'Data Analytics Dashboard'
        ];

        $startDate = $this->faker->dateTimeBetween('-6 months', '-1 month');
        $deadline = (clone $startDate)->modify('+' . $this->faker->numberBetween(1, 6) . ' months');

        $status = $this->faker->randomElement(['not_started', 'in_progress', 'on_hold', 'completed', 'cancelled']);
        $completedAt = null;

        if ($status === 'completed') {
            $completedAt = $this->faker->dateTimeBetween($startDate, min($deadline, new \DateTime()));
        }

        $estimatedHours = $this->faker->numberBetween(20, 500);
        $budget = $estimatedHours * $this->faker->numberBetween(80, 150);

        return [
            'name' => $this->faker->unique()->randomElement($projectNames),
            'code' => strtoupper(substr(str_replace(' ', '', $this->faker->unique()->words(2, true)), 0, 3)) . '-' . $this->faker->numberBetween(100, 999),
            'description' => $this->faker->paragraph(),
            'client_id' => null, // Will be set in seeder
            'start_date' => $startDate,
            'deadline' => $deadline,
            'status' => $status,
            'estimated_hours' => $estimatedHours,
            'budget' => $budget,
            'manager_id' => null, // Will be set in seeder
            'completed_at' => $completedAt,
        ];
    }

    /**
     * Configure the model factory to create a project in progress.
     */
    public function inProgress(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'in_progress',
                'completed_at' => null,
            ];
        });
    }

    /**
     * Configure the model factory to create a completed project.
     */
    public function completed(): static
    {
        return $this->state(function (array $attributes) {
            $startDate = $attributes['start_date'];
            $deadline = $attributes['deadline'];

            return [
                'status' => 'completed',
                'completed_at' => $this->faker->dateTimeBetween($startDate, min($deadline, new \DateTime())),
            ];
        });
    }

    /**
     * Configure the model factory to create a project that hasn't started yet.
     */
    public function notStarted(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'not_started',
                'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
                'completed_at' => null,
            ];
        });
    }
}
