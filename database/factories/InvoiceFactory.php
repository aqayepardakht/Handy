<?php

namespace Aqayepardakht\Handy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Aqayepardakht\Handy\Wallet\Models\Invoice;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Aqayepardakht\Handy\Wallet\Models\Wallet>
 */
class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payable_id'      => fake()->randomNumber(),
            'payable_type'    => fake()->word(),
            'trace_code'      => fake()->uuid(),
            'tracking_number' => fake()->uuid(),
            'amount'          => fake()->randomFloat(2, 100, 10000),
            'card_numbers'    => fake()->creditCardNumber(),
            'product_id'      => fake()->uuid(),
            'mobile'          => fake()->phoneNumber(),
            'email'           => fake()->email(),
            'description'     => fake()->sentence(),
            'status'          => fake()->randomElement(['created', 'paid', 'unpaid', 'pending_verify']),
        ];
    }
}
