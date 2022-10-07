<?php

namespace App\Http\Controllers;

use App\Actividad_userModel;
use App\AportacionesModel;
use App\ArticuloModel;
use App\CalendarioModel;
use App\CiudadModel;
use App\EspecialidadesModel;
use App\Events\HomeEventInfoMedico;
use App\Events\HomeEventPerfilUser;
use App\Events\PerfilUserEventUsuario;
use App\Events\PerfilUserEventUsuarioEdit;
use App\Events\SaveImgEvent;
use App\GuardadoModel;
use App\Http\Controllers\CoinsultController;
use App\Http\Controllers\NotificacionController;
use App\Notificacion;
use App\NotificacionDetalleModel;
use App\Registro_ActividadModel;
use App\SeguirModel;
use App\TipoUserModel;
use App\TituloModel;
use App\User;
use App\UsuarioEspecialidadModel;
use Illuminate\Http\Request;
use Log;
use Storage;

class DoctoresController extends Controller
{
    protected $notify;
    protected $coins;

    public function __construct(NotificacionController $notify, CoinsultController $coins)
    {    
        $this->middleware('auth');
        $this->notify=$notify;
        $this->coins=$coins;
    }
    
    public function index()
    {
        //registro de evento user medico
        // event(new HomeEventPerfilUser(['page'=>'Perfil Usuaio','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PER'])]));
        $datosPersonales=User::with('ciudad')->find(auth()->user()->id);
        $especialidad=UsuarioEspecialidadModel::with('especialidades')->where('iduser',auth()->user()->id)->get();
        $listaEspeci=EspecialidadesModel::all();
        $listaCiudad=CiudadModel::all();
        $listaTitulo=TituloModel::all(); 


        $listaArt=ArticuloModel::withCount(['like'])->where('iduser',auth()->user()->id)->where('estado','1')->where('tipo','N')->get();
        $countArt=ArticuloModel::where('iduser',auth()->user()->id)->count();
        $countSeguid=SeguirModel::where('iduser_medico',auth()->user()->id)->count();

       
        // return view('medico.medico',['listaArt'=>$listaArt,'publicaciones'=>$countArt,'seguidores'=>$countSeguid]);
        //registrar evento del medico
        // event(new PerfilUserEventUsuarioEdit(['idarticulo'=>null,'sub_a'=>'1','tipo_s'=>'PERMED','descripcion'=>' "Editar Perfil"','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PER'])]));

        return view('medico.perfil_medico',['seguidores'=>$countSeguid,'listaArt'=>$listaArt,'datos_p'=>$datosPersonales,'listaCiudad'=>$listaCiudad,'especialidad'=>$especialidad,'lista_especialidad'=>$listaEspeci,'lista_titu'=>$listaTitulo,'publicaciones'=>$countArt,'seguidores'=>$countSeguid]);
    }
    // lista de pacientes
    public function getPaciente()
    {
        $lista=CalendarioModel::with('usuario')->where('estado','AT')->get();
        return view('medico.listaPaciente',['listaPaciente'=>$lista]);
    }
    //casos execionales
    public function casos_ex()
    {
        
        $listacasos=ArticuloModel::withCount(['comentarios'=>function ($q){
           $q->where('activo',1);
       }])->with('medico')->where('tipo','E')->where('estado',1)->orderBy('created_at','desc')->simplePaginate(5);

        $ulm_mes=date('Y-m-d');
        $counCasos=ArticuloModel::where('created_at','like',$ulm_mes.'%')->where('tipo','E')->where('estado',1)->count();
        $casos=ArticuloModel::where('iduser',auth()->user()->id)->where('tipo','E')->where('estado',1)->count();
        $porcet= ($counCasos/100)*100;
        //registrar evento
        event(new HomeEventPerfilUser(['page'=>'Ayudanos a ayudar','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'CAEX'])]));
        return view('medico.gestionCasos',['lista_casos'=>$listacasos,'casos_publicado'=>$counCasos,'porcent'=>$porcet,'casos'=>$casos]);
    }

    //get guia medica 
    public function getGuiaMedico()
    {
         $especialidades=EspecialidadesModel::orderBy('descripcion', 'Asc')->get();
       
        $tipo_m=TipoUserModel::where('abr','dr')->first();
        // $listaTopMedico=User::where('idtipo_user',$tipo_m['idtipo_user'])->where('estado_registro',1)->get();
        $listapMedico=User::with('titulo')->where('idtipo_user',$tipo_m['idtipo_user'])->get();
        return view('medico.guiaMedica',['medicos'=>$listapMedico,'lista_espec'=>$especialidades]);
    }

    //get guia medica por especialidad
    public function getGuiaMedico_esp($value)
    {
        $value= decrypt($value);
        $especialidades=EspecialidadesModel::orderBy('descripcion', 'Asc')->get();
        
        $consul =UsuarioEspecialidadModel::with(
                ['especialidades'=>function ($q) use($value){
                    $q->where("descripcion","like", $value."%")->orderBy('descripcion', 'Asc')->get();
                            }]
        )->with('usuario')->get();

        $array=[];
        if( $consul!=null && $consul!="[]"){
            foreach ($consul as $key => $item) {
               if($item['especialidades']!=null){
                
                    array_push($array,$item['usuario'][0]);
               }
            }
        }
        
       
        return view('medico.guiaMedica',['medicos'=>$array,'lista_espec'=>$especialidades,'value'=>$value]);
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


            $listaArt=ArticuloModel::withCount(['like'])->where('iduser',auth()->user()->id)->where('estado','1')->where('tipo','N')->get()->take(11);
            $countArt=ArticuloModel::where('iduser',auth()->user()->id)->count();
            $countSeguid=SeguirModel::where('iduser_medico',auth()->user()->id)->count();
          
        
        //registrar evento del medico
        event(new PerfilUserEventUsuarioEdit(['idarticulo'=>null,'sub_a'=>'1','tipo_s'=>'PERMED','descripcion'=>' "Editar Perfil"','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PER'])]));

        return view('medico.perfil_medico',['seguidores'=>$countSeguid,'listaArt'=>$listaArt,'datos_p'=>$datosPersonales,'listaCiudad'=>$listaCiudad,'especialidad'=>$especialidad,'lista_especialidad'=>$listaEspeci,'lista_titu'=>$listaTitulo]);
     
    }

    public function show_info($id)
    {
        
        //informacion del perfil del medico
       $id=decrypt($id);

       //verificamos del medico logeado si es el mismo de la publicacion
        
        if(auth()->user()->id==$id){
           return redirect('medico/perfil');
        }

       $listaArt=ArticuloModel::withCount(['like'])
                ->with(['like'=>function($q){
                            $q->select(['*'])->where('iduser',auth()->user()->id)->get();
                    }])->where('iduser',$id)->where('tipo','N')->where('publicar','1')->where('estado','1')->get()->take(8);
                
        $datosPersonales=User::with('ciudad')->with('titulo')->find($id);
        $siguiendo=SeguirModel::where('iduser_medico',$id)->where('iduser',auth()->user()->id)->first();
        $tipo=TipoUserModel::find(auth()->user()->idtipo_user)->abr;
        $countArt=ArticuloModel::where('iduser',$id)->count();
        $countSeguid=SeguirModel::where('iduser_medico',$id)->count();
        //registro de actividad iformacion perfil medico
        event(new HomeEventInfoMedico(['idmedico'=>$id,'iduser'=>auth()->user()->id,'tipo_S'=>'']));
       
        return view('info_doc',['listaArt'=>$listaArt,'datos_p'=>$datosPersonales,'sigue'=>$siguiendo,'user'=>$tipo,'publicaciones'=>$countArt,'seguidores'=>$countSeguid]);
    }

    //obtener datos del medico
    public function getMedico($id)
    {
       $id=decrypt($id);
       $InfoMedico=User::with('titulo')->find($id);
       if(isset($InfoMedico)){
           //registrar evento editar caso
           // event(new MedicoEventCasoEx(['tipo'=>'edit','caso'=>$consul,'iduser'=>auth()->user()->id,'seccion'=>'CAEX']));
            $url_perfil=asset('/medico/info/'.encrypt($id));
            if(auth()->user()->id== $InfoMedico->id){
                $url_perfil=asset('/medico/perfil'); 
            }

            $img=\Storage::disk('diskDocumentosPerfilUser')->exists($InfoMedico->img);
            if($img){
               $img= asset(auth()->user()->img);     
            }else{
                $img=\Storage::disk('wasabi')->temporaryUrl($InfoMedico->img, now()->addMinutes(3600) );
            }

            $InfoMedico=[
                'name'=>$InfoMedico->name,
                'telefono'=>$InfoMedico->telefono,
                'email'=>$InfoMedico->email,
                'direccion'=>$InfoMedico->direccion,
                'url'=>$url_perfil,
                'idtitulo_profesional'=>$InfoMedico->idtitulo_profesional,
                'titulo'=>$InfoMedico->titulo,
                'detalle_experiencia'=>$InfoMedico->detalle_experiencia,
                'img'=>$img,
            ];
           return response()->json([
               'jsontxt'=>['msm'=>'success','estado'=>'success'],
               'request'=>$InfoMedico
           ],200);
       }else{
          return response()->json([
              'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
          ],501); 
       }
    }
    public function edit($id)
    {
        // 
    }

    //funcion para guardar fotos de portada del medico
    public function update_photo_portada(Request $request)
    {
        
        //función para validar datos
        $request->validate([
            'img_portada' => 'required',
        ]);

        //PREPARAMOS IMG o archivo
        if($request->img_portada!=null){
            $img= $request->file('img_portada');
            $name=$img->getClientOriginalName();
            $extension = pathinfo($img->getClientOriginalName(), PATHINFO_EXTENSION);

            if($extension=='jpeg' || $extension=='png' || $extension=='jpg'){
                $tipo="IMG";
            }else{
                return back()->with(['info' => 'Solo se aceptan archivos con formato JPEG Y PNG', 'estado' => 'error']);
            }

            $nombre= '00'.auth()->user()->id.$name.'-'.date('Ymd_h_s').'.'.$extension;
            // \Storage::disk('wasabi')->put('FotoPortada/'.$nombre,\File::get($img));
            \Storage::disk('diskDocumentosPerfilUser')->put('FotoPortada/'.$nombre,\File::get($img));
            event(new SaveImgEvent(['nombreDoc'=>'FotoPortada/'.$nombre] )); 

            //guardamos en base de datos
            $documento=  user::find(auth()->user()->id);
            $documento->img_portada='FotoPortada/'.$nombre;
            if($documento->save()){
                //registrar evento nuevo documento
                 // event(new UserEventBibliotecaSave(['tipo'=>'save','documento'=>$documento,'iduser'=>auth()->user()->id,'seccion'=>'REP']));
                return back()->with(['info' => 'Archivo guardado correctamente', 'estado' => 'info']);
            }

        }else{
              return back()->with(['info' => 'El archivo es requerido', 'estado' => 'warning']);
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
             
            $user=User::find(decrypt($id));
            $user_aux=User::find(decrypt($id));
            $user->name=$request->name;
            if($user->social_id==null){
                $user->email=$request->email;
            }
            $user->idtitulo_profesional=$request->idtitulo_profesional;
            // $user->detalle_estudio=$request->detalle_estudio;
            // $user->detalle_experiencia=$request->detalle_experiencia;
            $user->link_fb=$request->link_fb;
            // $user->link_tw=$request->link_tw;
            $user->link_stg=$request->link_stg;
            $user->link_yt=$request->link_yt;
            $user->telefono=$request->telefono;
            $user->direccion=$request->direccion;
            // $user->fecha_nacimiento=$request->fecha_nacimiento;
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
                    // event(new PerfilUserEventUsuario(['tipoUser'=>'M-E','objUserEspeci'=>$espe_axu,'objUserEspeciUpdate'=>$request->iduser_especialidad ,'iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PERMED'])] ));
                } 
                //registro de evento update datos basicos medico
                 session(['seccion_ctr'=>0]);
                // event(new PerfilUserEventUsuario(['tipoUser'=>'M','objUser'=>$user_aux,'objUserUdpate'=>$request,'iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PERMED'])] ));
                return back()->with(['info' => 'Datos guardados', 'estado' => 'success']);
            }else{
                return back()->with(['info' => 'No se pudieron actualizados los datos ', 'estado' => 'error']);
            }
        } catch (\Throwable $th) {
              return back()->with(['info' => 'Algo ha ido mal.. ', 'estado' => 'error']);
        } 
    }

    public function updateMedicoPerfil(Request $request, $id)
    {
        try {
            
            
            $user=User::find(decrypt($id));
            // $user_aux=User::find(decrypt($id));


            //PREPARAMOS IMG 
            if($request->img!=null){
                $img= $request->file('img');
                $extension = pathinfo($img->getClientOriginalName(), PATHINFO_EXTENSION);

                if($extension=='jpeg' || $extension=='png' || $extension=='jpg'){
                    $tipo="IMG";
                }else{
                    return back()->with(['info' => 'Solo se aceptan archivos con formato JPEG Y PNG', 'estado' => 'error']);
                }

                $nombre= '00'.auth()->user()->id.'-'.date('Ymd_h_s').'.'.$extension;

                // \Storage::disk('wasabi')->put('FotoPortada/'.$nombre,\File::get($img));
                 \Storage::disk('diskDocumentosPerfilUser')->put('FotoPerfil/'.$nombre,\File::get($img));

                 event(new SaveImgEvent(['nombreDoc'=>'FotoPerfil/'.$nombre] ));  
                
                  $user->img='FotoPerfil/'.$nombre;
            }
            $user->idtitulo_profesional=$request->idtitulo_profesional;
            $user->detalle_estudio=$request->detalle_estudio;
            $user->detalle_experiencia=$request->detalle_experiencia;
            $user->telefono=$request->telefono;
            $user->direccion=$request->direccion;
            $user->fecha_nacimiento=$request->fecha_nacimiento;
            $user->genero=$request->genero;
            $user->cedula=$request->cedula;
            $user->idciudad=$request->idciudad;
             $user->estado_registro=1;
            if( $user->save()){
                //actualizamos sus especialidad
                if($request->idespecialidades!=""){
                    $espe=UsuarioEspecialidadModel::where('iduser',decrypt($id));
                    $espe_axu=UsuarioEspecialidadModel::where('iduser',decrypt($id))->get();
                    $espe->delete();
                    foreach ($request->idespecialidades as $key => $value) {
                        $nuevos= new UsuarioEspecialidadModel();
                        $nuevos->idespecialidades=$value;
                        $nuevos->iduser=decrypt($id);
                        $nuevos->save(); 
                    }  
                    //registro evento para especialidades 
                    session(['seccion_ctr'=>0]);
                    // event(new PerfilUserEventUsuario(['tipoUser'=>'M-E','objUserEspeci'=>$espe_axu,'objUserEspeciUpdate'=>$request->iduser_especialidad ,'iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PERMED'])] ));
                } 
                //registro de evento update datos basicos medico
                 session(['seccion_ctr'=>0]);
                // event(new PerfilUserEventUsuario(['tipoUser'=>'M','objUser'=>$user_aux,'objUserUdpate'=>$request,'iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PERMED'])] ));

               
                 //asignamos 5 coinsult por update de datos code 2
                 $resul=$this->coins->add_coinsult('2');
                 if($resul){
                     // notificamos que se ha ganado 5 coinsul code 2
                     $this->notify->add_notificacion('5','coinsul');
                 }
                 
                //ELIMINAMOS LA NOTIFICACION
                $iddetalle=NotificacionDetalleModel::where('code','1')->first()->iddetalle_notificacion;
                $delete= Notificacion::where('iduser',decrypt($id))->where('iddetalle_notificacion',$iddetalle)->first();
                 if($delete){
                    $delete->activo=0;
                    $delete->save(); 
                 }
                 
                return back()->with(['info' => 'Datos guardados', 'estado' => 'success']);
            }else{
                return back()->with(['info' => 'No se pudieron actualizados los datos ', 'estado' => 'error']);
            }
        } catch (\Throwable $th) {
              return back()->with(['info' => 'Algo ha ido mal.. ', 'estado' => 'error']);
        } 
    }

    //actualizar informacion del médico
    public function actualiza(Request $request, $id)
    {
        try {
            
         
            $user=User::find(decrypt($id));
            $user_aux=User::find(decrypt($id));
          
            $user->detalle_estudio=$request->detalle_estudio;
            $user->detalle_experiencia=$request->detalle_experiencia;
           
            if( $user->save()){
                //registro de evento update datos basicos medico
                session(['seccion_ctr'=>0]);
                // event(new PerfilUserEventUsuario(['tipoUser'=>'M-A','objUser'=>$user_aux,'objUserUdpate'=>$request,'iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PERMED'])] ));
                return back()->with(['info' => 'Datos actualizados', 'estado' => 'success']);
            }else{
                return back()->with(['info' => 'No se pudieron actualizados los datos ', 'estado' => 'error']);
            }
        } catch (\Throwable $th) {
            return back()->with(['info' => 'Algo ha ido mal.. ', 'estado' => 'error']);
        }
       
    }

    public function destroy($id)
    {
        //
    }
}
