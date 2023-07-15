<?php

namespace Aqayepardakht\Handy\Ticket\Exceptions;

use Exception;

class TicketNotFoundException extends Exception
{
    public function __construct($message = "This ticket not found.")
    {
        parent::__construct($message);
    }
}