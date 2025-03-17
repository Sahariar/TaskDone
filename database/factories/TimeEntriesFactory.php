<?php

namespace Database\Factories;

use App\Models\TimeEntries;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeEntries>
 */
class TimeEntriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TimeEntries::class;

    public function definition(): array
    {
        $hoursToLog = $this->faker->randomFloat(2, 0.5, 4);
        $durationSeconds = intval($hoursToLog * 3600);

        $startTime = $this->faker->dateTimeBetween('-1 month', 'now');
        $endTime = (clone $startTime)->modify('+' . $durationSeconds . ' seconds');

        return [
            'user_id' => null, // Will be set in seeder
            'task_id' => null, // Will be set in seeder
            'description' => 'Working on task',
            'start_time' => $startTime,
            'end_time' => $endTime,
            'duration' => $durationSeconds,
            'billable' => $this->faker->boolean(80), // 80% chance of being billable
            'approved' => false,
            'approved_by' => null,
            'approved_at' => null,
        ];
    }

    /**
     * Configure the model factory to create an approved time entry.
     */
    public function approved(User $approver = null): static
    {
        return $this->state(function (array $attributes) use ($approver) {
            return [
                'approved' => true,
                'approved_by' => $approver ? $approver->id : null,
                'approved_at' => $this->faker->dateTimeBetween($attributes['end_time'], 'now'),
            ];
        });
    }

    /**
     * Configure the model factory to create a non-billable time entry.
     */
    public function nonBillable(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'billable' => false,
            ];
        });
    }
}
