<?php

namespace Aqayepardakht\Handy\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Aqayepardakht\Handy\Address\Province;

class City extends Model {
    use HasFactory;


    public function province() {
        $this->hasOne(Province::class, 'id', 'province_id');
    }
}
