<?php 

namespace Aqayepardakht\Handy\Wallet\Exceptions;

use Exception;

class InvalidInvoiceException extends Exception
{
    protected $message = 'Invalid invoice.';
}