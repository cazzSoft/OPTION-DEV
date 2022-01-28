<?php

namespace App\Listeners;

use App\Actividad_userModel;
use App\Events\HomeEventPerfilUser;
use App\Http\Controllers\Registro_ActividadController;
use App\SeccionActividadModel;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HomeListenerPerfilUser
{
    
    protected $actividad;
    
    public function __construct(Registro_ActividadController $actividad)
    {
        $this->actividad=$actividad;
    }
    
    public function handle(HomeEventPerfilUser $event)
    {
        
        try { 
            createInicialHome:
            //guardamos actividad
            $user=$event->data;
            
            $mytime=now();

            //colores random
            $color = array('info', 'success', 'maroon', 'warning', 'primary','teal','danger','secondary','gray','purple','orange','lime','olive');
            $count = count($color) - 1;
            $i = rand(0, $count); 
                
            $tipo_s=session()->get('seccion_tipo');
            $seccionNavegacion=null;
            $idactividad_padre=null;
            $controlHome=0;
            $nivel=1; 
             
            // verificamos a que seccion de la actividad va ha pertenecer
            $seccionNavegacion=SeccionActividadModel::where('tipo',$tipo_s)->first()->idsecciones_actividad;
           
            //encontrar el idpadre del evento o accion 
            if($tipo_s!='INI'){
                $seccionNavegacionAnterior=SeccionActividadModel::where('tipo','INI')->first()->idsecciones_actividad;
                //se obtiene el ultimo registro del tipo de seccion idactividad_user
                $idactividad_padre=Actividad_userModel::where('iduser',auth()->user()->id)
                    ->where('sub_actividad',1)->where('idsecciones_actividad',$seccionNavegacionAnterior)
                    ->get()->last();

                //validamos que siempre exista la accion inicial ya que de esa depende lo demas
                $varAuxUser=null;
                
                if(!isset($idactividad_padre->idactividad_user)){
                    $idactividad_padre=null;
                    $varAuxUser= $user['page'];
                    $user['page']="Home (principal)";
                    $controlHome=1; 
                    $seccionNavegacion=$seccionNavegacionAnterior;
                }else{
                  $idactividad_padre=$idactividad_padre->idactividad_user;
                }
            }
            

            $dataRegistro=[
                            'descripcion'=>'Páginas de interés',
                            'icon'=>'fas fa-pager',
                            'color'=>$color[$i],
                            'tipo'=>9
                        ];
            $dataActividad=[
                           
                            'descripcion'=>auth()->user()->name.' Cambio a la página de "'.$user['page'].'" '.$mytime->toTimeString(),
                            'iduser'=>$user['iduser'],
                            'last_logged_at'=> null,
                            'last_login'=> null,
                            'idarticulo'=>null,
                            'idmedico'=>null,
                            'sub_actividad'=>$nivel,
                            'idactividad_padre'=> $idactividad_padre,
                            'idsecciones_actividad'=>$seccionNavegacion,
                            'idtemas'=>null,
                        ];
            session(['seccion_ctr'=>0]);            
            $result=$this->actividad->historialUser($dataActividad,$dataRegistro);
            logger($result);
            
            //se crea la accion pendiente
            if($controlHome){
                $user['page']=$varAuxUser;
                goto createInicialHome; 
            }
        } catch (\Throwable $th) {
            // $tipo_s=session()->get('seccion_tipo');
             dd($th->getMessage());   
            dd("error".$tipo_s);
           // goto createInicialHome;
        }
        
    }
}
