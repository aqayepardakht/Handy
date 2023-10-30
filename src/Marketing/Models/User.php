<?php

namespace Aqayepardakht\Handy\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\Factory;

class User extends Authenticatable implements Referralable {

    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function meta() {
        return $this->hasOne(UserMeta::class);
    }

    public function getUserId(): int {
        
        return $this->id;
    }

     /**
     * Create a new factory instance for the model.
    */
    protected static function newFactory(): Factory
    {
        return \Aqayepardakht\Handy\Database\Factories\UserFactory::new();
    }
}