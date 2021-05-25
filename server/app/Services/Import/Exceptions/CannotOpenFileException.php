<?php

namespace App\Services\Import\Exceptions;

use Exception;

class CannotOpenFileException extends Exception
{
    protected $message = 'Cannot open the file';
}
