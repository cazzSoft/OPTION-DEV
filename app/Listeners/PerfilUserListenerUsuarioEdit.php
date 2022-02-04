<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\ArticuloModel;
use App\Events\PerfilUserEventUsuarioEdit;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PerfilUserListenerUsuarioEdit
{
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }

    /**
     * Handle the event.
     *
     * @param  PerfilUserEventUsuarioEdit  $event
     * @return void
     */
    public function handle(PerfilUserEventUsuarioEdit $event)
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
        $seccionNavegacion=SeccionActividadModel::where('tipo', $tipo_s)->first()->idsecciones_actividad;
        session(['seccion_tipo'=>$user['tipo_s']]);
        $tipo_s=session()->get('seccion_tipo');
       

        //se obtiene el ultimo registro para obtener el  idactividad_padre
        $actividadConsul=Actividad_userModel::where('iduser',auth()->user()->id)
            ->where('sub_actividad',1)
            ->where('idsecciones_actividad',$seccionNavegacion)->get()->last();
              $idactividad_padre= $actividadConsul->idactividad_user;
         
        $seccionNavegacion=SeccionActividadModel::where('tipo', $tipo_s)->first()->idsecciones_actividad;    
        
        //en caso del nombre del articulo
        $nameArticulo='';
        if($user['idarticulo']!=null){$nameArticulo=ArticuloModel::find($user['idarticulo'])->titulo;}

        $dataRegistro=[
                        'descripcion'=>'Datos del usuario',
                        'icon'=>'fas fa-user-shield',
                        'color'=>$color[$i],
                        'tipo'=>14
                    ];
        $dataActividad=[
                        'descripcion'=>auth()->user()->name.' dio clic en '.$user['descripcion'].' '.$nameArticulo.' '.$mytime->toTimeString(),
                        'iduser'=>$user['iduser'],
                        'last_logged_at'=> null,
                        'last_login'=> null,
                        'idarticulo'=>$user['idarticulo'],
                        'idmedico'=>null,
                        'sub_actividad'=>$user['sub_a'],
                        'idactividad_padre'=> $idactividad_padre,
                        'idsecciones_actividad'=>$seccionNavegacion,
                        'idtemas'=>null,
                        'idbiblioteca_virtual'=>null,
                    ];

       $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
       logger($result);

       
    }
}
