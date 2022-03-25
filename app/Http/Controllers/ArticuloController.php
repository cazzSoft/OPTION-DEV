<?php

namespace App\Http\Controllers;

use App\Actividad_userModel;
use App\ArticuloModel;
use App\Events\HomeEventPerfilUser;
use App\Events\HomeEventSearch;
use App\Events\MedicoEventPublicacion;
use App\Events\MedicoEventPublicacionesSave;
use App\Events\PerfilUserEventUsuarioEdit;
use App\Inters_userModel;
use App\Registro_ActividadModel;
use App\TipoUserModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Str;
use Log;
use Str;

class ArticuloController extends Controller
{
    public function __construct()
    {   
       
        $this->middleware('auth');
    }

    public function index()
    {
        $lista=ArticuloModel::where('iduser',auth()->user()->id)->where('tipo','N')->where('estado',1)->get();
        return view('medico.gestionArticulo',['listaArt'=>$lista]);
    }
    public function getlistaPublicaciones()
    {
       $lista=ArticuloModel::where('iduser',auth()->user()->id)->where('tipo','N')->where('estado',1)->get();

       //registro de evento  articulo
       event(new HomeEventPerfilUser(['page'=>'Agregar Publicación','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'ART'])]));

       return view('medico.lista_publicacion',['listaArt'=>$lista]);     
    }

    
    public function create()
    {
        //
    }

    //funcion para habilitar el articulo publico o privado
    public function publicar(Request $request)
    {
        try {
                $id=decrypt($request->id);
                $consul=ArticuloModel::find($id);
                if(isset($consul)  ){
                    //cambiamos el estado a la publicacion
                    if ($consul->publicar==1) {
                        $consul->publicar=0;
                        $consul->save();
                        //registrar evento publicar articulo
                        event(new MedicoEventPublicacionesSave(['tipo'=>'publicar','descripcion'=>' ha quitado la publicación del artículo','articulo'=>$consul,'iduser'=>auth()->user()->id,'seccion'=>'ART']));
                        return response()->json([
                            'jsontxt'=>['msm'=>'Se ha cambiado el estado a la publicación. ','estado'=>'info'],
                            'request'=>['clr'=>'btn-success','txt'=>'Publicar','icon'=>'fa fa-notes-medical','p'=>'0']
                        ],200);
                    }elseif ($consul->publicar==0) {
                        $consul->publicar=1;
                        $consul->save();
                        //registrar evento publicar articulo
                        event(new MedicoEventPublicacionesSave(['tipo'=>'publicar','descripcion'=>' ha publicado el artículo','articulo'=>$consul,'iduser'=>auth()->user()->id,'seccion'=>'ART']));
                        return response()->json([
                            'jsontxt'=>['msm'=>'Publicación habilitada.','estado'=>'success'],
                            'request'=>['clr'=>'btn-info','txt'=>'Quitar publicación ','icon'=>'fa fa-eye-slash','p'=>'1']
                        ],200);
                    }
                    

                }else{
                   return response()->json([
                       'jsontxt'=>['msm'=>'No 1se completo la acción','estado'=>'error'],
                   ],501); 
                }   
        } catch (\Throwable $th) {
            return response()->json([
                'jsontxt'=>['msm'=>'No se completo la acción'.$th->getMessage(),'estado'=>'error'],
            ],500);
        }
    }
    
    public function store(Request $request)
    {
         // try { 
                //validaciones requeridas y unicas de los campos
                $validator = Validator::make($request->all(), [
                     'descripcion' => 'required|string',
                     'titulo' => 'required|string',
                     'url_video' => 'required',
                     'area_desc' => 'required|string',
                     'afecta_desc' => 'required|string',
                     'edad_inicial' => 'required|numeric',
                     'edad_final' => 'required|numeric',
                     'sintoma' => 'required|string',
                ]);

                 if ($validator->fails()) {
                     return response()->json([
                         'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                         'request'=> $validator->errors()->all(), //msm de los campos requeridos

                     ],501);//Not Implemented
                 }
                 
                 //Guardamos los datos
                 $actArt= new ArticuloModel();
                 $actArt->descripcion=$request->descripcion;
                 $actArt->titulo=$request->titulo;
                 $actArt->vinculo_art=$request->vinculo_art;
                 $actArt->url_video=$request->url_video;
                 $actArt->area_desc=$request->area_desc;
                 $actArt->afecta_desc=$request->afecta_desc;
                 $actArt->edad_inicial=$request->edad_inicial;
                 $actArt->edad_final=$request->edad_final;
                 $actArt->sintoma=$request->sintoma;
                 $actArt->causas=$request->causas;
                 $actArt->tratamiento=$request->tratamiento;
                 $actArt->diagnostico=$request->diagnostico;
                 $actArt->enfermedades=$request->enfermedades;

                 $actArt->estado=0;
                 $actArt->publicar=0;
                 $actArt->iduser=auth()->user()->id;
                 $actArt->tipo='N';
                
                 if($actArt->save()){
                    
                    //registrar evento nuevo documento
                    event(new MedicoEventPublicacionesSave(['tipo'=>'save','articulo'=>$actArt,'iduser'=>auth()->user()->id,'seccion'=>'ART']));
                      return response()->json([
                         'jsontxt'=> ['msm'=>'Datos guardado con éxito..','estado'=>'success']
                      ],200);
                 }else{
                     return response()->json([
                         'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción1','estado'=>'error']
                     ],501);//Not Implemented
                 }
             // return $request;
         // } catch (\Throwable $th) {
         //     return response()->json([
         //         'jsontxt'=>['msm'=>'Lo sentimos algo salio mal, intente nuevamente','estado'=>'error'],
         //     ],500);
         // } 
    }

    //metodo para mostrar resultado de busqueda
    public function resultadoSearch($value)
    {
        $getSearch=$this->getSearch($value); 
         // return $getSearch['medicos'];
        $text_info=null;
        $medicos=$getSearch['medicos'];
        if( $medicos=='[]'){
            $tipoUser=TipoUserModel::where('abr','dr')->first()->idtipo_user;
            $medicos=User::where('idtipo_user',$tipoUser)->get()->take(5);
            $text_info='Sugerido';
        }
        return view('search.search',['medicos'=>$medicos,'articulos'=>$getSearch['data'],'text_search'=>$value,'text_sms'=>$text_info]);
    }

    public function getArticulos(Request $request)
    {
       
        $getSearch=$this->getSearch($request->q);  
        
        //Registro evento search
        // event(new HomeEventSearch(['txt_search'=>$request->q,'iduser'=>auth()->user()->id,'seccion'=>'INI']));

        // return view('home',['articulos'=>$data,'valor'=>$request->q]);

        
        $medicos=$getSearch['medicos'];
        $data=$getSearch['data'];
        $listaPublicaciones=[];
        $listMedicos=[];
        $take=8;
        if($medicos!='[]'){
            $item=[];

            foreach ($medicos as $key => $value) {
                $txt=Str::limit($value->name, 40); 
                array_push($item,'<a  class="text-dark list-group-item list-group-item-action border-0 "  onclick="verResul(\' '.url('/medico/info/'.encrypt($value['id'])).' \')"><dt>  <i class="fa fa-search  p-1 mr-1  text-muted " ></i>'.$txt.'</dt></a>');
            }
            $take=5;

            $listMedicos='<span  class="dropdown-item2">
                  <div class="media ">
                    <div class="media-body ">
                      <dl>
                        <dd class="dropdown-item-title  text-muted mt1"> Médicos <span class="float-right text-sm text-info"><i class="fa fa-user-md"></i></span></dd>
                        '.implode(" ",$item).'
                      </dl>
                    </div>
                  </div>
                </span>';
        }

        if($data!='[]'){
           $data= $data->take($take);
            $item=[];
            foreach ($data as $key => $value) {
                $txt=Str::limit($value['titulo'], 40);
                array_push($item,'<a href="'.url('/gestion/resul').'"  onclick="verResul(\' '.url('/gestion/resul/'.$value['titulo']).' \')" class="text-dark list-group-item list-group-item-action border-0 "><dt>  <i class="fa fa-search  p-1 mr-1  text-muted " ></i>'.$txt.'</dt></a>');
            }

            $listaPublicaciones='<span  class="dropdown-item2">
                  <div class="media ">
                    <div class="media-body">
                     
                      <dl>
                        <dd class="dropdown-item-title  text-muted mt-1"> Publicaciones <span class="float-right text-sm text-info"><i class="far fa-newspaper"></i></span></dd>
                        '.implode(" ",$item).'
                      </dl>
                    </div>
                  </div>
                </span>';
        }
       $data= ['listaPublicaciones'=>$listaPublicaciones,'listMedicos'=>$listMedicos];
     
       // return $data=array_merge($listMedicos, $listaPublicaciones);
        return response()->json($data);
    }

    //funcion para obtener array resultado del texto a buscar
    public function getSearch($value)
    {
        //consultar sus temas elegidos
        $id=auth()->user()->id;
        $array_temas=null;
        $temas=Inters_userModel::with('temas')->where('iduser',$id)->first();
        if(isset($temas['temas'])){
            $tema=  $temas['temas']['area_desc'];

            $splay = Str::slug($tema,", ");
            $array_temas= explode(', ', $splay );
        }
        
        

        
        //lista de enfermedades
        $enfermedades1=ArticuloModel::withCount(['like'])->with('medico')
                ->where('tipo','N')
                ->where('publicar','1')
                ->where('estado','1')
                ->where("titulo",'like',$value.'%')
                
                ->orWhere("descripcion", 'like', '%'.$value.'%')
                ->orderBy('idarticulo','desc')
                ->get();

        $enfermedades2= ArticuloModel::withCount(['like'])->with('medico')
                ->where('tipo','N')->where('publicar','1')->where('estado','1')
                ->orwhere("titulo",'like','%'.$value)
                ->orWhere("descripcion", 'like', '%'.$value.'%')
                ->orWhere("area_desc", 'like', '%'.$value.'%')
                ->orWhere("terminos", 'like', '%'.$value.'%')
                ->orWhere("organos_involucrados", 'like', '%'.$value.'%')
                ->orWhere("causas", 'like', '%'.$value.'%')
                ->orWhere("sintoma", 'like', '%'.$value.'%')
                ->orWhere("afecta_desc", 'like', '%'.$value.'%')
                ->orWhere("enfermedades", 'like', '%'.$value.'%')
                ->orderBy('idarticulo','desc')
                ->get();
        $enfermedades=[];

        if(isset($enfermedades1)  ){
            $enfermedades= array_merge($enfermedades1->toArray());

        }else if(isset($enfermedades2)){
            
               $enfermedades= array_merge($enfermedades2->toArray());   
        }

        
            //siempre dede ir esta informacion adicional
            $val = Str::limit($value, 3);
            $enfermedadesRes= ArticuloModel::withCount(['like'])
                ->where('tipo','N')->where('publicar','1')->where('estado','1')->with('medico')
                ->orwhere("titulo",'like','%'.$val.'%')
                ->orWhere("descripcion", 'like', '%'.$val.'%')
                ->orWhere("area_desc", 'like', '%'.$temas.'%')
                ->orWhere("causas", 'like', '%'.$val.'%')
                ->orWhere("sintoma", 'like', '%'.$val.'%')
                ->orWhere("afecta_desc", 'like', '%'.$val.'%')
                ->orWhere("enfermedades", 'like', '%'.$val.'%')
                ->orderBy('idarticulo','desc')
                ->get(); 
            $enfermedadesAx=$this->ordenarSearchPrioridad($enfermedadesRes, $array_temas);
            $enfermedades= array_merge($enfermedades,$enfermedadesAx);
        
        
        $myCollectionObj=collect($enfermedades);
        $data=$this->paginate($myCollectionObj); 
        
        $url='http://'.$_SERVER['HTTP_HOST'];
        $data->setPath($url.'/home/'); 

        // return $value;
        // $tipoUser=TipoUserModel::where('abr','dr')->first()->idtipo_user;
        $medicos=$enfermedadesRes->groupBy('iduser','asc');
        if(isset($medicos)){
            $array=[];
            foreach ($medicos as $key => $value) {
                 array_push($array,User::find($key));
            }
        }
        $medicos=$array;
        // $medicos=User::where('name','like','%'.$value.'%')->where('idtipo_user',$tipoUser)->get();

        return ['medicos'=>$medicos,'data'=>$data];

    }

    //ordena de acuerdo al genero y al edad que afecta la enfermedad
    public function ordenarSearchPrioridad($enfermedades, $array_temas)
    {
        $fecha_nacimiento = Carbon::createFromDate(auth()->user()->fecha_nacimiento)->age;
         //array principales
        $array1=[]; $array2=[]; $array3=[]; $array4=[];
        //array axiliares
        $array1ax=[]; $array2ax=[]; $array3ax=[]; $array4ax=[];
        //array axiliares 2
        $array1t=[]; $array2t=[]; $array3t=[];  $array4t=[];
        //array axiliares 3
        $array1r=[]; $array2r=[]; $array3r=[]; $array4r=[];

        $sexo=auth()->user()->genero;
        if($sexo){
            $sexop1='hombres';  $sexop2='hombreshombresymujeres'; $sexop3='hombresymujeres'; 
        }else{ 
            $sexop1= 'mujeres'; $sexop2='mujeresmujeresyhombres'; $sexop3='mujeresyhombres'; 
        }

        $tiene_hijos=auth()->user()->tine_hijo;
        if($tiene_hijos){
                $tiene_hijos= rand(1,18);
        }else{
            if(Str::contains('pediatria, infantil', $array_temas)){ 
                $tiene_hijos= rand(1,18);
            }
        }
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
                     
                }
            }

        }

        if($tiene_hijos){
           
          return  $enfermedades= array_merge($array1t,$array2t,$array3t,$array1,$array2,$array3,$array3ax,$array2ax,$array1ax,$array1r,$array2r);
          
        }else{
           
           return $enfermedades= array_merge($array1,$array2,$array3,$array3ax,$array1ax,$array2ax,$array1r,$array2r,$array3r,$array3t,$array1t,$array2t);
        }
    }

    //funcion para paginar array creados
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

    public function show($id)
    {
        //
    }


    
    

    public function edit($id)
    {
        try {
                $id=decrypt($id);
                $consul=ArticuloModel::find($id);

                //registro de evento edit articulo
                event(new PerfilUserEventUsuarioEdit(['idarticulo'=>$id,'sub_a'=>'0','tipo_s'=>'PER','descripcion'=>' "Icono Editar Publicacion "','iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PER'])]));

                if(isset($consul)){
                    return response()->json([
                        'jsontxt'=>['msm'=>'success','estado'=>'success'],
                        'request'=>$consul
                    ],200);
                }else{
                   return response()->json([
                       'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
                   ],501); 
                }   
                
        } catch (\Throwable $th) {
            return response()->json([
                'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
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
        try {
            $id=decrypt($id);
            //validaciones requeridas y unicas de los campos
            $validator = Validator::make($request->all(), [
                'descripcion' => 'required|string',
                'titulo' => 'required|string',
                'url_video' => 'required',
                'area_desc' => 'required|string',
                'afecta_desc' => 'required|string',
                'edad_inicial' => 'required|numeric',
                'edad_final' => 'required|numeric',
                'sintoma' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                    'request'=> $validator->errors()->all(), //msm de los campos requeridos

                ],501);//Not Implemented
            }

            //actualizamos registros
            $actArt= ArticuloModel::find($id);
            $art_Aux=ArticuloModel::find($id);
            $actArt->descripcion=$request->descripcion;
            $actArt->titulo=$request->titulo;
            $actArt->vinculo_art=$request->vinculo_art;
            $actArt->url_video=$request->url_video;
            $actArt->area_desc=$request->area_desc;
            $actArt->afecta_desc=$request->afecta_desc;
            $actArt->edad_inicial=$request->edad_inicial;
            $actArt->edad_final=$request->edad_final;
            $actArt->sintoma=$request->sintoma;
            $actArt->causas=$request->causas;
            $actArt->tratamiento=$request->tratamiento;
            $actArt->diagnostico=$request->diagnostico;
            $actArt->enfermedades=$request->enfermedades;

            if($actArt->save()){
                //registro de evento update publicacion
                event(new MedicoEventPublicacion(['objPublicacion'=>$art_Aux,'objPublicacionUpdate'=>$request,'iduser'=>auth()->user()->id,'session'=>session(['seccion_tipo'=>'PER'])] ));

                 return response()->json([
                    'jsontxt'=> ['msm'=>'Datos actualizado con éxito..','estado'=>'success']
                 ],200);
            }else{
                return response()->json([
                    'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción','estado'=>'error']
                ],501);//Not Implemented
            }
            // return $request;
        } catch (\Throwable $th) {
            return response()->json([
                'jsontxt'=>['msm'=>'Lo sentimos algo salio mal, intente nuevamente','estado'=>'error'],
            ],500);
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
