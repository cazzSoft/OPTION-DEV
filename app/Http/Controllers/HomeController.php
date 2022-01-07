<?php

namespace App\Http\Controllers;

use App\ArticuloModel;
use App\CoinsultDetalleModel;
use App\CoinsultModel;
use App\Inters_userModel;
use App\LikeUsersModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Str;
class HomeController extends Controller
{
    
    public function __construct()
    {   
       
        $this->middleware('auth');
    }

    public function paginate($items, $perPage = 12, $page = null, $options = [])
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
       $url='http://'.$_SERVER['HTTP_HOST'];
        
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

            

            //consultar sus temas elegidos
            $temas=Inters_userModel::with('temas')->where('iduser',$id)->first();
            if(isset($temas['temas'])){
                $tema=  $temas['temas']['area_desc'];

            }
            
            

            $splay = Str::slug($tema,", ");
            $array_temas= explode(', ', $splay );
            
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
        $enfermedades=ArticuloModel::withCount(['like'])
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
                            // array_push($array1t,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$tiene_hijos.' - '.$value->edad_final.'] | '.$vartx);
                                 array_push($array1t,$value);
                         } 
                    }else if(Str::startsWith($titulo, 'mujeresmujeresyhombres') || Str::startsWith($titulo, 'hombreshombresymujeres')){
                        if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                            // array_push($array2t,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$tiene_hijos.' - '.$value->edad_final.'] | '.$vartx.'|');
                                 array_push($array2t,$value);
                         } 
                    }else{
                        if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                            // array_push($array3t,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$tiene_hijos.' - '.$value->edad_final.'] | '.$vartx.'|');
                                 array_push($array3t,$value);
                         } 
                    }

                }else{
                    //posibles enfermedades de interes del paciente

                    //prioridad 1
                    if(strlen($titulo)==15 || strlen($titulo)==14){
                        //hijos hm edad hijo
                        if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                            // array_push($array1,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$tiene_hijos.' - '.$value->edad_final.'] | '.$vartx.'|');
                                 array_push($array1,$value);
                         }else if(in_array( $fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                            //paciente hm edad paciente
                            if(Str::startsWith($titulo, $sexop3)){ //
                                // array_push($array1ax,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx.'|'); 
                                 array_push($array1ax,$value);
                            }else{
                                // array_push($array1r,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx.'|'); 
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
                    }
                     // array_push($array4,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.'] | '.$vartx);
                }
            }

        }

        if($tiene_hijos){
           
            $enfermedades= array_merge($array1t,$array2t,$array3t,$array1,$array2,$array3,$array3ax,$array2ax,$array1ax,$array1r,$array2r);
          
        }else{
           
            $enfermedades= array_merge($array1,$array2,$array3,$array3ax,$array1ax,$array2ax,$array1r,$array2r,$array3r,$array3t,$array1t,$array2t);
        }
        
        // if($tiene_hijos){
        
        //     return ['Tema de interes seleccionado'=>$temas['temas']['descripcion'],
        //             'Areas del tema '=>$array_temas,
        //             'Tiene hijos'=>[ 'hijos sexo MYH o HYM'=>$array1t,
        //                              'hijos sexo MMYH o HHYM'=>$array2t,
        //                              'hijos sexo HoM'=>$array3t,
                                     
        //                           ],
        //             'otras posibles enfermedades hijos'=>[
        //                             'otras posibles enfermedades HM'=>$array1,
        //                             'otras posibles enfermedades HHMM'=>$array2,
        //                             'otras posibles enfermedades H'=>$array3
        //             ],
        //             'Paciente'=>auth()->user()->name,
        //             'Pte h'=>$array3ax,
        //             'Pte HHM o MMH'=>$array2ax,
        //             'Pte  HyM '=>$array1ax,
                    
        //             'Pte  HyM s'=>$array1r,
        //             'Pte HHM o MMH s'=>$array2r,    
                   
        //             ];
        // }else{
        //     return['Tema de interes seleccionado'=>$temas['temas']['descripcion'],
        //             'Areas del tema '=>$array_temas,
        //             'con tema'=>[  
        //                             'result'=>array_merge($array1,$array2,$array3,$array3ax,$array1ax,$array2ax),
        //                         ],
        //             'posivilidades'=>[  
        //                             'result'=>array_merge($array1r,$array2r,$array3r,$array3t,$array1t,$array2t),   
        //                         ],
        //             ];
        // }
        
        

        // $enfermedades= array_merge($array1ax,$array1,$array2ax,$array2,$array3ax, $array3,$array4ax,$array4);  
        
        $myCollectionObj=collect($enfermedades);
        
        $data=$this->paginate($myCollectionObj);
        $data->setPath($url.'/home/');
        
        // return $units = Paginator::make($array1ax, count($array1ax), 10);

        return view('home',['articulos'=>$data]);
    }

    public function update(Request $request ,$id)
    {

       $user=User::find(decrypt($id));
       $user->name=$request->name;
       $user->email=$request->email;
       $user->telefono=$request->telefono;
       $user->fecha_nacimiento=$request->fecha_nacimiento;
       $user->genero=$request->genero;
       $user->idciudad=$request->idciudad;
       $user->save();
       return redirect('/profile/perfil');
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
        $getPunto=CoinsultDetalleModel::where('punto','1')->first()->idcoinsultDetalle;
        $veri= LikeUsersModel::where('iduser',$iduser)->first();

        if(isset($veri)){
            //ya tiene registrado su like
            $exitArt=LikeUsersModel::where('iduser',$iduser)->where('idarticulo',$idarti)->first();
            if(!isset($exitArt)){
                //registro like
                    $regisLike=new LikeUsersModel();
                    $regisLike->iduser=$iduser;
                    $regisLike->idarticulo=$idarti;
                    $regisLike->save();
                     return response()->json([
                         'jsontxt'=>['msm'=>'Gracias por Like..!!','estado'=>'info']
                     ],200);
            }else{
                //eliminar like
                if($exitArt->delete()){
                     //verificar si elimino su primer like
                    if(!LikeUsersModel::where('iduser',$iduser)->first()){
                       if($delete=CoinsultModel::where('iduser',$iduser)->where('idcoinsultDetalle',$getPunto)->first()){
                            $delete->delete();
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
                
            //registro puntos
                
               
                $coinsulcreate= new CoinsultModel();
                $coinsulcreate->iduser= $iduser;
                $coinsulcreate->idcoinsultDetalle= $getPunto;
                $coinsulcreate->save();
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
