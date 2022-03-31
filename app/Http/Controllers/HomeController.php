<?php

namespace App\Http\Controllers;

use App\Actividad_userModel;
use App\AreaModel;
use App\ArticuloModel;
use App\CiudadModel;
use App\CoinsultDetalleModel;
use App\CoinsultModel;
use App\EspecialidadesModel;
use App\Events\HomeEventLike;
use App\Events\HomeEventPerfilUser;
use App\Events\PerfilUserEventUsuario;
use App\Http\Controllers\CoinsultController;
use App\Http\Controllers\NotificacionController;
use App\Inters_userModel;
use App\LikeUsersModel;
use App\NoticiaModel;
use App\Notificacion;
use App\NotificacionDetalleModel;
use App\Registro_ActividadModel;
use App\TemasModel;
use App\TipoUserModel;
use App\TituloModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Str;
class HomeController extends Controller
{
     
    protected $notify;
    protected $coins;

    public function __construct(NotificacionController $notify, CoinsultController $coins)
    {   
        $this->notify=$notify;
        $this->coins=$coins;
        $this->middleware('auth');
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(), 
            $perPage,
            $page,
            $options,
        );
    }

    public function index()
    {
         
        //datos iniciales del paciente para mostrar posibles enfermedades
            //paciente identificador
            $id=auth()->user()->id;
            //Edad del paciente
            $fecha_nacimiento = Carbon::createFromDate(auth()->user()->fecha_nacimiento)->age;
             // $fecha_nacimiento=30;
            //sexo del paciente
            $sexo=auth()->user()->genero;
            //tienes hijos
            $tiene_hijos=auth()->user()->tine_hijo;

            if($sexo){
                $sexop1='hombres';  $sexop2='hombreshombresymujeres'; $sexop3='hombresymujeres'; 
            }else{ 
                $sexop1= 'mujeres'; $sexop2='mujeresmujeresyhombres'; $sexop3='mujeresyhombres'; 
            }

            
             $array_temas=null;
            //consultar sus temas elegidos
            $temas=Inters_userModel::with('temas')->where('iduser',$id)->first();
            if(isset($temas['temas'])){
                 $tema=  $temas['temas']['area_desc'];
                 $splay = Str::slug($tema,", ");
                 $array_temas= explode(', ', $splay );
            }else{
                // asignamos tema aleatorio
                // $temas=TemasModel::inRandomOrder()->first();
                // $tema=  $temas['area_desc'];
                // $splay = Str::slug($tema,", ");
                // $array_temas= explode(', ', $splay );

            }
        
            
            //verificar si no tiene hijo pero el tema si
            //si tiene hijos
            if($tiene_hijos){
                $tiene_hijos= rand(1,18);
            }else{
                if(Str::contains('pediatria, infantil', $array_temas)){ 
                    $tiene_hijos= rand(1,18);
                }
            }
          
        //lista de enfermedades
        $enfermedades=ArticuloModel::inRandomOrder()->withCount(['like'])
                ->with(['like'=>function($q){
                            $q->select(['*'])->where('iduser',auth()->user()->id)->get();
                    }])->where('tipo','N')
                ->where('publicar','1')
                ->where('estado','1')
                ->Where('afecta_desc','like','%'.$sexop1.'%')
                ->orderBy('idarticulo','desc')
                ->get();
        
        //array principales
        $array1=[];
        $array2=[];
        $array3=[];
        $array4=[];
        //array axiliares
        $array1ax=[];
        $array2ax=[];
        $array3ax=[];
        $array4ax=[];
        //array axiliares 2
        $array1t=[];
        $array2t=[];
        $array3t=[];
        $array4t=[];
        //array axiliares 3
        $array1r=[];
        $array2r=[];
        $array3r=[];
        $array4r=[];
        
        
        
        foreach ($enfermedades as $key => $value) {
           
            //trasnformamos a texto plano
            $titulo = Str::slug($value->afecta_desc, ""); //sexo
            $vartx = Str::slug($value['area_desc'],", "); //areas
            //verificamos si tiene hijos para mostrar posibles enfermedades
            if ($tiene_hijos) {

                if( Str::contains( $vartx, $array_temas) ){//filtrado de tema
                    
                    ///////////obtenemos sexo prioritario (H o M) par su hji@s
                    if(Str::startsWith($titulo, 'mujeresyhombres') || Str::startsWith($titulo, 'hombresymujeres')){ 
                        if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){ 
                            array_push($array1t,$value);
                        } 
                    }else if(Str::startsWith($titulo, 'mujeresmujeresyhombres') || Str::startsWith($titulo, 'hombreshombresymujeres')){
                        if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                            array_push($array2t,$value);
                        } 
                    }else{
                        if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                            array_push($array3t,$value);
                        } 
                    }

                }else{
                    //posibles enfermedades de interes del paciente
                    //prioridad 1
                    if(strlen($titulo)==15 || strlen($titulo)==14){
                        //hijos hm edad hijo
                        if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                            array_push($array1,$value);
                         }else if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                            //paciente hm edad paciente
                            if(Str::startsWith($titulo, $sexop3)){ //
                                array_push($array1ax,$value);
                            }else{ 
                                array_push($array1r,$value);
                            }
                         }
                         
                    }else if(strlen($titulo)==22){ //hhym mmyh
                        //de acuerdo ala edad hijo
                        if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                            // array_push($array2,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$tiene_hijos.' - '.$value->edad_final.'] | '.$vartx.'|');
                             array_push($array2,$value);
                        }else if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                        //de acuerdo ala edad paciente
                            if(Str::contains($titulo, $sexop2)){ //

                                // array_push($array2ax,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx.'|'); 
                                  array_push($array2ax,$value);

                            }else{
                                // array_push($array2r,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx.'|'); 
                                  array_push($array2r,$value);
                            }
                            
                        } 
                       
                    }else {
                        if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                            // array_push($array3,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$tiene_hijos.' - '.$value->edad_final.'] | '.$vartx.'|');
                             array_push($array3,$value);
                        }else if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                            // array_push($array3ax,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx.'|');
                            array_push($array3ax,$value);
                        }else{
                             // array_push($array4,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx.'|');
                        }
                       
                    }
                    
                }

            }else{
               // return ['sex'=>$titulo,'temasEn'=>$vartx,'Temas'=>$array_temas] ;
                // return Str::contains( $vartx, $array_temas);
                //no tiene hijos pero si selecciono un tema
                if( Str::contains( $vartx, $array_temas) ){
    
                  //separamos de acuerdo al sexo y prioridad
                    if(strlen($titulo)==7){
                       //separamos del genero myh
                        if( Str::startsWith($titulo, $sexop1)){
                            //encagamos al rango de edad
                             if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                // array_push($array1,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                 array_push($array1,$value);
                             }
                            
                        }else{
                            //encagamos al rango de edad
                             if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                // array_push($array1ax,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                 array_push($array1ax,$value);
                             }
                            
                        }
                    }else if(strlen($titulo)==22) {
                        //separamos del genero mmh o hhm
                         if( Str::startsWith($titulo, $sexop2)){
                             //encagamos al rango de edad
                              if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                 // array_push($array2,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                  array_push($array2,$value);
                              }
                             
                         }else{
                             //encagamos al rango de edad
                              if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                 // array_push($array2ax,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                  array_push($array2ax,$value);
                              }
                             
                         }
                        // array_push($array2,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);

                    }else if(strlen($titulo)==15){

                        //separamos del genero myh o hym
                         if( Str::startsWith($titulo, $sexop2)){
                             //encagamos al rango de edad
                              if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                 // array_push($array3,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                  array_push($array3,$value);
                              }
                             
                         }else{
                             //encagamos al rango de edad
                              if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                 // array_push($array3ax,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                  array_push($array3ax,$value);
                              }
                             
                         }
                    }
                        
                }else{
                  
                    //separamos de acuerdo al sexo y prioridad
                    if(strlen($titulo)==7){

                       //separamos del genero myh
                        if( Str::startsWith($titulo, $sexop1)){
                            //encagamos al rango de edad
                             if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                // array_push($array1r,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                 array_push($array1r,$value);
                             }
                            
                        }else{
                            //encagamos al rango de edad
                             if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                // array_push($array1t,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                 array_push($array1t,$value);
                             }
                            
                        }
                    }else if(strlen($titulo)==22) {
                        //separamos del genero mmh o hhm
                         if( Str::startsWith($titulo, $sexop2)){
                             //encagamos al rango de edad
                              if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                 // array_push($array2r,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                  array_push($array2r,$value);
                              }
                             
                         }else{
                             //encagamos al rango de edad
                              if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                 // array_push($array2t,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                  array_push($array2t,$value);
                              }
                             
                         }
                        // array_push($array2,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);

                    }else if(strlen($titulo)==15){

                        //separamos del genero myh o hym
                         if( Str::startsWith($titulo, $sexop2)){
                             //encagamos al rango de edad
                              if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                 // array_push($array3r,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                  array_push($array3r,$value);
                              }
                             
                         }else{
                             //encagamos al rango de edad
                              if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                                 // array_push($array3t,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                                  array_push($array3t,$value);
                              }
                             
                         }
                    }else{
                      array_push($array1,$value);
                    }
                }
            }

        }

        if($tiene_hijos){
           
            $enfermedades= array_merge($array1t,$array2t,$array3t,$array1,$array2,$array3,$array3ax,$array2ax,$array1ax,$array1r,$array2r);
          
        }else{
           
            $enfermedades= array_merge($array1,$array2,$array3,$array3ax,$array1ax,$array2ax,$array1r,$array2r,$array3r,$array3t,$array1t,$array2t);
        }
         
        
        $myCollectionObj=collect($enfermedades);
        
        $data=$this->paginate($myCollectionObj);
        $url='http://'.$_SERVER['HTTP_HOST'];
        $data->setPath($url.'/home/');
        
        //registro de evento view page
        event(new HomeEventPerfilUser( ['page'=>'home (principal)','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'INI'])] ));

        // creacion de lista de noticia para el sliders
        $listaNoticia=NoticiaModel::with('especialidad')->where('estado',1)->where('activo',1);
        $listaNoticia = $listaNoticia->orderBy('orden','asc')->get();
        $listaNoticia=$listaNoticia->groupBy('idespecialidades');

         //lista medicos
         $tipo=TipoUserModel::where('abr','dr')->first();
         // $listaTopMedico=User::where('idtipo_user',$tipo['idtipo_user'])->get();
         $listaTopMedico=User::inRandomOrder()->where('idtipo_user',$tipo['idtipo_user'])->where('id','<>',auth()->user()->id)->get();

        //verificamos sus datos para update
        $estado_registro=null;
        if(!auth()->user()->estado_registro){
             $estado_registro=auth()->user()->estado_registro;
             $listaciu=CiudadModel::all();
             $listaEspe=EspecialidadesModel::all();
             $listaTitulo=TituloModel::all();
             $lista_area=AreaModel::all();


             //get datos del usuario tipo usuario
              $data_user_tipo=null;
              if(isset(auth()->user()->idtipo_user)){
                  $data_user_tipo=TipoUserModel::find(auth()->user()->idtipo_user)->abr;
              }
              
              //enviamos datos necesarios
              if($data_user_tipo=='us'){
                  return view('home',['articulos'=>$data,'registro'=>$estado_registro,'ciudades'=>$listaciu,'user_'=>$data_user_tipo,'list_top_medico'=>$listaTopMedico,'listaNoticia'=>$listaNoticia]);}
              if($data_user_tipo=='dr'){
                  return view('home',['articulos'=>$data,'registro'=>$estado_registro,'ciudades'=>$listaciu,'lista_especialidad'=>$listaEspe,'user_'=>$data_user_tipo,'lista_titu'=>$listaTitulo,'listaNoticia'=>$listaNoticia,'list_top_medico'=>$listaTopMedico]);
              }
              
              if($data_user_tipo=='em'){
                  return view('home',['articulos'=>$data,'registro'=>$estado_registro,'ciudades'=>$listaciu,'user_'=>$data_user_tipo,'lista_area'=>$lista_area,'listaNoticia'=>$listaNoticia,'list_top_medico'=>$listaTopMedico]);
              }

        }

       // return auth()->user()->estado_registro;

        return view('home',['articulos'=>$data,'listaNoticia'=>$listaNoticia,'list_top_medico'=>$listaTopMedico]);
    }

   

    //actualiza datos del usuario paciente
    public function update(Request $request ,$id)
    {
       try {
            // return $request;
           $user=User::find(decrypt($id));
           $userAux=User::find(decrypt($id));
           $user->name=$request->name;
           //actualizar email cuando sea registrado desde la pagina
           if($user->social_id==null){
             $user->email=$request->email;
           }
           
           $user->telefono=$request->telefono;
           $user->fecha_nacimiento=$request->fecha_nacimiento;
           $user->genero=$request->genero;
           $user->idciudad=$request->idciudad;
           $user->estado_registro=1;
           $user->tine_hijo=$request->tine_hijo;
           $user->nom_referido=$request->nom_referido;
           

           if($user->save()){
                $id= auth()->user()->id;
                //asignamos 5 coinsult por update de datos code 2
                $resul=$this->coins->add_coinsult('2');
                if($resul){
                    // notificamos que se ha ganado 5 coinsul code 2
                    $this->notify->add_notificacion('5','coinsul');
                }
                
                //ELIMINAMOS LA NOTIFICACION
                $iddetalle=NotificacionDetalleModel::where('code','1')->first()->iddetalle_notificacion;
                $delete= Notificacion::where('iduser',$id)->where('iddetalle_notificacion',$iddetalle)->first();
                $delete->activo=0;
                $delete->save();

                 return back()->with(['info' => 'Gracias, tus datos se han guardado con exito.', 'estado' => 'success']);
           }
           //registro de evento update de perfil user paciente
            // event(new PerfilUserEventUsuario(['tipoUser'=>'P','objUser'=>$userAux,'objUserUdpate'=>$request,'iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PER'])] ));
            return back()->with(['info' => 'Datos Guardados', 'estado' => 'success']);
           // return redirect('/profile/perfil');
       } catch (\Throwable $th) {
            return back()->with(['info' => 'Algo ha ido mal', 'estado' => 'error']);
       }
           

    }

    public function show($id)
    {
        // $id=decrypt($id);
        // $consul= User::find($id);
        // return view('perfil',['data'=>$consul]);
    }


    public function putLikePoint($id) 
    {

        $idarti=decrypt($id);
        $iduser= auth()->user()->id;
        $getNoti=NotificacionDetalleModel::where('code','3')->first()->iddetalle_notificacion;
        $getPunto=CoinsultDetalleModel::where('punto','1')->first()->idcoinsultDetalle;
        $veri= LikeUsersModel::where('iduser',$iduser)->first();

        if(isset($veri)){
            //ya tiene registrado su like
            $exitArt=LikeUsersModel::where('iduser',$iduser)->where('idarticulo',$idarti)->first();
            if(!isset($exitArt)){
                //registro de actividad
                 // event(new HomeEventLike(['idarticulo'=>$idarti,'iduser'=>$iduser,'descripcion'=>'dio un "like" ','tipo_S'=>session()->get('seccion_tipo')]));
                //registro like
                    $regisLike=new LikeUsersModel();
                    $regisLike->iduser=$iduser;
                    $regisLike->idarticulo=$idarti;
                    $regisLike->save();

                    //registro de notificacion 
                    $validarNoti=Notificacion::where('iduser',$iduser)->where('iddetalle_notificacion',$getNoti)->first();
                    if($validarNoti){
                        return response()->json([
                            'jsontxt'=>['msm'=>'Gracias por Like..!!','estado'=>'info']
                        ],200);
                    }
                    $notify= new Notificacion(); 
                    $notify->iduser= $iduser;
                    $notify->iddetalle_notificacion=$getNoti;
                    $notify->save();

                     return response()->json([
                         'jsontxt'=>['msm'=>'Gracias por Like..!!','estado'=>'info']
                     ],200);
            }else{
                //eliminar like
                if($exitArt->delete()){

                    //registro de actividad
                    // event(new HomeEventLike(['idarticulo'=>$idarti,'iduser'=>$iduser,'descripcion'=>'dio un "dislike" ','tipo_S'=>session()->get('seccion_tipo')]));
                     //verificar si elimino su primer like
                    if(!LikeUsersModel::where('iduser',$iduser)->first()){
                       if($delete=CoinsultModel::where('iduser',$iduser)->where('idcoinsultDetalle',$getPunto)->first()){
                            $delete->delete();
                            $validarNoti=Notificacion::where('iduser',$iduser)->where('iddetalle_notificacion',$getNoti)->first();
                            $validarNoti->delete();
                       } 
                       
                    }
                    return response()->json([
                        'jsontxt'=>['msm'=>'like removed','estado'=>'warning']
                    ],200);
                }else{
                   return response()->json([
                    'jsontxt'=>['msm'=>'Lo sentimos..','estado'=>'error']
                    ],200); 
                }
                
            }
            
        }else{


            //no tiene ningun like / entonces se registra y gana 1 puntos
            //registro like
                $regisLike=new LikeUsersModel();
                $regisLike->iduser=$iduser;
                $regisLike->idarticulo=$idarti;
                $regisLike->save();
                

                //registro de actividad
                // event(new HomeEventLike(['idarticulo'=>$idarti,'iduser'=>$iduser,'descripcion'=>'dio un "like" ','tipo_S'=>'SEA']));

            //registro puntos
                $coinsulcreate= new CoinsultModel();
                $coinsulcreate->iduser= $iduser;
                $coinsulcreate->idcoinsultDetalle= $getPunto;
                $coinsulcreate->save();


                //registro de notificacion 
                $validarNoti=Notificacion::where('iduser',$iduser)->where('iddetalle_notificacion',$getNoti)->first();
                if($validarNoti){
                    return response()->json([
                        'jsontxt'=>['msm'=>'Gracias por Like..!!','estado'=>'info']
                    ],200);
                }
                $notify= new Notificacion(); 
                $notify->iduser= $iduser;
                $notify->iddetalle_notificacion=$getNoti;
                $notify->save();

                return response()->json([
                    'jsontxt'=>['msm'=>'Gracias por tu primer Like!! has ganado un Coinsult','estado'=>'success']
                ],200);
        }
        
    }

  
   

    public function validarRol(Request $request)
    {
      
        return redirect('/home');
    }
}
