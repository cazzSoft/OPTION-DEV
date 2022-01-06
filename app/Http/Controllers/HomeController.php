<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\ArticuloModel;
use App\LikeUsersModel;
use App\CoinsultDetalleModel;
use App\CoinsultModel;
use Carbon\Carbon;


 use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
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
            //Edad del paciente
            $fecha_nacimiento = Carbon::createFromDate(auth()->user()->fecha_nacimiento)->age;
             $fecha_nacimiento=30;
            //sexo del paciente
            $sexo=auth()->user()->genero;
            //tienes hijos
            $tiene_hijos=auth()->user()->tine_hijo;

            if($sexo){
                $sexo='Hombres'; $sexohm='hombresymujeres'; $sexos='hombreshombres'; 
            }else{ 
                $sexo= 'Mujeres'; $sexos='mujeresmujeres';  $sexohm='mujeresyhombres'; 
            }

            //si tiene hijos
            if($tiene_hijos){
                $tiene_hijos= rand(1,18);
            }

           
            //likes del paciente
            $id=auth()->user()->id;

        //lista de enfermedades
        $enfermedades=ArticuloModel::withCount(['like'])
                ->with(['like'=>function($q){
                            $q->select(['*'])->where('iduser',auth()->user()->id)->get();
                    }])->where('tipo','N')
                ->where('publicar','1')
                ->where('estado','1')
                 // ->where('edad_inicial','<=',$fecha_nacimiento)
                ->Where('afecta_desc','like',$sexo.'%')
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
        
       
        foreach ($enfermedades as $key => $value) {
           
            //trasnformamos a texto plano
            $titulo = Str::slug($value->afecta_desc, "");
               
            if(strlen($titulo)<=7){ //obtenemos sexo prioritario (H o M)
                
                //si tienes hijo encontramos posibles rangos del hijo
                if ($tiene_hijos) {
                   if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                        // array_push($array1ax,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.']');
                        array_push($array1ax,$value);
                   } 
                }
                //encontramos posibles rango de acuerdo a la edad del usuario paciente
                if(in_array($fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                        // array_push($array1,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.']');
                        array_push($array1,$value);
                }
                

            }else if (Str::startsWith($titulo, $sexos)) { //obtenemos sexo prioritario (Hh o Mm)
               
                //si tienes hijo encontramos posibles rangos del hijo
                if ($tiene_hijos) {
                   if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                        // array_push($array2ax,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$tiene_hijos.' - '.$value->edad_final.']');
                         array_push($array2ax,$value);
                   } 
                }

               if(in_array($fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                 // array_push($array2,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.']');
                  array_push($array2,$value);
                }
            }else if (Str::startsWith($titulo, $sexohm)) {
                 //si tienes hijo encontramos posibles rangos del hijo
                if ($tiene_hijos) {
                   if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                        // array_push($array3ax,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$tiene_hijos.' - '.$value->edad_final.']');
                     array_push($array3ax,$value);
                   } 
                }

               if(in_array($fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                  // array_push($array3,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.']');
                   array_push($array3,$value);
                 }
            }else{

                 //si tienes hijo encontramos posibles rangos del hijo
                if ($tiene_hijos) {
                   if(in_array( $tiene_hijos, range($value->edad_inicial, $value->edad_final), true)){
                        // array_push($array4ax,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$tiene_hijos.' - '.$value->edad_final.']');
                         array_push($array4ax,$value);
                   } 
                }
                if(in_array($fecha_nacimiento, range($value->edad_inicial, $value->edad_final), true)){
                  // array_push($array4,$value->afecta_desc.' rango[ '.$value->edad_inicial.' - '.$fecha_nacimiento.' - '.$value->edad_final.']');
                   array_push($array4,$value);
                 }
            }
              
        }
        
        $enfermedades= array_merge($array1ax,$array1,$array2ax,$array2,$array3ax, $array3,$array4ax,$array4);  
        
        $myCollectionObj=collect($enfermedades);
        
        $data=$this->paginate($myCollectionObj);
        $data->setPath($url.'/home/');
         $data;
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
