<?php 

namespace Aqayepardakht\Handy\Wallet\Exceptions;

use Exception;

class WalletNotFoundException extends Exception
{
    protected $message = 'Wallet not found.';
}