<?php

namespace Database\Factories;

use App\Models\Settings;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Settings>
 */
class SettingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Settings::class;
    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->word(),
            'value' => $this->faker->word(),
        ];
    }

    /**
     * Configure the model factory to create predefined settings.
     */
    public function predefined(string $key): static
    {
        $settings = [
            'company_name' => 'Your Company Name',
            'company_email' => 'contact@yourcompany.com',
            'company_phone' => '+1234567890',
            'company_address' => '123 Business Street, City, Country',
            'company_logo' => null,
            'invoice_prefix' => 'INV-',
            'invoice_next_number' => '1001',
            'invoice_due_days' => '30',
            'default_tax_rate' => '0',
            'invoice_terms' => 'Payment is due within 30 days from the date of invoice.',
            'invoice_notes' => 'Thank you for your business!',
            'email_from_name' => 'Your Company Name',
            'email_from_address' => 'noreply@yourcompany.com',
            'time_tracking_increment' => '15',
            'time_tracking_auto_stop' => '1',
            'time_tracking_auto_stop_after' => '8',
            'default_task_status' => 'to_do',
            'default_task_priority' => 'medium',
            'deadline_reminder_days' => '3',
            'default_timezone' => 'UTC',
            'date_format' => 'Y-m-d',
            'time_format' => 'H:i',
            'currency' => 'USD',
            'currency_symbol' => '$',
            'weekend_days' => '6,0',
        ];

        return $this->state(function (array $attributes) use ($settings, $key) {
            return [
                'key' => $key,
                'value' => $settings[$key] ?? null,
            ];
        });
        }

    }
