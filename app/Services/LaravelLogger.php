<?php

namespace App\Services;

use App\Contracts\Logger;
use Illuminate\Support\Facades\Log;

class LaravelLogger implements Logger
{

    public function log()
    {
        return Log::info("Logging into the laravel logs");
    }
};
