<?php

namespace Aqayepardakht\Handy\Ticket\Exceptions;

use Exception;

class TicketClosedException extends Exception
{
    public function __construct($message = "This ticket is closed.")
    {
        parent::__construct($message);
    }
}