<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\Events\UserEventBibliotecaSave;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserListenerBibliotecaSave
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }


    /**
     * Handle the event.
     *
     * @param  UserEventBibliotecaSave  $event
     * @return void
     */
    public function handle(UserEventBibliotecaSave $event)
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
        $idbiblioteca_virtual=null;
        if($user['tipo']=='save'){
            $detalle=' ha guardado un Documento "'.$user['documento']['ruta'].'" ';
            $idbiblioteca_virtual=$user['documento']['idbiblioteca_virtual'];
        }

        if($user['tipo']=='edit'){
            $detalle=' ha dado clic en Icono "editar documento " del registro "'.$user['documento']['ruta'].'" ';
            $idbiblioteca_virtual=$user['documento']['idbiblioteca_virtual'];
        }

        if($user['tipo']=='delete'){
            $detalle=' ha  eliminado el Archivo "'.$user['documento']['ruta'].'" ';
            $idbiblioteca_virtual=$user['documento']['idbiblioteca_virtual'];
        }

        if($user['tipo']=='update'){
            
            if($user['documentoUpdate']['img']!=null){
                $img= $user['documentoUpdate']->file('img');
                $name=$img->getClientOriginalName();
                $extension = pathinfo($img->getClientOriginalName(), PATHINFO_EXTENSION);
                $ruta=  $name.'-'.date('Ymd_h_s').'.'.$extension;


             }else{
                $ruta=$user['documento']['ruta'];
             }

            $arra1=[
                'ruta'=>$ruta,
                'titulo'=>$user['documentoUpdate']['titulo'],
                'descripcion'=>$user['documentoUpdate']['descripcion'],
                'idespecialidades'=>$user['documentoUpdate']['idespecialidades'],
            ];
            $arra2=[
                'ruta'=>$user['documento']['ruta'],
                'titulo'=>$user['documento']['titulo'],
                'descripcion'=>$user['documento']['descripcion'],
                'idespecialidades'=>$user['documento']['idespecialidades'],
            ];

            $arrayResul=array_diff($arra1, $arra2);
            $idbiblioteca_virtual=$user['documento']['idbiblioteca_virtual'];
            $detalle=' ha  actualizado el Archivo '.json_encode($arrayResul);
              
        }

        $dataRegistro=[
                        'descripcion'=>'Documento Registrado',
                        'icon'=>'far fa-folder',
                        'color'=>$color[$i],
                        'tipo'=>16
                       ];
        $dataActividad=[
                        'descripcion'=>auth()->user()->name.''.$detalle.' '.$mytime->toTimeString(),
                        'iduser'=>$user['iduser'],
                        'last_logged_at'=> null,
                        'last_login'=> null,
                        'idarticulo'=>null,
                        'idmedico'=>null,
                        'sub_actividad'=>0,
                        'idactividad_padre'=>$idactividad_padre,
                        'idsecciones_actividad'=>$seccionNavegacion,
                        'idtemas'=>null,
                        'idbiblioteca_virtual'=>$idbiblioteca_virtual,
                        

                    ];

        $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
        logger($result);
    }
}
