<?php

namespace Aqayepardakht\Handy\Ticket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }

   
}
