<?php

namespace Database\Seeders;

use App\Models\Files;
use App\Models\Project;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Get tasks, projects, and users
        $tasks = Tasks::inRandomOrder()->limit(20)->get();
        $projects = Project::inRandomOrder()->limit(10)->get();
        $users = User::role(['project-manager', 'team-member'])->get();

        // Create task attachments
        foreach ($tasks as $task) {
            // Add 1-3 files to each task
            $numFiles = rand(1, 3);

            for ($i = 0; $i < $numFiles; $i++) {
                // Get random user
                $user = $users->random();

                // Create file
                Files::factory()->taskAttachment()->create([
                    'fileable_id' => $task->id,
                    'uploaded_by' => $user->id,
                ]);
            }
        }

        // Create project attachments
        foreach ($projects as $project) {
            // Add 2-5 files to each project
            $numFiles = rand(2, 5);

            for ($i = 0; $i < $numFiles; $i++) {
                // Get project manager
                $user = User::find($project->manager_id) ?? $users->random();

                // Create file
                Files::factory()->projectAttachment()->create([
                    'fileable_id' => $project->id,
                    'uploaded_by' => $user->id,
                ]);
            }
        }
    }
}
