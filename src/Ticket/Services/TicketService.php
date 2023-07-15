<?php

namespace Aqayepardakht\Handy\Ticket\Services;

use DB;
use Aqayepardakht\Handy\Ticket\Models\Ticket;
use Aqayepardakht\Handy\Ticket\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Aqayepardakht\Handy\Ticket\Services\TicketRepository;
use Aqayepardakht\Handy\Ticket\Exceptions\TicketClosedException;
use Aqayepardakht\Handy\Ticket\Exceptions\TicketNotFoundException;
use Aqayepardakht\Handy\Ticket\Exceptions\TicketFaildValidationException;


class TicketService {

    protected   $data;

    public function __construct(public TicketRepository $repository) {}
    
    protected function validateStoreData(Request $request) {

        $rules = config('validateticketdata.ticket.store');
        return $this->validateData($request, $rules);
    }

    protected function validateMessageData(Request $request) {

        $rules = config('validateticketdata.ticket.message');
        return $this->validateData($request, $rules);
    }

    protected function validateData(Request $request, array $rules) {
        
        $ip   = $request->ip();
        $data = $request->all();
        
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) throw new TicketFaildValidationException($validator);
        
        $data['ip'] = $ip;
        
        $this->data = $data;
        
    }

    protected function prepareData(array $fields) {

        return \Arr::only($this->data, $fields);
    }
    
    protected function prepareTicketData() {

        $configFields = config('validateticketdata.ticket_fields');
        $fields = array_keys($configFields);
        return $this->prepareData($fields);
    }

    protected function prepareMessageData() {

        $configFields = config('validateticketdata.ticket_mesage_fields');
        $fields = array_keys($configFields);
        $messageData = $this->prepareData($fields);

        $messageData['user_id'] = Auth::id();
        $messageData['ip'] = $this->data['ip'];
        $messageData['file'] = isset($messageData['file']) ? $this->fileUpload($messageData['file'], 'public/tickets/documents') : null;

        return $messageData;
    }

    public function create(Request $request) {

        DB::beginTransaction();
        try {

            $this->validateStoreData($request);

            $ticketData = array_merge($this->prepareTicketData(), [
                'status'    => 'waiting',
                'user_id'   => Auth::id(),
                'opts'      => '',
            ]);
    
            $ticketMessageData = $this->prepareMessageData();

            $saveResult = $this->repository->saveTicket($ticketData)
                                            ->saveMessage($ticketMessageData);

            DB::commit();
            return $saveResult;
        } catch (TicketFaildValidationException $exception) {
            throw $exception;
        }
        catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function reply(Request $request , $ticketId) {

        try {
            $response = ($this->repository->getTicketById($ticketId));

            if ($response->ticketModel->status == "closed") throw new TicketClosedException();
           
            $this->validateMessageData($request);
            $messageData = $this->prepareMessageData();
            
            $status = 'answered';
            $saveMessage = $response->saveMessage($messageData);
            $updateStatus = $saveMessage->updateTicketStatus($status);
             
            $response = $saveMessage->ticketModel->ticketMessage()->latest('id' , 'desc')->first();
            return $response;

        } catch (TicketNotFoundException $exception) {
            throw new TicketNotFoundException();
        } 
        catch (\Exception $exception) {
            throw $exception;
        }

    }

    public function fileUpload($files, $path){

        $uploadedFiles = [];
        if ($files instanceof \Illuminate\Http\UploadedFile) {
            $name = rand(0, time()) . '.' . $files->getClientOriginalExtension();
            $files->storeAs($path, $name);
            return $uploadedFiles = $name;
        }

        return json_encode($uploadedFiles);
    
    }
    
}