<?php

namespace App\Http\Controllers;

use App\Actividad_userModel;
use App\CoinsultDetalleModel;
use App\CoinsultModel;
use App\Events\HomeEventPerfilUser;
use App\Http\Controllers\NotificacionController;
use App\Notificacion;
use App\NotificacionDetalleModel;
use App\Registro_ActividadModel;
use Illuminate\Http\Request;
use Log;

class CoinsultController extends Controller
{
    protected $notify;
    public function __construct(NotificacionController $notify)
    {   
        $this->middleware('auth'); 
        $this->notify=$notify;
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

        // asignamos 5 coinsult code "1" por registrarse
        $resul=$this->add_coinsult('1');
        if($resul){
            // notificamos que se ha ganado 5 coinsul code 2
            $this->notify->add_notificacion('2','coinsul');
        }

        //notificamos para que complete los datos si aun no ha completado code 1
         $this->notify->add_notificacion('1','home');
        // creacion de notificacion para completar datos
        // $getNoti=NotificacionDetalleModel::where('code','1')->first()->iddetalle_notificacion;
        // $validarNoti=Notificacion::where('iduser',$id)->where('iddetalle_notificacion',$getNoti)->first();
        // if($validarNoti){
        //     return redirect('/home');
        // }
        // $notify= new Notificacion(); 
        // $notify->iduser= $id;
        // $notify->iddetalle_notificacion=$getNoti;
        // $notify->save();

        return redirect('/home');
    }

    //funcion para asignar coinsults
    public function add_coinsult($code)
    {
        $id= auth()->user()->id;
        $getPunto=CoinsultDetalleModel::where('code',$code)->first()->idcoinsultDetalle;
        $validarCo=CoinsultModel::where('iduser',$id)->where('idcoinsultDetalle',$getPunto)->first();
        if($validarCo){
            return 0;
        }

        //Asignamos coinsult al usuario
        $coinsulcreate= new CoinsultModel(); 
        $coinsulcreate->iduser= $id;
        $coinsulcreate->idcoinsultDetalle= $getPunto;
     
        if($coinsulcreate->save()){
            return 1;
        }

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
