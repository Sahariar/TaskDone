<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Get all users to assign as project managers and team members
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('Please run UserSeeder first.');
            return;
        }

        // Clear existing projects
        // DB::table('projects')->truncate();

        // Clear pivot table if it exists
        // if (Schema::hasTable('project_user')) {
        //     DB::table('project_user')->truncate();
        // }

        // Project statuses
        $statuses = ['not_started', 'in_progress', 'on_hold', 'completed', 'cancelled'];

        // Create 8-12 projects
        $projectCount = rand(8, 12);

        $projectTypes = [
            'Website Development',
            'Mobile App',
            'E-commerce Platform',
            'CRM Implementation',
            'ERP System',
            'UI/UX Redesign',
            'Database Migration',
            'API Integration',
            'Security Audit',
            'Performance Optimization',
            'Content Management System',
            'Cloud Migration'
        ];

        $companies = [
            'TechSolutions',
            'InnovateCorp',
            'DigitalDynamics',
            'FutureSystems',
            'SmartTech',
            'NextGen Solutions',
            'WebWizards',
            'DataDrivenLtd',
            'CloudComputing',
            'SoftwareSage',
            'AppArchitects',
            'VirtualVentures'
        ];

        for ($i = 0; $i < $projectCount; $i++) {
            $startDate = Carbon::now()->subMonths(rand(0, 6))->subDays(rand(0, 30));
            $endDate = (clone $startDate)->addMonths(rand(2, 12));

            $projectType = $projectTypes[array_rand($projectTypes)];
            $company = $companies[array_rand($companies)];

            $project = Project::create([
                'name' => $projectType . ' for ' . $company,
                'description' => 'This is a ' . $projectType . ' project for ' . $company . '. ' . Str::random(200),
                'status' => $statuses[array_rand($statuses)],
                'start_date' => $startDate,
                'end_date' => $endDate,
                'budget' => rand(5000, 100000),
                'manager_id' => $users->random()->id,
                'client_name' => $company,
                'client_email' => 'contact@' . Str::slug($company, '') . '.com',
                'created_at' => Carbon::now()->subMonths(rand(7, 12)),
                'updated_at' => Carbon::now()->subDays(rand(0, 60)),
            ]);

            // Assign 3-8 team members to the project
            $teamMemberCount = rand(3, 8);
            $teamMembers = $users->random($teamMemberCount);

            // If using a pivot table for team members
            if (method_exists($project, 'teamMembers')) {
                $project->teamMembers()->attach($teamMembers->pluck('id')->toArray());
            }
        }
    }
}
