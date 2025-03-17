<?php

namespace Database\Seeders;

use App\Models\ActivityLogs;
use App\Models\Project;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = \Faker\Factory::create();
        // Get tasks, projects, and users
        $tasks = Tasks::all();
        $projects = Project::all();
        $users = User::all();

        // Create task logs
        foreach ($tasks as $task) {
            // Generate 2-5 logs per task
            $numLogs = rand(2, 5);

            // Always create a creation log
            ActivityLogs::factory()->taskLog()->create([
                'loggable_id' => $task->id,
                'user_id' => $task->assigned_by,
                'action' => 'created',
                'description' => "Task '{$task->title}' was created",
                'new_values' => json_encode([
                    'title' => $task->title,
                    'description' => $task->description,
                    'project_id' => $task->project_id,
                    'assigned_to' => $task->assigned_to,
                    'status' => $task->status,
                    'priority' => $task->priority,
                ]),
                'created_at' => $task->created_at,
            ]);

            // If task is assigned, create an assignment log
            if ($task->assigned_to && $task->assigned_to !== $task->assigned_by) {
                ActivityLogs::factory()->taskLog()->create([
                    'loggable_id' => $task->id,
                    'user_id' => $task->assigned_by,
                    'action' => 'assigned',
                    'description' => "Task was assigned to " . User::find($task->assigned_to)->name,
                    'new_values' => json_encode(['assigned_to' => $task->assigned_to]),
                    'created_at' => $task->created_at->addMinutes(rand(5, 60)),
                ]);
            }

            // If task is completed, create a completion log
            if ($task->status === 'done' && $task->completed_at) {
                ActivityLogs::factory()->taskLog()->create([
                    'loggable_id' => $task->id,
                    'user_id' => $task->assigned_to,
                    'action' => 'completed',
                    'description' => "Task was marked as completed",
                    'old_values' => json_encode(['status' => 'in_review']),
                    'new_values' => json_encode(['status' => 'done', 'completed_at' => $task->completed_at]),
                    'created_at' => $task->completed_at,
                ]);
            }

            // Additional random logs
            for ($i = 0; $i < $numLogs - 2; $i++) {
                // Random user from project members
                $project = Project::find($task->project_id);
                $user = $project ? $project->members()->inRandomOrder()->first() : $users->random();

                // Create a status change log
                ActivityLogs::factory()->taskLog()->statusChange()->create([
                    'loggable_id' => $task->id,
                    'user_id' => $user ? $user->id : null,
                    'created_at' => $faker->dateTimeBetween($task->created_at, $task->completed_at ?? 'now'),
                ]);
            }
        }

        // Create project logs
        foreach ($projects as $project) {
            // Generate 3-7 logs per project
            $numLogs = rand(3, 7);

            // Always create a creation log
            ActivityLogs::factory()->projectLog()->create([
                'loggable_id' => $project->id,
                'user_id' => $project->manager_id,
                'action' => 'created',
                'description' => "Project '{$project->name}' was created",
                'new_values' => json_encode([
                    'name' => $project->name,
                    'description' => $project->description,
                    'client_id' => $project->client_id,
                    'manager_id' => $project->manager_id,
                    'status' => $project->status,
                ]),
                'created_at' => $project->created_at,
            ]);

            // If project is completed, create a completion log
            if ($project->status === 'completed' && $project->completed_at) {
                ActivityLogs::factory()->projectLog()->create([
                    'loggable_id' => $project->id,
                    'user_id' => $project->manager_id,
                    'action' => 'completed',
                    'description' => "Project was marked as completed",
                    'old_values' => json_encode(['status' => 'in_progress']),
                    'new_values' => json_encode(['status' => 'completed', 'completed_at' => $project->completed_at]),
                    'created_at' => $project->completed_at,
                ]);
            }

            // Additional random logs
            for ($i = 0; $i < $numLogs - 2; $i++) {
                // Random user from project members or manager
                $user = rand(0, 1) === 0 ?
                    User::find($project->manager_id) :
                    $project->members()->inRandomOrder()->first();

                if (!$user) {
                    $user = $users->random();
                }

                // Create a status change log
                ActivityLogs::factory()->projectLog()->statusChange()->create([
                    'loggable_id' => $project->id,
                    'user_id' => $user->id,
                    'created_at' => $faker->dateTimeBetween($project->created_at, $project->completed_at ?? 'now'),
                ]);
            }
        }
    }
}
