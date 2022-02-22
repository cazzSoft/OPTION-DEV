<?php

namespace App\Http\Controllers;

use App\Actividad_userModel;
use App\Events\HomeEvenMasInfo;
use App\Events\HomeEventContact;
use App\Events\HomeEventInfoMedico;
use App\Events\HomeEventPerfilUser;
use App\Events\HomeEventShare;
use App\Events\MedicoEventSeguirSociales;
use App\Events\MedicoEventTabsChange;
use App\Events\PerfilUserEventUsuarioEdit;
use App\Events\UserEventBibliotecaAction;
use App\Events\UserEventPreguntaIntere;
use App\Events\userRegistro;
use App\Registro_ActividadModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;
use Mail;


class Registro_ActividadController extends Controller
{
    
    

    public function index()
    {
        $fecha= now();
        $value=$fecha->format('Y-m-d');
        $consulta=Actividad_userModel::with('desub_actividad')->where('iduser',auth()->user()->id)->where('created_at','like',$value.'%')->where('sub_actividad',1)->get();
        $array=[];
       
        $listaHistorial=Registro_ActividadModel::all();
        return view('historial.registro_actividad',['lista_histo'=>$listaHistorial,'lista'=>$consulta]);
    }

    public function getDetail($id)
    {
        $id=decrypt($id);
        $consulta=Registro_ActividadModel::with('detalle_historial')->find($id);
        return view('historial.detalleHistorial',['detalle'=>$consulta]);
    }


    public function create()
    {
        
    }

    public function colas()
    {
        // $color = array('info', 'success', 'maroon', 'warning', 'primary','teal','danger','secondary','gray','purple','orange','lime','olive');
        // $count = count($color) - 1;
        // $i = rand(0, $count);
        //  $color[$i];
        // event(new HomeEventInfoMedico(['idmedico'=>1,'iduser'=>auth()->user()->id]));
        // return "success";
       
        //  return $mytime=Carbon::parse(auth()->user()->last_login)->diffForHumans();
        // return $mytime->diffForHumans();

        // Mail::send('mail.send-mail', ['name_user'=>'cazz'], function ($m)  {
        //     $m->to('cazzdj17@hotmail.com')
        //     ->from('info@option2health.com', 'Option2Health')
        //     ->subject('recuperacion de contraseña');
        // });

        // return 'success';
    }

    

    //funcion principal para guardar el historial del usuairo
    public function historialUser($dataAc,$dataRe)
    {
         //registro de actividades 
        $sub_actividad=$dataAc['sub_actividad'];
        if($sub_actividad==Null){$sub_actividad=0;}

        $consulLogin=  Registro_ActividadModel::where('tipo',$dataRe['tipo'])->first();
        if(isset($consulLogin)){
            //registro de datos de actividad "dataAc"
            $saveActividad=new Actividad_userModel();
            $saveActividad->idregistro_actividad= $consulLogin->idregistro_actividad;
            $saveActividad->descripcion=$dataAc['descripcion'];
            $saveActividad->idarticulo=$dataAc['idarticulo'];
            $saveActividad->iduser=$dataAc['iduser'];
            $saveActividad->idmedico=$dataAc['idmedico'];
            $saveActividad->last_logged_at=$dataAc['last_logged_at'];
            $saveActividad->last_login=$dataAc['last_login'];
            $saveActividad->sub_actividad=$sub_actividad;
            $saveActividad->idactividad_padre=$dataAc['idactividad_padre'];
            $saveActividad->idsecciones_actividad=$dataAc['idsecciones_actividad'];
            $saveActividad->idtemas=$dataAc['idtemas'];
            $saveActividad->idbiblioteca_virtual=$dataAc['idbiblioteca_virtual'];
            
            $saveActividad->save();
            //guardamos idpadre encaso este activo el search
            // if(session()->get('seccion_tipo')==1){
            //     // session()->put('idactividad_padre', 'me@example.com');
            //     session(['idactividad_padre'=>$saveActividad->idactividad_user]);
            //     // dd($saveActividad->idactividad_padre);
            // }
        }else{
            //Datos del registro de actividad "$dataRe"
            $saveLogin=  new Registro_ActividadModel();
            $saveLogin->descripcion=$dataRe['descripcion'];
            $saveLogin->icon=$dataRe['icon'];
            $saveLogin->color=$dataRe['color'];
            $saveLogin->tipo=$dataRe['tipo'];
            if( $saveLogin->save()){
               //registro de datos de actividad "dataAc"
                $saveActividad=new Actividad_userModel();
                $saveActividad->idregistro_actividad= $saveLogin->idregistro_actividad;
                $saveActividad->descripcion=$dataAc['descripcion'];
                $saveActividad->idarticulo=$dataAc['idarticulo'];
                $saveActividad->iduser=$dataAc['iduser'];
                $saveActividad->idmedico=$dataAc['idmedico'];
                $saveActividad->last_logged_at=$dataAc['last_logged_at'];
                $saveActividad->last_login=$dataAc['last_login'];
                $saveActividad->sub_actividad=$sub_actividad;
                $saveActividad->idactividad_padre=$dataAc['idactividad_padre'];
                $saveActividad->idsecciones_actividad=$dataAc['idsecciones_actividad'];
                $saveActividad->idtemas=$dataAc['idtemas'];
                $saveActividad->idbiblioteca_virtual=$dataAc['idbiblioteca_virtual'];
                $saveActividad->save();
                //guardamos idpadre encaso este activo el search
                // if(session()->get('activa_search')==1){
                //     session(['idactividad_padre'=>$saveActividad->idactividad_user]); 
                   
                // }
            }
        }

        return "success ".$dataRe['descripcion'];
        
    }

    ////////Gestión de Eventos ////////////////////// 

    public function EventInicial()
    {
       //registro de evento view page
        dd(22);
        event(new HomeEventPerfilUser( ['page'=>'home (principal)','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'INI'])] ));
    }
    public function EventVerMas($id)
    {
        $id=decrypt($id);
        event(new HomeEvenMasInfo(['idarticulo'=>$id,'iduser'=>auth()->user()->id]));
    }

    public function EventShareF($id)
    {
        $id=decrypt($id);
        event(new HomeEventShare(['idarticulo'=>$id,'iduser'=>auth()->user()->id,'share'=>'por Facebook']));
    }

    public function EventShareW($id)
    {
         $id=decrypt($id);
        event(new HomeEventShare(['idarticulo'=>$id,'iduser'=>auth()->user()->id,'share'=>'por Whatsapp']));
    }
    
    public function ContactOnline($id)
    {
        
        $id=decrypt($id);
        event(new HomeEventContact(['idarticulo'=>$id,'iduser'=>auth()->user()->id,'contact'=>'Contacto Online']));
    }

    public function ContactW($id)
    {
        $id=decrypt($id);
        event(new HomeEventContact(['idarticulo'=>$id,'iduser'=>auth()->user()->id,'contact'=>'Contacto Whatsapp']));
    }

    public function EventConoceme($id)
    {
        
       $id=decrypt($id);
        event(new MedicoEventTabsChange(['idmedico'=>$id,'iduser'=>auth()->user()->id,'descripcion'=>' "Conoceme"']));
    }

    public function Eventpublicaciones($id)
    {
        
        $id=decrypt($id);
        event(new MedicoEventTabsChange(['idmedico'=>$id,'iduser'=>auth()->user()->id,'descripcion'=>'"Publicaciones"']));
    }

    public function EventSociales($id,$des)
    {
       $id=decrypt($id);
       $des=' "Sigueme en: '.$des.'"';
       event(new MedicoEventSeguirSociales(['idmedico'=>$id,'iduser'=>auth()->user()->id,'descripcion'=>$des]));
    }

    //evento pregunta de interes del usuario
    public function EventOmitir()
    {
        event(new UserEventPreguntaIntere(['iduser'=>auth()->user()->id,'descripcion'=>'  ha "Omitido las pregunta de interes"','idtemas'=>null]));
    }

    //evento del medico
    public function EventMedicoPerfil()
    {
        //registrar evento del medico
        event(new PerfilUserEventUsuarioEdit(['idarticulo'=>null,'sub_a'=>'1','tipo_s'=>'ART','descripcion'=>' "Add publicación"','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PER'])]));

    }

    public function EventBiblioteca($id)
    {
        $id=decrypt($id);
        event(new UserEventBibliotecaAction(['idbiblioteca_virtual'=>$id,'iduser'=>auth()->user()->id]));
    }

    ////////Gestión de Eventos END ////////////////////// 
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
