<?php

namespace App\Http\Controllers;

use App\CalendarioModel;
use App\CatalogoModel;
use App\DiasModel;
use App\Horario_diasModel;
use App\Horario_medicoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use Log;
use DB;
use DateInterval;
use DatePeriod;
use DateTime;


class GestionHorarioMedicoController extends Controller
{
   
    public function index()
    {
        $lista_dias=DiasModel::where('activo',1)->get();
        $lista_horarios=Horario_medicoModel::with('horario_dias')->where('activo',1)->where('idmedico',auth()->user()->id)->get();

        // consulta horario laboral definico
        $horas_laboral=$this->horas_laborales();
       
        return view('configuracionMedico.horario',['lista_dias'=>$lista_dias,'lista_horarios'=>$lista_horarios,'horas_laboral'=>$horas_laboral['horas']]);
    } 

    // vista horarios para app
    public function getHorarios()
    {
        $lista_dias=DiasModel::where('activo',1)->get();
        $lista_horarios=Horario_medicoModel::with('horario_dias')->where('activo',1)->where('idmedico',auth()->user()->id)->get();

        // consulta horario laboral definico
        $horas_laboral=$this->horas_laborales();
        return view('configuracionMedico.horario_app',['lista_dias'=>$lista_dias,'lista_horarios'=>$lista_horarios,'horas_laboral'=>$horas_laboral['horas']]);
    }

    // funcion para opbtener horario laboral configurado por Option2healt
    public function horas_laborales()
    {
        $horas_laboral=CatalogoModel::with('tipo_catalogo')->where('codigo','TPCM')->get();

        if($horas_laboral!=null && $horas_laboral!='[]'){
            
            $hora_inicial_laboral=null;
            $hora_final_laboral=null;
            $interbalo_cita=null;
            
            foreach ($horas_laboral[0]['tipo_catalogo'] as $key => $value) {
               
               if($value['codigo']=='HLIC'){
                    $hora_inicial_laboral=$value['valor'];
               } 

               if($value['codigo']=='HLFC'){
                    $hora_final_laboral=$value['valor'];
               }  

               if($value['codigo']=='TP'){
                    $interbalo_cita= $value['valor'];
               }             
            } 


            // validamos que ninguna variable sea nula
            if($hora_inicial_laboral!=null &&  $hora_final_laboral!=null && $interbalo_cita!=null){

               return $this->obtener_cantidad_citas($hora_inicial_laboral,$hora_final_laboral,$interbalo_cita);
                
            }
            return  null;
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
        

        //función para validar datos
        if(!isset($request->dias)){
            $request->request->add(['dias' => null]); //add request
        }

        $messages = [
                'hora_inicio.required' =>'El campo hora inicio es obligatorio.', 
                'hora_fin.required' => ' El campo hora fin es obligatorio', 
                'dias.required' => ' Debe almenos seleccionar un día', 
                ];

        $request->validate([
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'dias'=>'required',
        ],$messages); 

        if($request->hora_fin <= $request->hora_inicio){
            return back()->with(['msm' => 'El rango de hora final debe ser superior al inicial..', 'estado' => 'error'])->withInput();
        }
        // validacion de horas y dias traslapados
        $existe=  $this->traslapado_horario($request->dias,$request->hora_inicio,$request->hora_fin);

        if($existe!='[]' && $existe!=null){
             return back()->with(['msm' => 'Alerta, no puedes configurar horarios traslapados entre sí.', 'estado' => 'error'])->withInput();
        }

        // calculo de citas por dia
        $num_cita=$this->obtener_cantidad_citas($request->hora_inicio,$request->hora_fin,'');
         
        if($num_cita['hora_cita']!=null){
            $num_cita=count($num_cita['hora_cita']);
        }else{
            $num_cita=0;
        }

        // registro de horarios
        $horario=new Horario_medicoModel();
        $horario->hora_inicio=$request->hora_inicio;
        $horario->hora_fin=$request->hora_fin;
        $horario->num_cita= $num_cita;
        $horario->iduser=auth()->user()->id;
        $horario->idmedico=auth()->user()->id;

         if($horario->save()){
                
                if(isset($request->dias)){
                    foreach ($request->dias as $key => $value) {
                       $horario_dias= new Horario_diasModel();
                       $horario_dias->iddias=$value;
                       $horario_dias->idhorario_medico=$horario->idhorario_medico;
                       $horario_dias->save();

                    }
                }

             return back()->with(['info' => 'Horario agregado con éxito', 'estado' => 'success']);
         }
    }


    // funcion que valida horarios traslapado
    public function traslapado_horario($dias,$hora_inicio,$hora_fin)
    {
        
        $array=[];

        // iteracion de dias a insertar
        foreach ($dias as $key => $value) {
           $consul= Horario_diasModel::with('horario_medico')->where('iddias',$value)->get();
            
            foreach ($consul as $key => $items) {
               if(isset($items['horario_medico']) && $items['horario_medico'][0]['idmedico']==auth()->user()->id){
               
                    // dia encontrado
                    $h_inicio=$items['horario_medico'][0]['hora_inicio'];
                    $h_fin=$items['horario_medico'][0]['hora_fin'];
                    $activo=$items['horario_medico'][0]['activo'];
                    
                    //solo horarios activos significa que no esten eliminados
                    if( $activo){
                        // validamos que la hora inicial ingresada no este en ningun rango
                        if($hora_inicio >= $h_inicio && $hora_inicio <= $h_fin  ){
                            $item= '[ h_i '.$h_inicio.'] {-'.$hora_inicio.'-} [ h_f '.$h_fin.']=hora_inicio';
                            array_push( $array,$item);
                          
                        }
                        // validamos que la hora Final ingresada no este en ningun rango
                        if($hora_fin >= $h_inicio && $hora_fin <= $h_fin ){
                             $item= '[ h_f_i '.$h_inicio.'] {-'.$hora_fin.'-} [ h_f '.$h_fin.']=hora_final';
                            array_push( $array,$item);
                        }
                    }
                       
               }
            }
             return $array;
        }

    }

    // funcion que obtiene numeros de citas
    public function obtener_cantidad_citas($hora_inicio,$hora_fin, $tiempo_cita, $num_cita='',$idm='',$fecha_in='')
    {
     
        if($tiempo_cita==null && $tiempo_cita==''){
            $get_inter=CatalogoModel::with('tipo_catalogo')->where('codigo','TPCM')->first(); 
            $tiempo_cita='';
            foreach ($get_inter['tipo_catalogo'] as $key => $value) {
                if($value['codigo']=='TP'){
                    $tiempo_cita=$value['valor'];
                }
            }
        }

        $hora_fin=substr($hora_fin,0,5);
        $hora_inicio=substr($hora_inicio,0,5);


        $tiempo_cita= Carbon::parse($tiempo_cita)->format('i');
        $inicio = new Carbon($hora_inicio);
        $fin = new Carbon($hora_fin);

        $intervalo = new DateInterval('PT'.$tiempo_cita.'M');

        $fechas = new DatePeriod($inicio, $intervalo, $fin);

        $array_h=['hora_cita'=>[],'horas'=>[]];
        $con=[];
        $aux=null;
        foreach($fechas as $key=> $fecha){
            
            $item= $fecha->format("H:ia");
            $val=$fecha->format("H:i");

            if($aux!=null){

                //verificar si tiene cupos para este horario de cita
                $dispoible=0;
                if($idm!=null){
                    $h_ini=$aux_val;
                    $h_fin=$val;
                    $dispoible=$this->disponible_cita($h_ini,$h_fin,$idm,$fecha_in); 
                }

                // asigancion de valores 
                array_push($array_h['hora_cita'],['text_h'=>$aux.' - '.$item,'valor_h'=>$aux_val.' '.$val,'cupo'=>$num_cita,'idm'=>$idm,'estado'=>$dispoible]);
                $aux=null;
                $aux_val=null;
            }

            array_push($array_h['horas'],['id'=>$val,'text'=>$item]);

            $aux=$fecha->format("H:ia");
            $aux_val=$fecha->format("H:i");
           
        }
        return $array_h;
    }

    // funcion para verificar el estado disponible del horario de la cita
    public function disponible_cita($hora_inicio,$hora_fin,$idmedico,$fecha)
    {
        
        $consulta= CalendarioModel::where('idmedico',$idmedico)
                                    ->where('hora_inicio',$hora_inicio)
                                    ->where('hora_fin',$hora_fin)
                                    ->where('fecha',$fecha)
                                    ->where('estado','AG')
                                    ->where('activo',1)
                                    ->get();
        if(count($consulta)!=0){
            return 0; //horario cita no disponible   
        }
        return 1;  //horario cita disponible                          
    }

    //funcion para activar y desactivar horarios medicos
    public function estado_horario($id,$estado)
    {
        try {
            $id=decrypt($id);
            // $estado=decrypt($estado);
        } catch (\Throwable $th) {
            return view('error.error-404');// vista de error
        }

        // verificar que no halla citas registrada para este horario
        $existe= $this->verificar_cita($id);
        if($existe!=null && $existe!='[]'){
           
            return response()->json([
                  'jsontxt'=>['msm'=>'Lo sentimos, no puedes cambiar el estado de este horario por que ya tiene citas agendadas','estado'=>'error'],
               ],200);  
        }

        //mesaje para mostrar el estado de la noticia
         $msm='Este horario se ha activado con exito';
         $estadoTxt='Activado';
         $txt_btn='Desactivar';
         $valor=0;
        if($estado=='0'){
            $msm='Este horario se ha desactivado con exito';
            $estadoTxt='Desactivado';
            $txt_btn='Activar';
            $valor=1;
        }

        $horario=Horario_medicoModel::find($id);
        if(isset($horario)){
            $horario->estado=$estado;
            if($horario->save()){
                 return response()->json([
                       'jsontxt'=>['msm'=>$msm,'estado'=>'success'],
                       'request'=>['text'=>$estadoTxt,'valor'=>$valor,'txt_btn'=>$txt_btn,'est'=>$estado]
                    ],200);
            } else{
                return response()->json([
                    'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
                ],501); 
            }
        }
    }

    // funcion para validar si hay citas en el horario de configuracion
    public function verificar_cita($idhorario)
    {
        $iduser=auth()->user()->id;

        // horario medico
        $horario=Horario_medicoModel::where('estado',1)->where('activo',1)->find($idhorario);

        // lista de citas del médico
        $citas=CalendarioModel::where('idmedico',$iduser)->where('estado','AG')->where('activo',1)->get();
        
        // si no se encuentra el horario
        if(!isset($horario)){
            return null;
        }

        $array=[];
        if($citas!=null || $citas!='[]'  ){
            foreach ($citas as $key => $value) {
              $dia_agenda=Carbon::parse($value['fecha'])->format('w');
              $consulta=DB::table('horario_medico')
                      ->leftJoin('horario_dias','horario_medico.idhorario_medico','=','horario_dias.idhorario_medico')
                      ->leftJoin('dias','horario_dias.iddias','=','dias.iddias')
                      ->where('horario_medico.estado',1)
                      ->where('horario_medico.activo',1)
                      ->where('horario_medico.idhorario_medico',$idhorario)
                      ->where('dias.valor',$dia_agenda)
                      ->first();
              if(isset($consulta )){
                  array_push($array,$value['titulo']);
              }
               // return date(format) $value['fecha'];
                // if($horario['hora_inicio'] <= $value['hora_inicio'] && $horario['hora_fin']>= $value['hora_inicio']){
                //     array_push($array,$value['titulo']);
                // }
            }
        }else{
            return null;
        }

        return $array;
    }
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
        $consul=Horario_medicoModel::find(decrypt($id));

        $dias_consul=Horario_diasModel::with('dias')->where('idhorario_medico',decrypt($id))->get();

        
        return response()->json([
             'jsontxt'=>['msm'=>'success','estado'=>'success'],
             'request'=>$consul,
             'check'=>$dias_consul
          ],200);
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
       
        try {
            $id=decrypt($id);
        } catch (\Throwable $th) {
            return view('error.error-404');// vista de error
        }


       //función para validar datos
        if(!isset($request->dias)){
            $request->request->add(['dias' => null]); //add request
        }

        $messages = [
                'hora_inicio.required' =>'El campo hora inicio es obligatorio.', 
                'hora_fin.required' => ' El campo hora fin es obligatorio', 
                'dias.required' => ' Debe almenos seleccionar un día', 
                ];

        $request->validate([
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'dias'=>'required',
        ],$messages);

        
        $horario=Horario_medicoModel::with('horario_dias')->find($id);



        // verificar que no halla citas registrada para este horario
        if($request['hora_inicio']!= $horario['hora_inicio'] || $request['hora_fin']!= $horario['hora_fin']){
            $existe= $this->verificar_cita($id);
            if($existe!=null && $existe!='[]'){
               return back()->with(['info' => 'Lo sentimos, no puedes modificar este horario por que ya tiene citas agendadas', 'estado' => 'error']);
            }
        }
           


        // calculo de citas por dia
        $num_cita=$this->obtener_cantidad_citas($request->hora_inicio,$request->hora_fin,'');
        
        if($num_cita['hora_cita']!=null){
            $num_cita=count($num_cita['hora_cita']);
        }else{
            $num_cita=0;
        }

        // actualizar datos de horarios
        $horario->hora_inicio=$request->hora_inicio;
        $horario->hora_fin=$request->hora_fin;
        $horario->num_cita= $num_cita;
        $horario->iduser=auth()->user()->id;
        $horario->idmedico=auth()->user()->id;

        if($horario->save()){

           if(isset($request->dias) && $request->dias!='[]'){
                $horario_dias=  Horario_diasModel::where('idhorario_medico',$id)->delete();
               foreach ($request->dias as $key => $value) {
                  $horario_dias= new Horario_diasModel();
                  $horario_dias->iddias=$value;
                  $horario_dias->idhorario_medico=$horario->idhorario_medico;
                  $horario_dias->save();

               }
           }

             return back()->with(['info' => 'Horario actualizado con éxito', 'estado' => 'info']);
 
        }else{
             return back()->with(['info' => 'No se pudo completar la acción...', 'estado' => 'error']);
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

        $horario=  Horario_medicoModel::find(decrypt($id));

        // verificar que no halla citas registrada para este horario
        $existe= $this->verificar_cita(decrypt($id));
        if($existe!=null && $existe!='[]'){
             return back()->with(['info' => 'Lo sentimos, no puedes eliminar este horario por que ya tiene citas agendadas', 'estado' => 'error']);
           
        }
        
        if(isset($horario)){
            $horario->activo=0; //eliminado por estado
            $horario->save();
            return back()->with(['info' => 'El horario se ha eliminado con exito', 'estado' => 'success']);
        }
    }
}
