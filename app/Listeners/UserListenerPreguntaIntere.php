<?php

namespace App\Listeners;

use App\Events\UserEventPreguntaIntere;
use App\Http\Controllers\Registro_ActividadController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;

class UserListenerPreguntaIntere
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    /**
     * Handle the event.
     *
     * @param  UserEventPreguntaIntere  $event
     * @return void
     */
    public function handle(UserEventPreguntaIntere $event)
    {
        //guardamos actividad
        $user=$event->data;
        $mytime = now();
       

         //colores random
        $color = array('info', 'success', 'maroon', 'warning', 'primary','teal','danger','secondary','gray','purple','orange','lime','olive');
        $count = count($color) - 1;
        $i = rand(0, $count);
       
        
        
        $dataRegistro=[
                        'descripcion'=>'Preguta de interés',
                        'icon'=>'far fa-newspaper',
                        'color'=>'success',
                        'tipo'=>13
                    ];
        $dataActividad=[
                        'descripcion'=>auth()->user()->name.' '.$user['descripcion'].' '.$mytime->toTimeString(),
                        'iduser'=>$user['iduser'],
                        'last_logged_at'=> null,
                        'last_login'=> null,
                        'idarticulo'=>null,
                        'idmedico'=>null,
                        'sub_actividad'=>0,
                        'idtemas'=>$user['idtemas'],
                        'idactividad_padre'=>null,
                        'idsecciones_actividad'=>null,

                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);
    }
}
