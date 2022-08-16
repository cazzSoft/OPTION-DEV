@extends('homeOption2h')
@section('title','Empoderate')

@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
{{-- cuerpo de la pagina --}}


@section('contenido')
	@movil
	    <div class="row mb-2">
	      	<div class="col-md-12 ">
		        <div class=" flex_titulo "> 
		          <a href="javascript: history.go(-1)"> 
		          	<p class=" text-lead  text-info_ ">  
		          		<i class="fas fa-chevron-left  mr-2 fa-1x"></i> ¡Empodérate de tu salud!  
		          	</p>
		          </a> 
		        </div>
	      	</div>
	    </div>
	@else
	    <div class="row ">
		    <div class="col text-center mt-5">
		        <a href="javascript: history.go(-1)" class="text-leth float-left ">  <i class="fas fa-chevron-left  text-info_ fa-2x ml-5 mb-5 "></i></a>
		        <span class="text-info_ h5"><b> ¡Empodérate de tu salud!</b></span>
		    </div>
	    </div>
	@endmovil

  	<div class="row justify-content-md-center">
	    <div class=" col ">
	      <div class="card card-tabs shadow-none">
	        <div class="card-header p-0 pt-1 ">
	          <ul class="nav nav-tabs nav-tabs-emp  shadow-md border-white " id="custom-tabs-five-tab" role="tablist">
	            <li class="nav-item ml-2">
	              <a class="nav-link active" id="custom-tabs-five-overlay-tab" data-toggle="pill" href="#custom-tabs-five-overlay" role="tab" aria-controls="custom-tabs-five-overlay" aria-selected="false">Uroanalisis</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link " id="custom-tabs-five-overlay-dark-tab" data-toggle="pill" href="#custom-tabs-five-overlay-dark" role="tab" aria-controls="custom-tabs-five-overlay-dark" aria-selected="false">
	              	Temperatura corporal
	              </a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link " id="custom-tabs-five-normal-tab" data-toggle="pill" href="#custom-tabs-five-normal" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="true">Indice de masa corporal</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link " id="custom-tabs-five-oxigeno-tab" data-toggle="pill" href="#custom-tabs-five-oxigeno" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="true">Saturación de oxigeno</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link " id="custom-tabs-five-f_cardiaca-tab" data-toggle="pill" href="#custom-tabs-five-f_cardiaca" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="true">Frecuencia cardiaca</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link " id="custom-tabs-five-p_arterial-tab" data-toggle="pill" href="#custom-tabs-five-p_arterial" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="true">Presión arterial</a>
	            </li>

	          </ul>
	        </div>
	        <div class="card-body border-light @movil p-0 @endmovil">
	          <div class="tab-content" id="custom-tabs-five-tabContent">
	            <div class="tab-pane  active show" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
	             	@include('empoderate.uroanalisis')
	            </div>
	            <div class="tab-pane fade " id="custom-tabs-five-overlay-dark" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-dark-tab">
	              @include('empoderate.temperatura_corporal')
	            </div>
	            <div class="tab-pane fade " id="custom-tabs-five-normal" role="tabpanel" aria-labelledby="custom-tabs-five-normal-tab">
	             	@include('empoderate.indice_de_masa_corporal')
	            </div>
	            <div class="tab-pane fade " id="custom-tabs-five-oxigeno" role="tabpanel" aria-labelledby="custom-tabs-five-oxigeno-tab">
	             	@include('empoderate.saturacion_de_oxigeno')
	            </div>
	            <div class="tab-pane fade " id="custom-tabs-five-f_cardiaca" role="tabpanel" aria-labelledby="custom-tabs-five-f_cardiaca-tab">
	             	@include('empoderate.frecuencia_cardiaca')
	            </div>
	            <div class="tab-pane fade " id="custom-tabs-five-p_arterial" role="tabpanel" aria-labelledby="custom-tabs-five-p_arterial-tab">
	             	@include('empoderate.precion_arterial')
	            </div>
	          </div>
	        </div>
	       
	      </div>
	    </div>
  	</div>

@stop

 {{-- Seccion para insertar css--}}
@section('include_css') 
   <link rel="stylesheet" href="{{ asset('css/empoderate.css') }}">
@stop 
 

{{-- Seccion para insertar js--}}
@section('include_js')
  <script src="{{ asset('/js/empoderate.js') }}"></script>
@stop