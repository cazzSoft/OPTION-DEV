<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\Events\MedicoEventPublicacion;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MedicoListenerPublicacion
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }
    /**
     * Handle the event.
     *
     * @param  MedicoEventPublicacion  $event
     * @return void
     */
    public function handle(MedicoEventPublicacion $event)
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
        
         $idarticulo=null;
        //verificar el dato actualizado del usuario $enfermedades1->toArray()
            if($user['objPublicacionUpdate']!=null && $user['objPublicacion']!=null ){
                $idarticulo=$user['objPublicacion']['idarticulo'];
                $arra1=[
                    'descripcion'=>$user['objPublicacionUpdate']['descripcion'],
                    'titulo'=>$user['objPublicacionUpdate']['titulo'],
                    'vinculo_art'=>$user['objPublicacionUpdate']['vinculo_art'],
                    'area_desc'=>$user['objPublicacionUpdate']['area_desc'],
                    'edad_inicial'=>$user['objPublicacionUpdate']['edad_inicial'],
                    'edad_final'=>$user['objPublicacionUpdate']['edad_final'],
                    'sintoma'=>$user['objPublicacionUpdate']['sintoma'],
                    'causas'=>$user['objPublicacionUpdate']['causas'],
                    'tratamiento'=>$user['objPublicacionUpdate']['tratamiento'],
                    'enfermedades'=>$user['objPublicacionUpdate']['enfermedades'],
                    
                ];
                
                $arra2=[
                    'descripcion'=>$user['objPublicacion']['descripcion'],
                    'titulo'=>$user['objPublicacion']['titulo'],
                    'vinculo_art'=>$user['objPublicacion']['vinculo_art'],
                    'area_desc'=>$user['objPublicacion']['area_desc'],
                    'edad_inicial'=>$user['objPublicacion']['edad_inicial'],
                    'edad_final'=>$user['objPublicacion']['edad_final'],
                    'sintoma'=>$user['objPublicacion']['sintoma'],
                    'causas'=>$user['objPublicacion']['causas'],
                    'tratamiento'=>$user['objPublicacion']['tratamiento'],
                    'enfermedades'=>$user['objPublicacion']['enfermedades'],  
                ];
            }
            
            $arrayResul=array_diff($arra1, $arra2);

               
         

        $dataRegistro=[
                        'descripcion'=>'Datos del usuario',
                        'icon'=>'fas fa-user-shield',
                        'color'=>$color[$i],
                        'tipo'=>14
                    ];
        $dataActividad=[
                        'descripcion'=>auth()->user()->name.' ha actualizado el artículo  '.json_encode($arrayResul),
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
        // session(['seccion_ctr'=>1]);
    }
}
