<?php

namespace App\Listeners;

use App\Events\SaveImgEvent;
use App\Http\Controllers\Registro_ActividadController;
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

    protected $prueba;

    public function __construct(Registro_ActividadController $prueba)
    {
        $this->prueba=$prueba;
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
         $result=$this->prueba->prueba($event);
        
         $prueba= new PruebaModel();
         $prueba->des='Evento '.$result;
         $prueba->save();
            // $url=\Storage::disk('diskDocumentosPerfilUser')->url($event->data['nombreDoc']);
            // $img= Storage::disk('diskDocumentosPerfilUser')->exists($event->data['nombreDoc']);
            //  // $exists= Storage::disk('diskDocumentosPerfilUser')->exists('FotoPerfil/'.$value);

            // $prueba= new PruebaModel();
            // $prueba->des=$event->data['nombreDoc'].' pasa '.$img.'url '.$url;
            // $prueba->save();

            // return $img;
                // if($img){
                //     $img= Storage::disk('diskDocumentosPerfilUser')->get($event->data['nombreDoc']);
                //     \Storage::disk('wasabi')->put($event->data['nombreDoc'], $img);

                //     $url=\Storage::disk('diskDocumentosPerfilUser')->url($event->data['nombreDoc']);
                //     $prueba= new PruebaModel();
                //     $prueba->des=$url;
                //     $prueba->save();
                // }

           //  $prueba= new PruebaModel();
           //  $prueba->des=$event->data['nombreDoc'].' error =>'.$img;
           // return $prueba->save();

            // logger("Guardar img".$event->data['nombreDoc']." se ha registrado");
       // } catch (\Throwable $th) {
            
       //      $prueba= new PruebaModel();
       //      $prueba->des=$event->data['nombreDoc'].' error =>'.$th->getMessage();
       //      $prueba->save();

       //      logger($th->getMessage()."  no se ha registrado  ".$event->data['nombreDoc']);
       // }
      
        
    }
}
