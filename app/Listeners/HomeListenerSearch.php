<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\Events\HomeEventSearch;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HomeListenerSearch
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    
    public function handle(HomeEventSearch $event)
    {
        //guardamos actividad
        $user=$event->data;
        
        $mytime=now();

        //colores random
        $color = array('info', 'success', 'maroon', 'warning', 'primary','teal','danger','secondary','gray','purple','orange','lime','olive');
        $count = count($color) - 1;
        $i = rand(0, $count);


        $tipo_s=$user['seccion'];
        $idactividad_padre=null;
        $seccionNavegacion=null;

        // verificamos a que seccion de la actividad va ha pertenecer

        $seccionNavegacionAnterior=SeccionActividadModel::where('tipo',$tipo_s)->first()->idsecciones_actividad;
        $seccionNavegacion=SeccionActividadModel::where('tipo','SEA')->first()->idsecciones_actividad;
          
        //Determinamos quien es el padre de esta seccion
        $idactividad_padre=Actividad_userModel::where('iduser',auth()->user()->id)
            ->where('sub_actividad',1)
            ->where('idsecciones_actividad',$seccionNavegacionAnterior)->get()->last()->idactividad_user;
         
         // if(isset($user['seccion']) ){
         //    dd($user['seccion']);
         //    $seccionNavegacionAnterior=SeccionActividadModel::where('tipo','G')->first()->idsecciones_actividad;
         // } 

        //se asigna nueva seccion 
        $tipo_s=session(['seccion_tipo'=>'SEA']);
      
       
        
        $dataRegistro=[
                        'descripcion'=>'Historial de busquedad',
                        'icon'=>'fas fa-search',
                        'color'=>$color[$i],
                        'tipo'=>11
                    ];
        $dataActividad=[
                       
                        'descripcion'=>auth()->user()->name.' Consulto " '.$user['txt_search'].' "  '.$mytime->toTimeString(),
                        'iduser'=>$user['iduser'],
                        'last_logged_at'=> null,
                        'last_login'=> null,
                        'idarticulo'=>null,
                        'idmedico'=>null,
                        'sub_actividad'=>1 ,
                        'idactividad_padre'=>$idactividad_padre,
                        'idsecciones_actividad'=>$seccionNavegacion,
                        'idtemas'=>null,
                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);
    }
}
