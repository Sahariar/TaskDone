<?php

namespace Database\Factories;

use App\Models\InvoiceItems;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceItems>
 */
class InvoiceItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = InvoiceItems::class;

    public function definition(): array
    {
        $quantity = $this->faker->randomFloat(2, 1, 40); // Hours
        $unitPrice = $this->faker->randomFloat(2, 50, 150); // Hourly rate
        $amount = $quantity * $unitPrice;

        return [
            'invoice_id' => null, // Will be set in seeder
            'description' => $this->faker->sentence(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'amount' => $amount,
            'task_id' => null, // Optional, will be set in seeder if applicable
            'time_entry_ids' => null, // Optional, will be set in seeder if applicable
        ];
    }
}
