<?php

namespace App\Http\Controllers;


use App\EspecialidadesModel;
use App\NoticiaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;
use Storage;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_espec=EspecialidadesModel::all();
        $listaNoticia= NoticiaModel::with('especialidad')->where('activo',1)->orderBy('orden','asc')->get();
        return view('noticia.gestionNoticia',['lista_esp'=>$lista_espec,'lista'=>$listaNoticia]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastOrden()
    {
        $noticia=  NoticiaModel::get()->last();
        if(isset($noticia)){
          return response()->json([
              'jsontxt'=>['msm'=>'success','estado'=>'success'],
              'request'=>$noticia->orden+1
          ],200);
        }else{
         return response()->json([
             'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
         ],501); 
        }  
    }

    //mostrar noticia detalle
    public function getNoticia($id)
    {
        $id=decrypt($id);
        $noticia = NoticiaModel::find($id);

        // creacion de lista de noticia para recomendar
        $listaNoticia=NoticiaModel::where('idnoticia','<>',$id)->with('especialidad')
            ->where('estado',1)->where('activo',1)->get();
        
       return view('noticia.detalleNoticia',['noticia'=>$noticia,'recoment'=>$listaNoticia]);
        // return ['NoticiaDetalle'=>$noticia,'noticia relacionadas'=>$listaNoticia];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        //función para validar datos
        $request->validate([
             'descripcion' => 'required|string',
             'titulo' => 'required|string',
             'img' => 'required',
             'orden' => 'required',
             // 'orden' => 'required|unique:noticia',
             'idespecialidades' => 'required|string',
        ]);

        //validamos el estado
        $estado=0;
        if(isset($request->estado)){
            $estado=1;
        }
        
        $nombre='';
        if($request->img!=null){
            $img= $request->file('img');
            $name=$img->getClientOriginalName();
            $extension = pathinfo($img->getClientOriginalName(), PATHINFO_EXTENSION);
            $nombre= $name.'-'.date('Ymd_h_s').'.'.$extension;
            \Storage::disk('diskPortadaNoticia')->put($nombre,\File::get($img));
        }



        $createNoticia= new NoticiaModel();
        $createNoticia->titulo=$request->titulo;
        $createNoticia->descripcion=$request->descripcion;
        $createNoticia->img=$nombre;
        $createNoticia->idespecialidades=$request->idespecialidades;
        $createNoticia->estado=$estado;
        $createNoticia->orden=$request->orden;

        if( $createNoticia->save()){
             // event(new MedicoEventCasoEx(['tipo'=>'save','caso'=>$actArt,'iduser'=>auth()->user()->id,'seccion'=>'CAEX']));
             return back()->with(['info' => 'Datos guardado correctamente', 'estado' => 'success']);
        }else{
             return back()->with(['info' => 'Error no se pudo registrar el registro', 'estado' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticia=  NoticiaModel::find(decrypt($id));
        if(isset($noticia)){
           //registrar evento nuevo documento
           // event(new UserEventBibliotecaSave(['tipo'=>'edit','documento'=>$documento,'iduser'=>auth()->user()->id]));
          return response()->json([
              'jsontxt'=>['msm'=>'success','estado'=>'success'],
              'request'=>$noticia
          ],200);
        }else{
         return response()->json([
             'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
         ],501); 
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
        // return $request;
        //función para validar datos
        $request->validate([
            'descripcion' => 'required|string',
            'titulo' => 'required|string',
            'idespecialidades' => 'required|string',
        ]);

        $updateNoticia=  NoticiaModel::find(decrypt($id));

        //función para validar datos unicos y requeridos
        if ($request->orden != $updateNoticia->orden) {
            $request->validate([
                // 'orden' => 'required|unique:noticia',
                 'orden' => 'required',
            ]);
        }
         
        $nombre=''; 
        if($request->img!=null){
            // dd( $request->file('img'));
            $img= $request->file('img');
            $name=$img->getClientOriginalName();
            $extension = pathinfo($img->getClientOriginalName(), PATHINFO_EXTENSION);
            $nombre= $name.'-'.date('Ymd_h_s').'.'.$extension;
            \Storage::disk('diskPortadaNoticia')->put($nombre,\File::get($img));

         $updateNoticia->img=$nombre;
        }
        
        $estado=0;
        if(isset($request->estado)){
            $estado=1;
        }

        $updateNoticia->titulo=$request->titulo;
        $updateNoticia->descripcion=$request->descripcion;
       
        $updateNoticia->idespecialidades=$request->idespecialidades;
        $updateNoticia->estado=$estado;
        $updateNoticia->orden=$request->orden;

        if( $updateNoticia->save()){
             // event(new MedicoEventCasoEx(['tipo'=>'save','caso'=>$actArt,'iduser'=>auth()->user()->id,'seccion'=>'CAEX']));
             return back()->with(['info' => 'Datos actualizado correctamente', 'estado' => 'success']);
        }else{
             return back()->with(['info' => 'Error no se pudo actualizar el registro', 'estado' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia=  NoticiaModel::find(decrypt($id));
        $noticia=NoticiaModel::find(decrypt($id));
        if($noticia->delete()){
            //registrar evento nuevo documento
            // event(new UserEventBibliotecaSave(['tipo'=>'delete','documento'=>$documentoAux,'iduser'=>auth()->user()->id]));
            return back()->with(['info' => 'Archivo eliminado', 'estado' => 'success']);
        }
    }
}
