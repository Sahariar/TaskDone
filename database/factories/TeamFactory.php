<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Team::class;
    public function definition(): array
    {
        $teamNames = [
            'Development Team',
            'Design Team',
            'Marketing Team',
            'QA Team',
            'DevOps Team',
            'Sales Team',
            'Customer Support Team',
            'Research & Development',
            'Content Creation Team',
            'Product Management'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($teamNames),
            'description' => $this->faker->sentence(10),
            'team_lead_id' => null, // Will be set after user creation
        ];
    }

    /**
     * Configure the model factory to create predefined teams.
     */
    public function predefined(int $index = 0): static
    {
        $teams = [
            [
                'name' => 'Development Team',
                'description' => 'Software development team focused on implementing core features.',
            ],
            [
                'name' => 'Design Team',
                'description' => 'UI/UX design team responsible for creating user interfaces and experiences.',
            ],
            [
                'name' => 'Marketing Team',
                'description' => 'Marketing and promotion team handling client outreach and branding.',
            ],
        ];

        $index = min($index, count($teams) - 1);

        return $this->state(function (array $attributes) use ($teams, $index) {
            return $teams[$index];
        });
    }
}
