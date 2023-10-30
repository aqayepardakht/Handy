<?php

namespace Aqayepardakht\Handy\Gateway;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Aqayepardakht\Handy\Marketing\Contracts\Referralable;
use Illuminate\Database\Eloquent\Factories\Factory;

class Gateway extends Model implements Referralable {
    use HasFactory;

    protected $guarded = ['id'];

    public function getUserId(): int {
        
        return $this->user_id;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

     /**
     * Create a new factory instance for the model.
    */
    protected static function newFactory(): Factory
    {
        return \Aqayepardakht\Handy\Database\Factories\GatewayFactory::new();
    }
}
