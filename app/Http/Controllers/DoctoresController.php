<?php

namespace App\Http\Controllers;

use App\AportacionesModel;
use App\ArticuloModel;
use App\CiudadModel;
use App\EspecialidadesModel;
use App\GuardadoModel;
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
        
        return view('medico.perfil_medico',['datos_p'=>$datosPersonales,'listaCiudad'=>$listaCiudad,'especialidad'=>$especialidad,'lista_especialidad'=>$listaEspeci,'lista_titu'=>$listaTitulo]);
     
    }

    public function show_info($id)
    {
       $id=decrypt($id);
       $listaArt=ArticuloModel::withCount(['like'])
                ->with(['like'=>function($q){
                            $q->select(['*'])->where('iduser',auth()->user()->id)->get();
                    }])->where('iduser',$id)->where('tipo','N')->where('publicar','1')->where('estado','1')->get()->take(8);
                
        $datosPersonales=User::with('ciudad')->with('titulo')->find($id);
        $siguiendo=SeguirModel::where('iduser_medico',$id)->where('iduser',auth()->user()->id)->first();
        $tipo=TipoUserModel::find(auth()->user()->idtipo_user)->abr;
        return view('info_doc',['listaArt'=>$listaArt,'datos_p'=>$datosPersonales,'sigue'=>$siguiendo,'user'=>$tipo]);
    }
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
        // return $request;
        $user=User::find(decrypt($id));
        $user->name=$request->name;
        $user->email=$request->email;
        $user->telefono=$request->telefono;
        $user->fecha_nacimiento=$request->fecha_nacimiento;
        $user->genero=$request->genero;
        $user->idciudad=$request->idciudad;
        if( $user->save()){
            //actualizamos sus especialidad
            if($request->iduser_especialidad!=""){
               
                $espe=UsuarioEspecialidadModel::where('iduser',decrypt($id));
                $espe->delete();
                foreach ($request->iduser_especialidad as $key => $value) {
                    $nuevos= new UsuarioEspecialidadModel();
                    $nuevos->idespecialidades=$value;
                    $nuevos->iduser=decrypt($id);
                    $nuevos->save(); 
                }   
            }

            return back()->with(['info' => 'Datos actualizados', 'estado' => 'success']);
        }else{
            return back()->with(['info' => 'No se pudieron actualizados los datos ', 'estado' => 'error']);
        }
    }

    //actualizar informacion del médico
    public function actualiza(Request $request, $id)
    {
        // return $request;
        $user=User::find(decrypt($id));
        $user->num_licenciaMedica=$request->num_licenciaMedica;
        $user->idtitulo_profesional=$request->idtitulo_profesional;
        $user->detalle_estudio=$request->detalle_estudio;
        $user->detalle_experiencia=$request->detalle_experiencia;
        $user->link_fb=$request->link_fb;
        $user->link_tw=$request->link_tw;
        $user->link_stg=$request->link_stg;
        $user->link_lkd=$request->link_lkd;
        if( $user->save()){
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