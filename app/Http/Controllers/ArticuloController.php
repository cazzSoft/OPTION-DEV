<?php

namespace App\Http\Controllers;

use App\ArticuloModel;
use App\Inters_userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

use Str;
use Carbon\Carbon;

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
                        return response()->json([
                            'jsontxt'=>['msm'=>'Se ha cambiado el estado a la publicación. ','estado'=>'info'],
                            'request'=>['clr'=>'btn-success','txt'=>'Publicar','icon'=>'fa fa-notes-medical','p'=>'0']
                        ],200);
                    }elseif ($consul->publicar==0) {
                        $consul->publicar=1;
                        $consul->save();
                        return response()->json([
                            'jsontxt'=>['msm'=>'Publicación habilitada.','estado'=>'success'],
                            'request'=>['clr'=>'btn-info','txt'=>'Quitar publicación ','icon'=>'fa fa-eye-slash','p'=>'1']
                        ],200);
                    }
                    

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

    public function getArticulos(Request $request)
    {
        
       
        //consultar sus temas elegidos
        $id=auth()->user()->id;
        $temas=Inters_userModel::with('temas')->where('iduser',$id)->first();
        if(isset($temas['temas'])){
            $tema=  $temas['temas']['area_desc'];
        }
        
        $splay = Str::slug($tema,", ");
        $array_temas= explode(', ', $splay );

        

        //lista de enfermedades
        $enfermedades1=ArticuloModel::withCount(['like'])
                ->where('tipo','N')
                ->where('publicar','1')
                ->where('estado','1')
                ->where("titulo",'like','%'.$request->q.'%')
                ->orWhere("descripcion", 'like', '%'.$request->q.'%')
                ->orderBy('idarticulo','desc')
                ->get();

        $enfermedades2= ArticuloModel::withCount(['like'])
                ->where('tipo','N')->where('publicar','1')->where('estado','1')
                ->where("titulo",'like','%'.$request->q.'%')
                ->orWhere("descripcion", 'like', '%'.$request->q.'%')
                ->orWhere("area_desc", 'like', '%'.$request->q.'%')
                ->orWhere("terminos", 'like', '%'.$request->q.'%')
                ->orWhere("organos_involucrados", 'like', '%'.$request->q.'%')
                ->orWhere("causas", 'like', '%'.$request->q.'%')
                ->orWhere("sintoma", 'like', '%'.$request->q.'%')
                ->orWhere("afecta_desc", 'like', '%'.$request->q.'%')
                ->orWhere("enfermedades", 'like', '%'.$request->q.'%')
                ->orderBy('idarticulo','desc')
                ->get();
        $enfermedades=[];
        if(isset($enfermedades1) || isset($enfermedades2) ){
            $enfermedades= array_merge($enfermedades1->toArray(),$enfermedades2->toArray());

        }else{
             $enfermedades= ArticuloModel::withCount(['like'])
                ->where('tipo','N')->where('publicar','1')->where('estado','1')
                ->orwhere("titulo",'like','%'.$request->q.'%')
                ->orWhere("descripcion", 'like', $request->q.'%')
                ->orWhere("area_desc", 'like', $temas.'%')
                ->orWhere("causas", 'like', $request->q.'%')
                ->orWhere("sintoma", 'like', $request->q.'%')
                ->orWhere("afecta_desc", 'like', $request->q.'%')
                ->orWhere("enfermedades", 'like', $request->q.'%')
                ->orderBy('idarticulo','desc')
                ->get(); 
                $enfermedades=$this->ordenarSearchPrioridad($enfermedades, $array_temas); 
                 
        }

        if($enfermedades==null ){
            
           $value = Str::limit($request->q, 3);
            $enfermedades= ArticuloModel::withCount(['like'])
                ->where('tipo','N')->where('publicar','1')->where('estado','1')
                ->orwhere("titulo",'like','%'.$value.'%')
                ->orWhere("descripcion", 'like', '%'.$value.'%')
                ->orWhere("area_desc", 'like', '%'.$temas.'%')
                ->orWhere("causas", 'like', '%'.$value.'%')
                ->orWhere("sintoma", 'like', '%'.$value.'%')
                ->orWhere("afecta_desc", 'like', '%'.$value.'%')
                ->orWhere("enfermedades", 'like', '%'.$value.'%')
                ->orderBy('idarticulo','desc')
                ->get(); 
            $enfermedades=$this->ordenarSearchPrioridad($enfermedades, $array_temas); 
        }
        
        $myCollectionObj=collect($enfermedades);
        $data=$this->paginate($myCollectionObj); 
        
        $url='http://'.$_SERVER['HTTP_HOST'];
        $data->setPath($url.'/home/');    
        // $aux=[];   
        //    foreach ($data as $key => $value) {
        //      return $value['iduser'];
        //        array_push($aux,$value->iduser);
        //     } 
        //     return $aux;
        return view('home',['articulos'=>$data,'valor'=>$request->q]);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id=decrypt($id);
            $consul=ArticuloModel::find($id);
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
