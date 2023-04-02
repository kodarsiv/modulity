<?php

namespace Kodarsiv\Modulity\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class ModuleAlreadyExistException extends Exception
{
    public function __construct(string $moduleName, int $code = 0, ?Throwable $previous = null)
    {
        $message = $moduleName." Already Exists!";
        parent::__construct($message, $code, $previous);
        Log::warning($message);
    }
}
