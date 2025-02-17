<?php

namespace App\Services;

use App\Contracts\Logger;
use App\Models\DatabaseLog;

class DatabaseLogger implements Logger{

public function log(){
    $message = 'Logging into the database log';
    
    DatabaseLog::create([
        'message' => $message
    ]);

}

}
