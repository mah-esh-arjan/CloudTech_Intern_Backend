<?php

namespace App\Jobs;

use App\Mail\RegisterSuccess;
use App\Models\Student;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendRegisterEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $student;


    public function __construct(Student $student)
    {
     $this->student = $student;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        Mail::to('mah.dot98@gmail.com')->send(
            new RegisterSuccess($this->student)
        );
    }
}
