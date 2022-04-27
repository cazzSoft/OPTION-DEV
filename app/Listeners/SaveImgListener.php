<?php

namespace App\Listeners;

use App\Events\SaveImgEvent;
use App\PruebaModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;


class SaveImgListener implements ShouldQueue
{
    /** implements ShouldQueue
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
     * @param  SaveImgEvent  $event
     * @return void
     */
    public function handle(SaveImgEvent $event)
    {
        $prueba= new PruebaModel();
        $prueba->des=$event->data['nombreDoc'];
        $prueba->save();
        
       try {
          
            $img=\Storage::disk('diskDocumentosPerfilUser')->exists($event->data['nombreDoc']);
                if($img){
                    $img=\Storage::disk('diskDocumentosPerfilUser')->get($event->data['nombreDoc']);
                    \Storage::disk('wasabi')->put($event->data['nombreDoc'], $img);

                    $url=\Storage::disk('diskDocumentosPerfilUser')->url($event->data['nombreDoc']);
                    $prueba= new PruebaModel();
                    $prueba->des=$url;
                    $prueba->save();
                }
            logger("Guardar img".$event->data['nombreDoc']." se ha registrado");
       } catch (\Throwable $th) {
            
            $prueba= new PruebaModel();
            $prueba->des=$event->data['nombreDoc'].' error =>'.$th->getMessage();
            $prueba->save();

            logger($th->getMessage()."  no se ha registrado  ".$event->data['nombreDoc']);
       }
      
        
    }
}
