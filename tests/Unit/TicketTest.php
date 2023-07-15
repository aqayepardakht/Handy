<?php

use Aqayepardakht\Ticket\Models\Ticket;
use Aqayepardakht\Ticket\Models\TicketMessage;
use Aqayepardakht\Ticket\Services\TicketRepository;
use Aqayepardakht\Ticket\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{
    protected function setUp(): void{

        parent::setUp();

    }

    public function testSaveTicket(){

        $ticketModel = $this->createMock(Ticket::class);
        $messageModel = $this->createMock(TicketMessage::class);
        $repository = new TicketRepository($ticketModel, $messageModel);

        $data = [
            'title' => 'Sample Ticket',
            'description' => 'This is a sample ticket.',
        ];

        $ticketModel->expects($this->once())
            ->method('create')
            ->with($data)
            ->willReturn($ticketModel);

        $result = $repository->saveTicket($data);
        $this->assertSame($repository, $result);
    }

    public function testCreateTicket(){
        
        $repository = $this->createMock(TicketRepository::class);

        $request = $this->createMock(Request::class);

        $validator = $this->createMock(Validator::class);

        $validator->expects($this->once())
            ->method('fails')
            ->willReturn(false);

        $request->expects($this->once())
            ->method('all')
            ->willReturn(['title' => 'Sample Ticket']);

        $repository->expects($this->once())
            ->method('saveTicket')
            ->with(['title' => 'Sample Ticket'])
            ->willReturn($repository);

        $service = new TicketService($repository);

        $result = $service->create($request);
        $this->assertSame($repository, $result);
    }

}