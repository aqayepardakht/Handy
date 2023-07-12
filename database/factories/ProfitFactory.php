<?php

namespace Aqayepardakht\Handy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Aqayepardakht\Handy\Wallet\Models\Profit;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Aqayepardakht\Handy\Wallet\Models\Wallet>
 */
class ProfitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_id' => $this->faker->randomNumber(),
            'amount' => $this->faker->randomNumber(),
            'type' => $this->faker->word(),
            'meta' => $this->faker->sentence(),
        ];
    }
}
