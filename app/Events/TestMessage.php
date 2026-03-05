<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestMessage implements ShouldBroadcast   // ✅ Must implement ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
        \Log::info('TestMessage event created with message: ' . $message);
    }

    // ✅ The channel to broadcast on
    public function broadcastOn(): Channel
    {
        \Log::info('Broadcasting on channel: chat');
        return new Channel('chat');
    }

    // Optional: custom event name in JS
    public function broadcastAs(): string
    {
        \Log::info('Broadcasting as: TestMessage');
        return 'TestMessage';
    }
    
    // Add this to see what data is being sent
    public function broadcastWith(): array
    {
        \Log::info('Broadcasting with data: ' . json_encode(['message' => $this->message]));
        return ['message' => $this->message];
    }
}
