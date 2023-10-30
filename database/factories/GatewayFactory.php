<?php

namespace Aqayepardakht\Handy\Database\Factories;

use Illuminate\Support\Str;
use Aqayepardakht\Handy\Models\User;
use Aqayepardakht\Handy\Marketing\Models\Gateway;
use Illuminate\Database\Eloquent\Factories\Factory;


class GatewayFactory extends Factory
{

    protected $model = Gateway::class;

    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }

    public function forReferralOwner($referralOwner)
    {
        return $this->state([
            'user_id' => $referralOwner->id,
        ]);
    }
}
