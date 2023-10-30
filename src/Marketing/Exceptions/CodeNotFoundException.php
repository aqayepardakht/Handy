<?php

namespace Aqayepardakht\Handy\Marketing\Exceptions;

use Exception;

class CodeNotFoundException extends Exception {
    
    public function __construct($message = "This code not found." )
    {
        parent::__construct($message);
    }
}