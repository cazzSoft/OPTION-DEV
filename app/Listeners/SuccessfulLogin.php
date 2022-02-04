<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\Registro_ActividadController;

class SuccessfulLogin 
{
    protected $actividad;
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //se restaura la varible de session 
        session()->regenerate();
        session(['seccion_tipo' => 'INI']); 

        //guardamos actividad
        $user=$event->user;
        $mytime = now();
        $mytime=Carbon::parse($mytime);

         //colores random
        $color = array('info', 'success', 'maroon', 'warning', 'primary','teal','danger','secondary','gray','purple','orange','lime','olive');
        $count = count($color) - 1;
        $i = rand(0, $count);

        $dataRegistro=[
                        'descripcion'=>'Inicio de Sessión del usuario',
                        'icon'=>'far fa-newspaper',
                        'color'=>$color[$i],
                        'tipo'=>1
                    ];
        $dataActividad=[
                        'idregistro_actividad'=>1,
                        'descripcion'=>$user->name.' inicío Sessión '.$mytime->toTimeString(),
                        'iduser'=>$user->id,
                        'last_login'=>new \DateTime(),
                        'last_logged_at'=> null,
                        'idarticulo'=>null,
                        'idmedico'=>null,
                        'sub_actividad'=>0,
                        'idactividad_padre'=>null,
                        'idsecciones_actividad'=>null,
                        'idtemas'=>null,
                        'idbiblioteca_virtual'=>null,

                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);
        $event->user->last_login = new \DateTime();
        $event->user->online = 1;
        $event->user->save();

       
    }
}
