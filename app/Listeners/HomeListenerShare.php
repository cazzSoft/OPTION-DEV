<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\ArticuloModel;
use App\Events\HomeEventShare;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HomeListenerShare
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }


    public function handle(HomeEventShare $event)
    {
        //guardamos actividad
        $user=$event->data;
        
        $mytime=now();

        //colores random
        $color = array('info', 'success', 'maroon', 'warning', 'primary','teal','danger','secondary','gray','purple','orange','lime','olive');
        $count = count($color) - 1;
        $i = rand(0, $count);
            
        $articuloName=ArticuloModel::find($user['idarticulo']);
        if($articuloName){
            $articuloName=$articuloName->titulo;
        }else{
            $articuloName=null;
        }
       
        // verificamos a que seccion de la actividad va ha pertenecer
        $tipo_s=session()->get('seccion_tipo');
        $idactividad_padre=null;
        $seccionNavegacion=null;

        
        //se busca el id de la seccion tipo navegación 
        $seccionNavegacion=SeccionActividadModel::where('tipo',$tipo_s)->first()->idsecciones_actividad;

        //se obtiene el ultimo registro del tipo de seccion idactividad_user
        $idactividad_padre=Actividad_userModel::where('iduser',auth()->user()->id)
            ->where('sub_actividad',1)
            ->where('idsecciones_actividad',$seccionNavegacion)->get()->last()->idactividad_user;
        

        $dataRegistro=[
                        'descripcion'=>'Artículos compartidos',
                        'icon'=>'fas fa-share-alt',
                        'color'=>$color[$i],
                        'tipo'=>6
                    ];
        $dataActividad=[
                       
                        'descripcion'=>auth()->user()->name.' Compartio el Artículo "'.$articuloName.'"  '.$user['share'].' '.$mytime->toTimeString(),
                        'iduser'=>$user['iduser'],
                        'last_logged_at'=> null,
                        'last_login'=> null,
                        'idarticulo'=>$user['idarticulo'],
                        'idmedico'=>null,
                        'sub_actividad'=>0,
                        'idactividad_padre'=> $idactividad_padre,
                        'idsecciones_actividad'=>$seccionNavegacion,
                        'idtemas'=>null,
                        'idbiblioteca_virtual'=>null,
                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);
    }
}
