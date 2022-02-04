<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\ArticuloModel;
use App\Events\MedicoEventCasoExComent;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MedicoListenerCasoExComent
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    /**
     * Handle the event.
     *
     * @param  MedicoEventCasoExComent  $event
     * @return void
     */
    public function handle(MedicoEventCasoExComent $event)
    {
        //guardamos actividad
        $user=$event->data;
        
        $mytime=now(); 

        //colores random
        $color = array('info', 'success', 'maroon', 'warning', 'primary','teal','danger','secondary','gray','purple','orange','lime','olive');
        $count = count($color) - 1;
        $i = rand(0, $count);

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
        

        $detalle='';
        $idarticulo=null;



        if($user['tipo']=='save'){
            $caso_name= ArticuloModel::find($user['comentario']['idarticulo'])->titulo;
            $detalle=' ha comentado "'.$user['comentario']['comentario'].'"  en el caso  "'.$caso_name.'" ';
            $idarticulo=$user['comentario']['idarticulo'];
        }

        if($user['tipo']=='delete'){
            $caso_name= ArticuloModel::find($user['comentario']['idarticulo'])->titulo;
            $detalle=' ha Eliminado el comentario "'.$user['comentario']['comentario'].'" en el caso "'.$caso_name.'" ';
            $idarticulo=$user['comentario']['idarticulo'];
        }


        if($user['tipo']=='update'){

            if($user['objComentUpdate']!=null && $user['objComent']!=null ){
              
                $arra1=[
                    'comentario'=>$user['objComentUpdate']['comentario'],
                   
                ];
                
                $arra2=[
                    'comentario'=>$user['objComent']['comentario'],
                ];
                $caso_name= ArticuloModel::find($user['objComent']['idarticulo'])->titulo;
                $arrayResul=array_diff($arra1, $arra2);
                $detalle='ha  actualizado el comentario  "'.json_encode($arrayResul).'" en el caso "'.$caso_name.'"';
                $idarticulo=$user['objComent']['idarticulo'];
            }
            
           
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
                        'idarticulo'=>$idarticulo,
                        'idmedico'=>null,
                        'sub_actividad'=>0,
                        'idactividad_padre'=>$idactividad_padre,
                        'idsecciones_actividad'=>$seccionNavegacion,
                        'idtemas'=>null,
                        'idbiblioteca_virtual'=>null,
                        

                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);
    }
}
