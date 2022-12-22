@extends('homeOption2h')
@section('title','Empoderate')

{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)

{{-- cuerpo de la pagina --}}
@section('contenido')
	@movil
	    <div class="row ">
	      	<div class="col-12 ">
		        <div class="flex_titulo mt-2 mb-2"> 
		          <a href="{{ url('horario/gestion') }}"> 
		          	<p class=" text-lead  text-info_ ">  
		          		<i class="fas fa-chevron-left  mr-2 fa-1x b"></i> Horarios  
		          	</p>
		          </a> 
		        </div>
	      	</div>
	    </div>
	@else
	    <div class="row ">
		    <div class="col text-center mt-5">
		        <a href="{{ url('/') }}" class="text-leth float-left ">  <i class="fas fa-chevron-left  text-info_ fa-2x ml-5 mb-5 "></i></a>
		        <span class="text-info_ h5"><b> Horarios</b></span>
		    </div>
	    </div>
	@endmovil

  	<div class="row p-0 ">
	    @movil
	   		<div class="col-12 p-0 m-0">
	   			<p class="text-justify parrafo_h " >
	   				Para configurar un horario, tan solo selecciona los días marcando en el recuadro, <span class="text-info_ " onclick="ver_mas()"><u>ver más.</u></span>
	   			</p>
	   		</div>
   			<div class="col-12  m-0 p-0">
	            <form method="POST" action="{{ url('horario/gestion') }}"  enctype="multipart/form-data" id="form_horario" >
            		@csrf
            		<input  type="hidden" name="_method" id="method_horario" value="POST">
            		<div class="row  m-0">
		                <div class="form-group col-12 ">
		                    <label for="dias" class=" text-left text-bol text-dark">Dias de trabajo: 
		                    	<br><span class="text-small text-muted ">(permitido selección multiple)</span>
		                    </label>
		                    <div class="p-0  m-0">
			                    @if(isset($lista_dias))
			                      	<div class="row m-auto secction_dia p-0"> 
				                      	@foreach( $lista_dias as $key=>$item)
				                      		<div class="col m-auto text-center text-truncate">
				                      			<span class="text-info_ text-truncate">{{$item['descripcion']}}</span>
				                      			<div class="icheck-info">
		                            				<input type="checkbox" id="{{$item['iddias']}}_dia"  value="{{$item['iddias']}}"  name="dias[]">
		                            				<label for="{{$item['iddias']}}_dia"></label>
		                        				</div>
				                      		</div>	
				                      	@endforeach
			                      	</div>
			                    @endif	
			                  @error('dias') <small class="text-danger ml-4"> <strong>{{ $message }}</strong></small> @enderror     	 
		                    </div>
		                </div>
   					</div>
   					<div class="row m-0 ">
   						<div class="form-group col-12  ">
   						   <label for="horas" class="text-bol text-dark ">Horas:</label>
   						</div>
					    <div class="form-group col-12 ">
					    	<div class="row ">
					    		<div class="col-6 ">
					    			 <div class="form-group row">
					    			 	<label for="hora_inicio" class="ml-2 mr-1">Inicio:</label>
					    			 	<select class="form-control select2 @error('hora_inicio') is-invalid @enderror col-7 form-control form-control-sm" data-placeholder="Seleccione" value="{{old('hora_inicio')}}" name="hora_inicio" id="hora_inicio" >
					    			 		<option></option>
					    			 		@if(isset($horas_laboral))
					    			 			@foreach($horas_laboral as $key=>$item)
					    			 				<option @if(old('hora_inicio')==$item['id']) selected  @endif value="{{$item['id']}}">{{$item['text']}}</option>
					    			 			@endforeach
					    			 		@endif
					    			 	</select>
					    			 	
					    			 	 @error('hora_inicio')
					    				  <span class="invalid-feedback m-auto  text-center" role="alert">
					    				    <strong>{{ $message }}</strong>
					    				  </span>
					    				@enderror
					    			 </div>
					    		</div>	
					    		<div class="col-6">
					    			<div class="form-group row ">
					    				<label for="hora_fin" class="mr-1">Fin:</label>
					    				<select class="form-control select2  @error('hora_fin') is-invalid @enderror col-7 m-auto form-control form-control-sm" data-placeholder="Seleccione" value="{{old('hora_fin')}}" name="hora_fin" id="hora_fin"  >
					    					<option></option>
					    					@if(isset($horas_laboral))
					    						@foreach($horas_laboral as $key=>$item)
					    							<option @if(old('hora_fin')==$item['id']) selected  @endif value="{{$item['id']}}">{{$item['text']}}</option>
					    						@endforeach
					    					@endif
					    				</select>
					    				@error('hora_fin')
					    				  <span class="invalid-feedback m-auto  text-center" role="alert">
					    				    <strong>{{ $message }}</strong>
					    				  </span>
					    				@enderror	
					    			</div>
					    		</div>
					    	</div> 		
						</div>		
   					</div>
   					<div class="row">
	                 	<div class="form-group col-10 text-center m-auto">
		                	<button type="submit" class="btn btn-info shadow btn-block" id="btn_horario_save">Guardar cambios</button>
	                  	</div>
	                  	<div class="form-group col-10  m-auto text-center d-none cancel">
		                   <button type="reset" class="btn text-info_" id="btn_horario_cancelar"><u>Cancelar</u></button>
	                  	</div>
   					</div>
	                <div class="card-body shadow-none border border-white ">
	                  	@if(session()->has('msm'))
		                  	<div class="form-group row text-center message ">
			                    <div class="col-sm-6 m-auto">
                  					<div class="alert alert-white alert-dismissible text-danger shadow-none">
                  		              <span type="button" class="close" data-dismiss="alert" aria-hidden="true">×</span>
                  		              <h6><i class="icon fas fa-exclamation-triangle text-danger"></i>{{session('msm')}}</h6>
                  		            </div>	
			                    </div>
		                  	</div>
	                  	@endif
	                </div>
	            </form>
   			</div>
   			<div class="col-12  m-0 p-0 ">
				@if(isset($lista_horarios) &&  $lista_horarios!='[]')
					<div class="card p-0 m-0 shadow-none border border-white">
			            <div class="card-body table-responsive p-0">
			                <table class="table table-sm text-center border-top border-left border-right border-bottom " >
			                  	<thead >
				                    <tr>
				                      <th>Día</th>
				                      <th>Horas</th>
				                      <th >Estado</th>
				                      <th >Acciones</th>
				                    </tr>
				                </thead>
				                <tbody>
				                  	@foreach( $lista_horarios as $key=>$item)
					                  	<tr class=" @if($item['estado'])  @else text-light_ @endif bg_col">
					                      	<td>
					                      		@if(isset($item['horario_dias']))
					                      			@foreach( $item['horario_dias'] as $d=>$dias)
					                      				{{$dias['dias'][0]['descripcion']}}, 
					                      			@endforeach	
					                      		@endif
					                      	</td>
					                      	<td>
					                      		<span> {{$item['hora_inicio']}} - {{$item['hora_fin']}} </span>
					                      	</td>
					                      
					                      	<td>
					                      		@if($item['estado']) Activado  @else Desactivado @endif
					                      	</td>	
					                      	<td  class="text-center " style="width: 10px">
					                      	  	<form method="POST"  class="frm_eliminar_horario" action="{{url('horario/gestion/'.$item->idhorario_medico_encrypt)}}"  enctype="multipart/form-data">
						                      	    <div class="btn-group btn-group-sm">
						                      	        {{ csrf_field() }}
						                      	        <input type="hidden" name="_method" value="DELETE">
						                      	    </div>
					                      	      	<div class="btn-group este">
					                      	        	<button type="button" class="btn btn-link text-info_ dropdown-toggle border border-info btn-sm " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					                      	           		<span class="pl-4 pr-4">Editar</span>
					                      	        	</button>
						                      	        <div class="dropdown-menu">
						                      	        	<a class="dropdown-item text-info_"  onclick="btn_eliminar_horario(this)" href="#">Eliminar</a>
						                      	          	<a class="dropdown-item text-info_ " href="#for_archivo"  onclick="editar_horario('{{ $item->idhorario_medico_encrypt }}')"> Editar </a>
						                      	          	<a class="dropdown-item text-info_"  onclick="estado_horario('{{$item['idhorario_medico_encrypt']}}','@if($item['estado']) 0  @else 1 @endif',this)" href="#">
						                      	          		@if($item['estado']) Desactivar  @else Activar @endif
						                      	          	</a>
						                      	        </div>
					                      	      	</div>
					                      	  	</form> 
					                      	</td>  
					                    </tr>
				                  	@endforeach
				                </tbody>
			                </table>
			            </div> 
		            </div>
	            @else
	            	<div class="card p-0 m-0 shadow-none border border-white">
			            <div class="card-body ">
			                <table class="table text-center border-top border-left border-right border-bottom table-sm" style="height: 426px;" >
				                <thead >
				                    <tr class="text-muted">
				                      	<th >Dia de la semana</th>
				                    	<th>Horas</th>
				                      	<th >Estado</th>
				                      	<th >Acciones</th>
				                    </tr>
				                </thead>
				                <tbody>
				                   	<tr>
				                   		<td colspan="4" style="vertical-align: middle;" >
				                   			<div class="row col-sm-4 m-auto text-center">
				                   				<img src="{{asset('img/horario.png')}}" class="img-h text-center m-auto" alt="horario">
				                   			</div>
				                   			<div class="row col-12 text-center m-auto p-3">
				                   				<h5 class="m-auto text_">Aún no tienes configurado ningún horario</h5>
				                   			</div>
				                   		</td>
				                   	</tr>
				                </tbody>
			                </table>
			            </div> 
		            </div>
	            @endif
   			</div>
	    @else
	   		@include('configuracionMedico.horario')
	    @endmovil
  	</div>

@stop

 {{-- Seccion para insertar css--}}
@section('include_css') 
	@movil
		<link rel="stylesheet" href="{{ asset('css/horario_medico_app.css') }}">
		<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	@else
		<link rel="stylesheet" href="{{ asset('css/horario_medico.css') }}">
	@endmovil
  
@stop 
 

{{-- Seccion para insertar js--}}
@section('include_js')
	@movil
		{{-- gestion de horarios --}}
		<script src="{{ asset('/js/horario_medico.js') }}"></script>

		{{-- libreria moment --}}
		<script src="{{ secure_asset('https://momentjs.com/downloads/moment.min.js') }}"></script>

		{{-- Mensaje de informacion --}}
	    @if(session()->has('info'))
	     	<script>
	       		sweetalert('{{session('info')}}','{{session('estado')}}');
	     	</script>
	    @endif
	@endmovil
   
@stop
