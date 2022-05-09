<?php

namespace App\Listeners;

use App\Events\SaveImgEvent;
use App\Http\Controllers\Registro_ActividadController;
use App\PruebaModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Storage;


class SaveImgListener 
{
    /** implements ShouldQueue
     * Create the event listener.
     * implements ShouldQueue
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
        
        
       try {
       
        //  $result=$this->prueba->prueba($event->data['nombreDoc']);
        // return $result;
          
            $img= Storage::disk('diskDocumentosPerfilUser')->exists($event->data['nombreDoc']);
           
                if($img){
                    $img= Storage::disk('diskDocumentosPerfilUser')->get($event->data['nombreDoc']);
                    \Storage::disk('wasabi')->put($event->data['nombreDoc'], $img);
                    // $prueba= new PruebaModel();
                    // $prueba->des=$event->data['nombreDoc'];
                    // $prueba->save();
                }

       } catch (\Throwable $th) {
            
            // $prueba= new PruebaModel();
            // $prueba->des=$event->data['nombreDoc'].' error =>'.$th->getMessage();
            // $prueba->save();

            logger($th->getMessage()."  no se ha registrado  ".$event->data['nombreDoc']);
       }
      
        
    }
}
