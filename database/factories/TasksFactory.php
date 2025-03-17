<?php

namespace Database\Factories;
use App\Models\Tasks;
use App\Models\Project;
use App\Models\User;
use App\Models\TaskCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Tasks::class;
    public function definition(): array
    {
        // Task titles by category will be defined in the seeder

        $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $deadline = $this->faker->dateTimeBetween('+1 week', '+2 months');

        return [
            'title' => $this->faker->sentence(rand(3, 8)),
            'description' => $this->faker->paragraph(),
            'project_id' => null, // Will be set in seeder
            'assigned_to' => null, // Will be set in seeder
            'assigned_by' => null, // Will be set in seeder
            'category_id' => null, // Will be set in seeder
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'urgent']),
            'status' => $this->faker->randomElement(['to_do', 'in_progress', 'in_review', 'done']),
            'start_date' => $startDate,
            'deadline' => $deadline,
            'estimated_hours' => $this->faker->randomFloat(2, 1, 40),
            'parent_task_id' => null, // Will be set for subtasks
            'completed_at' => null, // Will be set based on status
        ];
    }

    /**
     * Configure the model factory to create a task with "to_do" status.
     */
    public function toDo(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'to_do',
                'completed_at' => null,
            ];
        });
    }

    /**
     * Configure the model factory to create a task with "in_progress" status.
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
     * Configure the model factory to create a task with "in_review" status.
     */
    public function inReview(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'in_review',
                'completed_at' => null,
            ];
        });
    }

    /**
     * Configure the model factory to create a completed task.
     */
    public function done(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'done',
                'completed_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            ];
        });
    }

    /**
     * Configure the model factory to create a subtask.
     */
    public function subtask(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'title' => 'Subtask: ' . $this->faker->sentence(rand(3, 6)),
            ];
        });
    }
}
