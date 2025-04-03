<?php

namespace Database\Seeders;

use App\Models\TaskCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            [
                'name' => 'Development',
                'description' => 'Software development related tasks',
                'color' => '#4287f5',
                'icon' => 'code',
            ],
            [
                'name' => 'Design',
                'description' => 'UI/UX design tasks',
                'color' => '#f542e3',
                'icon' => 'brush',
            ],
            [
                'name' => 'Testing',
                'description' => 'QA and testing related tasks',
                'color' => '#42f56f',
                'icon' => 'bug',
            ],
            [
                'name' => 'Documentation',
                'description' => 'Documentation tasks',
                'color' => '#f5a742',
                'icon' => 'file-text',
            ],
            [
                'name' => 'Deployment',
                'description' => 'Deployment and DevOps tasks',
                'color' => '#f54242',
                'icon' => 'server',
            ],
        ];

        foreach ($categories as $category) {
            TaskCategories::create($category);
        }
    }
}
