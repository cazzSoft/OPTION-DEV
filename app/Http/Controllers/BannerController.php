<?php

namespace App\Http\Controllers;

use App\BannerModel;
use Illuminate\Http\Request;

use Log;
use Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listB=BannerModel::where('activo',1)->orderBy('orden','asc')->get();
        return view('gestionBanner.banner',['lista'=>$listB]);
    }

    // LAST ORDEN DE BANNER 
    public function lastOrden()
    {
        $orden=  BannerModel::where('activo',1)->max('orden');
        if(isset($orden)){
          return response()->json([
              'jsontxt'=>['msm'=>'success','estado'=>'success'],
              'request'=>$orden+1
          ],200);
        }else{
         return response()->json([
             'jsontxt'=>['msm'=>'No se completo la acción','estado'=>'error'],
         ],501); 
        }  
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        //mensaje para las validaciones
        $messages=[
                    'img.required'=>'El campo imagen es obligatorio.',
                    'img.mimes'=>'El campo imagen debe ser un archivo con formato: jpg, jpeg, bmp, png, jfif, webp',
                    'nombre_banner.required' => 'El campo Nombre banner es obligatorio.',
                    'aling_img.required' => 'El campo Aliniar imagen es obligatorio.',
                    'text_principal.required' => 'El campo Texto Principal es obligatorio.',
                    'text_principal_en.required' => 'El campo Texto Principal es obligatorio.',
                    'text_btn.required' => 'El campo Texto en el botón es obligatorio.',
                    'text_btn_en.required' => 'El campo Texto en el botón es obligatorio.',
                    'orden.required' => 'El campo Orden es obligatorio.',
            ];

        //función para validar datos
        $request->validate([
            'nombre_banner' => 'required|string',
            'orden' => 'required|unique:banner',
            'img'   =>  'required|mimes:jpg,jpeg,bmp,png,jfif',
            'aling_img' => 'required',
            'text_principal' => 'required',
            'text_principal_en' => 'required',
            'text_btn' => 'required',
            'text_btn_en' => 'required',

        ],$messages);

        //validamos el estado
        $estado=0;
        if(isset($request->estado)){
            $estado=1;
        }

        $nombre='';
        if($request->img!=null){
            $img= $request->file('img');
            $extension = pathinfo($img->getClientOriginalName(), PATHINFO_EXTENSION);
            
            $nombre='ban-'.date('Ymd_h_s').'.'.$extension;
                \Storage::disk('wasabi')->put('banner/'.$nombre,\File::get($img));
           
        }



        $banner= new BannerModel();
        $banner->nombre_banner=$request->nombre_banner;
        $banner->aling_img=$request->aling_img;
        $banner->img='banner/'.$nombre;
        $banner->text_opcional1=$request->text_opcional1;
        $banner->text_opcional1_en=$request->text_opcional1_en;
        $banner->text_principal=$request->text_principal;
        $banner->text_principal_en=$request->text_principal_en;
        $banner->text_opcional2=$request->text_opcional2;
        $banner->text_opcional2_en=$request->text_opcional2_en;
        $banner->text_btn=$request->text_btn;
        $banner->text_btn_en=$request->text_btn_en;
        $banner->orden=$request->orden;
        $banner->estado=$estado;
        $banner->activo=1;

        if( $banner->save()){
             // event(new MedicoEventCasoEx(['tipo'=>'save','caso'=>$actArt,'iduser'=>auth()->user()->id,'seccion'=>'CAEX']));
             return back()->with(['info' => 'Datos guardado correctamente', 'estado' => 'success']);
        }else{
             return back()->with(['info' => 'Error no se pudo registrar el registro', 'estado' => 'error']);
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        //
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
        //
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
