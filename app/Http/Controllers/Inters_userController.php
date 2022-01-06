<?php

namespace App\Http\Controllers;

use App\Inters_userModel;
use App\TemasModel;
use Illuminate\Http\Request;

class Inters_userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_temas=TemasModel::all();
        return view('preguntas',['lista_temas'=>$lista_temas]);
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
        // return decrypt($request->idtemas);
        $interes_user=new Inters_userModel();
        $interes_user->iduser=auth()->user()->id;
        $interes_user->idtemas=decrypt($request->idtemas);

        if($interes_user->save()){
            
             return response()->json([
                'jsontxt'=> ['msm'=>'Success','estado'=>'success'],
               
             ],200);
        }else{
            return response()->json([
                'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción','estado'=>'error']
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
