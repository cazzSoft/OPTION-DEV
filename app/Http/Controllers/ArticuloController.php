<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticuloModel;
use Illuminate\Support\Facades\Validator;

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
        
        $articulo= ArticuloModel::withCount(['like'])
                ->where("titulo",'like','%'.$request->q.'%')
                        ->where('tipo','N')->where('publicar','1')->where('estado','1')
                        ->orWhere("descripcion", 'like', $request->q.'%')
                        ->orWhere("titulo", 'like', '%'.$request->q.'%')
                        ->get()->take(12);

        return view('home',['articulos'=>$articulo,'valor'=>$request->q]);
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
