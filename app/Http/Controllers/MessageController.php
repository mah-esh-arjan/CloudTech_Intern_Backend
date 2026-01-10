<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function send(Request $request)
    {
        $data = $request->validate([
            'sender_id' => 'required|exists:student,student_id',
            'receiver_id' => 'required|exists:student,student_id',
            'content' => 'required|string'
        ]);

        return Message::create($data);

    }

    public function conversation($student_id)
    {
        $sentMessages = Message::where('sender_id', $student_id)
            ->get();

        $receivedMessages = Message::where('receiver_id', $student_id)
            ->get();

        $messages = $sentMessages->merge($receivedMessages)->orderBy('created_at');

        return $messages;
    }

}
