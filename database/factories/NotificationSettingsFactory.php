<?php

namespace Database\Factories;

use App\Models\NotificationSettings;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationSettings>
 */
class NotificationSettingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = NotificationSettings::class;
    public function definition(): array
    {
        return [
            'user_id' => null, // Will be set in seeder
            'notification_type_id' => null, // Will be set in seeder
            'email' => $this->faker->boolean(80), // 80% chance of email enabled
            'in_app' => $this->faker->boolean(95), // 95% chance of in-app enabled
        ];
    }

    /**
     * Configure the model factory to create default notification settings.
     */
    public function defaults(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => true,
                'in_app' => true,
            ];
        });
    }
}
