<?php

namespace Database\Seeders;

use App\Models\NotificationSettings;
use App\Models\NotificationTypes;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
            // Get all users and notification types
            $users = User::all();
            $notificationTypes = NotificationTypes::all();

            foreach ($users as $user) {
                // Create settings for each notification type
                foreach ($notificationTypes as $type) {
                    // Random settings for most combinations
                    $emailEnabled = $this->getEmailPreference($user, $type);
                    $inAppEnabled = true; // Keep in-app notifications on by default

                    NotificationSettings::create([
                        'user_id' => $user->id,
                        'notification_type_id' => $type->id,
                        'email' => $emailEnabled,
                        'in_app' => $inAppEnabled,
                    ]);
                }
            }
        }

        /**
         * Determine email preference based on user role and notification type.
         */
        private function getEmailPreference(User $user, NotificationTypes $type): bool
        {
            $faker = \Faker\Factory::create();
            // Admin and managers receive all email notifications
            if ($user->hasRole(['super-admin', 'admin', 'project-manager'])) {
                return true;
            }

            // For team members, disable some email notifications
            if ($user->hasRole('team-member')) {
                $lowPriorityTypes = ['task_comment', 'project_created', 'user_added_to_project'];
                if (in_array($type->name, $lowPriorityTypes)) {
                    return false;
                }
            }

            // For clients, only enable important email notifications
            if ($user->hasRole('client')) {
                $importantTypes = ['invoice_created', 'invoice_overdue', 'project_completed'];
                return in_array($type->name, $importantTypes);
            }

            // Default: 70% chance of email enabled
            return $faker->boolean(70);
        }
}
