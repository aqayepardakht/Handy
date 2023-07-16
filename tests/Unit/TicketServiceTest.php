<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Request;
use Aqayepardakht\Ticket\Models\Ticket;
use Aqayepardakht\Ticket\TicketService;
use Illuminate\Foundation\Testing\WithFaker;
use Aqayepardakht\Ticket\Models\TicketMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Aqayepardakht\Ticket\Repositories\TicketRepository;
use Aqayepardakht\Ticket\Exceptions\TicketClosedException;
use Aqayepardakht\Ticket\Exceptions\TicketNotFoundException;
use Aqayepardakht\Ticket\Exceptions\TicketFaildValidationException;

class TicketServiceTest extends TestCase
{
    //use RefreshDatabase;

    protected $ticketService;
    protected $ticketRepository;

    protected function setUp(): void {

        parent::setUp();

        $this->ticketRepository = new TicketRepository(new Ticket(), new TicketMessage());
        $this->ticketService = new TicketService($this->ticketRepository);
    }

    public function testCreateTicket() {

        $request = new Request([
            'title' => 'موضوع تیکت',
            'department' => 'financial',
            'priority' => 'high',
        ]);

        $response = $this->ticketService->create($request);
        $this->assertInstanceOf(TicketRepository::class, $response);
    }

      public function testReplyToTicket() {

        $request = new Request([
            'text' => 'موضوع تیکت',
            'parent_id' => 8
        ]);
        $ticketId = 2;

        $response = $this->ticketService->reply($request, $ticketId);

        $this->assertInstanceOf(TicketMessage::class, $response);
    }

    public function testReplyToClosedTicket() {

         $request = new Request([
            'text' => 'موضوع تیکت',
            'parent_id' => 8
        ]);

        $ticketId = 2;

        $this->expectException(TicketClosedException::class);
        $this->ticketService->reply($request, $ticketId);    
    }

    public function testReplyToNonExistingTicket() {

        $request = new Request([
            'text' => 'موضوع تیکت',
            'parent_id' => 8
        ]);

        $ticketId = 12;

        $this->expectException(TicketNotFoundException::class);
        $this->ticketService->reply($request, $ticketId);
    }

    public function testUpdateTicketStatus() {

        $newStatus = 'closed';
        $ticket_id = 3;

        $response = $this->ticketRepository->getTicketById($ticket_id)->updateTicketStatus($newStatus);

        $this->assertTrue($response);
    }

    public function testUpdateTicketSatisfaction() {

        $satisfaction = 'happy';
        $ticket_id = 3;

        $response = $this->ticketRepository->getTicketById($ticket_id)->updateTicketSatisfaction($satisfaction);

        $this->assertTrue($response);
    }

    public function testGetTicketByIdWithNonExistingTicket() {

        $id = 12;

        $this->expectException(TicketNotFoundException::class);
        $this->ticketRepository->getTicketById($id);
    }

    public function testGetTickets() {

        $user = User::findOrFail(1); 
        $perPage = 10;

        $response = $this->ticketRepository->getTickets($user, $perPage);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $response);
    }

}