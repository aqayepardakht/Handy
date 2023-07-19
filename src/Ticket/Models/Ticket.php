<?php

namespace Aqayepardakht\Handy\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function ticketMessage() {
        return $this->hasMany(TicketMessage::class , 'ticket_id' , 'id');
    }

    public function users() {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
