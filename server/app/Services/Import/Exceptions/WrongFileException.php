<?php

namespace App\Services\Import\Exceptions;

use Exception;

class WrongFileException extends Exception
{
    protected $message = 'The file is wrong';
}
