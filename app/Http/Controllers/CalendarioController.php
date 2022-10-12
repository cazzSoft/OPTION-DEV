<?php

namespace App\Http\Controllers;


use App\CalendarioModel;
use App\CatalogoModel;
use App\Mail\CitaMail;
use App\Mail\SendMails;
use App\Medio_reserva_citaModel;
use App\TipoCatalogoModel;
use App\TipoUserModel;
use App\user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Log;
use Mail;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_medios=Medio_reserva_citaModel::where('activo',1)->get();
        return view('agenda.calendario',['lista_medio'=>$lista_medios]);
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

    public function fecha()
    {
        return env('APP_URL');
        $date = Carbon::now()->locale(Session::get('language'));
        $date->locale();    
        $fecha= $date->isoFormat('dddd, D MMM YYYY '); 

       
    }

    public function enviar()
    {
        // $para=$datos['email'];
        $para='notifycost@gmail.com';
        
        // configuracion para guardar copias de los emails
        $email_tipo=CatalogoModel::where('codigo','EMCT')->first()->idcatalogo;
        $copia_cc=TipoCatalogoModel::where('atributo','cc')->where('idcatalogo',$email_tipo)->first();
        $copia_bcc=TipoCatalogoModel::where('atributo','bcc')->where('idcatalogo',$email_tipo)->first();
      
        try {
            Mail::to($para)
            ->cc($copia_cc->valor)
            ->bcc($copia_bcc->valor)
            ->send(new SendMails());
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
        
              
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
        $lista=CalendarioModel::with('usuario')->where('activo',1)->where('estado','AG')->where('iduser',auth()->user()->id)->get();
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

    public function infoCalendario()
    {  
        return view('agenda.calendario',['info'=>'Cita agendada con éxito','estado'=>'success']);
    }
    public function store(Request $request)
    {
       
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
       
      
        // formato de fecha para 
        $date = Carbon::parse($request->fecha)->locale(Session::get('language'));   
        $fecha= $date->isoFormat('dddd, D MMM YYYY ');


        // validacion de usuario quien esta registrando datos
        if( decrypt($request->iden)=='dr'){
            $idmedico=$iduser;
        }else{
            $idmedico=$request->idmedico;
        }
        
        if($request->idpaciente){
            // registro de cita
            $idpaciente=decrypt($request->idpaciente);

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
            ],['email.unique'=>'El campo email '.$request->email.' ya existe en nuestros registros.']);

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $id=decrypt($id);
        $cita=CalendarioModel::find($id);
       
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

        
        
        // actualizamos datos de la cita médica
        $iduser= Auth()->User()->id;
        $hora_inicio= substr($request->hora, 0, 5);
        $hora_fin= substr($request->hora, 6, 5);

        
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
