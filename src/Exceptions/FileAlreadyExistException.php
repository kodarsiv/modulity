<?php

namespace Kodarsiv\Modulity\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class FileAlreadyExistException extends Exception
{
    public function __construct(string $fileName, int $code = 0, ?Throwable $previous = null)
    {
        $message = $fileName." Already Exists!";
        parent::__construct($message, $code, $previous);
        Log::warning($message);
    }
}
