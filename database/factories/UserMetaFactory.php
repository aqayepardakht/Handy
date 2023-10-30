<?php

namespace Aqayepardakht\Handy\Database\Factories;

use Illuminate\Support\Str;
use Aqayepardakht\Handy\Models\User;
use Aqayepardakht\Handy\Models\UserMeta;
use Illuminate\Database\Eloquent\Factories\Factory;


class UserMetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMeta::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'user_id' => User::all()->unique()->random()->id,
        ];
    }
}
