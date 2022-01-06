@extends('homeOption2h')
@section('title','HOME')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.datatable',true)

@section('content_header')
    <h1>Agregar Publicación</h1>
@stop
{{-- cuerpo de la pagina --}}
@section('contenido')

	<div class="row">
	  <div class="col-xs-12 col-sm-12 col-md-12">
	    <div class="card card-default">
	      <div class="card-header">
	        <h3 class="card-title">Registrar datos</h3>
	      </div>
	      <div class="card-body  ">
	        <div class="bs-stepper">
		        <div class=" " role="tablist">
		            <!-- your steps here -->
		            <div class="row">

		            	<div class="col-sm-12 col-md-4 ">
		            		<div class="step  text-left " data-target="#logins-part">
		            		  <button type="button" class="step-trigger  btn-block" role="tab" aria-controls="logins-part" id="logins-part-trigger">
		            		    <span class="bs-stepper-circle">1</span>
		            		    <span class="bs-stepper-label  ">Información Principal</span>
		            		  </button>
		            		</div> 
		            	</div>

		            	<div class="col-sm-12 col-md-4 ">
		            		<div class="step  text-left " data-target="#information-part">
		            		  <button type="button" class="step-trigger  btn-block text-left" role="tab" aria-controls="information-part" id="information-part-trigger">
		            		    <span class="bs-stepper-circle  text-left">2</span>
		            		    <span class="bs-stepper-label  text-left">Información Complementaria</span>
		            		  </button>
		            		</div>
		            	</div>

		            	<div class="col-sm-12 col-md-4 ">
		            		<div class="step text-left" data-target="#information-part2">
		            		  <button type="button" class="step-trigger  btn-block" role="tab" aria-controls="information-part2" id="information-part-trigger2">
		            		    <span class="bs-stepper-circle ">3</span>
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
		            		<button class="btn btn-secondary" type="button"  onclick="stepper.previous()">Anterior</button>
		            		<button class="btn btn-info" type="submit" >Guardar</button>
		            	</form>	
		            </div>
		        </div>

	        </div>
	      </div>
	    </div>
	  </div>
	</div>
    <div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
		    <div class="card card-default">
			    <div class="card-header">
			        <h3 class="card-title">Lista de publicaciones registradas</h3>
			    </div>
		      	<div class="card-body  ">
		      		<div class="table-responsive">
		      			<table id="table_publi" class=" data_table table table-sm table-bordered table-striped">
		      			    <thead>
		      			        <tr>
		      			            <th> # </th>
		      			            <th>Nombre de la Publicación</th>
		      			            <th>Texto a presentar en la Publicación</th>
		      			            <th width="180px">Fecha </th>
		      			            <th >Verificación de información  </th>
		      			            <th width="80px">Opciones</th>
		      			        </tr>
		      			    </thead>
		      			    <tbody>
		      			        @if (isset($listaArt))
		      			            @foreach ($listaArt as $key => $item)
		      			                <tr >
		      			                    <td>{{ $key + 1 }}</td>
		      			                    <td>{{ $item->titulo }}</td>
		      			                    <td>{{ $item['descripcion'] }}</td>
		      			                    <td>{{$item->created_at->isoFormat(' lll') }}</td>
		      			                    @if ($item['estado'])
		      			                        <td class="text-center text-success bz-success" style="vertical-align: middle;"><i class="fa fa-check "> Aprobado</i> 
		      			                        	<p class="text-muted">Tu publicación ha sido revisada correctamente proceda a publicar.</p>
		      			                        </td>
		      			                    @else
		      			                        <td class="text-center  bz-warning" style="vertical-align: middle;"> <i class="fa fa-eye"></i> Pendiente </td>
		      			                    @endif

		      			                    <td class="text-center" style="vertical-align: middle;">
			      			                    @if($item['estado'])
			      			                    <button type="button" class="btn btn-sm @if($item['publicar']) btn-info @else btn-success @endif"
		      			                    	        onclick="confi_pub('{{$item->idarticulo_encryp}}', this,'{{$item['publicar']}}')">
		      			                    	    @if($item['publicar']) 
		      			                    	       	<i class="fa fa-eye-slash"></i> Quitar publicación  
		      			                    	    @else  
		      			                    	       	<i class="fa fa-notes-medical"></i> Publicar 
		      			                    	    @endif
		      			                    	</button>
		      			                    	@else
		      			                    	<button class="btn btn-light">No disponible</button>
		      			                    	@endif
		      			                    </td>
		      			                </tr>
		      			            @endforeach
		      			        @endif
		      			    </tbody>
		      			</table>		
		      		</div>
		    	</div>
			</div>
		</div>
	</div>
    //modal de ayuda url
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
