<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\Events\MedicoEventCasoEx;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MedicoListenerCasoEx
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    /**
     * Handle the event.
     *
     * @param  MedicoEventCasoEx  $event
     * @return void
     */
    public function handle(MedicoEventCasoEx $event)
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
        $sub_actividad=0;
        $idarticulo=null;
        if($user['tipo']=='save'){
            $detalle=' ha registrado un caso excepcional "'.$user['caso']['titulo'].'" ';
            $idarticulo=$user['caso']['idarticulo'];
        }

        if($user['tipo']=='edit'){

            $detalle='ha dado clic en el Icono  " Editar caso" '.$user['caso']['titulo'];
            $idarticulo=$user['caso']['idarticulo'];
        }

        if($user['tipo']=='update'){

            if($user['objCasoUpdate']!=null && $user['objCaso']!=null ){
              
                $arra1=[
                    'descripcion'=>$user['objCasoUpdate']['descripcion'],
                    'titulo'=>$user['objCasoUpdate']['titulo'],
                    'url_video'=>$user['objCasoUpdate']['url_video'],
                    'afecta_desc'=>$user['objCasoUpdate']['afecta_desc'],
                   
                    'edad_inicial'=>$user['objCasoUpdate']['edad_inicial'],
                    'edad_final'=>$user['objCasoUpdate']['edad_final'],
                    'sintoma'=>$user['objCasoUpdate']['sintoma'],
                    'causas'=>$user['objCasoUpdate']['causas'],
                    'tratamiento'=>$user['objCasoUpdate']['tratamiento'],
                    'diagnostico'=>$user['objCasoUpdate']['diagnostico'],
                    'medico_visitado'=>$user['objCasoUpdate']['medico_visitado'],
                ];
                
                $arra2=[
                    'descripcion'=>$user['objCaso']['descripcion'],
                    'titulo'=>$user['objCaso']['titulo'],
                    'url_video'=>$user['objCaso']['url_video'],
                    'afecta_desc'=>$user['objCaso']['afecta_desc'],
                   
                    'edad_inicial'=>$user['objCaso']['edad_inicial'],
                    'edad_final'=>$user['objCaso']['edad_final'],
                    'sintoma'=>$user['objCaso']['sintoma'],
                    'causas'=>$user['objCaso']['causas'],
                    'tratamiento'=>$user['objCaso']['tratamiento'],
                    'diagnostico'=>$user['objCaso']['diagnostico'], 
                    'medico_visitado'=>$user['objCaso']['medico_visitado'],  
                ];
                $arrayResul=array_diff($arra1, $arra2);
                $detalle='ha  actualizado el caso  "'.$user['objCaso']['titulo'].'" '.json_encode($arrayResul);
                $idarticulo=$user['objCaso']['idarticulo'];
            }
            
           
        }

        if($user['tipo']=='comment'){

            $detalle='Ingreso al caso '.$user['caso']['titulo'];
            $idarticulo=$user['caso']['idarticulo'];
            session(['seccion_tipo'=>'COM']);
            $seccionNavegacion=SeccionActividadModel::where('tipo',session()->get('seccion_tipo'))->first()->idsecciones_actividad;
            $sub_actividad=1;
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
                        'sub_actividad'=>$sub_actividad,
                        'idactividad_padre'=>$idactividad_padre,
                        'idsecciones_actividad'=>$seccionNavegacion,
                        'idtemas'=>null,
                        'idbiblioteca_virtual'=>null,
                        

                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);
    }
}
