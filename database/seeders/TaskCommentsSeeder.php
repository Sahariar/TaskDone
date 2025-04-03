<?php

namespace Database\Seeders;

use App\Models\TaskComments;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Make sure we have tasks and users to reference
        if (Tasks::count() == 0 || User::count() == 0) {
            $this->command->info('Please run the TaskSeeder and UserSeeder first');
            return;
        }

        $tasks = Tasks::all();
        $users = User::all();

        $comments = [
            [
                'content' => 'I need more information to complete this task.',
                'is_private' => false,
            ],
            [
                'content' => 'This task is taking longer than expected.',
                'is_private' => false,
            ],
            [
                'content' => 'We should prioritize this task for the next sprint.',
                'is_private' => true,
            ],
            [
                'content' => 'The requirements for this task are unclear.',
                'is_private' => false,
            ],
            [
                'content' => 'I completed this task ahead of schedule.',
                'is_private' => false,
            ],
            [
                'content' => 'This task has dependencies that need to be resolved first.',
                'is_private' => true,
            ],
            [
                'content' => 'We should consider breaking this down into smaller tasks.',
                'is_private' => false,
            ],
            [
                'content' => 'I encountered some technical challenges with this task.',
                'is_private' => false,
            ],
        ];

        // Create at least 30 comments
            TaskComments::factory()
            ->count(30)
            ->make()
            ->each(function ($comment) use ($tasks, $users) {
                $comment->task_id = $tasks->random()->id;
                $comment->user_id = $users->random()->id;
                $comment->save();
            });
    }
}
