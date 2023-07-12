<?php 

namespace Aqayepardakht\Handy\Wallet\Exceptions;

use Exception;

class InsufficientBalanceException extends Exception
{
    protected $message = 'Insufficient balance.';
}