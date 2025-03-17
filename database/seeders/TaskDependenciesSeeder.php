<?php

namespace Database\Seeders;

use App\Models\TaskDependencies;
use App\Models\Tasks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskDependenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Get all tasks
        $tasks = Tasks::all();

        if ($tasks->isEmpty()) {
            $this->command->info('Please run TasksSeeder first.');
            return;
        }

        // Clear existing task dependencies
        // DB::table('task_dependencies')->truncate();

        // Group tasks by project
        $tasksByProject = $tasks->groupBy('project_id');

        foreach ($tasksByProject as $projectId => $projectTasks) {
            // Create random dependencies between tasks in the same project
            $taskCount = $projectTasks->count();

            // Skip projects with less than 2 tasks
            if ($taskCount < 2) {
                continue;
            }

            // Create 1-3 dependencies per task for about 60% of tasks
            foreach ($projectTasks as $task) {
                // 60% chance to create dependencies for this task
                if (rand(1, 100) <= 60) {
                    // Create 1-3 dependencies
                    $dependencyCount = rand(1, min(3, $taskCount - 1));

                    // Get potential tasks this task can depend on
                    $potentialDependencies = $projectTasks->where('id', '!=', $task->id)->shuffle();

                    // Prevent circular dependencies by ensuring dependencies have lower IDs
                    $potentialDependencies = $potentialDependencies->filter(function ($potentialTask) use ($task) {
                        return $potentialTask->id < $task->id;
                    });

                    // Skip if no potential dependencies
                    if ($potentialDependencies->isEmpty()) {
                        continue;
                    }

                    // Create dependencies
                    foreach ($potentialDependencies->take($dependencyCount) as $dependencyTask) {
                        TaskDependencies::create([
                            'task_id' => $task->id,
                            'dependency_task_id' => $dependencyTask->id,
                            'dependency_type' => rand(0, 1) ? 'finish_to_start' : 'start_to_start', // Common dependency types
                        ]);
                    }
                }
            }
        }
    }
}
