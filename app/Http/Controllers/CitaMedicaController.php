<?php

namespace App\Http\Controllers;

use App\ArchivoCitaModel;
use App\CalendarioModel;
use App\Datos_medicosModel;
use App\Detalle_cita_medicaModel;
use App\Estado_CivilModel;
use App\GeneranCalculosModel;
use App\GrupoModel;
use App\Grupo_seccionesModel;
use App\Nivel_estudioModel;
use App\Opciones_preguntaModel;
use App\PreguntaModel;
use App\RazanModel;
use App\ReligionModel;
use App\RespuestaModel;
use App\Respuesta_citaModel;
use App\SeccionesModel;
use App\Secciones_preguntaModel;
use App\TipoPreguntaModel;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Log;

class CitaMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function iniciar_cita($idcita)
    {
        // try {
            $fecha_actual=Carbon::now()->toDateString();
           
            $idcita=decrypt($idcita);
            $consulta=CalendarioModel::with('usuario')->where('idagenda',$idcita)->first();

            // verificar fecha para iniciar la cita
            if($consulta->fecha < $fecha_actual){
                return back()->with(['info'=>'Lo sentimos no se pueden iniciar citas atrasadas.  ','estado'=>'error']);
            }
            $lista_ecivil=Estado_CivilModel::all();
            $lista_nivel_e=Nivel_estudioModel::all();
            $lista_religion=ReligionModel::all();
            $lista_raza=RazanModel::all();

            $date = Carbon::now()->locale(Session::get('language'));
            $date->locale();    
            $fecha= $date->isoFormat(' D MMMM YYYY ');

            // obtener numero de cita del paciente
            $num_cita=CalendarioModel::where('idpaciente',$consulta['usuario'][0]->id)
                                            ->where('estado','AT')
                                            ->where('activo',1)
                                            ->count();
            
            // obtener grupo 
            $grupo=$this->obtenerGrupoCita($num_cita);

            if($grupo!=null){
                // obtener secciones por grupo
                $secciones=$this->obtenerSecciones($grupo);
            }else{
                $secciones=[];
            }
           
            $data_segunda_cita=null;
            if($num_cita>=1){
                // obtener archivo para esta cita
                $doc=$this->obtenerArchivoCita($idcita);
                
                // datos de segunda cita
                $seg_cita=$this->obtenerDatosLasCita($consulta['usuario'][0]->id,$num_cita - 1);
                
                $data_segunda_cita=['arch'=>$doc,'datos_cita_last'=>$seg_cita];
            }
            // return [
            //         'datos_p'=>$consulta['usuario'][0],
            //         'datos_cita'=>$consulta,
            //         'lista_ecivil'=>$lista_ecivil,
            //         'lista_nivel_e'=>$lista_nivel_e,
            //         'lista_religion'=>$lista_religion,
            //         'lista_raza'=>$lista_raza,
            //         'fecha'=>$fecha,
            //         'lista_seccion'=>$secciones,
            //         'idcita'=>$idcita,
            //         'datos_sgd'=>$data_segunda_cita
            //     ];
            return view('agenda.cita_medica.inicio_cita',
                [
                    'datos_p'=>$consulta['usuario'][0],
                    'datos_cita'=>$consulta,
                    'lista_ecivil'=>$lista_ecivil,
                    'lista_nivel_e'=>$lista_nivel_e,
                    'lista_religion'=>$lista_religion,
                    'lista_raza'=>$lista_raza,
                    'fecha'=>$fecha,
                    'lista_seccion'=>$secciones,
                    'idcita'=>$idcita,
                    'datos_sgd'=>$data_segunda_cita
                ]);
        // } catch (\Throwable $th) {
        //     Log::error("CitaMedicaController Error iniciar_cita, " . $th->getMessage());
        //     return back();
        // }
    }

    // funcion para obtener datos de la ultima cita
    public function obtenerDatosLasCita($idpaciente,$num_cita)
    {
        try {
            $consul=DB::table('agenda')
                            ->leftJoin('cita_medica','agenda.idagenda','=','cita_medica.idagenda')
                            ->where('agenda.estado','AT')
                            ->where('agenda.activo',1)
                            ->where('agenda.idpaciente',$idpaciente)
                            ->get()
                            ->last();
            // verificar archivo para esta cita
            $doc_last=$this->obtenerArchivoCita($consul->idagenda);

            // obtener grupo 
            $grupo=$this->obtenerGrupoCita($num_cita);
            if($grupo!=null){
                // obtener secciones por grupo
                $secciones=$this->obtenerSecciones($grupo);
            }else{
                $secciones=[];
            }
            $fecha=Carbon::parse($consul->fecha_at);
            $fecha=$fecha->isoFormat('dddd, D MMM YYYY '); 
            return  $array_last_cita=['datos_cita'=>$consul,'fecha'=>$fecha,'lista_seccion'=>$secciones,'arch'=>$doc_last,'idcita'=>$consul->idagenda];   
        } catch (\Throwable $th) {
            Log::error("CitaMedicaController Error obtenerDatosLasCita, " . $th->getMessage());
            return [];
        }
    }

    // funcion para obtener grupo 
    public function obtenerGrupoCita($num_cita)
    {
        try {
            $confi_o2h_grupo=DB::table('catalogo')
                                ->leftJoin('tipo_catalogo','catalogo.idcatalogo','=','tipo_catalogo.idcatalogo')
                                ->where('catalogo.codigo','GSE')
                                ->first();

            // para activar un grupo especial
            if($num_cita==$confi_o2h_grupo->valor){
                return $grupo=GrupoModel::where('valor',$confi_o2h_grupo->valor)->first()->idgrupo;
            }else{
                return $grupo=GrupoModel::where('valor',$num_cita)->first()->idgrupo;
            }    
          } catch (\Throwable $th) {
                Log::error("CitaMedicaController Error obtenerGrupoCita, " . $th->getMessage());
                return null;
          }  
    }
    // funcion para obtener las secciones
    public function obtenerSecciones($grupo)
    {
        try {
            $secciones=DB::table('grupo_seccion')
                            ->leftJoin('secciones','grupo_seccion.idsecciones','=','secciones.idsecciones')
                            ->leftJoin('grupo','grupo_seccion.idgrupo','=','grupo.idgrupo')
                            ->where('secciones.activo',1)
                            ->where('secciones.estado',1)
                            ->where('grupo_seccion.activo',1)
                            ->where('grupo_seccion.idgrupo',$grupo)
                            ->orderBy('grupo_seccion.orden','asc')
                            ->get();
            return $secciones;   
        } catch (\Throwable $th) {
            Log::error("CitaMedicaController Error obtenerSecciones, " . $th->getMessage());
            return [];
        }
    }

    // funcion para obtener archivo de la cita
    public function obtenerArchivoCita($idcita)
    {
        try {
            $archivos= ArchivoCitaModel::where('idagenda',$idcita)->get(); 
            if($archivos!=null && $archivos!='[]'){
                $doc=[];
                //verificar si estan en el cloud
                foreach ($archivos as $key => $value) {
                   if(\Storage::disk('wasabi')->exists($value['ruta'])){
                        $url=\Storage::disk('wasabi')->temporaryUrl($value['ruta'], now()->addMinutes(3600)  );
                        $item=['url'=>$url,'name'=>$value['name'],'ext'=>$value['name']];
                        array_push($doc,$item);
                   }
                   else{
                        $item=['url'=>asset($value['ruta']),'name'=>$value['name'],'ext'=>$value['ext']];
                        array_push($doc,$item);
                   } 
                }
                return $doc;
            }else{
              return  $doc=[];
            }
        } catch (\Throwable $th) {
            Log::error("CitaMedicaController Error obtenerArchivoCita, " . $th->getMessage());
            return $doc=[];
        }
    }
    // obtener toda las pregunta de la seccion
    public function getPreguntasSeccion($idss,$idcita)
    {
        $ids=decrypt($idss);
        $idcita=decrypt($idcita);
        $lista_p=Secciones_preguntaModel::with('pregunta')->where('idsecciones',$ids)->orderBy('orden','asc')->get();
        
        $array_prgt=[];

        foreach ($lista_p as $key => $value) {

            //validacion de la pregunta visible
            if($value['pregunta'][0]['visiblle']){

                //id de la seccion
                $idseccion= encrypt( $value['idsecciones']);
                $idp=encrypt($value['idpregunta']);

                //verificacion de tipo de pregunta
                $tip_p=$value['pregunta'][0]['tipoPregunta'][0]['codigo'];

                // verificamos si tiene respuesta la pregunta para dicha cita
                $respuesta_p=Respuesta_citaModel::with('respuesta')->where('idpregunta',$value['idpregunta'])->where('idagenda', $idcita)->where('idsecciones', $ids)->first();

                if($tip_p=='sn'){//pregunta de Si y NO
                     
                    // variables para difinir espacio de columna en el componente
                    $col_p=$value['pregunta'][0]['col-pregt'];
                    $col_c=$value['pregunta'][0]['col-compt'];

                    // validacion de campo requerido
                    $required='';
                    $txt_require='';
                    if($value['pregunta'][0]['require']){
                        $required='required';
                        $txt_require=' <span class="text-red">*</span>';
                     }

                    // componente de pregunta
                    $componente=$value['pregunta'][0]['componentes'][0];

                    // opciones de la pregunta de si o no
                    $opc=$value['pregunta'][0]['opciones_pregunta'];

                    // variables para almacenar pregunta y opciones
                    $opciones_text=[];
                    $opciones_comp=[];

                    // nombre de clase para habilitar sub pregunta
                    $class_sub_p='class_sub_p_'.$value['pregunta'][0]['idpregunta'];
                    $name='pregunta_'.$value['pregunta'][0]['idpregunta'];
                    $id=$componente["type"].'_'.$value['pregunta'][0]['idpregunta'];

                    //verificamos si las pregunta requiere resaltado
                     $bg_color='text-info_';
                     if($value['pregunta'][0]['resalta_pregunta']){
                         $bg_color='bz-info text-dark';
                     }

                    //validar si la pregunta tiene preguntas hijas
                    $sub_prgt=PreguntaModel::with('opciones_pregunta','componentes','tipoPregunta')->where('idpregunta_padre',$value['idpregunta'])->get();

                    // descripción de la pregunta
                    $pregunta=' ';
                    if($value['pregunta'][0]['descripcion']!=null && $value['pregunta'][0]['descripcion']!=""){
                        
                        // recolectamos opciones de pregunta con descripcion
                        foreach ($opc as $z => $op) {
                            // funcion para guardar pregunta en la cita medica
                            $action_save='onchange="save_pregunta_cita(\''.$id.'_'.$z.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';

                            //obtenemos el valor de respuesta de la pregunta
                             $selected='';
                             if(isset($respuesta_p['respuesta'])){
                                // verificacion de respuesta
                                if($respuesta_p['respuesta'][0]['valor']==$op['opciones'][0]['valor']){
                                    $selected='checked';
                                }
                             }

                            // validamos si esta pregunta habilita a otras pregunta
                            if(isset($sub_prgt) && $sub_prgt!=null &&  $sub_prgt!='[]'){
                                //validamos tipo de opcion del radio para asignar funcion
                                if($op['active_sub_preg']==1){
                                    $funcion_class=' onchange="sub_pregunta(\''.$class_sub_p.'\',\''.encrypt($value['pregunta'][0]['idpregunta']).'\'),save_pregunta_cita(\''.$id.'_'.$z.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';
                                }else{
                                    $funcion_class=' onchange="sub_pregunta_hide(\''.$class_sub_p.'\'),save_pregunta_cita(\''.$id.'_'.$z.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';
                                }  
                            }else{
                                $funcion_class=$action_save;
                            }

                            $opc_='<dt class=" col-md-'.$col_c.' col-sm-3 text-info_ text-center">'.$op['opciones'][0]['descripcion'].'</dt>'; 
                            $opc_c='<dt class="col-md-'.$col_c.' col-sm-3 '.$bg_color.' text-info_ text-center"> 
                                        <div class="icheck-info">
                                            <input type="radio" '.$selected.'  value="'.$op['opciones'][0]['valor'].'" id="'.$id.'_'.$z.'" '.$funcion_class.'   name="'.$name.'" '.$required.' />
                                            <label for="'.$id.'_'.$z.'"></label>
                                        </div>
                                    </dt>
                            ';

                            array_push($opciones_text,$opc_);
                            array_push($opciones_comp,$opc_c);
                        }

                        // se verifica si tiene sub pregunta para reservar el espacio
                        if(isset($sub_prgt) && $sub_prgt!=null &&  $sub_prgt!='[]'){
                            $sub_pregunta='<div class="row '.$class_sub_p.' d-none col-6"> </div>';
                            if(isset($respuesta_p['respuesta'])){
                                // solo obtenermos pregunta si tiene respuesta de sub pregunta
                                $array_prgta=[]; 
                                $sub_pregunta_res=null;
                                foreach ($opc as $z => $op) {
                                    if($op['active_sub_preg']==1 && $respuesta_p['respuesta'][0]['valor']==$op['opciones'][0]['valor']){
                                          // obtener sub pregunta con su respuesta
                                        foreach ($sub_prgt as $key => $item) {
                                            // verificamos si tiene respuesta la pregunta para dicha cita
                                            $respuesta=Respuesta_citaModel::with('respuesta')->where('idpregunta',$item['idpregunta'])->where('idagenda', $idcita)->where('idsecciones',$ids)->first();
                                            
                                            $respuesta_='';
                                            if(isset($respuesta['respuesta'])){
                                                  $respuesta_=$respuesta['respuesta']; 
                                            } 
                                            $pregunta= $this->crear_pregunta($item,$respuesta_,$id,$idcita);
                                            array_push($array_prgta, $pregunta);
                                        }  
                                        $sub_pregunta_res=implode($array_prgta);
                                    }
                                }
                                if($sub_pregunta_res!=null){
                                    $sub_pregunta='<div class="row '.$class_sub_p.' col-6"> '.$sub_pregunta_res.' </div>';
                                }  
                           
                           }else{
                               $sub_pregunta='<div class="row '.$class_sub_p.' d-none col-6"> </div>';
                           }
                            // $sub_pregunta='<div class="row '.$class_sub_p.' d-none  col-6">  </div>';
                            
                        }else{
                            $sub_pregunta=' ';
                        }


                        // preguntas
                        $item_pregunta='<dl class="row">
                                            <dd class="col-md-'.$col_p.' col-sm-12 text-info_">'.$value['pregunta'][0]['descripcion'].' '.$txt_require.'</dd>
                                                '.implode($opciones_text).'
                                            </dl> 
                                        <dl class="row">
                                        <dt class="col-md-'.$col_p.' col-sm-6 '.$bg_color.' p-1"><span class="ml-2">'.$value['pregunta'][0]['pregunta'].'</span></dt>
                                            '.implode($opciones_comp).'
                                        </dl>
                                        '.$sub_pregunta;

                        array_push($array_prgt,$item_pregunta);

                    }else{
                        
                        $active_respuesta=0;
                        // para pregunta sin descripcion
                        // recolectamos opciones de pregunta con descripcion
                        foreach ($opc as $z => $op) {

                            // funcion para guardar pregunta en la cita medica
                            $action_save='onchange="save_pregunta_cita(\''.$id.'_'.$z.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';

                            // validamos si esta pregunta habilita a otras pregunta
                            if(isset($sub_prgt) && $sub_prgt!=null &&  $sub_prgt!='[]'){

                                //validamos tipo de opcion del radio para asignar funcion
                                if($op['active_sub_preg']==1){
                                    $funcion_class=' onchange="sub_pregunta(\''.$class_sub_p.'\',\''.encrypt($value['pregunta'][0]['idpregunta']).'\'), save_pregunta_cita(\''.$id.'_'.$z.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';
                                }else{
                                    $funcion_class=' onchange="sub_pregunta_hide(\''.$class_sub_p.'\'), save_pregunta_cita(\''.$id.'_'.$z.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';
                                }  
                                
                                // verificamos que si la respuesta pertenece a la opcion que contiene subpregunta
                                if(isset($respuesta_p['respuesta'])){
                                    if($op['active_sub_preg']==1 && $respuesta_p['respuesta'][0]['valor']==$op['opciones'][0]['valor']){
                                        $active_respuesta=1;
                                    }
                                }
                                  
                                // return  $respuesta_p['respuesta'][0]['valor'];
                            }else{
                                $funcion_class=$action_save;
                            }

                            //obtenemos el valor de respuesta de la pregunta
                             $selected='';
                             if(isset($respuesta_p['respuesta'])){
                                // verificacion de respuesta
                                if($respuesta_p['respuesta'][0]['valor']==$op['opciones'][0]['valor']){
                                    $selected='checked';
                                }
                             }

                            $opc_c='<dt class="col-md-'.$col_c.' col-sm-2  text-info_ text-center"> 
                                        <span class="mr-1">'.$op['opciones'][0]['descripcion'].'</span>
                                        <div class="icheck-info">
                                            <input type="radio" '.$selected.' value="'.$op['opciones'][0]['valor'].'" id="'.$id.'_'.$z.'" '.$funcion_class.'  name="'.$name.'" '.$required.' />
                                            <label for="'.$id.'_'.$z.'"></label>
                                        </div>
                                    </dt>
                                ';
                            array_push($opciones_comp,$opc_c);

                        }

                        // se verifica si tiene sub pregunta para reservar el espacio
                        if(isset($sub_prgt) && $sub_prgt!=null &&  $sub_prgt!='[]'){
                            $sub_pregunta='<div class="row '.$class_sub_p.' d-none "> </div>';
                            // $sub_pregunta='<div class="row '.$class_sub_p.' d-none">  </div>';
                            if(isset($respuesta_p['respuesta'])){

                                if($active_respuesta){
                                    $array_prgta=[]; 
                                    foreach ($sub_prgt as $key => $item) {
                                        // verificamos si tiene respuesta la pregunta para dicha cita
                                        $respuesta_p=Respuesta_citaModel::with('respuesta')->where('idpregunta',$item['idpregunta'])->where('idagenda', $idcita)->where('idsecciones', $ids)->first();
                                        
                                        $respuesta_='';
                                        if(isset($respuesta_p['respuesta'])){
                                            $respuesta_=$respuesta_p['respuesta'];
                                        }
                                        $pregunta= $this->crear_pregunta($item,$respuesta_,$id,$idcita);
                                        array_push($array_prgta, $pregunta);
                                    }
                                    $sub_pregunta='<div class="row  '.$class_sub_p.' ">'.implode($array_prgta).' </div>';
                                }
                            }
                        }else{
                            $sub_pregunta=' ';
                        }

                            // preguntas
                        $item_pregunta='<dl class="row">
                                            <dd class="col-md-'.$col_p.' col-sm-6  '.$bg_color.' ">'.$value['pregunta'][0]['pregunta'].' '.$txt_require.'</dd>
                                        </dl>
                                        <dl class="row">
                                            '.implode($opciones_comp).'
                                        </dl>'.$sub_pregunta;

                        array_push($array_prgt,$item_pregunta);

                    }

                }else {// all pregunta 

                   $respuesta='';
                   if(isset($respuesta_p['respuesta'])){
                        $respuesta=$respuesta_p['respuesta'];
                   }
                    $pregunta= $this->crear_pregunta($value['pregunta'][0],$respuesta,$ids,$idcita);
                    array_push($array_prgt, $pregunta); 
                }

            }
        }

        return response()->json([
            'jsontxt'=>['estado'=>'success'],
            'request'=>$array_prgt
        ],200);
    }

    // obtener solo pregunta
    public function getPreguntas($idp)
    {
        $id=decrypt($idp);
        $pregunta=PreguntaModel::with('opciones_pregunta','componentes','tipoPregunta')->where('idpregunta_padre',$id)->get();

        $data=[];

        if(isset($pregunta)){
            foreach ($pregunta as $key => $value) {

                 //validacion de la pregunta visible
                if($value['visiblle']){

                    $prg=$this->crear_pregunta($value);
                    array_push($data,$prg);

                }
            }
        }

        return response()->json([
            'jsontxt'=>['estado'=>'success'],
            'request'=>$data
        ],200);

    }

    // funcion para crear pregunta de acuerdo al tipo de componente
    public function crear_pregunta($value,$respuesta=null,$ids='',$idcita='')
    {
        // identificar cual es la seccion de las preguntas hijas
        if($value['idpregunta_padre']!=null  && $value['idpregunta_padre']!='0'){
            $idseccion=Secciones_preguntaModel::where('idpregunta',$value['idpregunta_padre'])->first()->idsecciones;
        }else{
            $idseccion=Secciones_preguntaModel::where('idpregunta',$value['idpregunta'])->first()->idsecciones;
        }

       //id de la seccion
        $idseccion=encrypt($idseccion);
        

        // id de la pregunta
        $idp=encrypt($value['idpregunta']);

        // variables para difinir espacio de columna en el componente
        $col_p=$value['col-pregt'];
        $col_c=$value['col-compt'];

        // variables para almacenar pregunta y opciones
        $array_preg=[];
        $opciones_comp=[];

        // tipo de componente
        $componente=$value['componentes'][0]['type'];

        // nombre de clase para habilitar sub pregunta
        $class_sub_p='class_sub_p_'.$value['idpregunta'];
        $name='pregunta_'.$value['idpregunta'];
        $id=$componente.'_'.$value['idpregunta'];

         //verificamos si las pregunta requiere resaltado
        $bg_color=" ";
        if($value['resalta_pregunta']){
            $bg_color='bz-info';
        }

        // validacion de campo requerido
        $required='';
        $txt_require='';
        if($value['require']){
            $required='required';
            $txt_require=' <span class="text-red">*</span>';
         }

        // identificamos si la pregunta genera resultado
        $action_resultado='';
        if($value['grupo_resultado']){
           $conulta=GeneranCalculosModel::where('pregunta1',$value['idpregunta'])->orWhere('pregunta2',$value['idpregunta'])->first();
           if(isset($conulta)){
               $idp1=$componente.'_'.$conulta['pregunta1'];
               $idp2=$componente.'_'.$conulta['pregunta2'];
               $idr=$componente.'_'.$conulta['resultado'];
                // funcion para hacer calculo y obtener resultado
                $action_resultado='onkeyup="calculo_resultado(\''.$idp1.'\',\''.$idp2.'\',\''.$idr.'\')"';
           }
        }

        
        //validar si la pregunta tiene preguntas hijas
        $sub_prgt=PreguntaModel::with('opciones_pregunta','componentes')->where('idpregunta_padre',$value['idpregunta'])->get();

        if($componente=='select'){

            // funcion para guardar pregunta en la cita medica
            $action_save='onchange="save_pregunta_cita(\''.$id.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';

            // COMPONENTE SELECT SEA MULTIPLE
            $op_multiple=' ';
            $name_=$name;
            if($value['componentes'][0]['tipo']){
                $op_multiple='multiple';
                $name_=$name.'[]';
            }
            
            // opciones para este componente
            $opc=$value['opciones_pregunta'];

            foreach ($opc as $z => $op) {
                $selected='';
                if($respuesta!='' && $respuesta!=null){
                    if($op_multiple!=''){
                        foreach ($respuesta as $key => $item) {
                           if($item['valor']==$op['opciones'][0]['valor']){
                                $selected='selected';
                            } 
                        }
                    }else{
                        if($respuesta[0]['valor']==$op['opciones'][0]['valor']){
                            $selected='selected';
                        }
                        
                    }
                }
                $opc_c='
                        <option '.$selected.' value="'.$op['opciones'][0]['valor'].'  ">'.$op['opciones'][0]['descripcion'].'</option> 
                    ';
                array_push($opciones_comp,$opc_c);
            }

            // pregunta
            $item_pregunta='<div class="col-md-'.$col_p.' col-sm-12">
                            <dl class="row" >
                                <dd  class="col col-sm-12 text-info_ '.$bg_color.'">'.$value['pregunta'].' '.$txt_require.'</dd>
                                <dl class="col-'.$col_c.' col-sm-12  text-info_ "> 
                                    <select  class="form-control select2 form-control-sm " '.$action_save.'  '.$op_multiple.' data-placeholder="'.$value['texto_placeholder'].'" style="width: 100%;" id="'.$id.'"  name="'.$name_.'" '.$required.'>
                                        <option ></option>
                                        '.implode($opciones_comp).'
                                    </select>
                                </dl>   
                            </dl> 
                        </div>';

            return $item_pregunta;

        }else if($componente=='radio'){

            // opciones para este componente
            $opc=$value['opciones_pregunta'];
            $active_respuesta=0;
            foreach ($opc as $z => $op) {

                // funcion para guardar pregunta en la cita medica
                $action_save='onchange="save_pregunta_cita(\''.$id.'_'.$z.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';

                // validamos si esta pregunta havilita a otras pregunta
                if(isset($sub_prgt) && $sub_prgt!=null &&  $sub_prgt!='[]'){
                    
                    //validamos tipo de opcion del radio para asignar funcion
                    if($op['active_sub_preg']==1){
                       
                        $funcion_class=' onchange="sub_pregunta(\''.$class_sub_p.'\',\''.encrypt($value['idpregunta']).'\'),save_pregunta_cita(\''.$id.'_'.$z.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';
                    }else{
                        
                        $funcion_class=' onchange="sub_pregunta_hide(\''.$class_sub_p.'\'),save_pregunta_cita(\''.$id.'_'.$z.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';
                    }

                    // verificamos que si la respuesta pertenece a la opcion que contiene subpregunta
                    if($respuesta!='' && $respuesta!=null){
                        if($op['active_sub_preg']==1 && $respuesta[0]['valor']==$op['opciones'][0]['valor']){
                            $active_respuesta=1;
                        }
                    }    
                }else{
                    $funcion_class=$action_save;
                }


                // validadmos el tamaño de las columna de los div col
                $col_=$col_c;
                if(strlen($op['opciones'][0]['descripcion'])>3){
                    $col_='col-3';
                }
                $checked='';
                
                // tiene respuesta la pregunta
                if($respuesta!='' && $respuesta!=null){
                    if($respuesta[0]['valor']==$op['opciones'][0]['valor']){
                        $checked='checked';
                    }
                }

                //se crea las opciones 
                $opc_c='
                    <dt class="col-'.$col_.' text-info_ text-center"> 
                        <span class="mr-1">'.$op['opciones'][0]['descripcion'].'</span>
                        <div class="icheck-info">
                            <input type="radio" id="'.$id.'_'.$z.'" '.$funcion_class.' '.$checked.' value="'.$op['opciones'][0]['valor'].'"  name="'.$name.'" />
                            <label for="'.$id.'_'.$z.'"></label>
                        </div>
                    </dt>
                    ';
                array_push($opciones_comp,$opc_c);
            }

            // se verifica si tiene sub pregunta para reservar el espacio
            if(isset($sub_prgt) && $sub_prgt!=null &&  $sub_prgt!='[]'){
                $sub_pregunta='<div class="row '.$class_sub_p.' d-none"> </div>';
                if($respuesta!='' && $respuesta!=null){
                    if($active_respuesta==1){
                        $array_prgt=[]; 
                        foreach ($sub_prgt as $key => $value) {
                            // verificamos si tiene respuesta la pregunta para dicha cita
                            $respuesta_p=Respuesta_citaModel::with('respuesta')->where('idpregunta',$value['idpregunta'])->where('idagenda', $idcita)->where('idsecciones', $ids)->first();
                            
                            $respuesta_='';
                            if(isset($respuesta_p['respuesta'])){
                                $respuesta_=$respuesta_p['respuesta'];
                            }
                            $pregunta= $this->crear_pregunta($value,$respuesta_,$id,$idcita);
                            array_push($array_prgt, $pregunta);
                        }
                        $sub_pregunta='<div class="row '.$class_sub_p.' ">'.implode($array_prgt).' </div>';
                    }
                }
            }else{
                $sub_pregunta=' ';
            }

            // se crea la pregunta
            $item_pregunta='<div class="col-'.$col_p.' ">
                                <dl class="row" >
                                    <dd  class="col col-sm-12 text-info_ '.$bg_color.'">'.$value['pregunta'].' '.$txt_require.'</dd>
                                    <dl class="row col-'.$col_p.'   text-info_ ">
                                        '.implode($opciones_comp).'
                                    </dl>   
                                </dl> 
                            </div>
                            '.$sub_pregunta.' ';

            return $item_pregunta;

        }else if($componente=='checkbox'){

        }else if($componente=='textarea'){

            // funcion para guardar pregunta en la cita medica
            $action_save='onblur="save_pregunta_cita(\''.$id.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';

            // tiene respuesta la pregunta
            $valor='';
            if($respuesta!='' && $respuesta!=null){
               $valor=$respuesta[0]['valor'];
            }

            // pregunta
            $item_pregunta='<div class="col-md-'.$col_p.' col-sm-12">
                                <dl class="row" >
                                    <dd  class="col col-sm-12 text-info_ '.$bg_color.'">'.$value['pregunta'].' '.$txt_require.'</dd>
                                    <dl class="col-'.$col_c.' col-sm-12  text-info_ "> 
                                        <textarea '.$action_save.' name="'.$name.'" id="'.$id.'" rows="4" class="form-control form-control-sm shadow-sm border-white"  placeholder="'.$value['texto_placeholder'].'" value="111'.$valor.'" '.$required.' >'.$valor.'</textarea>
                                    </dl>   
                                </dl> 
                            </div>';
            return $item_pregunta;
        }else{

            $valor='';
            // tiene respuesta la pregunta
            if($respuesta!='' && $respuesta!=null){
               $valor=$respuesta[0]['valor'];
            }

            // validacion de componete con decimal
            if($value['componentes'][0]['tipo']=='decimal'){
                $step='step="0.1"';
            }else{
               $step='';
            }

            // evento para tipo de componete
            if($componente=='date'){
                
                // funcion para guardar pregunta en la cita medica
                $action_save='onchange="save_pregunta_cita(\''.$id.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';
            
            }else{
                // funcion para guardar pregunta en la cita medica
                $action_save='onblur="save_pregunta_cita(\''.$id.'\',\''.$idp.'\',\''.$idseccion.'\',this)"';
           
            }

            // pregunta
            $item_pregunta='<div class="col-md-'.$col_p.' col-sm-12">
                               <dl class="row" >
                                   <dd  class="col col-sm-12 text-info_ '.$bg_color.'">'.$value['pregunta'].' '.$txt_require.'</dd>
                                   <dl class="col-'.$col_c.' col-sm-12  text-info_ "> 
                                   <input type="'.$componente.'" '.$step.' name="'.$name.'" '.$action_save.'  id="'.$id.'" class="form-control form-control-sm shadow-sm border-white"  placeholder="'.$value['texto_placeholder'].'" value="'.$valor.'"  autocomplete="off" '.$action_resultado.'  '.$required.' >
                                   </dl>   
                               </dl> 
                           </div>';
           return $item_pregunta;
        }

    }

    // actualizacion de datos general del paciente
    public function updatePaciente(Request $request)
    {
        // try {
        $idp=decrypt($request->idp);
        $paciente=User::find($idp);
        $campo= $request['campo'];

        //validaciones requeridas y unicas de los campos
        $validator = Validator::make($request->all(), [
            'valor' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json([
               'jsontxt'=>['msm'=>'El campos es requerido y no puede estar vacío ','estado'=>'error'],
                     'request'=> $validator->errors()->all(), //msm de los campos requeridos
                 ],501);//Not Implemented
       }

       $paciente->$campo=$request->valor;

       if($paciente->save()){   
            $edad= Carbon::parse($paciente->fecha_nacimiento)->age;  
            return response()->json([
                'jsontxt'=> ['msm'=>'El campo fue actualizado con éxito..','estado'=>'success','edad'=>$edad]
            ],200);
        }else{
            return response()->json([
                'jsontxt'=> ['msm'=>'Lo sentimos no se pudo actualizar el campo','estado'=>'error']
                                ],501);//Not Implemented
        }  
            // } catch (\Throwable $th) {
            //     return response()->json([
            //         'jsontxt'=>['msm'=>'Lo sentimos algo salio mal, intente nuevamente'.$th->getMessage(),'estado'=>'error'],
            //     ],500);
            // }
    }

    // actualizacion de datos medicos del paciente
    public function updatePaciente_datosMedicos(Request $request)
    {
        $idp=decrypt($request->idp);
        $paciente=Datos_medicosModel::where('iduser',$idp)->first();
        $campo= $request['campo'];

        //validaciones requeridas y unicas de los campos
        $validator = Validator::make($request->all(), [
            'valor' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'jsontxt'=>['msm'=>'El campos es requerido y no puede estar vacío ','estado'=>'error'],
                              'request'=> $validator->errors()->all(), //msm de los campos requeridos
                          ],501);//Not Implemented
        }


        $paciente->$campo=$request->valor;

        if($paciente->save()){   
              
             return response()->json([
                 'jsontxt'=> ['msm'=>'El campo fue actualizado con éxito..','estado'=>'success']
             ],200);
         }else{
             return response()->json([
                 'jsontxt'=> ['msm'=>'Lo sentimos no se pudo actualizar el campo','estado'=>'error']
                                 ],501);//Not Implemented
         }     
    }

    // guaradar datos de la cita medica
    public function store(Request $request)
    {
        //función para validar datos
        $messages = [
            'img_receta.mimes'=>'El campo receta que se va a administrar al paciente debe ser un archivo con formato: jpg, jpeg, png o pdf',
            'diagnostico_presuntivo.required' => ' El campo Diagnóstico presuntivo es obligatorio',
            'motivo_cita.required' => ' El campo Motivo de cosulta  es obligatorio',  
        ];

        $request->validate([
            'img_receta' => 'mimes:jpg,jpeg,png,pdf',
            'diagnostico_presuntivo' => 'required',
            'motivo_cita' => 'required',
        ],$messages); 
 
        // validacion de imagen y guardado
        $nombre='';
        if($request->img_receta!=null){
            $img= $request->file('img_receta');
            $extension = pathinfo($img->getClientOriginalName(), PATHINFO_EXTENSION);
            
            $nombre='recta-'.date('Ymd_h_s').'.'.$extension;
            
            try {
                \Storage::disk('wasabi')->put('cita_medica_recetas/'.$nombre,\File::get($img));
            } catch (\Throwable $e) {
                \Storage::disk('diskRecetamedica')->put('recta_medica/'.$nombre,\File::get($img));
            }  
        }
        
        //guardado de datos
        $cita_medica=new Detalle_cita_medicaModel();
        $cita_medica->motivo_cita=$request->motivo_cita;
        $cita_medica->diagnostico_presuntivo=$request->diagnostico_presuntivo;
        $cita_medica->idagenda= decrypt($request->idcita_medica);
        $cita_medica->fecha=date('Y-m-d H:i:s');
        $cita_medica->img_receta=$nombre;

        if($cita_medica->save()){
            // cambio de estado para la cita 
            $agenda=CalendarioModel::find(decrypt($request->idcita_medica));
            $agenda->estado='AT';
            $agenda->fecha_at= date('Y-m-d H:i:s');
            $agenda->detalle= $request->motivo_cita;
            $agenda->save();
             return redirect('calendario');
        }else{
             return back()->with(['info' => 'Error no se pudo registrar los datos', 'estado' => 'error']);
        }

    }

    // guardar pregunta de la cita medica
    public function save_pregunta(Request $request)
    {
        // validacion de parametros por alguna inconsistencias
        try {

           $idpregunta=decrypt($request->idp);
           $idagenda=decrypt($request->idagenda);
           $idsecciones=decrypt($request->ids);
           $valor=$request->valor;
        } catch (\Throwable $th) {
            return response()->json([
                'jsontxt'=>['msm'=>'lo sentimos encontramos inconsistencias en los datos','estado'=>'error'],
            ],501); 
        
        }

        //validaciones requeridas y unicas de los campos
        $consulta=PreguntaModel::find($idpregunta);

        if(isset($consulta)){
            if($consulta->require){
                $messages = [
                    'idp.required' => ' El campo es requerido y obligatorio', 
                    'idagenda.required' =>'El campo es requerido y obligatorio', 
                    'ids.required' => ' El campo es requerido y obligatorio', 
                    'valor.required' => ' El campo es obligatorio y no lo puedes dejar vacío', 
                ];

                $validator = Validator::make($request->all(), [
                    'idp' => 'required',
                    'idagenda' => 'required',
                    'ids' => 'required',
                    'valor' => 'required',
                ],$messages);

                if ($validator->fails()) {
                    return response()->json([
                        'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                        'request'=> $validator->errors()->all(), //msm de los campos requeridos

                    ],501);//Not Implemented
                }
            }
        }
            
        
        // buncamos el dato a registrar caso contrario lo guardamos
        $consul=Respuesta_citaModel::where('idpregunta',$idpregunta)->where('idagenda', $idagenda)->where('idsecciones', $idsecciones)->first();
        if(isset($consul)){
            // actualiza respuesta de la pregunta
            // insertamos la respuesta o el valor obtenido de la pregunta
            if(is_array($request->valor)){

                // la pregunta tinene varias respuestas
                try {
                        $respuesta=  RespuestaModel::where('idrespuesta_cita',$consul->idrespuesta_cita)->delete();
                        foreach ($request->valor as $key => $value) {
                            // la pregunta solo tiene una respuesta
                            $respuesta= new RespuestaModel();
                            $respuesta->valor=$value;
                            $respuesta->idrespuesta_cita=$consul->idrespuesta_cita;
                            $respuesta->save();
                        }
                        
                        return response()->json([
                             'jsontxt'=>['msm'=>'Se han actualizado las respuestas de esta pregunta con exito','estado'=>'info'],
                        ],200);//success

                } catch (\Throwable $e) {
                        return response()->json([
                            'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción','estado'=>'error']
                        ],501);//Not Implemented     
                }
            }else{

                // validacion de pregunta que requiera otras pregunta
                $tiene_hijos=Respuesta_citaModel::where('idpregunta_padre',$idpregunta)->where('idagenda', $idagenda)->where('idsecciones', $idsecciones)->get();
                if(isset($tiene_hijos) && $tiene_hijos!=null && $tiene_hijos!="[]"){
                   
                    foreach ($tiene_hijos as $key => $value) {
                       $tiene_respuesta= RespuestaModel::where('idrespuesta_cita',$value->idrespuesta_cita)->get();
                       if (isset($tiene_respuesta) && $tiene_respuesta!="[]") {
                            $tiene_respuesta= RespuestaModel::where('idrespuesta_cita',$value->idrespuesta_cita)->delete();
                            $respuesta_cita=Respuesta_citaModel::find($value->idrespuesta_cita);
                            if (isset($respuesta_cita)) {
                                $respuesta_cita->delete();
                            }
                       }
                    }

                }
                
                // la pregunta solo tiene una respuesta
                // $respuesta=  RespuestaModel::find($consul->idrespuesta_cita);
                $respuesta=  RespuestaModel::where('idrespuesta_cita',$consul->idrespuesta_cita)->first();
                $respuesta->valor=$valor;

                if( $respuesta->save()){
                     return response()->json([
                         'jsontxt'=>['msm'=>'Se ha actualizado la respuesta de esta pregunta con exito','estado'=>'info'],
                    ],200);//success
                }else{
                    return response()->json([
                        'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción','estado'=>'error']
                    ],501);//Not Implemented 
                }
            }

        }else{
           
            // validamos si la pregunta tiene padre
            $tiene_padre=PreguntaModel::find($idpregunta);

            if(isset($tiene_padre)){
                $idpregunta_padre=$tiene_padre['idpregunta_padre'];
            }else{
                $idpregunta_padre=0;
            }
           


            // guarda la pregunta 
            $repuesta_pregunta=new Respuesta_citaModel();
            $repuesta_pregunta->idpregunta=$idpregunta;
            $repuesta_pregunta->idagenda=$idagenda;
            $repuesta_pregunta->idsecciones=$idsecciones;
            $repuesta_pregunta->idpregunta_padre=$idpregunta_padre;

            if($repuesta_pregunta->save()){
                // insertamos la respuesta o el valor obtenido de la pregunta
                if(is_array($request->valor)){
                    // la pregunta tinene varias respuestas
                    try {
                            foreach ($request->valor as $key => $value) {
                                $respuesta= new RespuestaModel();
                                $respuesta->idrespuesta_cita=$repuesta_pregunta->idrespuesta_cita;
                                $respuesta->valor=$value;
                                $respuesta->save();   
                            }

                            return response()->json([
                                  'jsontxt'=>['msm'=>'Se han guardado las respuestas de esta pregunta con exito','estado'=>'success'],
                             ],200);//success  

                    } catch (\Throwable $e) {
                            return response()->json([
                                'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción','estado'=>'error']
                            ],501);//Not Implemented 
                    }
                       
                }else{
                    // la pregunta solo tiene una respuesta
                    $respuesta= new RespuestaModel();
                    $respuesta->idrespuesta_cita=$repuesta_pregunta->idrespuesta_cita;
                    $respuesta->valor=$valor;
                    $respuesta->save();
                }

                 return response()->json([
                     'jsontxt'=>['msm'=>'Se ha guardado la respuesta de esta pregunta con exito','estado'=>'success'],
                ],200);//success
            }else{
                return response()->json([
                    'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción','estado'=>'error']
                ],501);//Not Implemented 
            }
            
        }
        
    }
    
    // obtener datos del paciente
    public function obtenerPaciente($idp)
    {
        try {
            $idp=decrypt($idp);
            $consulta=User::find($idp)->select('name')->get();
            $lista_ecivil=Estado_CivilModel::all();
            $lista_nivel_e=Nivel_estudioModel::all();
            $lista_religion=ReligionModel::all();
            $lista_raza=RazanModel::all();
            
            return response()->json([
               'jsontxt'=>['msm'=>'success','estado'=>'success'],
               'request'=>$consulta
           ],200); 
        } catch (\Throwable $th) {
            Log::error("CitaMedicaController Error obtenerPaciente" . $th->getMessage());
            return response()->json([
                'jsontxt'=>['msm'=>'lo sentimos encontramos inconsistencias en los datos','estado'=>'error'],
            ],501);
        }
    }
    public function show($id)
    {
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 2;
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
           $id= decrypt($id);
            //función para validar datos
            $messages = [
                // 'img_receta.mimes'=>'El campo receta que se va a administrar al paciente debe ser un archivo con formato: jpg, jpeg, png o pdf',
                'diagnostico_presuntivo.required' => ' El campo Diagnóstico presuntivo es obligatorio',
                'motivo_cita.required' => ' El campo Motivo de cosulta  es obligatorio',  
            ];

            $validator = Validator::make($request->all(), [
                // 'img_receta' => 'mimes:jpg,jpeg,png,pdf',
                'diagnostico_presuntivo' => 'required',
                'motivo_cita' => 'required',
            ],$messages); 

            if ($validator->fails()) {
                return response()->json([
                    'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                    'request'=> $validator->errors()->all(), //msm de los campos requeridos
                ],501);//Not Implemented
            }
           
            //guardado de datos
            $cita_medica= Detalle_cita_medicaModel::find($id);
            $cita_medica->motivo_cita=$request->motivo_cita;
            $cita_medica->diagnostico_presuntivo=$request->diagnostico_presuntivo;

            if($cita_medica->save()){
                // cambio de estado para la cita 
                $agenda=CalendarioModel::find($cita_medica->idagenda);
                $agenda->detalle= $request->motivo_cita;
                $agenda->save();
                return response()->json([
                    'jsontxt'=>['msm'=>'Se actualizaron los datos con éxito ','estado'=>'success'],
                    'request'=> $validator->errors()->all(), //msm de los campos requeridos
                ],200);//
             
            }else{
                return response()->json([
                    'jsontxt'=>['msm'=>'Error no se pudo actualizar los datos ','estado'=>'success'],
                    'request'=> $validator->errors()->all(), //msm de los campos requeridos
                ],200);//
             
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
        //
    }
}
