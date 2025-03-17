<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin (already created in RoleAndPermissionSeeder)
        $adminUser = User::where('email', 'admin@example.com')->first();

        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin User',
                'avatar' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . fake()->unique()->word,
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);

            $adminUser->assignRole('super-admin');
        }

        // Project Managers
        $projectManagers = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'role' => 'project-manager'
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael.chen@example.com',
                'role' => 'project-manager'
            ],
            [
                'name' => 'Jessica Williams',
                'email' => 'jessica.williams@example.com',
                'role' => 'project-manager'
            ],
        ];

        foreach ($projectManagers as $manager) {
            $user = User::create([
                'name' => $manager['name'],
                'avatar' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . fake()->unique()->word,
                'email' => $manager['email'],
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);

            $user->assignRole($manager['role']);
        }

        // Team Members
        $teamMembers = [
            [
                'name' => 'David Smith',
                'email' => 'david.smith@example.com',
                'role' => 'team-member'
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'role' => 'team-member'
            ],
            [
                'name' => 'James Wilson',
                'email' => 'james.wilson@example.com',
                'role' => 'team-member'
            ],
            [
                'name' => 'Sophia Miller',
                'email' => 'sophia.miller@example.com',
                'role' => 'team-member'
            ],
            [
                'name' => 'Daniel Taylor',
                'email' => 'daniel.taylor@example.com',
                'role' => 'team-member'
            ],
            [
                'name' => 'Olivia Martinez',
                'email' => 'olivia.martinez@example.com',
                'role' => 'team-member'
            ],
            [
                'name' => 'William Anderson',
                'email' => 'william.anderson@example.com',
                'role' => 'team-member'
            ],
        ];

        foreach ($teamMembers as $member) {
            $user = User::create([
                'name' => $member['name'],
                'avatar' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . fake()->unique()->word,
                'email' => $member['email'],
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);

            $user->assignRole($member['role']);
        }

        // Accountant
        $accountant = User::create([
            'name' => 'Rachel Green',
            'avatar' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . fake()->unique()->word,
            'email' => 'rachel.green@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);

        $accountant->assignRole('accountant');

        // Create project managers
        $projectManagers = User::factory()->count(3)->projectManager()->create();
        foreach ($projectManagers as $manager) {
            $manager->assignRole('project-manager');
        }

        // Create team members
        $teamMembers = User::factory()->count(7)->teamMember()->create();
        foreach ($teamMembers as $member) {
            $member->assignRole('team-member');
        }

        // Create accountant
        $accountants = User::factory()->count(3)->accountant()->create();
        foreach ($accountants as $accountant) {
            $accountant->assignRole('accountant');
        }
    }
}
