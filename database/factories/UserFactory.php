<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'avatar' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . fake()->unique()->word,
            'password' => static::$password ??= Hash::make('Pa$$w0rd!'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

        /**
     * Configure the model factory to create a project manager.
     */
    public function projectManager(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => $this->faker->name(),
                'email' => 'pm_' . $this->faker->unique()->userName() . '@example.com',
            ];
        });
    }

    /**
     * Configure the model factory to create a team member.
     */
    public function teamMember(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => $this->faker->name(),
                'email' => 'member_' . $this->faker->unique()->userName() . '@example.com',
            ];
        });
    }

    /**
     * Configure the model factory to create a client.
     */
    public function client(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => $this->faker->name(),
                'email' => 'client_' . $this->faker->unique()->userName() . '@example.com',
            ];
        });
    }

    /**
     * Configure the model factory to create an accountant.
     */
    public function accountant(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => $this->faker->name(),
                'email' => 'accountant_' . $this->faker->unique()->userName() . '@example.com',
            ];
        });
    }
}
