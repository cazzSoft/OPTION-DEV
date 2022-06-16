@extends('homeOption2h')
@section('title','Perfil-Médico')


{{--para activar los plugin en la view  perfil medico --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
{{-- cuerpo de la pagina --}}
@section('contenido')
    <div class="container-fluid containerResul">
        <div class="row">   
            @movil 
                <div class="col-12 ">
                    <div class="d-flex justify-content-start  mt-4 flex_titulo  ">
                        <a href="/">  <p class=" text-lead h2 text-info_ ">  <i class="fas fa-chevron-left mr-3 text-info_ "></i> 
                            <b>Resultados para @if(isset($text_search)) {{ Str::limit( $text_search, 20)}} @endif</b>   </p>
                        </a>    
                    </div>
                </div>
                <div class="col-12">
                    <div class=" mt-2">
                        <p class="lead-search">Aquí tienes todos los resultados que tenemos disponible para ti.</p>
                        <p class="text-secu h4 text-muted  mt-2 ">
                           <b>Médicos <small class="text-muted description">@if(isset($text_sms)) ({{ $text_sms}} )@endif  </small></b> 
                        </p>
                    </div>
                </div>
            @else
                <div class="col mt-3">
                    <p class=" text-title text-info_ text-center mb-3">  
                       <a href="/"> <i class="fas fa-chevron-left  float-left ml-5 text-info_ "></i></a>
                       <b class="text-center mr-5 ">  Guía Médica   </b> 
                        {{-- <b>Resultados para @if(isset($text_search)) {{$text_search}} @endif</b>  --}}
                    </p>
                </div>
            
                <div class="col-md-12 col-sm-12 mt-2 m-2">
                    <div class="ml-5 mr-5 mt-4">
                        <p class="lead">Aquí tienes todos los resultados que tenemos disponible para ti.</p>
                        <p class=" text-lead h4 text-muted  mt-5 mb-4">
                           <b>Médicos <small class="text-muted description">@if(isset($text_sms)) ({{ $text_sms}} )@endif  </small></b> 
                        </p>
                    </div>
                </div>
            @endmovil
        </div>
        <div class="row justify-content-start text-center  @movil m-0 @else ml-3 @endmovil">
            @if(isset($medicos) && $medicos!=null)
              @movil
                <div id="slider_medicos" class="draggable-slider slider">
                  <div class="inner">
                    @foreach($medicos as $key=> $item) 
                        @if($item)
                            <div class="slider text-center ">
                                @if(isset($item->img) && $item['img']!=null) 
                                    <a href="{{url('medico/info/'.encrypt($item['id']))}}">
                                        <img src="{{ \Storage::disk('wasabi')->temporaryUrl($item->img, now()->addMinutes(3600)  )}}" class="img_slide_medico img-circle img-fluid p-0 elevation-1" alt="">
                                    </a>
                                @else  
                                    <a href="{{url('medico/info/'.encrypt($item['id']))}}">
                                        <img src="{{asset('img/user.png') }}" class="img_slide_medico img-circle img-fluid p-0 elevation-1" alt="">
                                    </a>
                                @endif  
                                <div class="text-medico-slide text-dark ">
                                   <a href="{{url('medico/info/'.encrypt($item['id']))}}" class="text-muted" >{{$item->name}} </a>
                                </div>
                            </div>
                        @endif
                  @endforeach
                  </div>
                </div>
              @else
                @foreach($medicos as $key=> $item)
                    @if($item)
                        <div class="col-md-2 col-sm-3 col-xs-12 text-left  @if($key<1) offset-md-1  @endif  text-center mb-1">
                            @if(isset($item->img) && $item['img']!=null) 
                                <a href="{{url('medico/info/'.encrypt($item['id']))}}">
                                  <img src="{{ \Storage::disk('wasabi')->temporaryUrl($item->img, now()->addMinutes(3600)  )}}" alt="{{$item->img}}"  class="img_doc bg-light img-circle {{-- img-fluid --}} p-0 elevation-0  ">
                                </a>
                            @else 
                                <a href="{{url('medico/info/'.encrypt($item['id']))}}">  
                                  <img src="{{asset('img/user.png') }}" alt="{{$item->img}}"   class="img_doc img-circle {{-- img-fluid --}} p-0 elevation-0 bg-light">
                                </a>
                            @endif
                            <a class="users-list-name mt-3 mb-1 text-truncate" href="{{url('medico/info/'.encrypt($item['id']))}}"><b class="h5">{{$item->name}}</b></a>
                        </div>
                    @endif
                @endforeach
              @endmovil
            @endif       
        </div>
        @movil
            <div class="row ">
                <div class="col-12">
                    <p class="text-secu h4 text-muted ">
                       <b>Publicaciones </b>
                    </p>
                </div>
                <div class="col-12">
                     <div class="row mt-2 "> 
                       <div class="col-12 search_publi">
                            @include('publicaciones')
                       </div>
                     </div>
                </div>  
            </div>
        @else
            <div class="row ml-4 conten_publicaciones_search">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <p class="text-secu h4 text-muted  mt-5">
                       <b>Publicaciones </b>
                    </p>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 ">
                     <div class="row mt-2 "> 
                       <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 offset-lg-3 offset-md-2  ">
                        @include('publicaciones')
                       </div>
                     </div>
                </div>  
            </div>
        @endmovil
       
    </div>
   

    @section('include_css') 
      <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
        <script src="{{ asset('/js/slider.js') }}"></script> 
        {{-- textarea estan raros --}}
        @if( isset($datos_p) )
           <script>
                $('#detalle_experiencia').val('{{$datos_p->detalle_experiencia}}');
                $('#detalle_estudio').val('{{$datos_p->detalle_estudio}}');
           </script>
        @endif
        {{-- Mensaje de informacion --}}
          @if(session()->has('info'))
             <script >
               
               mostrar_toastr('{{session('info')}}','{{session('estado')}}')
             </script>
          @endif
        <script src="{{ asset('/js/medico.js') }}"></script>
        <script src="{{ asset('/js/controlLike.js') }}"></script>
            {{-- //activar select --}}
        <script>
           $('.select2').select2();
        </script> 
        <script >
            const mySlider2 = new DraggableSlider('slider_medicos');
        </script>

        <script src="{{ asset('/js/actionEvent.js') }}"></script>

    @stop


 @stop
