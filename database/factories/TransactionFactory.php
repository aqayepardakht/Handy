<?php

namespace Aqayepardakht\Handy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Aqayepardakht\Handy\Wallet\Models\Transaction;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Aqayepardakht\Handy\Wallet\Models\Wallet>
 */
class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wallet_id' => $this->faker->randomNumber(),
            'type'      => $this->faker->randomElement(['deposit', 'withdraw']),
            'amount'    => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
