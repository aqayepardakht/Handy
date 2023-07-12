<?php 

namespace Aqayepardakht\Handy\Wallet\Exceptions;

use Exception;

class InvalidRequestException extends Exception
{
    protected $message = 'Invalid request.';
}