<?php

namespace Database\Factories;

use App\Models\TaskComments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskComments>
 */
class TaskCommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TaskComments::class;
    public function definition(): array
    {
        $commentTemplates = [
            'I\'ve started working on this task.',
            'I need some clarification on the requirements.',
            'This task is more complex than expected.',
            'Making good progress on this task.',
            'I\'ve run into a blocker. Need help with %s.',
            'I\'ve completed the first part of this task.',
            'Can someone review my work so far?',
            'Updated the implementation based on feedback.',
            'Task is almost complete, just doing final testing.',
            'This task is now complete and ready for review.',
            'I\'ve marked this task as complete.',
            'Had to adjust the approach because of %s.',
            'I need more time to complete this task.',
            'Working with %s on this task.',
            'What\'s the priority of this compared to other tasks?'
        ];

        $blockersTemplates = [
            'the API integration',
            'the database setup',
            'third-party dependencies',
            'environment issues',
            'permission problems',
            'missing assets',
            'conflicting requirements'
        ];

        // Select random comment template
        $commentTemplate = $this->faker->randomElement($commentTemplates);

        // Replace placeholders if any
        if (strpos($commentTemplate, '%s') !== false) {
            if (strpos($commentTemplate, 'blocker') !== false) {
                $replacement = $this->faker->randomElement($blockersTemplates);
            } else {
                $replacement = $this->faker->name();
            }

            $comment = sprintf($commentTemplate, $replacement);
        } else {
            $comment = $commentTemplate;
        }

        return [
            'task_id' => null, // Will be set in seeder
            'user_id' => null, // Will be set in seeder
            'comment' => $comment,
        ];
    }
}
