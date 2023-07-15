<?php

namespace Aqayepardakht\Handy\Ticket\Services;

use Aqayepardakht\Handy\Ticket\Models\Ticket;
use Aqayepardakht\Handy\Ticket\Models\TicketMessage;
use Aqayepardakht\Handy\Ticket\Exceptions\TicketNotFoundException;

class TicketRepository {

    public function __construct(public Ticket $ticketModel , public TicketMessage $messageModel) {}

    public function saveTicket(array $data) {

        $this->ticketModel = $this->ticketModel->create($data);
        return $this;
    }

    public function saveMessage(array $data) {

        $this->ticketModel->ticketMessage()->create($data); 
        return $this;   
    }

    public function updateTicketStatus ($newStatus) {

        $this->ticketModel->status = $newStatus;
        $this->ticketModel->save();

        return true;
    }

    public function updateTicketSatisfaction ($satisfaction) {

        $this->ticketModel->satisfaction = $satisfaction;
        $this->ticketModel->save();

        return true;
    }
    
    public function getTicketById($id) {

        $ticket = $this->ticketModel->find($id);
        if (!$ticket) throw new TicketNotFoundException();
        
        $this->ticketModel = $ticket;
        return $this;
    }

    public function getTickets(User $user = null , $perPage = null) {

       $user = $user ?? \Auth::user();
       $query = $user->tickets();
       return $this->paginateTickets($query , $perPage);
    }

    public function paginateTickets($query , $perPage = null) {

        return $query->paginate($perPage);
    }


}