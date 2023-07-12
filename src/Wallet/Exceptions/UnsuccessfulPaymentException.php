<?php 

namespace Aqayepardakht\Handy\Wallet\Exceptions;

use Exception;

class UnsuccessfulPaymentException extends Exception
{
    protected $message = 'Unsuccessful payment.';
}