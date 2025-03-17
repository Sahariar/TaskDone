<?php

namespace Database\Seeders;

use App\Models\NotificationTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $notificationTypes = [
            [
                'name' => 'task_assigned',
                'description' => 'Notification when a task is assigned to a user',
            ],
            [
                'name' => 'task_completed',
                'description' => 'Notification when a task is marked as completed',
            ],
            [
                'name' => 'task_comment',
                'description' => 'Notification when someone comments on a task',
            ],
            [
                'name' => 'deadline_approaching',
                'description' => 'Notification when a task deadline is approaching',
            ],
            [
                'name' => 'deadline_overdue',
                'description' => 'Notification when a task is overdue',
            ],
            [
                'name' => 'project_created',
                'description' => 'Notification when a new project is created',
            ],
            [
                'name' => 'project_completed',
                'description' => 'Notification when a project is completed',
            ],
            [
                'name' => 'time_entry_approved',
                'description' => 'Notification when a time entry is approved',
            ],
            [
                'name' => 'time_entry_rejected',
                'description' => 'Notification when a time entry is rejected',
            ],
            [
                'name' => 'invoice_created',
                'description' => 'Notification when an invoice is created',
            ],
            [
                'name' => 'invoice_sent',
                'description' => 'Notification when an invoice is sent to client',
            ],
            [
                'name' => 'invoice_paid',
                'description' => 'Notification when an invoice is marked as paid',
            ],
            [
                'name' => 'invoice_overdue',
                'description' => 'Notification when an invoice is overdue',
            ],
            [
                'name' => 'user_added_to_project',
                'description' => 'Notification when a user is added to a project',
            ],
            [
                'name' => 'user_added_to_team',
                'description' => 'Notification when a user is added to a team',
            ],
        ];

        foreach ($notificationTypes as $type) {
            NotificationTypes::create($type);
        }
    }
}
