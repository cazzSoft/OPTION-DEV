<?php

namespace App\Listeners;

use App\Events\MedicoEventPublicacionesHabilitar;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MedicoListenerPublicacionesHabilitar
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MedicoEventPublicacionesHabilitar  $event
     * @return void
     */
    public function handle(MedicoEventPublicacionesHabilitar $event)
    {
        //
    }
}
