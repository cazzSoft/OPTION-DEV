@extends('configuracionMedico.gestion')

@section('contenido-configiracion')
	
	<div class="row">
		<div class="col-12">
			<p>Para configurar un horario, tan solo selecciona los días marcando en el recuadro, posteriormente selecciona el intervalo de horas que trabajarás los días seleccionados y dale a guardar. 
			</p>
			<p>
				Nota: Puedes crear varias configuraciones para cada día.
			</p>

		</div>
		<div class="col-12">
			<div class="row  ">
				<div class="col-md-9 col-sm-12 m-auto">
					<div class="card  shadow-none border border-white">
		              <!-- form start -->
			            <form method="POST" action="{{ url('horario/gestion') }}"  enctype="multipart/form-data" id="form_horario" >
	                		@csrf
	                		<input  type="hidden" name="_method" id="method_horario" value="POST">
			                <div class="card-body shadow-none border border-white">
				                <div class="form-group row">
				                    <label for="inputEmail3" class="col-sm-3  text-right h5">Dias de trabajo: <br><small>(permitido selección multiple)</small></label>
				                    <div class="col-sm-8 text-left">
					                     {{-- horario --}}
					                    @if(isset($lista_dias))
					                      	<div class="row m-auto secction_dia"> 
						                      	@foreach( $lista_dias as $key=>$item)
						                      		<div class="col m-auto text-center">
						                      			<span class="text-info_ text-center mr-1"><strong>{{$item['descripcion']}}</strong></span>
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

				                <div class="form-group row">
				                   
				                   <label for="inputPassword3" class="col-sm-3  text-right h5 ">Horas:</label>
				                    <div class="col-sm-8  ">
				                    	<div class="row m-auto ">
				                    		<div class="col-6">
				                    			 <div class="form-group row">
				                    			 	<label for="inputPassword3" class="col-sm-3 col-form-label text-right">Inicio:</label>
				                    			 	<select class="form-control select2 @error('hora_inicio') is-invalid @enderror col-6 form-control form-control-sm" data-placeholder="Seleccione" value="{{old('hora_inicio')}}" name="hora_inicio" id="hora_inicio" >
				                    			 		<option></option>
				                    			 		@if(isset($horas_laboral))
				                    			 			@foreach($horas_laboral as $key=>$item)
				                    			 				<option @if(old('hora_inicio')==$item['id']) selected  @endif value="{{$item['id']}}">{{$item['text']}}</option>
				                    			 			@endforeach
				                    			 		@endif
				                    			 	</select>
				                    			 	 {{-- <input type="time" class="@error('hora_inicio') is-invalid @enderror col-6 form-control form-control-sm" id="hora_inicio" name="hora_inicio" value="{{old('hora_inicio')}}"> --}}
				                    			 	 @error('hora_inicio')
				                    				  <span class="invalid-feedback m-auto  text-center" role="alert">
				                    				    <strong>{{ $message }}</strong>
				                    				  </span>
				                    				@enderror
				                    			 </div>
				                    		</div>	
				                    		<div class="col-6">
				                    			<div class="form-group row">
				                    				<label for="inputPassword3" class="col-sm-3 col-form-label ">Fin:</label>
				                    				{{-- <input type="time" class="@error('hora_fin') is-invalid @enderror col-6 form-control form-control-sm" id="hora_fin" name="hora_fin" value="{{old('hora_fin')}}"> --}}
				                    				<select class="form-control select2  @error('hora_fin') is-invalid @enderror col-6 form-control form-control-sm" data-placeholder="Seleccione" value="{{old('hora_fin')}}" name="hora_fin" id="hora_fin"  >
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
			                 	<div class="form-group row text-center">
				                    <div class="col-md-3 col-sm-6 col-xs-12 m-auto">
				                      <button type="submit" class="btn btn-info btn-block" id="btn_horario_save">Guardar cambios</button>
				                    </div>
				                  
			                  	</div>
			                  	<div class="form-group row text-center d-none cancel">
				                    <div class="col-sm-3 m-auto">
				                  		 <button type="reset" class="btn text-info_" id="btn_horario_cancelar"><u>Cancelar</u></button>
				                    </div>
			                  	</div>
			                  	{{-- mensaje alert --}}
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
				</div>
				
			</div>
		</div>
		
		<div class=" m-auto @movil col-12 @else col-md-8 col-sm-12 @endmovil">
			@if(isset($lista_horarios) &&  $lista_horarios!='[]')
				<div class="card p-0 m-0 shadow-none border border-white">
		            <div class="card-body ">
		                <table class="table text-center border-top border-left border-right border-bottom " >
		                  	<thead >
			                    <tr >
			                      <th>Dia de la semana</th>
			                      <th>Horas</th>
			                      <th style="width: 40px">Estado</th>
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
				                      	<td style="vertical-align: middle;" class="text-center ">
				                      	  	<form method="POST"  class="frm_eliminar_horario" action="{{url('horario/gestion/'.$item->idhorario_medico_encrypt)}}"  enctype="multipart/form-data">
					                      	    <div class="btn-group btn-group-sm">
					                      	        {{ csrf_field() }}
					                      	        <input type="hidden" name="_method" value="DELETE">
					                      	    </div>
				                      	      	<div class="btn-group este">
				                      	        	<button type="button" class="btn btn-link text-info_ dropdown-toggle border border-info btn-block " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                      	           		<span class="pl-4 pr-4">Acciones</span>
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
	</div>
@stop