<?php

namespace App\Http\Controllers;

use App\Actividad_userModel;
use App\AportacionesModel;
use App\ArticuloModel;
use App\CiudadModel;
use App\EspecialidadesModel;
use App\Events\HomeEventInfoMedico;
use App\Events\HomeEventPerfilUser;
use App\Events\PerfilUserEventUsuario;
use App\Events\PerfilUserEventUsuarioEdit;
use App\GuardadoModel;
use App\Registro_ActividadModel;
use App\SeguirModel;
use App\TipoUserModel;
use App\TituloModel;
use App\User;
use App\UsuarioEspecialidadModel;
use Illuminate\Http\Request;

class DoctoresController extends Controller
{
   
    public function __construct()
    {   
       
        $this->middleware('auth');
    }
    
    public function index()
    {
        //registro de evento user medico
        event(new HomeEventPerfilUser(['page'=>'Perfil Usuaio','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PER'])]));
        $listaArt=ArticuloModel::withCount(['like'])->where('iduser',auth()->user()->id)->where('estado','1')->where('tipo','N')->get()->take(11);
        $countArt=ArticuloModel::where('iduser',auth()->user()->id)->count();
        $countSeguid=SeguirModel::where('iduser_medico',auth()->user()->id)->count();
        return view('medico.medico',['listaArt'=>$listaArt,'publicaciones'=>$countArt,'seguidores'=>$countSeguid]);
    }

    //casos execionales
    public function casos_ex()
    {
        
        $listacasos=ArticuloModel::withCount(['comentarios'=>function ($q){
           $q->where('activo',1);
       }])->with('medico')->where('tipo','E')->where('estado',1)->orderBy('created_at','desc')->simplePaginate(5);
        $counCasos=ArticuloModel::where('created_at','like','2021-12%')->where('tipo','E')->where('estado',1)->count();
        $casos=ArticuloModel::where('iduser',auth()->user()->id)->where('tipo','E')->where('estado',1)->count();
        $porcet= $counCasos/100;
        //registrar evento
        event(new HomeEventPerfilUser(['page'=>'Ayudanos a ayudar','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'CAEX'])]));
        return view('medico.gestionCasos',['lista_casos'=>$listacasos,'casos_publicado'=>$counCasos,'porcent'=>$porcet,'casos'=>$casos]);
    }
    public function create()
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    //obtener datos del medico
    public function getInfo()
    {
        
        $datosPersonales=User::with('ciudad')->find(auth()->user()->id);
        $especialidad=UsuarioEspecialidadModel::with('especialidades')->where('iduser',auth()->user()->id)->get();
        $listaEspeci=EspecialidadesModel::all();
        $listaCiudad=CiudadModel::all();
        $listaTitulo=TituloModel::all(); 
        //registrar evento del medico
        event(new PerfilUserEventUsuarioEdit(['idarticulo'=>null,'sub_a'=>'1','tipo_s'=>'PERMED','descripcion'=>' "Editar Perfil"','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PER'])]));

        return view('medico.perfil_medico',['datos_p'=>$datosPersonales,'listaCiudad'=>$listaCiudad,'especialidad'=>$especialidad,'lista_especialidad'=>$listaEspeci,'lista_titu'=>$listaTitulo]);
     
    }

    public function show_info($id)
    {

        //informacion del perfil del medico
       $id=decrypt($id);
       $listaArt=ArticuloModel::withCount(['like'])
                ->with(['like'=>function($q){
                            $q->select(['*'])->where('iduser',auth()->user()->id)->get();
                    }])->where('iduser',$id)->where('tipo','N')->where('publicar','1')->where('estado','1')->get()->take(8);
                
        $datosPersonales=User::with('ciudad')->with('titulo')->find($id);
        $siguiendo=SeguirModel::where('iduser_medico',$id)->where('iduser',auth()->user()->id)->first();
        $tipo=TipoUserModel::find(auth()->user()->idtipo_user)->abr;
       
        //registro de actividad iformacion perfil medico
        event(new HomeEventInfoMedico(['idmedico'=>$id,'iduser'=>auth()->user()->id,'tipo_S'=>'']));
       
       
        return view('info_doc',['listaArt'=>$listaArt,'datos_p'=>$datosPersonales,'sigue'=>$siguiendo,'user'=>$tipo]);
    }
    public function edit($id)
    {
        // 
    }

    
    
    public function update(Request $request, $id)
    {
         
        // return $request;
        $user=User::find(decrypt($id));
        $user_aux=User::find(decrypt($id));
        // $user->name=$request->name;
        // $user->email=$request->email;
        $user->telefono=$request->telefono;
        $user->fecha_nacimiento=$request->fecha_nacimiento;
        // $user->genero=$request->genero;
        // $user->idciudad=$request->idciudad;
         $user->estado_registro=1;
        if( $user->save()){
            //actualizamos sus especialidad
            if($request->iduser_especialidad!=""){
                $espe=UsuarioEspecialidadModel::where('iduser',decrypt($id));
                $espe_axu=UsuarioEspecialidadModel::where('iduser',decrypt($id))->get();
                $espe->delete();
                foreach ($request->iduser_especialidad as $key => $value) {
                    $nuevos= new UsuarioEspecialidadModel();
                    $nuevos->idespecialidades=$value;
                    $nuevos->iduser=decrypt($id);
                    $nuevos->save(); 
                }  
                //registro evento para especialidades 
                session(['seccion_ctr'=>0]);
                event(new PerfilUserEventUsuario(['tipoUser'=>'M-E','objUserEspeci'=>$espe_axu,'objUserEspeciUpdate'=>$request->iduser_especialidad ,'iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PERMED'])] ));
            } 
            //registro de evento update datos basicos medico
             session(['seccion_ctr'=>0]);
            event(new PerfilUserEventUsuario(['tipoUser'=>'M','objUser'=>$user_aux,'objUserUdpate'=>$request,'iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PERMED'])] ));
            return back()->with(['info' => 'Datos guardados', 'estado' => 'success']);
        }else{
            return back()->with(['info' => 'No se pudieron actualizados los datos ', 'estado' => 'error']);
        }
    }

    //actualizar informacion del médico
    public function actualiza(Request $request, $id)
    {
      
        $user=User::find(decrypt($id));
        $user_aux=User::find(decrypt($id));
        $user->num_licenciaMedica=$request->num_licenciaMedica;
        $user->idtitulo_profesional=$request->idtitulo_profesional;
        $user->detalle_estudio=$request->detalle_estudio;
        $user->detalle_experiencia=$request->detalle_experiencia;
        $user->link_fb=$request->link_fb;
        $user->link_tw=$request->link_tw;
        $user->link_stg=$request->link_stg;
        $user->link_lkd=$request->link_lkd;
        if( $user->save()){
            //registro de evento update datos basicos medico
            session(['seccion_ctr'=>0]);
            event(new PerfilUserEventUsuario(['tipoUser'=>'M-A','objUser'=>$user_aux,'objUserUdpate'=>$request,'iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PERMED'])] ));
            return back()->with(['info' => 'Datos actualizados', 'estado' => 'success']);
        }else{
            return back()->with(['info' => 'No se pudieron actualizados los datos ', 'estado' => 'error']);
        }
       
    }

    public function destroy($id)
    {
        //
    }
}
