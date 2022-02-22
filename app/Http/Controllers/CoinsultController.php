<?php

namespace App\Http\Controllers;

use App\Actividad_userModel;
use App\CoinsultModel;
use App\Events\HomeEventPerfilUser;
use App\Registro_ActividadModel;
use Illuminate\Http\Request;
use App\CoinsultDetalleModel;
use Log;

class CoinsultController extends Controller
{
    public function __construct()
    {   
       
        $this->middleware('auth');
    }
    public function index()
    {
        $id= auth()->user()->id;
        $consul=CoinsultModel::with('detalle_coinsult')->where('iduser',$id)->orderBy('idcoinsult','desc')->get();
        
        //registro de evento view page
        event(new HomeEventPerfilUser(['page'=>'Coinsul usuaio','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'COIN'])]));

        return view('coinsult',['coinsult'=>$consul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $id= auth()->user()->id;
        $getPunto=CoinsultDetalleModel::where('punto','5')->first()->idcoinsultDetalle;
        $validarCo=CoinsultModel::where('iduser',$id)->where('idcoinsultDetalle',$getPunto)->first();
        if($validarCo){
            return redirect('/home');
        }
        $coinsulcreate= new CoinsultModel(); 
        $coinsulcreate->iduser= $id;
        $coinsulcreate->idcoinsultDetalle= $getPunto;
        $coinsulcreate->save();

        

        return redirect('/home');
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
