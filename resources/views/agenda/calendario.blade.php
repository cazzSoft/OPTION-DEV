@extends('homeOption2h')
@section('title','Calendario')

@section('plugins.Select2',true)
@section('plugins.toastr',true)
@section('plugins.Sweetalert2',true)



{{-- cuerpo de la pagina --}}
@section('contenido')
    @movil
      <div class="row mt-1">
        <div class="col-md-12 mb-4">
          <p class="m-0  "> 
           <i class="fas fa-angle-down text-info_ mr-2 fa-lg"></i> 
            <span class="text-info_ text-mes text-capitalize">@if(isset($dato_fecha)) {{$dato_fecha['mes']}} @endif </span> 
            <span class="text-muted text-year ml-1">@if(isset($dato_fecha)) {{$dato_fecha['año']}} @endif</span> 
            <span class="text-semana ml-3"> <i class="fas fa-angle-left fa-md"></i> Semana @if(isset($dato_fecha)) {{$dato_fecha['semana']}} @endif <i class="fas fa-angle-right fa-md"></i> </span>
          </p>
        </div>
      </div>
    @else
    <div class="row ">
      <div class="col text-center  @movil @else mt-5 @endmovil">
          <a href="javascript: history.go(-1)" class="text-leth float-left ">  <i class="fas fa-chevron-left  text-info_ fa-2x ml-1 mb-1 "></i></a>
      </div>
    </div>
      <div class="row mt-1">
        <div class="col-md-12 mb-4">
          <p class="m-0 "> 
           <i class="fas fa-angle-down text-info_ mr-2 fa-lg"></i> 
            <span class="text-info_ text-mes text-capitalize">@if(isset($dato_fecha)) {{$dato_fecha['mes']}} @endif </span> 
            <span class="text-muted text-year ml-2">@if(isset($dato_fecha)) {{$dato_fecha['año']}} @endif</span> 
            <span class="text-semana ml-5"> <i class="fas fa-angle-left fa-md"></i> Semana @if(isset($dato_fecha)) {{$dato_fecha['semana']}} @endif <i class="fas fa-angle-right fa-md"></i> </span>
          </p>
        </div>
      </div>
    @endmovil

    

    <div class="row ">
      <div class="col text-center ">
        <div id="agenda" class=" @movil @else mb-4 p-2 @endmovil" style=""></div>  
      </div>
    </div>

    @include('agenda.modalFormCita')
    @include('agenda.modalInfoCita')

    
    <!-- /.modal -->
@stop

{{-- Seccion para insertar css--}}
@section('include_css') 
 
  {{-- fullcalendario css --}}
  <link rel="stylesheet" href="{{ secure_asset('vendor/lib/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/FormCitasRegistro.css') }}">
  {{-- jquery-ui js --}}
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

  <link rel="stylesheet" href="{{ asset('css/calendario.css') }}">
@stop 
 

{{-- Seccion para insertar js--}}
@section('include_js')
  
  {{-- fullcalendario js --}}
  <script src="{{ secure_asset('vendor/lib/main.js') }}"></script>
  <script src="{{ secure_asset('vendor/lib/locales-all.js') }}"></script>
  
  <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
  <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
  
  {{-- libreria moment --}}
  <script src="{{ secure_asset('vendor/moment/moment.min.js') }}"></script>
  <script src="{{ secure_asset('vendor/moment/moment-with-locales.js') }}"></script>
    @if(session()->has('info'))
      <script >
         sweetalert('{{session('info')}}','{{session('estado')}}')
      </script>
    @endif

    {{-- Mensaje de informacion --}}
    @if(isset($info))
      <script >
         sweetalert('{{$info}}','{{$estado}}');
      </script>
    @endif

  {{-- gestion js calendario --}}
  <script src="{{ asset('/js/calendario.js') }}"></script>
   <script src="{{ asset('/js/gestionSaveAgenda.js') }}"></script>
  
  {{-- jquery-ui --}}
  <script src="{{ asset('/js/jquery-ui.js') }}"></script>
  <script >

    $("#modal-form-cita").draggable({
      handle: ".modal-header",
      cursor: 'pointer', 
    });

    $("#modal-info-cita").draggable({
      handle: ".modal-header"
    });
  </script> 
 
  
@stop