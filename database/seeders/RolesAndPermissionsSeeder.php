<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Client management
            'view clients',
            'create clients',
            'edit clients',
            'delete clients',

            // Project management
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',

            // Task management
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'assign tasks',

            // Time tracking
            'view time entries',
            'create time entries',
            'edit time entries',
            'delete time entries',
            'approve time entries',

            // Invoice management
            'view invoices',
            'create invoices',
            'edit invoices',
            'delete invoices',
            'send invoices',
            'mark invoices paid',

            // Reports
            'view reports',
            'export reports',

            // Settings
            'manage settings',

            // Teams
            'manage teams',

            // Files
            'upload files',
            'view files',
            'delete files'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions

        // 1. Super Admin - has all permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        // 2. Admin - has most permissions but not system settings
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all()->except('manage settings'));

        // 3. Project Manager - manages projects, tasks, and team members
        $managerRole = Role::create(['name' => 'project-manager']);
        $managerRole->givePermissionTo([
            'view users',
            'view clients',
            'view projects',
            'create projects',
            'edit projects',
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'assign tasks',
            'view time entries',
            'create time entries',
            'edit time entries',
            'approve time entries',
            'view invoices',
            'create invoices',
            'view reports',
            'manage teams',
            'upload files',
            'view files'
        ]);

        // 4. Team Member - works on tasks, tracks time
        $memberRole = Role::create(['name' => 'team-member']);
        $memberRole->givePermissionTo([
            'view projects',
            'view tasks',
            'create tasks',
            'edit tasks',
            'view time entries',
            'create time entries',
            'edit time entries',
            'upload files',
            'view files'
        ]);

        // 5. Client - limited access to their projects and tasks
        $clientRole = Role::create(['name' => 'client']);
        $clientRole->givePermissionTo([
            'view projects',
            'view tasks',
            'view invoices',
            'view files'
        ]);

        // 6. Accountant - handles invoices and finances
        $accountantRole = Role::create(['name' => 'accountant']);
        $accountantRole->givePermissionTo([
            'view clients',
            'view projects',
            'view time entries',
            'approve time entries',
            'view invoices',
            'create invoices',
            'edit invoices',
            'send invoices',
            'mark invoices paid',
            'view reports',
            'export reports'
        ]);

        // Create admin user and assign role
        User::factory()->create([
            'name' => 'Sahariar Kabir',
            'email' => 'sahariark@gmail.com',
            'avatar' => 'https://gravatar.com/avatar/872453767ea164358e41858e0e3387f1?size=256',
            'password' => Hash::make('Pa$$w0rd!'),
        ])->assignRole($superAdminRole);

    }
}
