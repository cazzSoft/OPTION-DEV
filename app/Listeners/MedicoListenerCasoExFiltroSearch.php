<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\Events\MedicoEventCasoExFiltroSearch;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MedicoListenerCasoExFiltroSearch
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    /**
     * Handle the event.
     *
     * @param  MedicoEventCasoExFiltroSearch  $event
     * @return void
     */
    public function handle(MedicoEventCasoExFiltroSearch $event)
    {
         //guardamos actividad
        $user=$event->data;
        
        $mytime=now();

        //colores random
        $color = array('info', 'success', 'maroon', 'warning', 'primary','teal','danger','secondary','gray','purple','orange','lime','olive');
        $count = count($color) - 1;
        $i = rand(0, $count);


        $tipo_s=session()->get('seccion_tipo');
        $idactividad_padre=null;
        $seccionNavegacion=null;

        //se busca el id de la seccion tipo navegación 
        $seccionNavegacion=SeccionActividadModel::where('tipo', $user['seccion'])->first()->idsecciones_actividad;
        // $lastSeccion=$tipo_s;
        // session(['seccion_tipo'=>$user['seccion']]);
        // $tipo_s=session()->get('seccion_tipo');
       

        //se obtiene el ultimo registro para obtener el  idactividad_padre
        // $actividadConsul=Actividad_userModel::where('iduser',auth()->user()->id)
        //     ->where('sub_actividad',1)
        //     ->where('idsecciones_actividad',$seccionNavegacion)->get()->last();
        // $idactividad_padre= $actividadConsul->idactividad_user;
         
        $seccionNavegacion=SeccionActividadModel::where('tipo', $tipo_s)->first()->idsecciones_actividad; 
         
        $detalle='';

        if($user['tipo']=='search'){
            //obtenemos el nombre de la especialidad
            $detalle='ha buscado "'.$user['nameFiltro'].'" en los casos excepcionales';
            $sub_a =1;
            // session(['seccion_tipo'=>$lastSeccion]);
        }

        if($user['tipo']=='filtro'){
           
            $detalle='ha filtrado los Casos por "'.$user['nameFiltro'].'" ';
            $sub_a =1;
            // session(['seccion_tipo'=>'SEA']);
        }

        $dataRegistro=[
                        'descripcion'=>'Casos excepcionales',
                        'icon'=>'fas fa-hand-holding-heart',
                        'color'=>$color[$i],
                        'tipo'=>18
                       ];
        $dataActividad=[
                        'descripcion'=>auth()->user()->name.''.$detalle.' '.$mytime->toTimeString(),
                        'iduser'=>$user['iduser'],
                        'last_logged_at'=> null,
                        'last_login'=> null,
                        'idarticulo'=>null,
                        'idmedico'=>null,
                        'sub_actividad'=>$sub_a,
                        'idactividad_padre'=>$idactividad_padre,
                        'idsecciones_actividad'=>$seccionNavegacion,
                        'idtemas'=>null,
                        'idbiblioteca_virtual'=>null,
                        

                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);
    }
}
