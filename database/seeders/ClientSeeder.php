<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $clients = [
            [
                'name' => 'John Doe',
                'company' => 'Acme Corporation',
                'email' => 'john.doe@acmecorp.com',
                'phone' => '+1 (555) 123-4567',
                'address' => '123 Main St, Suite 200, San Francisco, CA 94105',
                'notes' => 'Key client for enterprise projects. Prefers communication via email.'
            ],
            [
                'name' => 'Jane Smith',
                'company' => 'GlobalTech Industries',
                'email' => 'jane.smith@globaltech.com',
                'phone' => '+1 (555) 234-5678',
                'address' => '456 Market St, Floor 15, New York, NY 10001',
                'notes' => 'Long-term client with multiple ongoing projects.'
            ],
            [
                'name' => 'Robert Johnson',
                'company' => 'Blue Sky Media',
                'email' => 'robert.johnson@bluesky.com',
                'phone' => '+1 (555) 345-6789',
                'address' => '789 Broadway, Chicago, IL 60601',
                'notes' => 'New client, needs extra attention and guidance.'
            ],
            [
                'name' => 'Patricia Brown',
                'company' => 'Sunshine Retail',
                'email' => 'patricia.brown@sunshine.com',
                'phone' => '+1 (555) 456-7890',
                'address' => '101 Pine St, Miami, FL 33101',
                'notes' => 'Retail client with seasonal project needs.'
            ],
            [
                'name' => 'Michael Wilson',
                'company' => 'GreenEarth Foundation',
                'email' => 'michael.wilson@greenearth.org',
                'phone' => '+1 (555) 567-8901',
                'address' => '222 Oak St, Seattle, WA 98101',
                'notes' => 'Non-profit client, special billing arrangements.'
            ],
            [
                'name' => 'Elizabeth Taylor',
                'company' => 'Quantum Innovations',
                'email' => 'elizabeth.taylor@quantum.com',
                'phone' => '+1 (555) 678-9012',
                'address' => '333 University Ave, Austin, TX 78701',
                'notes' => 'Tech startup, fast-paced projects with changing requirements.'
            ],
            [
                'name' => 'Thomas Anderson',
                'company' => 'Matrix Systems',
                'email' => 'thomas.anderson@matrix.com',
                'phone' => '+1 (555) 789-0123',
                'address' => '444 Digital Dr, Boston, MA 02110',
                'notes' => 'IT security focus, requires strict confidentiality.'
            ]
        ];

        foreach ($clients as $clientData) {
            \App\Models\Client::create($clientData);
        }

        // Create client users
        $clients = \App\Models\Client::all();
        $clientRole = Role::where('name', 'client')->first();

        foreach ($clients as $client) {
            $nameParts = explode(' ', $client->name);
            $firstName = $nameParts[0];

            $user = User::create([
                'name' => $client->name,
                'email' => strtolower($firstName) . '@' . strtolower(str_replace(' ', '', $client->company)) . '.com',
                'avatar' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . fake()->unique()->word,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);

            $user->assignRole($clientRole);
        }
    }
}
