<?php

namespace App\Http\Controllers;

use App\EspecialidadesModel;
use App\Events\HomeEventPerfilUser;
use App\Events\UserEventBibliotecaSave;
use App\Events\UserEventSearchBibliotecaFiltro;
use App\biblioteca_virtualModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Log;
use Storage;
use PDF;
use Response;

class DocumentRepository extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_esp=EspecialidadesModel::all();
        $lista=biblioteca_virtualModel::with('especialidad')->get();
        //registro de evento biblioteca virtual
        event(new HomeEventPerfilUser( ['page'=>'biblioteca virtual','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'BBL'])] ));
        return view('Repositorio.biblioteca_virtual',['lista_esp'=>$lista_esp,'lista_archivo'=>$lista]);
    }

    //cargar vista guardar documento
    public function show_documento_virtual()
    {
        $lista=biblioteca_virtualModel::with('especialidad')->get();
        $lista_esp=EspecialidadesModel::all();
        //registro de evento biblioteca virtual
        event(new HomeEventPerfilUser( ['page'=>'Guardar documento','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'REP'])] ));
        return view('Repositorio.registroDocument',['lista_esp'=>$lista_esp,'lista'=>$lista]);
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        
        //función para validar datos
        $messages = [
                'img.required' =>'El campo documentación es obligatorio.', 
                'idespecialidades.required' => ' El campo especialidad es obligatorio',  
                ];

        $request->validate([
            'img' => 'required',
            'titulo' => 'required',
            'idespecialidades' => 'required',
        ],$messages);

        try {
            
            //PREPARAMOS IMG o archivo
            if($request->img!=null){
                $img= $request->file('img');
                $name=$img->getClientOriginalName();
                $extension = pathinfo($img->getClientOriginalName(), PATHINFO_EXTENSION);

                if($extension=='pdf'){
                    $tipo="PDF";
                }else if($extension=='jpeg' || $extension=='png' || $extension=='jpg'){
                    $tipo="IMG";
                }else{
                    return back()->with(['info' => 'Solo se aceptan archivos con formato PDF, JPEG Y PNG', 'estado' => 'error']);
                }

                $nombre= 'listaPublicaciones/'.$name.'-'.date('Ymd_h_s').'.'.$extension;

                // \Storage::disk('diskDocumentosBiblioteca_v')->put($nombre,\File::get($img));
                 \Storage::disk('wasabi')->put($nombre,\File::get($img));

                //guardamos en base de datos
                $documento= new biblioteca_virtualModel();
                $documento->titulo=$request->titulo;
                $documento->descripcion=$request->descripcion;
                $documento->idespecialidades=$request->idespecialidades;
                $documento->ruta=$nombre;
                $documento->tipo=$tipo;
                if($documento->save()){
                    //registrar evento nuevo documento
                     event(new UserEventBibliotecaSave(['tipo'=>'save','documento'=>$documento,'iduser'=>auth()->user()->id,'seccion'=>'REP']));
                    return back()->with(['info' => 'Archivo guardado correctamente', 'estado' => 'success']);
                }

            }else{
                  return back()->with(['info' => 'El archivo es requerido', 'estado' => 'warning']);
            }
      
        } catch (\Throwable $th) {
            return back()->with(['info' => 'Algo ha ido mal.. '.$th->getMessage(), 'estado' => 'error']);
        }
    }

    //consulta obtener archivos por especialidades
    public function show($id)
    {

       $documento=  biblioteca_virtualModel::with(['especialidad'])->where('idespecialidades',$id)->get();
        if(isset($documento)){

            //Registro evento search documento
            event(new UserEventSearchBibliotecaFiltro(['tipo'=>'filter','idfiltro'=>$id,'iduser'=>auth()->user()->id,'seccion'=>'FLT','sec'=> session(['seccion_tipo'=>'BBL'])]));
           return response()->json([
               'jsontxt'=>['msm'=>'success','estado'=>'success'],
               'request'=>$documento
           ],200);
        }else{
          return response()->json([
              'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
          ],501); 
        }   
    }

    //funcion para buscar archivos
    public function search_documento(Request $request)
    {
        // return $request;
        $documento=  biblioteca_virtualModel::with(['especialidad'])->where('idespecialidades',$request->id)->where('titulo','like',$request->value.'%')->get();
        
        if($documento=="[]"){

            $documento=  biblioteca_virtualModel::with(['especialidad'])->where('titulo','like',$request->value.'%')->get();
        }
      
        if(isset($documento)){
            //Registro evento search documento
            event(new UserEventSearchBibliotecaFiltro(['tipo'=>'search','data_search'=>$request,'iduser'=>auth()->user()->id,'seccion'=>'SEA','sec'=>  session(['seccion_tipo'=>'BBL'])]));
            return response()->json([
               'jsontxt'=>['msm'=>'success','estado'=>'success'],
               'request'=>$documento
            ],200);
        }else{
          return response()->json([
              'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
          ],501); 
        }   
    }


    public function edit($id)
    {
        $documento=  biblioteca_virtualModel::find(decrypt($id));
        if(isset($documento)){
            //registrar evento nuevo documento
            event(new UserEventBibliotecaSave(['tipo'=>'edit','documento'=>$documento,'iduser'=>auth()->user()->id]));
           return response()->json([
               'jsontxt'=>['msm'=>'success','estado'=>'success'],
               'request'=>$documento
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
       
        //guardamos en base de datos
        $documento=  biblioteca_virtualModel::find(decrypt($id));
        $documentoAux=  biblioteca_virtualModel::find(decrypt($id));
       //PREPARAMOS IMG o archivo
        if($request->img!=null){
            $img= $request->file('img');
            $name=$img->getClientOriginalName();
            $extension = pathinfo($img->getClientOriginalName(), PATHINFO_EXTENSION);

            if($extension=='pdf'){
                $tipo="PDF";
            }else if($extension=='jpeg' || $extension=='png' || $extension=='jpg'){
                $tipo="IMG";
            }else{
                return back()->with(['info' => 'Solo se aceptan archivos con formato PDF, JPEG Y PNG', 'estado' => 'error']);
            }

            $nombre= $name.'-'.date('Ymd_h_s').'.'.$extension;
            \Storage::disk('diskDocumentosBiblioteca_v')->put($nombre,\File::get($img));

            $documento->ruta=$nombre;
            $documento->tipo=$tipo;
        }


            $documento->titulo=$request->titulo;
            $documento->descripcion=$request->descripcion;
            $documento->idespecialidades=$request->idespecialidades;
            
            if($documento->save()){
                //registrar evento nuevo documento
                event(new UserEventBibliotecaSave(['tipo'=>'update','documento'=>$documentoAux,'documentoUpdate'=>$request,'iduser'=>auth()->user()->id]));
                return back()->with(['info' => 'Archivo actualizado con exito', 'estado' => 'success']);
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
        $documento=  biblioteca_virtualModel::find(decrypt($id));
        $documentoAux=biblioteca_virtualModel::find(decrypt($id));
        if($documento->delete()){
            //registrar evento nuevo documento
            event(new UserEventBibliotecaSave(['tipo'=>'delete','documento'=>$documentoAux,'iduser'=>auth()->user()->id]));
            return back()->with(['info' => 'Archivo eliminado', 'estado' => 'success']);
        }
    }

    // funcion para mostrar el documentos
    public function viewDocument($id)
    {
        $id=decrypt($id);
        $documento=  biblioteca_virtualModel::find($id);
        if(isset($documento)){
            $contents = base64_encode(\Storage::disk('wasabi')->get($documento->ruta));
            
            if($documento->tipo=='IMG'){
                return ' <img class="img img-fluid mb-3" src="data:image/png;base64, '. base64_encode(\Storage::disk('wasabi')->get($documento->ruta)).'"alt="Attachment"/>';
            }

            return '<embed  src="data:application/pdf;base64,'.$contents.'" frameborder="0" type="application/pdf" width="100%" height="100%"/>';
        }
    }

    //funcion para descargar
    public function download($id)
    {
       

        try {
            $id=decrypt($id);
        } catch (\Throwable $th) {
            return view('error.error-404');// vista de error
        }

        $documento=  biblioteca_virtualModel::find($id);
        if(isset($documento)){
            // return base64_encode(\Storage::disk('wasabi')->get($documento->ruta));
            return  \Storage::disk('wasabi')->download($documento->ruta);;
        }

        return back();
    }


}
