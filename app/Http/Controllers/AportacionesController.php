<?php

namespace App\Http\Controllers;

use App\AportacionesModel;
use App\Events\MedicoEventCasoExComent;
use Illuminate\Http\Request;

class AportacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $coment=new AportacionesModel();
        $coment->comentario=$request->comentario;
        $coment->idarticulo=decrypt($request->idart);
        $coment->iduser=auth()->user()->id;
      
        if($coment->save()){
            //registrar evento comentario nuevo
            event(new MedicoEventCasoExComent(['tipo'=>'save','comentario'=>$coment,'iduser'=>auth()->user()->id,'seccion'=>'COM']));
             return response()->json([
                'jsontxt'=> ['msm'=>'Datos guardado con éxito..','estado'=>'success'],
                'request'=> AportacionesModel::with('usuario')->find($coment->idaportaciones)
             ],200);
        }else{
            return response()->json([
                'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción1','estado'=>'error']
            ],501);//Not Implemented
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
        $coment= AportacionesModel::find(decrypt($id));
        $comentAux= AportacionesModel::find(decrypt($id));
        //si es el comentario es vacio quiere decir que eliminamos su comentario
        if($request->comentario == null){
           
            return $this->destroy($id);
        }
         
       
        $coment->comentario=$request->comentario;
        $coment->idarticulo=decrypt($request->idart);
       
        if($coment->save()){
            //registrar evento actulizar comentario del caso
            event(new MedicoEventCasoExComent(['tipo'=>'update','objComent'=>$comentAux,'objComentUpdate'=>$request,'iduser'=>auth()->user()->id]));
             return response()->json([
                'jsontxt'=> ['msm'=>'Datos guardado con éxito..','estado'=>'success'],
             ],200);
        }else{
            return response()->json([
                'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción1','estado'=>'error']
            ],501);//Not Implemented
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
        $coment= AportacionesModel::find(decrypt($id));
        $coment->activo=0;
       if($coment->save()){
            //registrar evento comentario eliminado
            event(new MedicoEventCasoExComent(['tipo'=>'delete','comentario'=>$coment,'iduser'=>auth()->user()->id,'seccion'=>'COM']));
             return response()->json([
                'jsontxt'=> ['msm'=>'Eliminado','estado'=>'success'],
             ],200);
        }else{
            return response()->json([
                'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción','estado'=>'error']
            ],501);//Not Implemented
        }
    }
}
