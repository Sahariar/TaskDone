<?php

namespace Database\Factories;

use App\Models\Invoices;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoices>
 */
class InvoicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Invoices::class;
    public function definition(): array
    {
        $prefix = 'INV-';
        $amount = $this->faker->randomFloat(2, 100, 10000);
        $taxRate = $this->faker->randomFloat(2, 0, 20);
        $taxAmount = $amount * ($taxRate / 100);
        $totalAmount = $amount + $taxAmount;

        $issueDate = $this->faker->dateTimeBetween('-2 months', '-1 week');
        $dueDate = (clone $issueDate)->modify('+30 days');

        return [
            'invoice_number' => $prefix . $this->faker->unique()->numberBetween(1001, 9999),
            'client_id' => null, // Will be set in seeder
            'project_id' => null, // Will be set in seeder
            'amount' => $amount,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'issue_date' => $issueDate,
            'due_date' => $dueDate,
            'status' => $this->faker->randomElement(['draft', 'sent', 'paid', 'overdue', 'cancelled']),
            'notes' => $this->faker->optional(0.7)->sentence(),
            'created_by' => null, // Will be set in seeder
            'paid_at' => null, // Will be set based on status
        ];
    }

    /**
     * Configure the model factory to create a paid invoice.
     */
    public function paid(): static
    {
        return $this->state(function (array $attributes) {
            $issueDate = $attributes['issue_date'];
            $dueDate = $attributes['due_date'];

            return [
                'status' => 'paid',
                'paid_at' => $this->faker->dateTimeBetween($issueDate, $dueDate),
            ];
        });
    }

    /**
     * Configure the model factory to create an overdue invoice.
     */
    public function overdue(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'overdue',
                'issue_date' => $this->faker->dateTimeBetween('-3 months', '-2 months'),
                'due_date' => $this->faker->dateTimeBetween('-1 month', '-1 week'),
                'paid_at' => null,
            ];
        });
    }

    /**
     * Configure the model factory to create a draft invoice.
     */
    public function draft(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'draft',
                'paid_at' => null,
            ];
        });
    }
}
