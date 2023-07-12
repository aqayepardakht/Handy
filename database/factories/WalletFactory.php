<?php

namespace Aqayepardakht\Handy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Aqayepardakht\Handy\Wallet\Models\Wallet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Aqayepardakht\Handy\Wallet\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'holder_id' => 1,
            'holder_type' => 'App\\Models\\User',
            'balance' => 0
        ];
    }
}
