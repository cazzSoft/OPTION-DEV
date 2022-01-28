<?php

namespace App\Listeners;


use App\Actividad_userModel;
use App\Events\HomeEventInfoMedico;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HomeListenerInfoMedico 
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    
    public function handle(HomeEventInfoMedico $event)
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
            
        $medicoName=User::find($user['idmedico'])->name;
        

         // verificamos a que seccion de la actividad va ha pertenecer
        $tipo_s=session()->get('seccion_tipo');
        $idactividad_padre=null;
        $seccionNavegacion=null;

        // dd( $tipo_s);
        //se busca el id de la seccion tipo navegación 
        $seccionNavegacion=SeccionActividadModel::where('tipo', $tipo_s)->first()->idsecciones_actividad;
        session(['seccion_tipo'=>'PERMED']);
        $tipo_s=session()->get('seccion_tipo');
       

        //se obtiene el ultimo registro para obtener el  idactividad_padre
        $actividadConsul=Actividad_userModel::where('iduser',auth()->user()->id)
            ->where('sub_actividad',1)
            ->where('idsecciones_actividad',$seccionNavegacion)->get()->last();
              $idactividad_padre= $actividadConsul->idactividad_user;
         
        $seccionNavegacion=SeccionActividadModel::where('tipo', $tipo_s)->first()->idsecciones_actividad;    
        
       
        

        $dataRegistro=[
                        'descripcion'=>'Médico Visitados',
                        'icon'=>'fas fa-user-md',
                        'color'=>$color[$i],
                        'tipo'=>2
                    ];
        $dataActividad=[
                       
                        'descripcion'=>auth()->user()->name.' Visitó el perfil del médico "'.$medicoName.'"  '.$mytime->toTimeString(),
                        'iduser'=>$user['iduser'],
                        'last_logged_at'=> null,
                        'last_login'=> null,
                        'idarticulo'=>null,
                        'idmedico'=>$user['idmedico'],
                        'sub_actividad'=>1,
                        'idactividad_padre'=> $idactividad_padre,
                        'idsecciones_actividad'=>$seccionNavegacion,
                        'idtemas'=>null,
                    ];

       $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
       logger($result);

        //se cambia el valor para cuando recargue no se inserte otravez la misma accion
        session(['seccion_ctr'=>1]);
    }
}
