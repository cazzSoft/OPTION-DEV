<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\Events\HomeEventLike;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HomeListenerLike
{
    
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    public function handle(HomeEventLike $event)
    {
        //guardamos actividad
        $user=$event->data;
        
        $mytime=now(); 

        //colores random
        $color = array('info', 'success', 'maroon', 'warning', 'primary','teal','danger','secondary','gray','purple','orange','lime','olive');
        $count = count($color) - 1;
        $i = rand(0, $count);

        // verificamos a que seccion de la actividad va ha pertenecer
        $tipo_s=$user['tipo_S'];
        $idactividad_padre=null;
        $seccionNavegacion=null;

        
        //se busca el id de la seccion tipo navegación 
        $seccionNavegacion=SeccionActividadModel::where('tipo',$tipo_s)->first()->idsecciones_actividad;

        //se obtiene el ultimo registro del tipo de seccion idactividad_user
        $idactividad_padre=Actividad_userModel::where('iduser',auth()->user()->id)
            ->where('sub_actividad',1)
            ->where('idsecciones_actividad',$seccionNavegacion)->get()->last()->idactividad_user;
        
        $dataRegistro=[
                        'descripcion'=>'Artículos que le gustan',
                        'icon'=>'fas fa-first-aid',
                        'color'=>$color[$i],
                        'tipo'=>5
                    ];
        $dataActividad=[
                        'descripcion'=>auth()->user()->name.' '.$user['descripcion'].' '.$mytime->toTimeString(),
                        'iduser'=>$user['iduser'],
                        'last_logged_at'=> null,
                        'last_login'=> null,
                        'idarticulo'=>$user['idarticulo'],
                        'idmedico'=>null,
                        'sub_actividad'=>0,
                        'idactividad_padre'=>$idactividad_padre,
                        'idsecciones_actividad'=>$seccionNavegacion,
                        'idtemas'=>null,

                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);

       

    }
}
