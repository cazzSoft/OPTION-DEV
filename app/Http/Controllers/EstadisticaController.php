<?php

namespace App\Http\Controllers;

use App\CalendarioModel;
use App\Medio_reserva_citaModel;
use App\TipoUserModel;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $anio=date('Y');
        $anio_anterior=date('Y')-1;

        $citas=CalendarioModel::where('fecha','LIKE',$anio.'%')->where('estado','AT')
                                                    ->where('activo','1')->orderBy('fecha', 'asc')->get();

        $citas_reservadas_actual=$citas->count();
        $citas_reservadas_anterior=CalendarioModel::where('fecha','LIKE',$anio_anterior.'%')->where('estado','AT')
                                                    ->where('activo','1')->count();
        $tipo_pacinete=TipoUserModel::where('abr','us')->first()->idtipo_user;
        $citas_reservadas_paciente= DB::table('agenda')
                        ->join('users','agenda.iduser','=','users.id')
                        ->where('users.idtipo_user',$tipo_pacinete)
                        ->where('fecha','LIKE',$anio.'%')
                        ->where('estado','AT')
                        ->where('activo','1')
                        ->count();
        
        $incremento_prgt=(($citas_reservadas_actual-$citas_reservadas_anterior) / $citas_reservadas_anterior)*100;

        // citas reservada dentro y fuera del horario de trabajo
        $fuera_h=0;
        $dentro_h=0;
        
        foreach ($citas as $key => $value) {
            
            $date = Carbon::parse($value->created_at);
            $hora= $date->toTimeString();
            $dia= $date->format('N');
            
            if($dia!=6 && $dia!=7){
                
                if($hora >= '08:00:00' && $hora <= '17:00:00'){
                    $dentro_h++; 
               }else{
                    $fuera_h++;
               }
            }else{
                $fuera_h++;
            }
               
        }
        
        $fuera_h= number_format(($fuera_h/$citas_reservadas_actual)*100,2);
        $dentro_h=number_format(($dentro_h/$citas_reservadas_actual)*100,2);

      
        // lugar de reservación de citas
        $m_o2h=Medio_reserva_citaModel::where('codigo','O2H')->first()->idmedio_reserva;
        $num_o2h=$citas->where('idmedio_reserva',$m_o2h)->count();
        $prct_o2h=number_format(($num_o2h/$citas_reservadas_actual)*100,1);

        $m_consultorio=Medio_reserva_citaModel::where('codigo','CTO')->first()->idmedio_reserva;
        $num_consultorio=$citas->where('idmedio_reserva',$m_consultorio)->count();
        $prct_consultorio=number_format(($num_consultorio/$citas_reservadas_actual)*100,1);

        $m_buzon=Medio_reserva_citaModel::where('codigo','BZV')->first()->idmedio_reserva;
        $num_buzon=$citas->where('idmedio_reserva',$m_buzon)->count();
        $prct_buzon=number_format(($num_buzon/$citas_reservadas_actual)*100,1);

        $m_campania=Medio_reserva_citaModel::where('codigo','CMP')->first()->idmedio_reserva;
        $num_campania=$citas->where('idmedio_reserva',$m_campania)->count();
        $prct_campania=number_format(($num_campania/$citas_reservadas_actual)*100,1);

        
        $data=$this->getDatos($anio);
       
        return view('estadistica.estadisticaCitas',[
            'total_citas'=>$citas_reservadas_actual,
            'crecimiento'=>$incremento_prgt,
            'citas_online'=>$citas_reservadas_paciente,
            'cita_dentro_horario'=>$dentro_h,
            'cita_fuera_horario'=>$fuera_h,
            'prct_o2h'=>$prct_o2h,
            'prct_cnsl'=>$prct_consultorio,
            'prct_bzn'=>$prct_buzon,
            'prct_cmp'=>$prct_campania,
            'areaChartData'=>$data
        ]);
    }

    // obtener datos graficas
    public function getDatos($anio)
    {   

        $citas=CalendarioModel::where('fecha','LIKE',$anio.'%')->where('estado','AT')
                                    ->where('activo','1')->orderBy('fecha', 'asc');
        
        $array=[];
        
        foreach ($citas->get() as $key => $value) {
            $fecha=Carbon::parse($value->fecha)->format('Y-m');
            array_push($array,$fecha);
        } 
         
        $dataVirtual=[];
        $dataPrecen=[];
        
        foreach (array_unique($array ) as $z => $item) {
            $precencial=CalendarioModel::where('fecha','LIKE',$item.'%')->where('estado','AT')
                                ->where('activo','1')->where('tipo_cita','precencial')->count();

            $vitual=CalendarioModel::where('fecha','LIKE',$item.'%')->where('estado','AT')
                                ->where('activo','1')->where('tipo_cita','virtual')->count();
           
            array_push($dataVirtual,$vitual);
            array_push($dataPrecen,$precencial);
           
        }

        $ult_mes = Carbon::parse(end($array).'-25')->format('m');

        if($ult_mes<='09'){

            $fecha_sum=''.$anio.'-'.$ult_mes.'-01';
            $con=0;
           
                $fecha_formato_par=Carbon::parse($fecha_sum);
                $sum_mes=$fecha_formato_par;
                mes:
                $sum_mes=$sum_mes->addMonths(1);
                array_push($array,$sum_mes->format('Y-m'));
                $con++;
                if($con<=2){
                    goto mes;
                }   
        }
       
        // creacion de labels grafica
        $labels=[];
        foreach (array_unique($array )as $i => $value) {
            $item_meces=Carbon::parse($value);
            array_push( $labels, substr(ucfirst($item_meces->monthName),0,3).' '.$item_meces->format('y') );
        }
        
        $areaChartData=[        
                'labels'=>$labels,
                'dataVirtual'=>$dataVirtual,
                'dataPrecen'=>$dataPrecen
        ];
        return  $areaChartData;     
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
