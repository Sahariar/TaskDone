<?php

namespace Database\Factories;

use App\Models\EmailTemplates;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailTemplates>
 */
class EmailTemplatesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = EmailTemplates::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'subject' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(5),
            'variables' => json_encode([]),
        ];
    }

    /**
     * Configure the model factory to create task assigned email template.
     */
    public function taskAssigned(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'task_assigned',
                'subject' => 'New Task Assigned: {task_title}',
                'body' => $this->getTaskAssignedTemplate(),
                'variables' => json_encode(['user_name', 'project_name', 'task_title', 'task_priority', 'task_deadline', 'task_description', 'assigned_by', 'task_url', 'company_name']),
            ];
        });
    }

    /**
     * Configure the model factory to create task status changed email template.
     */
    public function taskStatusChanged(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'task_status_changed',
                'subject' => 'Task Status Update: {task_title}',
                'body' => $this->getTaskStatusChangedTemplate(),
                'variables' => json_encode(['user_name', 'project_name', 'task_title', 'previous_status', 'new_status', 'updated_by', 'task_deadline', 'task_url', 'company_name']),
            ];
        });
    }

    /**
     * Get task assigned email template.
     */
    private function getTaskAssignedTemplate(): string
    {
        return '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #4A6FDC; color: white; padding: 10px 20px; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 5px 5px; }
        .footer { margin-top: 20px; font-size: 12px; color: #777; text-align: center; }
        .btn { display: inline-block; background-color: #4A6FDC; color: white; text-decoration: none; padding: 10px 20px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Task Assignment</h2>
        </div>
        <div class="content">
            <p>Hello {user_name},</p>
            <p>You have been assigned a new task in the project <strong>{project_name}</strong>.</p>

            <h3>Task Details:</h3>
            <p><strong>Title:</strong> {task_title}</p>
            <p><strong>Priority:</strong> {task_priority}</p>
            <p><strong>Deadline:</strong> {task_deadline}</p>
            <p><strong>Description:</strong><br>{task_description}</p>

            <p>Assigned by: {assigned_by}</p>

            <p style="margin-top: 30px;">
                <a href="{task_url}" class="btn">View Task</a>
            </p>
        </div>
        <div class="footer">
            <p>This is an automated message from {company_name} task management system.</p>
            <p>Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>';
    }

    /**
     * Get task status changed email template.
     */
    private function getTaskStatusChangedTemplate(): string
    {
        return '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #4A6FDC; color: white; padding: 10px 20px; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 5px 5px; }
        .footer { margin-top: 20px; font-size: 12px; color: #777; text-align: center; }
        .btn { display: inline-block; background-color: #4A6FDC; color: white; text-decoration: none; padding: 10px 20px; border-radius: 3px; }
        .status-change { background-color: #f5f5f5; padding: 15px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Task Status Update</h2>
        </div>
        <div class="content">
            <p>Hello {user_name},</p>
            <p>The status of a task in project <strong>{project_name}</strong> has been updated.</p>

            <div class="status-change">
                <p><strong>Task:</strong> {task_title}</p>
                <p><strong>Previous Status:</strong> {previous_status}</p>
                <p><strong>New Status:</strong> {new_status}</p>
                <p><strong>Updated by:</strong> {updated_by}</p>
            </div>

            <p>Deadline: {task_deadline}</p>

            <p style="margin-top: 30px;">
                <a href="{task_url}" class="btn">View Task</a>
            </p>
        </div>
        <div class="footer">
            <p>This is an automated message from {company_name} task management system.</p>
            <p>Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>';
    }
}
