<?php

namespace App\Listeners;

use App\Events\SaveImgEvent;
use App\PruebaModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Storage;


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
        
        
       // try {
          
            $img= Storage::disk('diskDocumentosPerfilUser')->exists('FotoPerfil/00315_20220www427_06_08.png');
             // $exists= Storage::disk('diskDocumentosPerfilUser')->exists('FotoPerfil/'.$value);

            $prueba= new PruebaModel();
            $prueba->des=$event->data['nombreDoc'].' pasa '.$img;
            $prueba->save();

            return $img;
                // if($img){
                //     $img= Storage::disk('diskDocumentosPerfilUser')->get($event->data['nombreDoc']);
                //     \Storage::disk('wasabi')->put($event->data['nombreDoc'], $img);

                //     $url=\Storage::disk('diskDocumentosPerfilUser')->url($event->data['nombreDoc']);
                //     $prueba= new PruebaModel();
                //     $prueba->des=$url;
                //     $prueba->save();
                // }

            $prueba= new PruebaModel();
            $prueba->des=$event->data['nombreDoc'].' error =>'.$img;
           return $prueba->save();

            logger("Guardar img".$event->data['nombreDoc']." se ha registrado");
       // } catch (\Throwable $th) {
            
       //      $prueba= new PruebaModel();
       //      $prueba->des=$event->data['nombreDoc'].' error =>'.$th->getMessage();
       //      $prueba->save();

       //      logger($th->getMessage()."  no se ha registrado  ".$event->data['nombreDoc']);
       // }
      
        
    }
}
