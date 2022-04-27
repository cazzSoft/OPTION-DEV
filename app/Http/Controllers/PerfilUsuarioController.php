<?php

namespace App\Http\Controllers;

use App\CiudadModel;
use App\Datos_medicosModel;
use App\Events\HomeEventPerfilUser;
use App\Events\SaveImgEvent;
use App\GuardadoModel;
use App\SeguirModel;
use App\User;
use Illuminate\Http\Request;
use Log;
use Storage;
use Str;

class PerfilUsuarioController extends Controller
{
    

     public function __construct()
    {   
       
        $this->middleware('auth'); 
     
    }
    

    //Información del perfil del usuario
    public function index()
    {
       
        $consul= User::find(Auth()->user()->id);
        $guardado=GuardadoModel::with('articulo_user')->where('iduser',auth()->user()->id)->orderBy('idguardado','desc')->get();
        $seguidos=SeguirModel::where('iduser',auth()->user()->id)->count();
        $ciudades= CiudadModel::all();
        $datos_medico=Datos_medicosModel::where('iduser',Auth()->user()->id)->first();
        $array=null;
        if(isset($datos_medico['enfermedades'])){
            $array= json_decode($datos_medico['enfermedades'], true);
        }
        
       
        //registro de evento view page
        event(new HomeEventPerfilUser(['page'=>'Perfil usuaio','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PER'])]));

        return view('perfil',['data'=>$consul,'listaGuar'=>$guardado,'sigues'=>$seguidos,'listaCiudad'=>$ciudades,'datos_m'=>$datos_medico,'lista_enf'=>$array]);
    }

    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_info()
    {
         
         $seguidos=SeguirModel::with('usuarios')->where('iduser',auth()->user()->id)->get();
         if ($seguidos) {
            $array=[];
            foreach ($seguidos as $key => $value) {
               
               $item=' <div class="form-group mt-3">
                            <div class="product-info">
                              <a  class="product-title username direct-chat-name hover">'.$value->usuarios[0]->name.'
                                <span class="text-muted float-right text-red">
                                   <button onclick="dejarS("'.encrypt($value->iduser_medico).'")" type="button" class="btn btn-block btn-outline-secondary btn-sm">Siguiendo</button>
                                </span></a>
                            </div>
                        </div>
                            ';
               array_push( $array, $item);
            }
            return response()->json($array);
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    //funcion para guardar imagen de perfil del usuario
    public function update_photo(Request $request)
    {
        //función para validar datos
        $request->validate([
            'img' => 'required',
        ]);

        //PREPARAMOS IMG o archivo
        if($request->img!=null){
            $img= $request->file('img');
            // $name=$img->getClientOriginalName();
            $extension = pathinfo($img->getClientOriginalName(), PATHINFO_EXTENSION);

            if($extension=='jpeg' || $extension=='png' || $extension=='jpg'){
                $tipo="IMG";
            }else{
                return back()->with(['info' => 'Solo se aceptan archivos con formato JPEG Y PNG', 'estado' => 'error']);
            }

            $nombre= '00'.auth()->user()->id.'_'.date('Ymd_h_s').'.'.$extension;
            // \Storage::disk('diskDocumentosPerfilUser')->put($nombre,\File::get($img));
             // \Storage::disk('wasabi')->put('FotoPerfil/'.$nombre,\File::get($img));
              \Storage::disk('diskDocumentosPerfilUser')->put('FotoPerfil/'.$nombre,\File::get($img));

            event(new SaveImgEvent(['nombreDoc'=>'FotoPerfil/'.$nombre] ));  
            //guardamos en base de datos
            $documento=  user::find(auth()->user()->id);
            $documento->img='FotoPerfil/'.$nombre;
            if($documento->save()){
                //registrar evento nuevo documento
                 // event(new UserEventBibliotecaSave(['tipo'=>'save','documento'=>$documento,'iduser'=>auth()->user()->id,'seccion'=>'REP']));
                return back()->with(['info' => 'Archivo guardado correctamente', 'estado' => 'info']);
            }

        }else{
              return back()->with(['info' => 'El archivo es requerido', 'estado' => 'warning']);
        }
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
        $id=decrypt($id);
        $datos_medico=Datos_medicosModel::find($id);
        $datos_medico->peso=$request->peso;
        $datos_medico->tipo_sangre=$request->tipo_sangre;
        $datos_medico->talla=$request->talla;
        $datos_medico->enfermedades=$request->enfermedades;
        $datos_medico->save();

        return back();
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
