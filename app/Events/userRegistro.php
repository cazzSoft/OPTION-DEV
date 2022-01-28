<?php

namespace App\Events;  

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class userRegistro
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    
    public $user;

    public function __construct($user)
    {
        $this->user=$user;
    }

    //este eveto solo sirve como contenedor todas las acciones las hacen los listener???

}
