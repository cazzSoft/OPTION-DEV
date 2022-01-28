<?php

namespace App\Listeners; 

use App\Events\userRegistro;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\Registro_ActividadController;

class ActividadRegistro implements ShouldQueue
{
    public $value;

    public function __construct(Registro_ActividadController $value)
    {
        $this->value=$value;
    }

    public function handle(userRegistro $event)
    {
        sleep(5);
        logger("El usuario ".$event->user." se ha registrado");
        $lol=$this->value->historialUser($event);
        logger("ESTADO=".$lol."----------");
           
         //registro de actividades perfil medico tipo 7
        // $consulLogin=  Registro_ActividadModel::where('tipo',1)->first();
        // if(isset($consulLogin)){
        //     $saveActividad=new Actividad_userModel();
        //     $saveActividad->idregistro_actividad= $consulLogin->idregistro_actividad;
        //     $saveActividad->descripcion=$des; 
        //     $saveActividad->iduser=$iduser;
        //     $saveActividad->save();
        // }else{
        //     $saveLogin=  new Registro_ActividadModel();
        //     $saveLogin->descripcion='Historia de busquedad';
        //     $saveLogin->icon='fas fa-search';
        //     $saveLogin->color='success';
        //     $saveLogin->tipo=7;
        //     if( $saveLogin->save()){
        //         $saveActividad=new Actividad_userModel();
        //         $saveActividad->idregistro_actividad= $saveLogin->idregistro_actividad;
        //         $saveActividad->descripcion=$des;
        //         $saveActividad->iduser=$iduser;
        //         $saveActividad->save();
        //     }
        // }

    }
}
