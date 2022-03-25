@extends('homeOption2h')
@section('title','Crear Publicación')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.datatable',true)

@section('content_header')
   
@stop
{{-- cuerpo de la pagina --}}
@section('contenido')
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class=" col-md-11  ">
				<div class="row">
				  <div class="col-xs-12 col-sm-12 col-md-12">
				    <div class="card card-default border-0">
				      <div class="card-header border-0">
				        <h3 class="card-title">{{-- Registrar datos --}}</h3>
				      </div>
				      <div class="card-body  ">
				        <div class="bs-stepper">
					        <div class=" " role="tablist">
					            <!-- your steps here -->
					            <div class="row">

					            	<div class="col-sm-12 col-md-4 ">
					            		<div class="step  text-left " data-target="#logins-part">
					            		  <button type="button" class="step-trigger  btn-block " role="tab" aria-controls="logins-part" id="logins-part-trigger">
					            		    <span class="bs-stepper-circle text-left bgz-info">1</span> 
					            		    <span class="bs-stepper-label  ">Información Principal</span> 
					            		  </button>
					            		</div> 
					            	</div>

					            	<div class="col-sm-12 col-md-4 ">
					            		<div class="step  text-left " data-target="#information-part">
					            		  <button type="button" class="step-trigger  btn-block text-left" role="tab" aria-controls="information-part" id="information-part-trigger">
					            		    <span class="bs-stepper-circle  text-left bgz-info">2</span>
					            		    <span class="bs-stepper-label  text-left">Información Complementaria</span>
					            		  </button>
					            		</div>
					            	</div>

					            	<div class="col-sm-12 col-md-4 ">
					            		<div class="step text-left" data-target="#information-part2">
					            		  <button type="button" class="step-trigger  btn-block" role="tab" aria-controls="information-part2" id="information-part-trigger2">
					            		    <span class="bs-stepper-circle bgz-info	">3</span>
					            		    <span class="bs-stepper-label">Información Complementaria Final</span>
					            		  </button>
					            		</div>
					            	</div>

					            </div>  
					        </div>
					        <div class="bs-stepper-content">
					            <!-- your steps content here -->
					            <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
						            <form method="POST" id="form_1">  
						            	<div class="card mt-4 border border-info">
						            	    <div class="card-body">
						            	    	<div class="row ">
						            	    	  <div class="col-xs-12 col-sm-12 col-md-12">
						            	    	    <div class="form-group ">
						            	    	        <label class="text-muted" for="titulo" >Nombre de la Publicación<span class="text-red">*</span></label>
						            	    	        <input id="titulo" type="text" class="form-control " name="titulo" value="" placeholder="Ej: Falta de aire y disnea son sinonimos" required  autocomplete="titulo" autofocus>
						            	    	    </div>
						            	    	  </div>
						            	    	  <div class="col-xs-12 col-sm-12 col-md-12">
						            	    	    <div class="form-group ">
						            	    	        <label class="text-muted" for="area_desc" >Áreas directa o indirectamente relacionadas a la enfermedad / tema / contenido<span class="text-red">*</span></label>
						            	    	        <textarea class="form-control"  rows="4" placeholder="Ej: Falta de aire y disnea son sinonimos"  value="" name="area_desc"  autocomplete="area_desc" id="area_desc" autofocus value="" required></textarea>
						            	    	    </div>
						            	    	  </div>
						            	    	  <div class="col-xs-12 col-sm-12 col-md-12">
						            	    	    <div class="form-group ">
						            	    	        <label class="text-muted" for="url_video" >Url del video<span class="text-red">*</span> 
						            	    	        	<small class="text-mutsed text-primary cursor-pointer " style="cursor: pointer;" data-toggle="modal" data-target="#ayuda">(Ayuda)</small>
						            	    	        </label>
						            	    	        <input id="url_video"  type="text" class="form-control" name="url_video" value="" placeholder="Ej: https://www.youtube.com/embed/go1VxrDbr8g" required autocomplete="url_video" autofocus>
						            	    	        <span id="url_video" class="error invalid-feedback">Por favor Ingresar (URL) valida </span>
						            	    	    </div>
						            	    	  </div>
						            	    	  <div class="col-xs-12 col-sm-12 col-md-12">
						            	    	    <div class="form-group ">
						            	    	        <label class="text-muted" for="descripcion" > Texto a presentar en la Publicación <span class="text-red">*</span></label>
						            	    	        <textarea class="form-control"  rows="3" placeholder="Ej: Un absceso cerebral es una emergencia médica. La presión intracraneal puede volverse tan alta que puede ser mortal. Usted necesitará hospitalización hasta que su condición sea estable. Algunas personas pueden requerir soporte vital"   value="" name="descripcion"  autocomplete="descripcion" id="descripcion" autofocus value="" required></textarea>
						            	    	    </div>
						            	    	  </div>
						            	    	  <div class="col-xs-12 col-sm-12 col-md-12">
						            	    	    <div class="form-group ">
						            	    	        <label class="text-muted" for="vinculo_art" >Url para mas información de la publicación</label>
						            	    	        <input id="vinculo_art" type="text" class="form-control " name="vinculo_art" value="" placeholder="Ej: https://medlineplus.gov/spanish/ency/article/000783.htm"  autocomplete="vinculo_art" autofocus />
						            	    	        <span id="vinculo_art" class="error invalid-feedback">Por favor Ingresar (URL) valida </span>
						            	    	    </div>
						            	    	  </div>
						            	    	  
						            	    	</div>     
						            	    </div>
						            	</div>
							            <button class="btn btn-info" type="submit" >Siguiente</button>
							            <a class="btn  float-md-right btn-outline-info btz-info" href="{{url('medico/perfil')}}"><i class="far fa-arrow-alt-circle-left"></i> Cancelar</a>
							            
						            </form>
					            </div>
					            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
					            	<form method="POST" id="form_2">  

					            		<div class="card mt-4 border border-info">
					            			<div class="card-body">
						            			<div class="row">
						            				<div class="col-xs-12 col-sm-12 col-md-12">
						            				  <div class="form-group ">
						            				      <label class="text-muted" for="afecta_desc" >Sexo (Esta enfermedad afecta a ...) <span class="text-red">*</span></label>
						            				      <input id="afecta_desc" type="text" class="form-control " name="afecta_desc" value="" placeholder="Esta enfermedad afecta a" required autocomplete="afecta_desc" autofocus>
						            				  </div>
						            				</div>	
							            			<div class="col-xs-12 col-sm-12 col-md-6">
							            			    <div class="form-group ">
							            			      <label class="text-muted" for="edad_inicial" >Límite de edad (INICIA EN ) <span class="text-red">*</span></label>
							            			      <input id="edad_inicial" type="number" min="1" class="form-control " name="edad_inicial" value=""  required autocomplete="edad_inicial" autofocus />
							            			      <span id="edad_inicial" class="error invalid-feedback">La edad inicial debe ser menor a la final</span>
							            			    </div>
							            			</div>
							            			<div class="col-xs-12 col-sm-12 col-md-6">
							            			    <div class="form-group ">
							            			      <label class="text-muted" for="edad_final" >Límite de edad (TERMINA EN) <span class="text-red">*</span></label>
							            			      <input id="edad_final" type="number" min="1" class="form-control " name="edad_final" value="" required autocomplete="edad_final" autofocus />
							            			      <span id="edad_final" class="error invalid-feedback">La edad final debe ser mayor a la inicial</span>
							            			    </div>
							            			</div>
							            			<div class="col-xs-12 col-sm-12 col-md-12">
							            				<div class="form-group ">
						            				      <label class="text-muted" for="sintoma" >Síntomas<span class="text-red">*</span></label>
						            				      <textarea class="form-control"  rows="3" placeholder="Ingrese Síntomas"  value="" name="sintoma"  autocomplete="sintoma" id="sintoma" autofocus  required></textarea>
						            				  </div>
						            				</div>
						            			</div>
						            		</div>
					            		</div>
					            		<button class="btn btn-secondary" type="button"  onclick="stepper.previous()">Anterior</button>
					            		<button class="btn btn-info" type="submit" >Siguiente</button>
					            	</form>	
					            </div>
					            <div id="information-part2" class="content" role="tabpanel" aria-labelledby="information-part-trigger2">
					            	<form method="POST" id="form_3">  
					            		<div class="card mt-4 border border-info">
					            			<div class="card-body">
					            				<div class="row">
					            					<div class="col-xs-12 col-sm-12 col-md-12">
					            					  <div class="form-group ">
					            					      <label class="text-muted" for="causas" >Causas </label>
					            					      <textarea class="form-control"  rows="3" placeholder="Ingrese Causas"  value="" name="causas"  autocomplete="causas" id="causas" autofocus ></textarea>
					            					  </div>
					            					</div>
					            					<div class="col-xs-12 col-sm-12 col-md-12">
					            					  <div class="form-group ">
					            					      <label class="text-muted" for="tratamiento" >Tratamiento </label>
					            					      <textarea class="form-control"  rows="3" placeholder="Ingrese Tratamiento"  value="" name="tratamiento"  autocomplete="tratamiento" id="tratamiento" autofocus  ></textarea>
					            					  </div>
					            					</div>
					            					<div class="col-xs-12 col-sm-12 col-md-12">
					            					  <div class="form-group ">
					            					      <label class="text-muted" for="diagnostico" >Diagnóstico</label>
					            					      <textarea class="form-control"  rows="3" placeholder="Ingrese Diagnóstico"  name="diagnostico"  autocomplete="diagnostico" id="diagnostico" autofocus value="" ></textarea>
					            					  </div>
					            					</div>
					            					<div class="col-xs-12 col-sm-12 col-md-12">
					            					  <div class="form-group ">
					            					      <label class="text-muted" for="enfermedades" >Enfermedades relacionadas</label>
					            					      <textarea class="form-control"  rows="3" placeholder="Ingrese Enfermedades relacionadas"  name="enfermedades"  autocomplete="enfermedades" id="enfermedades" autofocus value="" ></textarea>
					            					  </div>
					            					</div>
					            				</div>
					            			</div>
					            		</div>
					            		<button class="btn btn-secondary " type="button"  onclick="stepper.previous()">Anterior</button>
					            		<button class="btn btn-info " type="submit" >Guardar</button>


					            	</form>	
					            </div>

					        </div>

				        </div>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>
	
    
    {{-- //modal de ayuda url --}}
    @include('medico.modalAyudaUrl')
    
    @section('include_css') 
		<!-- BS Stepper -->
		<link rel="stylesheet" href="{{asset('../vendor/bs-stepper/css/bs-stepper.min.css')}}">
    @stop  

    {{-- Seccion para insertar js--}}
    @section('include_js')
	    {{-- medico js --}}
	    <script src="{{asset('js/medico.js')}}"></script>
	     <!-- BS-Stepper -->
    	<script src="{{asset('../vendor/bs-stepper/js/bs-stepper.min.js')}}"></script>
		 <script>
		  	// BS-Stepper Init
			document.addEventListener('DOMContentLoaded', function () {
		  	  window.stepper = new Stepper(document.querySelector('.bs-stepper'))
		  	})
		  	
		 </script>
		 
    @stop
    
 @stop
