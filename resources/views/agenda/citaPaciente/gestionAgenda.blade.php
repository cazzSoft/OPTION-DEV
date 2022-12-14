@extends('homeOption2h')
@section('title','Agendamiento')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
{{-- cuerpo de la pagina --}}


@section('contenido')
  @movil
    <div class="row mb-4">
      <div class="col-md-12 ">
          <div class="flex_titulo">
           <a href="/">  <p class=" text-lead h2 text-info_ ">  <b class="h4"><i class="fas fa-chevron-left mr-0 text-info_ float-left "></i></b>  Agendar cita </p></a> 
          </div>
      </div>
    </div>
  @else
    <div class="row ">
      <div class="col text-center mt-5">
        <a href="{{asset('/')}}" class="text-left float-left ">  <i class="fas fa-chevron-left mr-1 text-info_ fa-2x ml-4 mb-5 "></i></a>
        <span class="text-info_ h5"><b>Agendar cita</b></span>
      </div>
    </div>
  @endmovil

  <div class="container-fluid ">
    <div class="row">
      <div class=" m-auto @movil col-12 @else p-3 col-11 @endmovil">
        <p class="text-justify">
          <b>Agendar cita</b> <br>
          Dentro de Option2health, te ofrecemos dos modalidades para agendar una cita con un médico dentro de nuestra plataforma.             
        </p>
      </div>
      <div class="m-auto @movil col-12 @else col-11 @endmovil">
        <div class="row justify-content-md-center">
          {{-- targetas mostrar --}}
          @if(isset($targetas))
            @foreach($targetas as $key=>$item)
              <div class="card-deck @movil m-auto @endmovil">
                <div class="card m-4" style="width: 20rem;">
                  <div class="card-body">
                    <h4 class="text-center"><b> {{$item['titulo']}}</b></h4>
                    <h4 class="p-1 text-muted text-info_ text-center">
                      @if($item->precio_coins!=0)
                        <b>${{number_format($item['precio_usa'],2, ',', '.')}} o {{$item['precio_coins']}} coinsults</b></h5>
                      @else
                         <b>${{number_format($item['precio_usa'],2, ',', '.')}}</b></h5>
                      @endif

                      @if($item['Targeta_detalle']!='[]')
                        @foreach($item['Targeta_detalle'] as $key=>$det)
                          <ul >
                            <li class="mt-1 mb-2">{{$det['detalle_targeta'][0]['descripcion']}}</li>
                          </ul>
                        @endforeach  
                      @endif
                      
                  </div>
                  <div class="card-footer shadow-none bg-white">
                     <div class="text-center row col-11 m-auto">
                        <a href="{{url('agenda/form_cita/').'/'.encrypt($item['idtargeta_cita'])}}" class="card-link  btn btn-info btn-block text-center m-2">{{$item['txt_btn']}}</a>
                      </div>
                   </div>
                </div>
              </div>
            @endforeach
          @endif
          
        </div>
      </div>
    </div>
  </div>
@stop


{{-- Seccion para insertar css--}}
@section('include_css') 
  {{-- aqui ingrese otros stilos --}}
    <link rel="stylesheet" href="{{ asset('css/gestionAgenda.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
@stop 

{{-- Seccion para insertar js--}}
  @section('include_js')

    {{-- <script src="{{ asset('/js/gestionBanner.js') }}"> --}}

    {{-- Mensaje de informacion --}}
    @if(session()->has('info'))
      <script>
        sweetalert('{{session('info')}}','{{session('estado')}}');
      </script>
    @endif

    @if(isset($info))
      <script>
        sweetalert('{{$info}}','{{$estado}}');
      </script>
    @endif
  @stop