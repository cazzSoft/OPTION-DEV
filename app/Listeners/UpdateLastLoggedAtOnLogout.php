<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use App\Http\Controllers\Registro_ActividadController;

class UpdateLastLoggedAtOnLogout
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        //guardamos actividad
        $user=$event->user;
       
        $mytime=now();
        
        $dataRegistro=[
                        'descripcion'=>'Cierre de Sessión del usuario',
                        'icon'=>'far fa-newspaper',
                        'color'=>'success',
                        'tipo'=>20
                    ];
        $dataActividad=[
                        'idregistro_actividad'=>20,
                        'descripcion'=>$user->name.' Cerro Sessión '.$mytime->toTimeString(),
                        'iduser'=>$user->id,
                        'last_logged_at'=> new \DateTime(),
                        'last_login'=> null,
                        'idarticulo'=>null,
                        'idmedico'=>null,
                        'sub_actividad'=>null,
                        'idactividad_padre'=>null,
                        'idsecciones_actividad'=>null,
                        'idtemas'=>null,
                        'idbiblioteca_virtual'=>null,

                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);

        // para que no se actualice la columna "updated_at"
        $event->user->timestamps  = false;
        $event->user->last_logged_at = new \DateTime();
        $event->user->online = 0;
        $event->user->save();
        session()->forget('seccion_tipo'); //destruimos la variable de la session
    }
}
