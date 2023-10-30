<?php

namespace Aqayepardakht\Handy\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarketingPivot extends Model {

    use HasFactory;
    public $timestamps = false;
   
    protected $table    = 'marketing_pivot';
    protected $fillable = [
       'owner_id',
       'marketable_id',
       'marketable_type'
    ];

}
