<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use function rand;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Get all users and projects to assign tasks to
        $users = User::all();
        $projects = Project::all();

        if ($users->isEmpty() || $projects->isEmpty()) {
            $this->command->info('Please run UserSeeder and ProjectSeeder first.');
            return;
        }

        // Clear existing tasks
        // DB::table('tasks')->truncate();

        // Task statuses
        $statuses = ['to_do', 'in_progress', 'in_review', 'done'];

        // Task priorities
        $priorities = ['low', 'medium', 'high', 'urgent'];

        // Generate tasks for each project
        foreach ($projects as $project) {
            // Generate 5-15 tasks per project
            $taskCount = rand(5, 15);

            for ($i = 0; $i < $taskCount; $i++) {
                $startDate = Carbon::now()->subDays(rand(0, 30));
                $dueDate = (clone $startDate)->addDays(rand(1, 14));

                Tasks::create([
                    'title' => 'Task ' . ($i + 1) . ' for ' . $project->name,
                    'description' => 'This is a detailed description for task ' . ($i + 1) . ' of project ' . $project->name,
                    'project_id' => $project->id,
                    'status' => $statuses[array_rand($statuses)],
                    'priority' => $priorities[array_rand($priorities)],
                    'start_date' => $startDate,
                    'end_date' => $dueDate,
                    'assigned_to' => $users->random()->id,
                    'created_by' => $users->random()->id,
                    'estimated_hours' => rand(1, 40),
                    'actual_hours' => rand(0, 50),
                    'progress' => rand(0, 100),
                    'created_at' => Carbon::now()->subDays(rand(1, 60)),
                    'updated_at' => Carbon::now()->subDays(rand(0, 30)),
                ]);
            }
        }

        $this->command->info('Tasks seeded successfully!');
    }
}
