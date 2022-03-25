<?php

namespace App\Http\Controllers;

use App\Notificacion;
use App\NotificacionDetalleModel;
use Illuminate\Http\Request;

class NotificacionController extends Controller
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

    //funcion base para notificar al usuario
    public function add_notificacion($code, $url="home")
    {
        
        $id=auth()->user()->id;
        // creacion de notificacion para completar datos
        $getNoti=NotificacionDetalleModel::where('code',$code)->first()->iddetalle_notificacion;
        $validarNoti=Notificacion::where('iduser',$id)->where('iddetalle_notificacion',$getNoti)->first();
        if($validarNoti){
            return 0;
        }
        $notify= new Notificacion(); 
        $notify->iduser= $id;
        $notify->iddetalle_notificacion=$getNoti;
        $notify->url=$url;
        if($notify->save()){
            return 1;
        }
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
       
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listaNot=Notificacion::where('iduser',auth()->user()->id)->where('estado','1')->get();

        if($listaNot){
            foreach ($listaNot as $key => $value) {
                 $updateNot=  Notificacion::find($value->idnotificacion);
                 $updateNot->estado=0;
                 $updateNot->save();
            }    
        }

        return $listaNot;
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
