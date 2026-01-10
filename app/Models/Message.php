<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = "message";
    protected $primaryKey = "id";

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content'
    ];

    public function sender()
    {
        return $this->belongsTo(Student::class, 'sender_id', 'student_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Student::class, 'receiver_id', 'student_id');
    }


}
