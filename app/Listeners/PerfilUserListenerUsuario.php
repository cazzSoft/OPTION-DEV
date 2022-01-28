<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\Events\PerfilUserEventUsuario;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Str;

class PerfilUserListenerUsuario
{
    

    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    public function handle(PerfilUserEventUsuario $event)
    {
        //control de registro sirve para al recargar la pagina no se registre la misma acción 
        if(session()->get('seccion_ctr')==1){
           
            return 0;
        }
 
  
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
        
        //verificar el dato actualizado del usuario $enfermedades1->toArray()
            if($user['tipoUser']=='P'){
                $arra1=[
                    'name'=>$user['objUser']['name'],
                    'email'=>$user['objUser']['email'],
                    'telefono'=>$user['objUser']['telefono'],
                    'fecha_nacimiento'=>$user['objUser']['fecha_nacimiento'],
                    'genero'=>$user['objUser']['genero'],
                    'idciudad'=>$user['objUser']['idciudad'],
                ];
                $arra2=[
                    'name'=>$user['objUserUdpate']['name'],
                    'email'=>$user['objUserUdpate']['email'],
                    'telefono'=>$user['objUserUdpate']['telefono'],
                    'fecha_nacimiento'=>$user['objUser']['fecha_nacimiento'],
                    'genero'=>$user['objUserUdpate']['genero'],
                    'idciudad'=>$user['objUserUdpate']['idciudad'],
                ];
            }
            
            $arrayResul=array_diff($arra2, $arra1);

               
         

        $dataRegistro=[
                        'descripcion'=>'Datos del usuario',
                        'icon'=>'fas fa-user-shield',
                        'color'=>$color[$i],
                        'tipo'=>14
                    ];
        $dataActividad=[
                        'descripcion'=>auth()->user()->name.' ha actualizado los datos'.json_encode($arrayResul),
                        'iduser'=>$user['iduser'],
                        'last_logged_at'=> null,
                        'last_login'=> null,
                        'idarticulo'=>null,
                        'idmedico'=>null,
                        'sub_actividad'=>0,
                        'idactividad_padre'=>$idactividad_padre,
                        'idsecciones_actividad'=>$seccionNavegacion,
                        'idtemas'=>null,

                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);
        session(['seccion_ctr'=>1]); 
    }
}
