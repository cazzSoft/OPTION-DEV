<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\Events\UserEventBibliotecaAction;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use App\biblioteca_virtualModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserListenerBibliotecaAction
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    /**
     * Handle the event.
     *
     * @param  UserEventBibliotecaAction  $event
     * @return void
     */
    public function handle(UserEventBibliotecaAction $event)
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
        
        $documentName=biblioteca_virtualModel::find($user['idbiblioteca_virtual'])->ruta;
        $dataRegistro=[
                        'descripcion'=>'Biblioteca',
                        'icon'=>'fas fa-book-open',
                        'color'=>$color[$i],
                        'tipo'=>15
                       ];
        $dataActividad=[
                        'descripcion'=>auth()->user()->name.' Dio clic en el documento '.$documentName,
                        'iduser'=>$user['iduser'],
                        'last_logged_at'=> null,
                        'last_login'=> null,
                        'idarticulo'=>null,
                        'idbiblioteca_virtual'=>$user['idbiblioteca_virtual'],
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
