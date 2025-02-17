<?php

namespace App\Http\Controllers;

use App\Contracts\Logger;
use Illuminate\Http\Request;

class DependencyController extends Controller
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function logging()
    {

        return $this->logger->log();
    }
}
