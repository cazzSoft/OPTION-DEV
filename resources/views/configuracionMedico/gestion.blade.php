@extends('homeOption2h')
@section('title','configuración')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
{{-- cuerpo de la pagina --}}

@section('contenido')
  	<div class="sidenav sidebar sidebar-mini">
	  	<h3 class="p-1 mt-4 mb-4">Configuraciones</h3>
	    <a href="{{url('preferencia/gestion')}}" class="mt-2 d-none  {{ request()->is(['preferencia/gestion']) ? 'text-info_' : '' }}"><i class="fas fa-user-md"></i> Preferencias de la cuenta </a>
	    <a href="{{url('horario/gestion')}}" class="mt-2 {{ request()->is(['horario/gestion']) ? 'text-info_' : '' }}"><i class="far fa-calendar-check"></i> Horarios</a>
   
  	</div>

	<div class="main  @movil @else mt-3 @endmovil">
		@yield('contenido-configiracion')
	</div>

@stop

{{-- Seccion para insertar css--}}
 @section('include_css') 
 	
  {{-- stilos de configuracionMedica --}}
  <link rel="stylesheet" href="{{ asset('css/configuracionMedica.css') }}">
 	<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
 	
  {{-- horario medico --}}
 	<link rel="stylesheet" href="{{ asset('css/horario_medico.css') }}">
 @stop

 {{-- Seccion para insertar js--}}
 @section('include_js')

    {{-- gestion de horarios --}}
 	 <script src="{{ asset('/js/horario_medico.js') }}"></script>

   {{-- libreria moment --}}
 {{--   <script src="{{ secure_asset('vendor/moment/moment.min.js') }}"></script> --}}
   <script src="{{ secure_asset('https://momentjs.com/downloads/moment.min.js') }}"></script>

 	 {{-- Mensaje de informacion --}}
    @if(session()->has('info'))
      <script>
        sweetalert('{{session('info')}}','{{session('estado')}}');
      </script>
    @endif
 @stop