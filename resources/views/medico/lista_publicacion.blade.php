@extends('homeOption2h')
@section('title','Publicaciones')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.datatable',true)

@section('content_header')
    <div class="container-fluid">
		<div class="row ">
			<div class=" col-md-1 ">
				<a href="{{url('/medico/show')}}"><i class="fas fa-chevron-left fa-2x text-left ml-5 text-info_ mb-3"></i></a>
			</div>
			<div class=" col-md-10  text-center">
				<p class="h3 ml-5 text-info_"><b>Publicaciones registradas</b></p>
				 
			</div>
		</div>
	</div>
@stop
{{-- cuerpo de la pagina --}}
@section('contenido')
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class=" col-md-11  ">
				    <div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
						    <div class="card card-default">
							    <div class="card-header">
							        <h3 class="card-title"><a  class="btn btn-sm bgz-info float-left  pl-2 pr-2" href="{{url('gestion/articulo')}}">Agrear Publicación</a> </h3>
							    </div>
						      	<div class="card-body  ">
						      		<div class="table-responsive">
						      			<table id="table_publi" class=" data_table table table-sm border-0 text-center">
						      			    <thead>
						      			        <tr class="text-info">
						      			            <th> # </th>
						      			            <th width="180px">Fecha </th>
						      			            <th>Nombre de la Publicación</th>
						      			            <th>Texto a presentar en la Publicación</th>
						      			            
						      			            <th width="180px">Verificación de información  </th>
						      			            <th width="180px">Opciones</th>
						      			        </tr>
						      			    </thead>
						      			    <tbody>
						      			        @if (isset($listaArt))
						      			            @foreach ($listaArt as $key => $item)
						      			                <tr >
						      			                    <td>{{ $key + 1 }}</td>
						      			                     <td>{{$item->created_at->isoFormat(' lll') }}</td>
						      			                    <td>{{ $item->titulo }}</td>
						      			                    <td>{{ $item['descripcion'] }}</td>
						      			                   
						      			                    @if ($item['estado'])
						      			                        <td class="text-center " style="vertical-align: middle;">{{-- <i class="fa fa-check "> --}} Aprobado</i> 
						      			                        	<p class="text-muted">{{-- Tu publicación ha sido revisada correctamente proceda a publicar. --}}</p>
						      			                        </td>
						      			                    @else
						      			                        <td class="text-center  " style="vertical-align: middle;"> <i class="fa fa-eye"></i> Pendiente </td>
						      			                    @endif

						      			                    <td class="text-center text-wight " style="vertical-align: middle;">
							      			                    @if($item['estado'])
							      			                    <button type="button" class="btn  btn-block  @if($item['publicar'])btn-outline-info @else btn-info @endif"
						      			                    	        onclick="confi_pub('{{$item->idarticulo_encryp}}', this,'{{$item['publicar']}}')">
						      			                    	    @if($item['publicar']) 
						      			                    	       	<i class="fa fa-eye-slash"></i> <span class="text-white"><span class="text-info_">Quitar publicación</span></span>  
						      			                    	    @else  
						      			                    	       <i class="fas fa-check-double"></i> Publicar 
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
