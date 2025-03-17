<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->call([
            // Core system data
            RolesAndPermissionsSeeder::class,
            NotificationTypesSeeder::class,
            SettingsSeeder::class,
            EmailTemplatesSeeder::class,

            // Users and clients
            UserSeeder::class,
            ClientSeeder::class,

            // Teams and projects
            TeamSeeder::class,
            ProjectSeeder::class,

            // Tasks and time tracking
            TaskCategoriesSeeder::class,
            TasksSeeder::class,
            TimeEntriesSeeder::class,

            // Files
            FilesSeeder::class,

            // Invoices
            InvoicesSeeder::class,

            // Notification settings
            NotificationSettingsSeeder::class,

            // Activity logs (run last to ensure all entities exist)
            ActivityLogsSeeder::class,
        ]);
    }
}
