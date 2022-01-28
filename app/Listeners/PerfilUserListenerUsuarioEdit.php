<?php

namespace App\Listeners;

use App\Events\PerfilUserEventUsuarioEdit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PerfilUserListenerUsuarioEdit
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
     * @param  PerfilUserEventUsuarioEdit  $event
     * @return void
     */
    public function handle(PerfilUserEventUsuarioEdit $event)
    {
        //
    }
}
