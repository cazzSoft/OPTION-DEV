<?php

namespace App\Http\Controllers;

use App\ArticuloModel;
use App\CiudadModel;
use Illuminate\Http\Request;
class PrincipalController extends Controller
{

    public function __construct()
    {   
       
        $this->middleware('web2');
    }

    public function index()
    {
        $articulo=ArticuloModel::inRandomOrder()->withCount(['like'])
                ->with(['medico','like'=>function($q){
                            $q->select(['*'])->get();
                    }])->where('tipo','N')->where('publicar','1')->where('estado','1')->take(21)->paginate(16);

        return view('home',['articulos'=>$articulo,'activeM'=>0]); 
    }


  
    public function showRegistro()
    {
        $consul=CiudadModel::all();
        return view('auth.register',['ciudades'=>$consul]);
    }

    //informacion de loguin
    public function infoLogin()
    {
        return view('login-registro.info-login');
    }

    //informacion de loguin
    public function login()
    {
        return view('login-registro.login');
    }

    public function store(Request $request)
    {
        //
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
