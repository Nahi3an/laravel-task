<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class DeleteResourceFailedException extends Exception
{
    public function report()
    {
        Log::error($this->getMessage());
    }
}
