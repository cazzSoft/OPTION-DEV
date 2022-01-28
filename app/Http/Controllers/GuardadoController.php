<?php

namespace App\Http\Controllers;

use App\Events\HomeEventGuardar;
use App\Events\HomeEventPerfilUser;
use App\Events\HomeEventSearch;
use App\GuardadoModel;
use Illuminate\Http\Request;

class GuardadoController extends Controller
{
    
    public function __construct()
    {   
       
        $this->middleware('auth');
    }
    
    public function index()
    {
      
       $guardado=GuardadoModel::with(['articulo_user'=>function ($q)
       {
           $q->where('tipo','N')->where('publicar','1')->where('estado','1');
       }])->where('iduser',auth()->user()->id)->orderBy('idguardado','desc')
       ->get(); 

       //registro de evento view page
        event(new HomeEventPerfilUser(['page'=>'Guardados','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'GUR'])]));
        
        return view('guardado',['listaGuar'=>$guardado]);
    }

    
    

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
        $idart=decrypt($request->idart);
        $exitArtisave=GuardadoModel::where('idarticulo',$idart)->where('iduser',auth()->user()->id)->first();
        if(isset($exitArtisave)){
           
            return response()->json([
                    'jsontxt'=>['msm'=>'Este artículo ya fue guardado','estado'=>'info']
                ],200);
        }else{
           
            $saveArt= new GuardadoModel();
            $saveArt->iduser=auth()->user()->id;
            $saveArt->idarticulo=$idart;
            
            if( $saveArt->save()){
                //registro de eventos
                event(new HomeEventGuardar(['idarticulo'=>$idart,'iduser'=>auth()->user()->id,'descripcion'=>' "guardo" ']));
                return response()->json([
                        'jsontxt'=>['msm'=>'Artículo guardado..','estado'=>'success']
                    ],200);
            }  
        }
    }

    public function search_art(Request $request)
    {
        

        $value=$request->search_user;
        $articulo=GuardadoModel::with(['articulo_user'=>function ($q) use($value)
        {
            $q->where('titulo','like','%'.$value.'%')->orwhere('descripcion', 'like', '%'.$value.'%');
        }])->where('iduser',auth()->user()->id)->get();
       
        //Registro evento search
        event(new HomeEventSearch(['txt_search'=>$value,'iduser'=>auth()->user()->id,'seccion'=>'GUR']));

        return view('guardado',['listaGuar'=>$articulo,'search_user'=>$value]); 
    }

    //evento para quitar articulo de guardado de user
    public function show($id)
    {
        $id=decrypt($id);

        if(GuardadoModel::where('idarticulo',$id)->where('iduser',auth()->user()->id)->delete() ){
            //registro de eventos
            event(new HomeEventGuardar(['idarticulo'=>$id,'iduser'=>auth()->user()->id,'descripcion'=>' "removió" ']));
            return response()->json([
                    'jsontxt'=>['msm'=>'Artículo removido','estado'=>'success']
                ],200);
        }else{
            return response()->json([
                        'jsontxt'=>['msm'=>'No se permite..','estado'=>'warning']
                    ],200);
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
