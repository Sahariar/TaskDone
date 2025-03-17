<?php

namespace Database\Factories;

use App\Models\ActivityLogs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivityLogs>
 */
class ActivityLogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ActivityLogs::class;
    public function definition(): array
    {
        $actions = [
            'created',
            'updated',
            'deleted',
            'restored',
            'status_changed',
            'assigned',
            'completed',
            'commented'
        ];

        return [
            'user_id' => null, // Will be set in seeder
            'loggable_id' => null, // Will be set in seeder
            'loggable_type' => null, // Will be set in seeder
            'action' => $this->faker->randomElement($actions),
            'description' => $this->faker->sentence(),
            'old_values' => null,
            'new_values' => null,
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }

    /**
     * Configure the model factory to create a task log.
     */
    public function taskLog(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'loggable_type' => 'App\\Models\\Task',
            ];
        });
    }

    /**
     * Configure the model factory to create a project log.
     */
    public function projectLog(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'loggable_type' => 'App\\Models\\Project',
            ];
        });
    }

    /**
     * Configure the model factory to create a status change log.
     */
    public function statusChange(): static
    {
        $taskStatuses = ['to_do', 'in_progress', 'in_review', 'done'];
        $projectStatuses = ['not_started', 'in_progress', 'on_hold', 'completed', 'cancelled'];

        return $this->state(function (array $attributes) use ($taskStatuses, $projectStatuses) {
            $loggableType = $attributes['loggable_type'] ?? 'App\\Models\\Tasks';

            if ($loggableType === 'App\\Models\\Tasks') {
                $oldStatus = $this->faker->randomElement($taskStatuses);
                // Ensure new status is different from old status
                $newStatus = $this->faker->randomElement(array_diff($taskStatuses, [$oldStatus]));

                return [
                    'action' => 'status_changed',
                    'description' => "Task status changed from $oldStatus to $newStatus",
                    'old_values' => json_encode(['status' => $oldStatus]),
                    'new_values' => json_encode(['status' => $newStatus]),
                ];
            } else {
                $oldStatus = $this->faker->randomElement($projectStatuses);
                // Ensure new status is different from old status
                $newStatus = $this->faker->randomElement(array_diff($projectStatuses, [$oldStatus]));

                return [
                    'action' => 'status_changed',
                    'description' => "Project status changed from $oldStatus to $newStatus",
                    'old_values' => json_encode(['status' => $oldStatus]),
                    'new_values' => json_encode(['status' => $newStatus]),
                ];
            }
        });
    }
}
