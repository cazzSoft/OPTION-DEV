<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\GuardadoModel;
use App\SeguirModel;
use App\CiudadModel;


class PerfilUsuarioController extends Controller
{
    

     public function __construct()
    {   
       
        $this->middleware('auth');
    }
    
    public function index()
    {
       
        $consul= User::find(Auth()->user()->id);
        $guardado=GuardadoModel::with('articulo_user')->where('iduser',auth()->user()->id)->orderBy('idguardado','desc')->get();
        $seguidos=SeguirModel::where('iduser',auth()->user()->id)->count();
        $ciudades= CiudadModel::all();
        return view('perfil',['data'=>$consul,'listaGuar'=>$guardado,'sigues'=>$seguidos,'listaCiudad'=>$ciudades]);
    }

    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
