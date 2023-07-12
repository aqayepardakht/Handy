<?php

namespace Aqayepardakht\Handy\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Aqayepardakht\Handy\Address\City;

class Province extends Model {
    use HasFactory;

    public function cities() {
        return $this->hasMany(City::class, 'province_id');
    }
}
