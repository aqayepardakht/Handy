<?php 

namespace Aqayepardakht\Handy\Wallet\Exceptions;

use Exception;

class InvoiceNotFoundException extends Exception
{
    protected $message = 'Invoice not found.';
}