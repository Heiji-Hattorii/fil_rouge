<?php

// App/Events/Chat.php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Log;

class Chat implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;
    public $user;
    public $room_id;
    public $timestamp;
    public $action; 
    public $user_id;


    public function __construct($data)
    {
        Log::info($data);
        $this->message = $data['message']; 
        $this->user = $data['user']; 
        $this->room_id = $data['room_id'];
        $this->user_id = $data['user_id'];
        $this->timestamp = $data['timestamp']; 
    }

    public function broadcastOn()
    {
        return new Channel('my-channel');
    }

    public function broadcastAs()
    {
        return 'chatEvent';
    }

}

