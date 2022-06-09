<?php

namespace App\Http\Controllers;

use App\CoinsultModel;
use App\Notificacion;
use App\NotificacionDetalleModel;
use Illuminate\Http\Request;
use Log;
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


    public function getNotificacion()
    {
        if(isset(auth()->user()->id)){
            $listNotify=Notificacion::with('detalle_notificacion')->where('activo',1)->where('iduser',auth()->user()->id)->get();
            $count_notify=Notificacion::where('estado',1)->where('activo',1)->where('iduser',auth()->user()->id)->get()->count();
            
            $lista=[];
            // lista de notificaciones
                if(isset($listNotify)){
                    foreach ($listNotify as $key => $items) {
                        $item='
                            <div class="dropdown-divider"></div>
                            <a href="'.asset($items["detalle_notificacion"][0]["url"]).'" class="dropdown-item2 text-dark " onclick="notify('.$items['detalle_notificacion'][0]['code'].')"> 
                              <i class="'.$items['detalle_notificacion'][0]['icon'].' mr-2 text-warning"></i>'.$items['detalle_notificacion'][0]['descripcion'].'
                              <span class="float-right text-muted text-sm">'.$items['created_at']->isoFormat('l').'</span>
                            </a> ';
                        array_push($lista,$item);
                    }
                }

            // total de coins
               $id=auth()->user()->id;
               $coins=CoinsultModel::where('iduser',$id)->with('detalle_coinsult')->get();
               $sum=00;
               foreach ($coins as $key => $value) {
                   if (isset($value['detalle_coinsult'])) {
                        $sum=$sum + $value['detalle_coinsult'][0]->punto;
                    } 
               }
             

            return response()->json([
               'jsontxt'=> ['msm'=>'Datos obtenidos','estado'=>'success'],
               'request'=> ['count_notify'=>$count_notify ,'listaNotify'=>$lista,'t_coins'=>$sum]
            ],200);

        }

        return response()->json([
            'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción','estado'=>'error']
        ],501);//Not Implemented
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
