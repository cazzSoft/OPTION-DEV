<?php

namespace App\Http\Controllers;

use App\ArchivoCitaModel;
use App\CalendarioModel;
use App\CatalogoModel;
use App\Datos_medicosModel;
use App\Horario_medicoModel;
use App\Http\Controllers\GestionHorarioMedicoController;
use App\PagoCitaModel;
use App\Targeta_citaModel;
use App\TipoTargetaModel;
use Carbon\Carbon;
use DB;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Log;
use Storage;


class AgendaCitaPaciente extends Controller
{

    protected $horario_lab; 
    
    public function __construct(GestionHorarioMedicoController $horario_lab)
    {   
        // $this->middleware('auth'); 
        $this->horario_lab=$horario_lab;
    }

    public function index()
    {

        $num_citas=CalendarioModel::where('idpaciente',auth()->user()->id)->where('activo',1)->count();

        $tipo_tageta=TipoTargetaModel::where('codigo','G')->first();
        if($num_citas>0){
            $lista=Targeta_citaModel::orderBy('orden','asc')->with('Targeta_detalle')->where('estado',1)->where('activo',1)->where('idtipo_targeta','<>',$tipo_tageta['idtipo_targeta'])->get();
        }else{
            $tipo_tageta=TipoTargetaModel::where('codigo','N')->first();
            $lista=Targeta_citaModel::with('Targeta_detalle')->where('estado',1)->where('activo',1)->where('idtipo_targeta','<>',$tipo_tageta['idtipo_targeta'])->get();
        }

        return view('agenda.citaPaciente.gestionAgenda',['targetas'=>$lista]);
    }

    
    // vista para tomar datos para el agendamiento del paciente
    public function datos_agendamiento($idtp)
    {
        
        // tiene segunda cita
        $num_citas=CalendarioModel::where('idpaciente',auth()->user()->id)->where('activo',1)->where('estado','AT')->count();

        $datos_medicos=Datos_medicosModel::where('iduser',Auth()->user()->id)->first(); 

        if(isset($datos_medicos)){

            $datos_medicos=new Datos_medicosModel();
            $datos_medicos->tipo_sangre='ninguno';
            $datos_medicos->talla=0;
            $datos_medicos->peso=0;
            $datos_medicos->iduser=Auth()->user()->id;
            $datos_medicos->save();

        }

        // datos de fecha header
        $date = date('Y-m-d');
        $fecha_formato_str= strtotime($date);
        $fecha_formato_par=Carbon::parse($date);
        // $fecha= $fecha_formato_par->format('Y-m-d');
        $mes_text=$fecha_formato_par->monthName;
        $año= $fecha_formato_par->format('Y');
        $num_semana=$fecha_formato_par->format('Y-m-01');

        $semana_del_mes= date('W',$fecha_formato_str) - date("W",strtotime($fecha_formato_par->format('Y-m-01'))) + 1;

        $fecha_ac= ['año'=>$año,'mes'=>$mes_text,'semana'=>$semana_del_mes];


        // horarios medicos disponibles
        $lista_horarios=Horario_medicoModel::where('activo',1)->where('estado',1)->orderBy('hora_inicio','asc')->get();
        if($lista_horarios=="[]" ){
            return back()->with(['info'=>'Lo sentimos por ahora no tenemos horarios disponibles..','estado'=>'info']);
        }
        
       
        // numero de citas asignada para este horario de este medico
        
        $fecha= new Carbon('tomorrow'); 
        $hoy_dia=$fecha->format('Y-m-d');
        $fecha_tomorrow = $fecha->format('Y-m-d');

        $lista_citas= $this->get_nuevo_horario_fecha($hoy_dia);

        if($lista_citas!=null){
            $lista_citas=implode($lista_citas);
            $cal_msm=null;
        }else{
            // return back()->with(['info'=>'Lo sentimos por ahora no tenemos horarios disponibles..','estado'=>'info']);
            $lista_citas=null;
            $cal_msm='Lo sentimos, no tenemos horarios disponibles para esa fecha.
                            Por favor selecciona otra horario.';
        }
        
        // return $lista_citas;
        return view('agenda.citaPaciente.agendar',
                ['datos_medicos'=>$datos_medicos,
                'dato_fecha'=>$fecha_ac,
                'lista'=>$lista_citas,
                'fehca_calendar'=>$fecha_tomorrow,
                'citas_AT'=>$num_citas,
                'cal_msm'=>$cal_msm,
                'idtargeta_cita'=>$idtp]);  
    }

    // registro de archivos de la cita
    public function registrar_archivos($archivos ,$idagenda)
    {
        $nombre='';
        $cantidad=count($archivos);
        $cont=0;
        foreach ($archivos as $key => $value) {
          $extension = pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION);
          
          $nombre='examen_'.date('Ymd_h_s').'.'.$extension;
            try {
               \Storage::disk('wasabi')->put('cita_medica_examenes/'.$nombre,\File::get($value));
            } catch (\Throwable $e) {
                \Storage::disk('diskDocumentos_medicos')->put('cita_medica_examenes/'.$nombre,\File::get($value));
            }
              // \Storage::disk('wasabi')->put('cita_medica_examenes/'.$nombre,\File::get($value));
              // \Storage::disk('diskDocumentos_medicos')->put($nombre,\File::get($value)); 

          $registrar= new ArchivoCitaModel();
          $registrar->idagenda=$idagenda;
          $registrar->ruta='cita_medica_examenes/'.$nombre;
          $registrar->name=$nombre;
          $registrar->ext=$extension;

          if ($registrar->save()) {
                $cont++;
          } 
        }

        if($cantidad == $cont){
            return 1;
        }else{
            return 0;
        }
        
    }

    // registrar pago de de la cita
    public function registrar_pagoCita($idagenda,$idtargeta_cita='')
    {
        try {
            $consulta=Targeta_citaModel::find($idtargeta_cita);
        } catch (\Throwable $e) {
            return 0; // no se registro valor a  pago
        }
            
        if(isset($consulta)){
            if($consulta->precio_usa==0){
                $estado='Pagado';
            }else{
                $estado='Pendiente';
            }

            $pago_cita= new PagoCitaModel();
            $pago_cita->valor=$consulta->precio_usa;
            $pago_cita->idagenda=$idagenda;
            $pago_cita->estado=$estado;
            $pago_cita->idtargeta_cita=$idtargeta_cita;
            
            if( $pago_cita->save() ){
                return 1; // registrado valor a pagar
            }
        }

        return 0;// no se registro valor a  pago
        
    }

    // horarios por fehca y dia
    public function get_nuevo_horario_fecha($fecha)
    {   
       
        $dia=Carbon::parse($fecha)->format('w');
        $lista_horarios=DB::table('horario_medico')
                            ->leftJoin('horario_dias','horario_dias.idhorario_medico','=','horario_medico.idhorario_medico')
                            ->leftJoin('dias','dias.iddias','=','horario_dias.iddias')
                            ->where('dias.valor','=',$dia)
                            ->where('horario_medico.estado','=',1)
                            ->where('horario_medico.activo','=',1)
                            ->orderBy('hora_inicio','asc')
                            ->get();

        if($lista_horarios=='[]'){
            return null;
        }
        // todos los horarios que hay disponible
        $horarios= $this->all_horarios($lista_horarios,$fecha);

        // mostrar las citas disponibles
        $lista_citas=[];
        if($horarios!=null){
            foreach ($horarios as $key => $value) {
                
                $ct=0;//controlar si no hay disponible
                foreach ($value as $z => $item) {
                    if($item['estado']){
                        $det='  <div  class="card text-center rounded-pill p-1 m-2 disponible border-secondary" onclick="select_cita(\''.$item['valor_h'].'\',\''.$item['idm'].'\',this)" style="width: 10rem;cursor: pointer;">
                                  <div class="card-body p-2 " >
                                    <span class=" font-weight-bold text-muted">'.$item['text_h'].'</span>
                                  </div>
                                </div>';
                        $ct=1;
                        break;
                    }else{
                        $ct=0;
                    }
                }

                // si no hay horario disponible mostramos no disponible
                if($ct==0){
                    
                    $det=' <div class="card text-center rounded-pill p-1 m-2 bz-desactiva  border-secondary" style="width: 10rem;">
                              <div class="card-body p-2 ">
                                <span class="font-weight-bold text-muted">'.$item['text_h'].'</span>
                              </div>
                            </div>';
                }


                // diseñamos el boton de cita
                array_push($lista_citas,$det);
            }

           return $lista_citas;
        }    
    }

    // nuevos horarios
    public function get_horario_citas_fechas($fecha)
    {
        $fecha_naw=date('Y-m-d');
        
        $fecha_max = date('Y-m', strtotime('+1 month'));
        
        $fecha_in=Carbon::parse($fecha)->format('Y-m');

        if($fecha>$fecha_naw && $fecha_in <= $fecha_max){
            $dia=Carbon::parse($fecha)->format('Y-m-d');
            $lista_citas=$this->get_nuevo_horario_fecha($dia);
            
            if($lista_citas==null){
               return response()->json([
                   'jsontxt'=>['msm'=>'Lo sentimos, no tenemos horarios disponibles para esa fecha.
                               Por favor selecciona otra fecha','estado'=>'error'],
                   'request'=>null, //msm de los campos requeridos
               ],501);//Not Implemented 
            }
            return response()->json([
                'jsontxt'=>['msm'=>'success','estado'=>'success'],
                'request'=>$lista_citas, 
            ],200);//success

        }else {
            return response()->json([
                'jsontxt'=>['msm'=>'Lo sentimos, no tenemos horarios disponibles para esa fecha.
                            Por favor selecciona otra fecha','estado'=>'error'],
                'request'=>null, //msm de los campos requeridos
            ],501);//Not Implemented
        }
       
    }

    // funcion para obtener todos los horarios disponibles
    public function all_horarios($lista_horarios,$fecha='')
    {
        $horarios=[];
        if ($lista_horarios!='null' && $lista_horarios!='[]' ) {

            foreach ($lista_horarios as $key => $value) {
               
                // seccionamos las citas para este dia
                $horario_cita= $this->horario_lab->obtener_cantidad_citas($value->hora_inicio,$value->hora_fin,'',$value->num_cita,$value->idmedico,$fecha);
                $horarios= array_merge($horarios, $horario_cita['hora_cita']);
            }

            $horarios_=[];

            // orden de citas
            asort($horarios);
            foreach ($horarios as $key => $val) {
                array_push($horarios_, $val);
            }
            // unset($horarios_[0]);

            // return ($horarios_); 

            // agrupar array
            $valores=[];
            foreach ($horarios_ as $key1 => $item1) {
                $array=[];

                foreach ($horarios_ as $j => $item2) {

                    if( $item1['valor_h'] == $item2['valor_h']){
                        array_push($array,$item2);
                        
                        unset($horarios_[$j]);
                    }
                }
                // return $array;
                if($array!=null){
                     array_push($valores,$array);
                }
               
            }

            return ($valores); 
        }

        return null;
    }

    // funcion que obtiene cntidad de cita del dia
    // public function obtener_cantidad_citas($hora_inicio,$hora_fin)
    // {
    //     $catalogo_tiempo=CatalogoModel::with('tipo_catalogo')->where('codigo','TPCM')->first();
    //     $tiempo_cita=$catalogo_tiempo['tipo_catalogo'][0]['valor'];

    //     $tiempo_cita= Carbon::parse($tiempo_cita)->format('i');
    //     $inicio = new Carbon( $hora_inicio);
    //     $fin = new Carbon( $hora_fin);

    //     $intervalo = new DateInterval('PT'.$tiempo_cita.'M');

    //     $fechas = new DatePeriod($inicio, $intervalo, $fin);

    //     $array_h=[];

    //     foreach($fechas as $fecha){
    //         $item= $fecha->format("H:i");
    //         array_push($array_h,$item);
    //     }
    //     return $array_h;
    // }



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
