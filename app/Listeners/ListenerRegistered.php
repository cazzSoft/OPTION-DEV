<?php

namespace App\Listeners;

use App\Datos_medicosModel;
use App\Http\Controllers\Registro_ActividadController;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered ;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerRegistered
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }



    public function handle(Registered  $event)
    {
       
        //se restaura la varible de session 
        session()->regenerate();
        // insertamos datos medicos al us
        

        

        //guardamos actividad
        $user=$event->user;
        $mytime = now();
        $mytime=Carbon::parse($mytime);

         //colores random
        $color = array('info', 'success', 'maroon', 'warning', 'primary','teal','danger','secondary','gray','purple','orange','lime','olive');
        $count = count($color) - 1;
        $i = rand(0, $count);


         $datos_medico=new Datos_medicosModel();
            $datos_medico->peso=0;
            $datos_medico->tipo_sangre='ninguno';
            $datos_medico->talla=0;
            $datos_medico->iduser=$user->id;
            $datos_medico->save();

        $dataRegistro=[
                        'descripcion'=>'Registro de usuario',
                        'icon'=>'fas fa-registered',
                        'color'=>$color[$i],
                        'tipo'=>0
                    ];
        $dataActividad=[
                        'idregistro_actividad'=>1,
                        'descripcion'=>$user->name.' se registro '.$mytime->toTimeString(),
                        'iduser'=>$user->id,
                        'last_login'=>new \DateTime(),
                        'last_logged_at'=> null,
                        'idarticulo'=>null,
                        'idmedico'=>null,
                        'sub_actividad'=>null,
                        'idactividad_padre'=>null,
                        'idsecciones_actividad'=>null,
                        'idtemas'=>null,
                        'idbiblioteca_virtual'=>null,

                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);

        
        logger($result);
        $event->user->last_login = new \DateTime();
        $event->user->online = 1;
        $event->user->save();

    }
}
