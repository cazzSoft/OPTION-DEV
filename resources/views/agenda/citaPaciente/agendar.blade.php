@extends('homeOption2h')
@section('title','agendar')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.datatable',true)
@section('plugins.Select2',true)

@section('content_header')
   	@movil
   	  <div class="row">
   	    <div class="col-md-12 ">
   	        <div class="flex_titulo">
   	         <a href="{{url('agenda/cita')}}">  <p class=" text-lead h5 text-dark ">  <i class="fas fa-chevron-left mr-3 text-info_"></i>  Agendar cita  </p></a>    
   	        </div>
   	    </div>
   	  </div>
   	@else
	    <div class="row ">
	      <div class="col text-center mt-5">
	        <a href="{{asset('agenda/cita')}}" class="text-left float-left ">  <i class="fas fa-chevron-left mr-1 text-info_ fa-2x ml-4 mb-2 "></i></a>
	        <span class="text-info_ h5"><b>Agendar cita</b></span>
	      </div>
	    </div>
   	@endmovil
@stop
{{-- cuerpo de la pagina --}}
@section('contenido')
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class="col-md-12">
	            <div class="card card-default shadow-none @movil p-0 ml-0 @else p-4 ml-4 @endmovil">
	            	<div class=" atenuar-horarios">
	            		
	            	</div>
	            	<div class="card-body p-0">
	            			
			            <form id="form_cita_paciente" action="" enctype="multipart/form-data" method="POST">
			                <div class="bs-stepper linear">
				                <div class="bs-stepper-header  @movil row col-12 @else row col-6 m-auto @endmovil" role="tablist">
				                    
				                    <div class="step" data-target="#sintomas">
					                    <button type="button" class="step-trigger btn-info" role="tab" aria-controls="sintomas" id="logins-part-trigger" aria-selected="false" disabled="disabled">
					                      	<span class="bs-stepper-label">Sintomas</span> 
					                        <span class="bs-stepper-circle text-left ">1</span>
					                    </button>
				                    </div>

				                    <div class="line"></div>

				                    <div class="step active" data-target="#fecha_hora">
				                      	<button type="button" class="step-trigger" role="tab" aria-controls="fecha_hora" id="information-part-trigger" aria-selected="true">
					                        <span class="bs-stepper-label">Fecha y Hora</span>
					                        <span class="bs-stepper-circle">2</span>
				                      	</button>
				                    </div>
				                </div>
			                  	<div class="bs-stepper-content">
			                    	<div id="sintomas" class="content " role="tabpanel" aria-labelledby="logins-part-trigger">
			                       		
			                       		<div class="row">
			                       			<div class="col-md-12 mt-4">
			                       				<label for="exampleInputEmail1" class="h5 text-info_ col-12">Motivo de consulta</label>
			                       			</div>
		                       				<div class="col-md-6 col-sm-12">
	                       					  	<div class="form-group row">
	                       					    	<label class="text-muted col-form-label col-12" for="detalle">¿Cual es la molestia que tiene?</label>
	                       					    	<textarea class="form-control shadow-sm border border-white col-md-10 col-sm-12"  rows="4" placeholder="Ingrese texto..."  name="detalle"  id="detalle"  autofocus  ></textarea>
	                       					  	</div>	
		                       				</div>
		                       				@if(isset($citas_AT) && $citas_AT > 0)
			                       				<div class="col-md-6 col-sm-12">
		                       					  	<div class="form-group row">
		                       					    	<label class="text-muted col-form-label col-12" for="detalle">Adjuntar examenes complementarios:</label>
		                       					    	<div class="form-group p-2 ">
		                       					    	  <label for="img_examenes" class="custom-img_examenes text-left text-muted btn border-dark p-2">
		                       					    	    <i class="fas fa-image text-info_ fa-lg mr-2"></i> Adjuntar 
		                       					    	    <i class="fa-solid fa-circle-arrow-up text-info_ fa-lg ml-5 pl-4"></i>
		                       					    	  </label>
		                       					    	  <input  accept="image/*,.pdf" name="img_examenes[]"  id="img_examenes" class=""  onchange="processSelectedFiles(this)" type="file" multiple  />
		                       					    	  <ul class="list-file text-info_"></ul>
		                       					    	</div>
		                       					  	</div>	
			                       				</div>	
			                       			@endif
			                       		</div>

				                    	

				                       	<div class="form-group row">
				                        	<label for="exampleInputEmail1" class="h5 text-info_ col-12">Datos personales</label>
				                      	</div>

				                      	{{-- datos personales user --}}
				                      	<div class="form-group row ">
				                      		<input type="hidden" id="idp" value="{{ encrypt(auth()->user()->id)}}">
				                        	<label class=" col-md-2 col-sm-12 text-muted col-form-label @movil @else text-right @endmovil" for="name">Nombres:</label>
				                        	<input type="text" class="form-control shadow-sm col-md-3 col-sm-12 border-white" id="name" name="name" value="{{auth()->user()->name}}">
				                      	</div>
				                      	<div class="form-group row">
				                        	<label class="col-md-2 col-sm-12 text-muted col-form-label @movil @else text-right @endmovil" for="apellido">Apellidos:</label>
				                        	<input type="text" class="form-control shadow-sm col-md-3 col-sm-12 border-white" id="apellido" name="apellido" value="{{auth()->user()->apellido}}">
				                      	</div>
				                      	<div class="form-group row">
				                        	<label class=" col-md-2 text-muted   @movil @else text-right @endmovil" for="cedula">Cedula o Pasaporte:</label>
				                        	<input type="text" class="form-control shadow-sm col-md-3 col-sm-12 border-white" id="cedula" name="cedula" value="{{auth()->user()->cedula}}">
				                      	</div>
				                      	<div class="form-group row">
				                        	<label class=" col-md-2 text-muted col-form-label  @movil @else text-right @endmovil" for="edad">Edad:</label>
				                        	<input type="text" class="form-control shadow-sm col-md-3 col-sm-12 border-white" id="edad" name="cedula" value="{{ \Carbon\Carbon::parse(auth()->user()->fecha_nacimiento)->age}}">
				                      	</div>
				                      	<div class="form-group row">
				                        	<label class=" col-md-2 text-muted col-form-label  @movil @else text-right @endmovil" for="sexo">Sexo:</label>
				                        	<div class="col-md-3 col-sm-12 p-0">
				                        		<select class="form-control select2 form-control-sm shadow-sm "  data-placeholder="Seleccione sexo" style="width: 100%;"  name="sexo" id="sexo">
				                        		  <option></option>
				                        		  <option @if(auth()->user()->sexo==1) selected="selected" @endif value="1">Hombre</option>
				                        		  <option @if(auth()->user()->sexo==0) selected="selected" @endif value="0">Mujer</option> 
				                        		</select>
				                        	</div>
				                      	</div>
				                      	{{-- <div class="form-group row">
				                        	<label class=" col-md-2 text-muted col-form-label  @movil @else text-right @endmovil " for="peso">Peso:</label>
				                        	<input type="number" placeholder="65 kg" step="0.01"  class="form-control shadow-sm col-md-3 col-sm-12 border-white" id="peso" name="peso" value="@if($datos_medicos['peso']>0){{$datos_medicos['peso']}}@endif">
				                      	</div>
				                      	<div class="form-group row">
				                        	<label class=" col-md-2 text-muted col-form-label  @movil @else text-right @endmovil" for="talla">Estatura:</label>
				                        	<input type="number" placeholder="1.70 m" step="0.01" class="form-control shadow-sm col-md-3 col-sm-12 border-white " id="talla" name="talla" value="@if($datos_medicos['talla']>0){{$datos_medicos['talla']}}@endif">
				                      	</div> --}}
				                      	

				                      	<div class="row col-12 m-auto">
				                      		<div class="form-group  text-center m-auto">
					                      		<div class="mt-4 text-center">
					                      			 <a href="{{url('agenda/cita')}}" class="card-link  btn btn-white border-info pr-5 pl-5">Cancelar</a>
					                      			 <button type="button" class="btn btn-secondary  pr-5 pl-5" id="sig_cp" disabled onclick="siguiente()">Siguiente</button>
					                      		</div>
					                      	</div>
			                      		</div>
				                    
				                	</div>  	
			                    </div>

			                    <div id="fecha_hora" class="content active dstepper-block" role="tabpanel" aria-labelledby="information-part-trigger">	
			                    	@include('agenda.citaPaciente.fecha_hora')
			                      	
			                      	<div class="row col-12 m-auto">
			                      		<div class="form-group  text-center m-auto">
				                      		<div class="mt-4 text-center">
				                      			 
				                      			 <button type="button" class="btn btn btn-white border-info pr-5 pl-5" onclick="stepper.previous()">Regresar</button>
				                      			 <button type="submit" class="btn btn-info  pr-5 pl-5"  id="btn_save_cita" >
					                      			 Guardar cita
				                      			</button>
				                      		</div>
				                      	</div>
		                      		</div>

			                    </div>

			                </div>
			            </form>
		            </div>
	            </div>
	        </div>
	    </div>
	</div>
	
	
   
    @section('include_css') 

    	<!-- icheck -->
    	<link rel="stylesheet" href="{{ secure_asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    	
    	<!-- Tempusdominus Bootstrap 4 -->
  		<link rel="stylesheet" href="{{secure_asset('vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
		
  		<link rel="stylesheet" href="{{secure_asset('vendor/datepicker/css/bootstrap-datepicker.css')}}">

		<!-- BS Stepper -->
		<link rel="stylesheet" href="{{secure_asset('vendor/bs-stepper/css/bs-stepper.min.css')}}">

		{{-- gestion de cita paciente --}}
		<link rel="stylesheet" href="{{ asset('css/agendar.css') }}">

    @stop  

    {{-- Seccion para insertar js--}}
    @section('include_js')
	    
	    {{-- libreria moment --}}
	    <script src="{{ secure_asset('vendor/moment/moment.min.js') }}"></script>
	    <script src="{{ secure_asset('vendor/moment/moment-with-locales.js') }}"></script>

	    <!-- Tempusdominus Bootstrap 4 -->
	   	<script src="{{secure_asset('vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

	   	{{-- datepicker --}}
	   	<script src="{{secure_asset('vendor/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
	   	<script src="{{secure_asset('vendor/datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
	     <!-- BS-Stepper -->
    	<script src="{{secure_asset('vendor/bs-stepper/js/bs-stepper.min.js')}}"></script>
		
		

		{{-- agendar paciente js --}}
	    <script src="{{asset('js/agendar.js')}}"></script>	

    @stop
    
@stop
