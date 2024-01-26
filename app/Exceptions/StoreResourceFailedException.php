<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class StoreResourceFailedException extends Exception
{
    protected $code = 1234;
    public function report()
    {
        Log::error($this->getMessage());
    }
}
