<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeguirModel;

class SeguirController extends Controller
{
    public function __construct()
    {   
       
        $this->middleware('auth');
    }
    
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
        $idmedico=decrypt($request->idmedico);
         auth()->user()->id;
        //validamos si ya lo sigue este usuario
        $buscarUser=SeguirModel::where('iduser_medico',$idmedico)->where('iduser',auth()->user()->id)->first();
        if($buscarUser){
            // dejar de seguir
            if($buscarUser->delete()){
                return response()->json([
                             'jsontxt'=>['msm'=>'Ha dejado de seguirlo..','estado'=>'info']
                         ],200);
            }
            
        }else{
            //registro para seguirlo
            $saveSeguir=new SeguirModel();
            $saveSeguir->iduser=auth()->user()->id;
            $saveSeguir->iduser_medico=decrypt($request->idmedico);
            if( $saveSeguir->save()){
                return response()->json([
                                'jsontxt'=>['msm'=>'Gracias por seguirme..','estado'=>'success']
                            ],200);
            }else{
                return response()->json([
                             'jsontxt'=>['msm'=>'Algo salio mal','estado'=>'error']
                         ],200);
            }
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
