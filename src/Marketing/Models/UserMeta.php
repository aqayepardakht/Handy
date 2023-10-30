<?php

namespace Aqayepardakht\Handy\Models;

use Aqayepardakht\Handy\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMeta extends Model {
    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'father',
        'birth',
        'home_phone',
        'national',
        'passport',
        'referral',
        'telegram_id',
        'email',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
