<?php

namespace App\Http\Controllers;

use App\ArticuloModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class Caso_exController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try { 
               //validaciones requeridas y unicas de los campos
               $validator = Validator::make($request->all(), [
                    'titulo' => 'required|string',
                    'url_video' => 'required',
                    'afecta_desc' => 'required|string',
                    'edad_inicial' => 'required|numeric',
                    'edad_final' => 'required|numeric',
                    'sintoma' => 'required|string',
                    'causas' => 'required|string',
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
                $actArt->url_video=$request->url_video;
                $actArt->afecta_desc=$request->afecta_desc;
                $actArt->edad_inicial=$request->edad_inicial;
                $actArt->edad_final=$request->edad_final;
                $actArt->sintoma=$request->sintoma;
                $actArt->causas=$request->causas;
                $actArt->tratamiento=$request->tratamiento;
                $actArt->diagnostico=$request->diagnostico;
                $actArt->medico_visitado=$request->medico_visitado;

                $actArt->estado=0;
                $actArt->publicar=0;
                $actArt->iduser=auth()->user()->id;
                $actArt->tipo='E';
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
        } catch (\Throwable $th) {
            return response()->json([
                'jsontxt'=>['msm'=>'Lo sentimos algo salio mal, intente nuevamente','estado'=>'error'],
            ],500);
        } 
    }

    //obtener filtro de casos search
    public function get_casos(Request $request)
    {
       $value= $request->search_caso;
       
       $listacasos=ArticuloModel::withCount('comentarios')
            ->with('medico')
            ->where('titulo','like','%'.$value.'%')
            ->orWhere('descripcion','like','%'.$value.'%')
            ->where('tipo','E')
            ->where('estado',1)
            ->orderBy('created_at','desc')
            ->simplePaginate(5);

        $counCasos=ArticuloModel::where('created_at','like','2021-12%')->where('tipo','E')->where('estado',1)->count();
        $casos=ArticuloModel::where('iduser',auth()->user()->id)->where('tipo','E')->where('estado',1)->count();
        $porcet= $counCasos/100;

        if($value==""){
            return redirect('medico/casos_ex')->with(['lista_casos'=>$listacasos,'casos_publicado'=>$counCasos,'porcent'=>$porcet,'casos'=>$casos,'valor'=>$value]);
       }
        return view('medico.gestionCasos',['lista_casos'=>$listacasos,'casos_publicado'=>$counCasos,'porcent'=>$porcet,'casos'=>$casos,'valor'=>$value]);
    }

    //obtener filtro de casos ultimo mes
    public function get_casos_last_month()
    {
      
        $listacasos=ArticuloModel::withCount('comentarios')
            ->with('medico')
            ->where('tipo','E')
            ->where('estado',1)
            ->orderBy('created_at','desc')
            ->where('created_at','like',date('Y-m').'%')
            ->simplePaginate(4);
        $counCasos=ArticuloModel::where('created_at','like','2021-12%')->where('tipo','E')->where('estado',1)->count();
        $casos=ArticuloModel::where('iduser',auth()->user()->id)->where('tipo','E')->where('estado',1)->count();
        $porcet= $counCasos/100;
        return view('medico.gestionCasos',['lista_casos'=>$listacasos,'casos_publicado'=>$counCasos,'porcent'=>$porcet,'casos'=>$casos]);
    }

    public function get_user_casos()
    {
        
        $listacasos=ArticuloModel::withCount('comentarios')
            ->with('medico')
            ->where('tipo','E')
            ->where('estado',1)
            ->orderBy('idarticulo','desc')
            ->where('iduser',auth()->user()->id)
            ->simplePaginate(4);
        $counCasos=ArticuloModel::where('created_at','like','2021-12%')->where('tipo','E')->where('estado',1)->count();
        $casos=ArticuloModel::where('iduser',auth()->user()->id)->where('tipo','E')->where('estado',1)->count();
        $porcet= $counCasos/100;
        return view('medico.gestionCasos',['lista_casos'=>$listacasos,'casos_publicado'=>$counCasos,'porcent'=>$porcet,'casos'=>$casos]);
    }
    public function show($id)
    {

        $id=decrypt($id);
        $consul=ArticuloModel::with(['medico'])->withCount(['comentarios'=>function ($q){
                $q->where('activo',1);
            }])->find($id);

        //incrementamos los visto por clic
        if(isset($consul)){
            $consul->visto=$consul->visto+1;
            $consul->save();
        }

        return view('medico.casoComent',['caso'=>$consul]);
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
               //validaciones requeridas y unicas de los campos
               $validator = Validator::make($request->all(), [
                    'titulo' => 'required|string',
                    'url_video' => 'required',
                    'afecta_desc' => 'required|string',
                    'edad_inicial' => 'required|numeric',
                    'edad_final' => 'required|numeric',
                    'sintoma' => 'required|string',
                    'causas' => 'required|string', 
               ]);

                if ($validator->fails()) {
                    return response()->json([
                        'jsontxt'=>['msm'=>'Campos requerido','estado'=>'error'],
                        'request'=> $validator->errors()->all(), //msm de los campos requeridos

                    ],501);//Not Implemented
                }
                
                //Guardamos los datos
                $actArt= ArticuloModel::find(decrypt($id));
                $actArt->descripcion=$request->descripcion;
                $actArt->titulo=$request->titulo;
                $actArt->url_video=$request->url_video;
                $actArt->afecta_desc=$request->afecta_desc;
                $actArt->edad_inicial=$request->edad_inicial;
                $actArt->edad_final=$request->edad_final;
                $actArt->sintoma=$request->sintoma;
                $actArt->causas=$request->causas;
                $actArt->tratamiento=$request->tratamiento;
                $actArt->diagnostico=$request->diagnostico;
                $actArt->medico_visitado=$request->medico_visitado;

                if($actArt->save()){
                     return response()->json([
                        'jsontxt'=> ['msm'=>'Datos actualizado con éxito..','estado'=>'success']
                     ],200);
                }else{
                    return response()->json([
                        'jsontxt'=> ['msm'=>'Lo sentimos no se pudo completar la acción1','estado'=>'error']
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
