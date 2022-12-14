<?php

namespace App\Http\Controllers;


use App\CalendarioModel;
use App\CatalogoModel;
use App\Horario_medicoModel;
use App\Http\Controllers\AgendaCitaPaciente;
use App\Http\Controllers\GestionHorarioMedicoController;
use App\Mail\CitaMail;
use App\Mail\SendMails;
use App\Medio_reserva_citaModel;
use App\Targeta_citaModel;
use App\TipoCatalogoModel;
use App\TipoTargetaModel;
use App\TipoUserModel;
use App\user;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Log;
use Mail;

class CalendarioController extends Controller
{
    
    protected $horario_lab; 
    protected $cita_paciente;

    public function __construct(GestionHorarioMedicoController $horario_lab, AgendaCitaPaciente $cita_paciente)
    {   
        // $this->middleware('auth'); 
        $this->horario_lab=$horario_lab;
        $this->cita_paciente=$cita_paciente;
    }


    public function index()
    {   
        $lista_medios=Medio_reserva_citaModel::where('activo',1)->get();

        // horario laboral del medico 
        $lista_horario= $this->horario_de_cita(auth()->user()->id,date('w'),date('Y-m-d'));
       
        return view('agenda.calendario',['lista_medio'=>$lista_medios,'horario_cita'=>$lista_horario]);
    }

    // obtener horario laboral de citas del medico
    public function horario_de_cita($iduser,$num_dia,$fecha='')
    {
        
        if($num_dia==null && $num_dia==''){
            $num_dia= date('w');
        }

        // horarios del medico
        $lista_horarios=DB::table('horario_medico')
                                ->leftJoin('horario_dias','horario_dias.idhorario_medico','=','horario_medico.idhorario_medico')
                                ->leftJoin('dias','dias.iddias','=','horario_dias.iddias')
                                ->where('dias.valor','=',$num_dia)
                                ->where('horario_medico.idmedico',$iduser)
                                ->where('horario_medico.estado','=',1)
                                ->where('horario_medico.activo','=',1)
                                ->orderBy('hora_inicio','asc')
                                ->get();
        $horarios=[];
       

        if ($lista_horarios!='null' && $lista_horarios!='[]' ) {
            
            foreach ($lista_horarios as $key => $value) {
                $aux_array=[];
                
                    // seccionamos las citas para este dia
                    // $horario_cita= $this->horario_lab->obtener_cantidad_citas($value['hora_inicio'],$value['hora_fin'],'');
                    $horario_cita= $this->horario_lab->obtener_cantidad_citas($value->hora_inicio,$value->hora_fin,'',$value->num_cita,$value->idmedico,$fecha);
                    // $horarios= array_merge($horarios, $horario_cita['hora_cita']);
                    array_push($horarios,$horario_cita);
            }

            $lista_hora_cita=[];
            foreach ($horarios as $key => $value) {
                $lista_hora_cita= array_merge($lista_hora_cita,$value['hora_cita']);
            }

            return $lista_hora_cita;
        }else{
            return $lista_hora_cita=null;
        }
    }

    // get horario de acuerdo al dia seleccionado en el calendario para mostrar horarios a los medicos
    public function get_horario_dia($fecha)
    {
        $num_dia= Carbon::parse($fecha)->format('w');
       
        $lista_horario=$this->horario_de_cita(auth()->user()->id,$num_dia,$fecha);  

        if($lista_horario!=null && $lista_horario!='[]'){
            return response()->json([
                    'jsontxt'=> ['estado'=>'success'],
                    'request'=> $lista_horario
                ],200);
        }else{
            return response()->json([
                    'jsontxt'=> ['estado'=>'error','msm'=>'No dispones de ningún horario, te sugerimos que configures un horario laboral en configuraciones 
                    '],
            ],500);
        }
       
    }

    public function create()
    {
        //
    }

    public function fecha()
    {
         env('APP_URL');
       return $date = Carbon::now();
      return  $date->locale();    
      return  $fecha= $date->isoFormat('dddd, D MMM YYYY '); 

       
    }

    public function enviar()
    {
        // $para=$datos['email'];
        $para='notifycost@gmail.com';
        
        // configuracion para guardar copias de los emails
        $email_tipo=CatalogoModel::where('codigo','EMCT')->first()->idcatalogo;
        $copia_cc=TipoCatalogoModel::where('atributo','cc')->where('idcatalogo',$email_tipo)->first();
        $copia_bcc=TipoCatalogoModel::where('atributo','bcc')->where('idcatalogo',$email_tipo)->first();
      
        
            Mail::to($para)
            ->cc($copia_cc->valor)
            ->bcc($copia_bcc->valor)
            ->send(new SendMails());
            return 1;
        
                  
    }

    // funcion para mostrar el form registro de citas
    public function getFormCita($request)
    {   
        
       
        $fecha_formato_str= strtotime($request);
        $fecha_formato_par=Carbon::parse($request);
        $fecha= $fecha_formato_par->format('Y-m-d');
        $mes_text=$fecha_formato_par->monthName;
        $año= $fecha_formato_par->format('Y');
        $hora= $fecha_formato_par->format('G:00');
        $num_semana=$fecha_formato_par->format('Y-m-01');

        $semana_del_mes= date('W',$fecha_formato_str) - date("W",strtotime($fecha_formato_par->format('Y-m-01'))) + 1;

        return view('agenda.formRegistroCita',['hora'=>$hora,'fecha'=>$fecha,'año'=>$año,'mes'=>$mes_text,'semana'=>$semana_del_mes]);
    }

    public function getListaCitas()
    {
        $lista=CalendarioModel::with('usuario')->where('activo',1)->where('estado','AG')->where('idmedico',auth()->user()->id)->get();
        $array=[];
        foreach ($lista as $key => $value) {
            $item=[ 
                    'id'=> encrypt($value->idagenda),
                    'title'=>'Cita médica:'.$value->usuario[0]['name'],
                    'start'=>$value->fecha.'T'.$value->hora_inicio,
                    'end'=>$value->fecha.'T'.$value->hora_fin,
                    'color'=>$value->color
                    ];
            array_push($array,$item);
        }
        return response()->json($array);
    }

    // public function infoCalendario()
    // {  
    //     return view('agenda.calendario',['info'=>'Cita agendada con éxito','estado'=>'success']);
    // }
   

    public function store(Request $request)
    { 
        try {
            //validaciones requeridas y unicas de los campos
            $validator = Validator::make($request->all(), [
                'titulo' => 'required|string',
                'fecha' => 'required|string',
                'hora' => 'required',
                'tipo_cita' => 'required',
                'idmedio_reserva' => 'required',
            ],['tipo_cita.required'=>'El campo agregar canal es obligatorio.']);

             if ($validator->fails()) {
                 return response()->json([
                     'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                     'request'=> $validator->errors()->all(), //msm de los campos requeridos

                 ],501);//Not Implemented
             }

            $iduser= Auth()->User()->id;
            $tipo_us='us';
            $hora_inicio= substr($request->hora, 0, 5);
            $hora_fin= substr($request->hora, 6, 5);
           
            
            // validacion de cupos para este dia
            $existe_cita= $this->horario_lab-> disponible_cita($hora_inicio,$hora_fin,auth()->user()->id,$request->fecha);
            // $cupos_asignados=$this->get_cupos_citas($request->fecha,$hora_inicio,$hora_fin,auth()->user()->id);
            
            if($existe_cita==0){
                return response()->json([
                    'jsontxt'=>['msm'=>'Ya no tienes cupos para agentar esta cita en este horario','estado'=>'error']
                ],200);
            }

            // validacion de citas repetidas
            $existe_cita_en_fh=CalendarioModel::where('fecha',$request->fecha)->where('hora_inicio',$hora_inicio)->where('hora_fin',$hora_fin)->first();

            if (isset($existe_cita_en_fh)) {
                 return response()->json([
                     'jsontxt'=>['msm'=>'Ya tienes registrada una cita para este horario ','estado'=>'error']
                 ],200);
             }

             
            // formato de fecha para 
            $date = Carbon::parse($request->fecha);   
            $fecha= $date->isoFormat('dddd, D MMM YYYY');


            // validacion de usuario quien esta registrando datos
            if( decrypt($request->iden)=='dr'){
                $idmedico=$iduser;
            }else{
                $idmedico=$request->idmedico;
            }
            

            if($request->idpaciente){
                // registro de cita
                $idpaciente=decrypt($request->idpaciente);

                // numero de citas agendadas
                $num_citas=CalendarioModel::where('idpaciente',$idpaciente)->where('activo',1)->count();

                // registro de datos
                $cita=new CalendarioModel();
                $cita->idpaciente=$idpaciente; // indicamos el paciente
                $cita->iduser= $iduser; // usuario quien hace el registro
                $cita->idmedico=$idmedico; // medico asignado
                $cita->fecha=$request->fecha;
                $cita->titulo=$request->titulo;
                $cita->detalle=$request->detalle;
                $cita->hora_inicio=$hora_inicio;
                $cita->hora_fin=$hora_fin;
                $cita->estado='AG';
                $cita->activo=1;
                $cita->color='#c3eaf3';
                $cita->idmedio_reserva=$request->idmedio_reserva;
                $cita->tipo_cita=$request->tipo_cita;
                $cita->nuevo_paciente=0;
                

                if($cita->save()){
                    // notificar paciente
                    $datos=[
                            'titulo'=> $cita->titulo,
                            'fecha' => $fecha,
                            'lugar' => $cita->detalle,
                            'email' => $request->email,
                            'hora'  => $request->text_hora,
                    ];
                    $resul=$this->envioMails($datos,'nt-cita');
                    
                    //  registro valor de pago
                    if($num_citas!=0){
                        $targeta=TipoTargetaModel::where('codigo','N')->first();
                        $consulta=Targeta_citaModel::where('idtipo_targeta',$targeta->idtipo_targeta)->first();
                    }else{
                        $targeta=TipoTargetaModel::where('codigo','G')->first();
                        $consulta=Targeta_citaModel::where('idtipo_targeta',$targeta->idtipo_targeta)->first();
                    }
                     $pago= $this->cita_paciente->registrar_pagoCita($cita->idagenda,$consulta->idtargeta_cita);
                  
                    // verificar el envio de correo..
                    if($resul){
                        $msm=' se le ha notificado al paciente sobre este evento.';
                    }else{
                        $msm=' no se pudo notificar al paciente sobre este evento.';
                    }

                    return response()->json([
                            'jsontxt'=> ['msm'=>'Cita agendada con éxito, '.$msm,'estado'=>'success']
                        ],200);
                }   

            }else{

                //validación de usuarios
                $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ],['email.unique'=>'El paciente con el correo: "'.$request->email.'" ya existe en nuestros registros.']);

                 if ($validator->fails()) {
                     return response()->json([
                         'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                         'request'=> $validator->errors()->all(), //msm de los campos requeridos

                     ],501);//Not Implemented
                 }

                // registro de paciente
                $password_raw='o2h'.rand(100,1000);

                $paciente= new user();
                $paciente->name=$request->name;
                $paciente->email=$request->email;
                $paciente->idtipo_user=TipoUserModel::where('abr',$tipo_us)->first()->idtipo_user;
                $paciente->telefono=$request->telefono;
                $paciente->img='img/user.png';
                $paciente->password=Hash::make($password_raw);
                 
                if($paciente->save()){
                    // numero de citas agendadas
                    $num_citas=CalendarioModel::where('idpaciente',$paciente->id)->where('activo',1)->count();

                    // registro de cita
                    $cita=new CalendarioModel();
                    $cita->idpaciente=$paciente->id; // indicamos el paciente
                    $cita->iduser= $iduser; // usuario quien hace el registro
                    $cita->idmedico=$idmedico; // medico asignado
                    $cita->fecha=$request->fecha;
                    $cita->titulo=$request->titulo;
                    $cita->detalle=$request->detalle;
                    $cita->hora_inicio=$hora_inicio;
                    $cita->hora_fin=$hora_fin;
                    $cita->estado='AG';
                    $cita->activo=1;
                    $cita->color='#c3eaf3';
                    $cita->idmedio_reserva=$request->idmedio_reserva;
                    $cita->tipo_cita=$request->tipo_cita;
                    $cita->nuevo_paciente=1;
                   

                   if($cita->save()){
                       // notificar paciente
                        $datos=[
                                'titulo'=> $cita->titulo,
                                'fecha' => $fecha,
                                'lugar' => $cita->detalle,
                                'email' => $paciente->email,
                                'hora' => $request->text_hora,
                                'password'=>$password_raw
                        ];

                        $resul= $this->envioMails($datos,'nt-nuevo');
                        

                        //  registro valor de pago
                        if($num_citas!=0){
                            $targeta=TipoTargetaModel::where('codigo','N')->first();
                            $consulta=Targeta_citaModel::where('idtipo_targeta',$targeta->idtipo_targeta)->first();
                        }else{
                            $targeta=TipoTargetaModel::where('codigo','G')->first();
                            $consulta=Targeta_citaModel::where('idtipo_targeta',$targeta->idtipo_targeta)->first();
                        }
                         $pago= $this->cita_paciente->registrar_pagoCita($cita->idagenda,$consulta->idtargeta_cita);

                        // verificar el envio de correo..
                        if($resul){
                            $msm=' se le ha notificado al paciente sobre este evento.';
                        }else{
                            $msm=' no se pudo notificar al paciente sobre este evento.';
                        }

                        return response()->json([
                               'jsontxt'=> ['msm'=>'Cita agendada con éxito, '.$msm,'estado'=>'success']
                           ],200);
                   }   
                }
            }
        } catch (\Throwable $th) {
            Log::error("CalendarioController Error store" . $th->getMessage());
            return response()->json([
                   'jsontxt'=> ['msm'=>'Lo sentimos.. Algo ha ido mal inténtalo más tarde','estado'=>'error']
               ],501);
        }
    }

    public function save_cita_paciente(Request $request)
    {
        
        try {
           $idtargeta=decrypt($request->idtargeta_cita); 
        } catch (\Throwable $e) {
            return response()->json([
                 'jsontxt'=>['msm'=>'Algo ha ido mal, intententa nuevamente','estado'=>'error'],
                ],200);//Not Implemented
        }


        // asignamos fecha en caso que no tenga
        if($request->fecha==null || $request->fecha==""){
            $fecha_=date('Y-m-d');
        }else{
            $fecha_=$request->fecha;
        }

        //validaciones requeridas y unicas de los campos
        $validator = Validator::make($request->all(), [
            'detalle' => 'required|string',
            'horas' => 'required',
        ],['detalle.required'=>'El campo Motivo de consulta es obligatorio.',
            'horas.required'=>'Por favor debes seleccionar un horario para agendar tu cita..']);

         if ($validator->fails()) {
             return response()->json([
                 'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                 'request'=> $validator->errors()->all(), //msm de los campos requeridos

             ],501);//Not Implemented
         }
         
         // validacion del formato de la imagen
        if($request->TotalImages!=0 && $request->TotalImages!='undefined'){
          
            $validator = Validator::make($request->all(), 
                [
                    'img_examenes' =>'required',
                    'img_examenes.*' =>'mimes:jpg,jpeg,bmp,png,jfif,pdf,tif,webp,gif,svg'
                ],[
                    'img_examenes.mimes'=>'Error de formato en los archivos que intentas subir  formato recomendados:PDF, JPG, BMP, GIF, PNG, TIF, WEBP'
            ]);

            if ($validator->fails()) {
                return response()->json([
                     'jsontxt'=>['msm'=>'Error de formato en los archivo','estado'=>'error'],
                     'request'=> $validator->errors()->all(), //msm de los campos requeridos

                ],501);//Not Implemented
            }
        }
         
        // variable de control de registro de cita
        $iduser= Auth()->User()->id;
        $hora_inicio= substr($request->horas, 0, 5);
        $hora_fin= substr($request->horas, 6, 5);
        
        // validamos que no agende cita para el mismo horario en caso este disponible
        $consulta=CalendarioModel::where('idpaciente',$iduser)
                                    ->where('fecha',$request->fecha)
                                    ->where('hora_inicio',$hora_inicio)
                                    ->where('hora_fin',$hora_fin)
                                    ->where('estado','AG')
                                    ->where('activo',1)
                                    ->first();
        if(isset($consulta)){
            return response()->json([
                'jsontxt'=>['msm'=>'Ya tienes agendada una cita para este horario','estado'=>'error']
            ],200);
        }
        
        // obtener medico con horario disponible para agendar cita
        $medico_disponible=$this->get_cupos_citas($request->fecha,$hora_inicio,$hora_fin,$request->idmedico);
        
        if($medico_disponible<=0){
            return response()->json([
                'jsontxt'=>['msm'=>'Lo sentimos. No fue posible agendar la cita para este horario. Te sugerimos que seleccione otra fecha','estado'=>'error']
            ],200);
        }

        // formato de fecha para notificar a los usuarios
        $date = Carbon::parse($request->fecha)->locale(Session::get('language'));   
        $fecha= $date->isoFormat('dddd, D MMM YYYY ');
        
        // registro de cita
        $cita=new CalendarioModel();
        $cita->idpaciente=$iduser; // indicamos el paciente
        $cita->iduser= $iduser; // usuario quien hace el registro
        $cita->idmedico=$medico_disponible; // medico asignado
        $cita->fecha=$fecha_;
        $cita->titulo=substr($request->detalle, 0, 8);
        $cita->detalle=$request->detalle;
        $cita->hora_inicio=$hora_inicio;
        $cita->hora_fin=$hora_fin;
        $cita->estado='AG';
        $cita->activo=1;
        $cita->color='#c3eaf3';
        $cita->idmedio_reserva=1;
        $cita->tipo_cita='virtual';
        $cita->nuevo_paciente=0;
        

        if($cita->save()){
            
             // validar si existen archivos para registrar
            if($request->TotalImages!=0 && $request->TotalImages!='undefined'){
                $resul=$this->cita_paciente->registrar_archivos($request->img_examenes,$cita->idagenda);
            }

            // registrar valor de la cita agendada
            $this->cita_paciente->registrar_pagoCita($cita->idagenda,$idtargeta);
           
            // notificar paciente
            $datos=[
                    'titulo'=> null,
                    'fecha' => $fecha,
                    'lugar' => null,
                    'email' => auth()->user()->email,
                    'hora'  => $request->horas,
            ];

            $resul=$this->envioMails($datos,'nt-cita');
            
            //notificar al medico
            $medico=User::find($cita->idmedico);
            if(isset($medico)){
                $datos_m=[
                        'titulo'=> auth()->user()->name.' '.auth()->user()->apellido.' ha agendado una cita.',
                        'fecha' => $fecha,
                        'telefono' =>'Telefono del paciente: '. auth()->user()->telefono,
                        
                        'email' => $medico->email,
                        'hora'  => $request->horas,
                ];
                
                $resul=$this->envioMails($datos_m,'nt-medico');
            }
             

            return response()->json([
                    'jsontxt'=> ['msm'=>'Cita agendada con éxito. ','estado'=>'success']
                ],200);
        }
        
    }


    // envio de correos electronicos
    public function envioMails($datos,$tipo_notify)
    {   
        try {
            
            $para=$datos['email'];
            // $para='notifycost@gmail.com';

            // configuracion para guardar copias de los emails
            $email_tipo=CatalogoModel::where('codigo','EMCT')->first()->idcatalogo;
            $copia_cc=TipoCatalogoModel::where('atributo','cc')->where('idcatalogo',$email_tipo)->first();
            $copia_bcc=TipoCatalogoModel::where('atributo','bcc')->where('idcatalogo',$email_tipo)->first();

            Mail::to($para)
                ->cc($copia_cc->valor)
                ->bcc($copia_bcc->valor)
                ->send(new CitaMail($tipo_notify,$datos));
                // ->queue(new CitaMail($tipo_notify,$datos));
           
            return 1;
         } catch (\Throwable $th) {
            return 0;
        }
                 
    }

    // funcion para obtener cupos de citas para paciente
    public function get_cupos_citas($fecha,$hora_inicio,$hora_fin,$idmedico)
    {
     
        $dia= Carbon::parse($fecha)->format('w');
        
        // verificacion de si existe este horario registrado
        $existe_cita= CalendarioModel::where('idmedico',$idmedico)
                                   ->where('hora_inicio',$hora_inicio)
                                   ->where('hora_fin',$hora_fin)
                                   ->where('fecha',$fecha)
                                   ->where('estado','AG')
                                   ->where('activo',1)
                                   ->get();
        if(count($existe_cita)!=0){
            // ya existe la cita para este horario, encontrar medico con este horario
            $consulta=DB::table('horario_medico')
                            ->leftJoin('horario_dias','horario_dias.idhorario_medico','=','horario_medico.idhorario_medico')
                            ->leftJoin('dias','dias.iddias','=','horario_dias.iddias')
                            ->where('dias.valor','=',$dia)
                            
                            ->where('horario_medico.hora_inicio','<=',$hora_inicio)
                            ->where('horario_medico.hora_fin','>=',$hora_inicio)

                            ->where('horario_medico.hora_inicio','<=',$hora_fin)
                            ->where('horario_medico.hora_fin','>=',$hora_fin)

                            ->where('horario_medico.estado','=',1)
                            ->where('horario_medico.activo','=',1)
                            ->orderBy('hora_inicio','asc')
                            ->get();
            
            if( $consulta!=null &&  $consulta!='[]'){

                $horarios=[];
                foreach ($consulta as $key => $value) {
                   
                    // seccionamos el horario para encontrar la cita 
                    $horario_cita= $this->horario_lab->obtener_cantidad_citas($value->hora_inicio,$value->hora_fin,'',$value->num_cita,$value->idmedico,$fecha);
                    $horarios= array_merge($horarios, $horario_cita['hora_cita']);
                }
                
                // validar cita disponible
                $valor_hora=$hora_inicio.' '.$hora_fin;
                $horarios_=[];
                foreach ($horarios as $key => $val) {
                    if(Str::slug($val['valor_h'],"")==Str::slug($valor_hora,"")){

                        if($val['estado']==1){
                            array_push($horarios_, $val);   
                            return $val['idm'];
                        }
                         
                    }
                   
                }

                // no se encontro horario disponible para esos datos
               return 0;
            }else{
                return 0;
            }
            
        }else{
            // esta disponible el medico para estee horario
            return $idmedico;
        }
    
    }


    // lista de usuarios
    public function obtenerUsuarios($value='')
    {
        try {

                $idtipo_user= TipoUserModel::where('abr','us')->first()->idtipo_user;
                $usuarios=user::where('name','like','%'.$value.'%')
                                ->where('idtipo_user',$idtipo_user)
                                ->orWhere('telefono','like','%'.$value)
                                ->orWhere('celular','like','%'.$value)
                                ->orWhere('email','like','%'.$value.'%')
                                ->get();

                // creamos la lista de user
                $listaUser=[];
                if(isset($usuarios) && $usuarios!=null){
                    foreach ($usuarios->take(10) as $key => $items) {
                        $item='
                                <a  class="dropdown-item-user-cita" onclick="obtenerUsuario(\' '.encrypt($items['id']).'\')">
                                  <p class="mt-2 text-name-user">
                                     <i class="fas fa-user mr-2 text-info"></i> 
                                     <b>'.$items['name'].'</b><br>
                                     <span class="ml-5 text-muted text-sm">'.$items['telefono'].'</span> - 
                                     <span class=" text-muted text-sm">'.$items['email'].'</span>
                                  </p>
                                </a>
                            ';
                            array_push($listaUser,$item);

                    }
                }
                 return response()->json([
                       'jsontxt'=> ['estado'=>'success'],
                       'request'=> $listaUser
                    ],200);

         } catch (\Throwable $th) {
            return response()->json([
                'jsontxt'=>['msm'=>'No se completo la acción'.$th->getMessage(),'estado'=>'error'],
            ],500);
        }
        
    }

    // selecionar usuario
    public function selectUser($id)
    { 
       
        try {
            $id=decrypt($id);
            $consul=user::find($id);
            
            if(isset($consul)){
                if($consul->telefono){
                    $telefono=$consul->telefono;
                }else{
                    $telefono=$consul->celular;
                }
                $array=[
                        'id'=>encrypt($consul->id),
                        'name'=>$consul->name,  
                        'telefono'=>$telefono,
                        'email'=>$consul->email,

                    ];
                return response()->json([
                    'jsontxt'=>['estado'=>'success'],
                    'request'=>$array
                ],200);
            }else{
                return response()->json([
                   'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
                ],501); 
            }
        } catch (\Throwable $th) {
            return response()->json([
                    'jsontxt'=>['msm'=>'No se completo la acción intente nuevamente, '.$th->getMessage(),'estado'=>'error'],
                    ],500);
        }
    }


    public function edit($id)
    {
        try {
            $id=decrypt($id);
            $consul=CalendarioModel::with('usuario')->find($id);
            if(isset($consul)){
                return response()->json([
                    'jsontxt'=>['estado'=>'success'],
                    'request'=>$consul
                ],200);
            }else{
                return response()->json([
                   'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
                ],501); 
            }
            } catch (\Throwable $th) {
                return response()->json([
                        'jsontxt'=>['msm'=>'No se completo la acción intente nuevamente, '.$th->getMessage(),'estado'=>'error'],
                ],500);
        }
    }

   // actualizar datos de la cita
    public function update(Request $request, $id)
    {
        try {
            
            $id=decrypt($id);
            $cita=CalendarioModel::find($id);
           
            //validaciones requeridas y unicas de los campos
            $validator = Validator::make($request->all(), [
                'titulo' => 'required|string',
                'fecha' => 'required|string',
                'hora' => 'required',
                'tipo_cita' => 'required',
                'idmedio_reserva' => 'required',
            ],['tipo_cita.required'=>'El campo agregar canal es obligatorio.']);

             if ($validator->fails()) {
                 return response()->json([
                     'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                     'request'=> $validator->errors()->all(), //msm de los campos requeridos

                 ],501);//Not Implemented
             }

            $cntr=0; //controlar el envio de email si se cambia el correo del paciente
            $ctlr=0;
            $msm='';
            
            // datos para enviar emails
            $date = Carbon::parse($request->fecha)->locale(Session::get('language'));   
            $fecha= $date->isoFormat('dddd, D MMM YYYY');
            $password_raw='o2h'.rand(100,1000);
            $datos=[
                    'titulo' => $request->titulo,
                    'fecha'   => $fecha,
                    'lugar'   => $request->detalle,
                    'email'   => $request->email,
                    'password'=>$password_raw,
                    'hora'    => $request->text_hora,
            ];

            // Format de hora 
            $hora_inicio= substr($request->hora, 0, 5);
            $hora_fin= substr($request->hora, 6, 5);


            // validacion de citas repetidas
            if($hora_inicio!=$cita->hora_inicio || $hora_fin!=$cita->hora_fin){
                $existe_cita_en_fh=CalendarioModel::where('fecha',$request->fecha)->where('hora_inicio',$hora_inicio)->where('hora_fin',$hora_fin)->where('idmedico',auth()->user()->id)->first();
                if (isset($existe_cita_en_fh)) {
                     return response()->json([
                         'jsontxt'=>['msm'=>'Lo sentimos ya tienes registrada una cita para este horario ','estado'=>'error']
                     ],200);
                 }
            }
           
            // validacion de cupos para este dia y fecha
            if( $request->fecha!=$cita->fecha){
                // $cupos_asignados=$this->get_cupos_citas($request->fecha,$hora_inicio,$hora_fin,auth()->user()->id);
                $existe_cita= $this->horario_lab->disponible_cita($hora_inicio,$hora_fin,auth()->user()->id,$request->fecha);
                if($existe_cita==0){
                    return response()->json([
                        'jsontxt'=>['msm'=>'Ya no tienes cupos para agentar esta cita en este horario','estado'=>'error']
                    ],200);
                }
            }
            
            // actualizamos datos de la cita médica
            $iduser= Auth()->User()->id;
            

            
            if($request->titulo!=$cita->titulo || $request->fecha!=$cita->fecha || $request->tipo_cita!=$cita->tipo_cita || $hora_inicio!=$cita->hora_inicio || $request->detalle!=$cita->detalle){
                $ctlr=1;
            }

            $cita->iduser= $iduser; // usuario quien hace el update
            $cita->fecha=$request->fecha;
            $cita->titulo=$request->titulo;
            $cita->detalle=$request->detalle;
            $cita->hora_inicio=$hora_inicio;
            $cita->hora_fin=$hora_fin;
            $cita->idmedio_reserva=$request->idmedio_reserva;
            $cita->tipo_cita=$request->tipo_cita;

         
            // actualizamos datos del usuario si el medico tiene acceso
            if($cita->nuevo_paciente){
                //validación de usuarios
                    $validator = Validator::make($request->all(), [
                        'name' => ['required'],
                    ]);

                     if ($validator->fails()) {
                         return response()->json([
                             'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                             'request'=> $validator->errors()->all(), //msm de los campos requeridos

                         ],501);//Not Implemented
                     }

                $paciente=user::find($cita->idpaciente);
                $paciente->name=$request->name;
                $paciente->telefono=$request->telefono;
                // $paciente->email=$request->email;
                $paciente->save();

                if( $paciente->email!= $request->email ){
                    //validación de usuarios
                    $validator = Validator::make($request->all(), [
                        'email' => ['required', 'string', 'email', 'unique:users'],
                    ],['email.unique'=>'Este email "'.$request->email.'" ya existe en nuestros registros.']);

                     if ($validator->fails()) {
                         return response()->json([
                             'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                             'request'=> $validator->errors()->all(), //msm de los campos requeridos

                         ],501);//Not Implemented
                     }
                    // enviar notificacion email
                    $paciente->password=Hash::make($password_raw);
                    $paciente->email=$request->email;
                    $paciente->save();
                    
                    $resul=$this->envioMails($datos,'nt-nuevo'); 

                    // verificar el envio de correo..
                    if($resul){
                        $msm=', se le ha notificado al paciente la actualización del evento.';
                    }else{
                        $msm=', no se pudo notificar al paciente sobre este evento.';
                    }
                    $cntr=1;
                }
            }

            if($cita->save()){
               
                // notificar paciente si no se notifico antes por cambio de email
                if($cntr!=1 && $ctlr==1){
                    
                    $resul=$this->envioMails($datos,'nt-update');

                    // verificar el envio de correo..
                    if($resul){
                        $msm=', se le ha notificado al paciente la actualización del evento.';
                    }else{
                        $msm=', no se pudo notificar al paciente sobre este evento.';
                    }
                    
                }

                return response()->json([
                        'jsontxt'=> ['msm'=>'Cita actualizada con éxito'.$msm,'estado'=>'success']
                    ],200);
            }    
        } catch (\Throwable $th) {
            Log::error("CalendarioController Error update" . $th->getMessage());
            return response()->json([
                   'jsontxt'=> ['msm'=>'Lo sentimos.. Algo ha ido mal inténtalo más tarde','estado'=>'error']
               ],501);
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

        try {
            $id=decrypt($id);
            $consul=CalendarioModel::find($id);
            if(isset($consul)){
               $consul->activo=0;
               $consul->save(); //estado a eliminado

               //notificacion de correo
                   
                $date = Carbon::parse($consul->fecha)->locale(Session::get('language'));   
                $fecha= $date->isoFormat('dddd, D MMM YYYY');
                $datos=[
                       'titulo'=> $consul->titulo,
                       'fecha' => $fecha,
                       'lugar' => $consul->detalle,
                       'email' => user::find($consul->idpaciente)->email,
                ];

               $resul=$this->envioMails($datos,'nt-delete'); 
                
                // verificar el envio de correo..
                if($resul){
                    $msm=' y se ha notificado al paciente la cancelación del evento.';
                }else{
                    $msm=' no se pudo notificar al paciente la cancelación del evento.';
                }
                return response()->json([
                    'jsontxt'=>['msm'=>'La cita se ha eliminado del calendario '.$msm,'estado'=>'success'],
                ],200);
            }else{
                return response()->json([
                   'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
                ],501); 
            }
            } catch (\Throwable $th) {
                return response()->json([
                        'jsontxt'=>['msm'=>'No se completo la acción intente nuevamente, '.$th->getMessage(),'estado'=>'error'],
                ],500);
        }
    }
}
