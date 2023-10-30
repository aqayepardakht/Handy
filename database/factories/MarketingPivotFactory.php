<?php

namespace Aqayepardakht\Handy\Database\Factories;

use Illuminate\Support\Str;
use Aqayepardakht\Handy\Models\MarketingPivot;
use Illuminate\Database\Eloquent\Factories\Factory;


class MarketingPivotFactory extends Factory
{

    protected $model = MarketingPivot::class;

    public function definition()
    {
        return [
            'owner_id'        => 1,
            'marketable_id'   => 1,
            'marketable_type' => 'App\\Models\\User',
        ];
    }

}
