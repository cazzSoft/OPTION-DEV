<?php

namespace App\Listeners;

use App\Events\SearchEventResul;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SearchListenerResul
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
     * @param  SearchEventResul  $event
     * @return void
     */
    public function handle(SearchEventResul $event)
    {
        //
    }
}
