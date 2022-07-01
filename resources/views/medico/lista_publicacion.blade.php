@extends('homeOption2h')
@section('title','Publicaciones')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.datatable',true)

@section('content_header')
    <div class="container-fluid">
		
		@movil
		  <div class="row">
		    <div class="col-md-12 ">
		        <div class="flex_titulo">
		         <a href="{{url('/medico/perfil')}}">  <p class=" text-lead h2 text-info_ ">  <i class="fas fa-chevron-left mr-3 text-info_"></i>  Publicaciones registradas  </p></a>    
		        </div>
		    </div>
		  </div>
		@else
		  <div class="row mt-5 mb-5 ">
		    <div class="col-lg-1 col-xs-1">
		      <a href="{{url('/medico/perfil')}}" class="text-center ml-1" >  <i class="fas fa-chevron-left mr-3 text-info_ fa-2x "></i></a>    
		    </div>
		    <div class="col-lg-10">
		      <a href="{{url('/medico/perfil')}}" class="text-center " > <p class="flex_titulo text-info_  text-center">   Publicaciones registradas  </p></a> 
		    </div>
		  </div>
		@endmovil
	</div>
@stop
{{-- cuerpo de la pagina --}}
@section('contenido')
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class=" col-md-12  ">
				    <div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 @movil p-0 @endmovil">
						    <div class="card card-default @movil border-0 shadow-none mt-1 @endmovil">
							    <div class="card-header border-0 ">
							        <a  class="btn @movil btn-block  @else btn-sm float-left @endmovil bgz-info   pl-2 pr-2 rounded " href="{{url('gestion/articulo')}}">
							        	Agrear Publicación
							        </a> 
							    </div>
						      	<div class="card-body  @movil border-0 shadow-none p-0 @endmovil">



						      		<div class="table-responsive pb-2">
						      			<table id="table_publi_" class=" table table-sm border-0 ">
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
						      			                    <td>{{ Str::limit($item['descripcion'], 100)  }}</td>
						      			                   
						      			                    @if ($item['estado'])
						      			                        <td class="text-center " style="vertical-align: middle;">{{-- <i class="fa fa-check "> --}} Aprobado</i> 
						      			                        	<p class="text-muted">{{-- Tu publicación ha sido revisada correctamente proceda a publicar. --}}</p>
						      			                        </td>
						      			                    @else
						      			                        <td class="text-center  " style="vertical-align: middle;"> <i class="fa fa-eye"></i> Pendiente </td>
						      			                    @endif

						      			                    <td class="text-center text-wight " style="vertical-align: middle;">
							      			                    @if($item['estado'])
							      			                    <button type="button" class="btn  btn-block  @if($item['publicar']) btn-outline-info @else btn-info @endif"
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
		{{-- <link rel="stylesheet" href="{{asset('../vendor/bs-stepper/css/bs-stepper.min.css')}}"> --}}
		 <link rel="stylesheet" href="{{ asset('css/lista_publicacion.css') }}">
    @stop  

    {{-- Seccion para insertar js--}}
    @section('include_js')
	    {{-- medico js --}}
	    <script src="{{asset('js/medico.js')}}"></script> 
	    <script >
		    $('#table_publi_').dataTable( {
		    	  "language": {
		    	 
		    	  "infoFiltered": "(filtrar from _MAX_ total registros)",
		    	  "processing": "Procesando...",
		    	  "lengthMenu": "Mostrar _MENU_ registros",
		    	  "zeroRecords": "No se encontraron resultados",
		    	  "emptyTable": "Ningún dato disponible en esta tabla",
		    	  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    	  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
		    	  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
		    	  
		    	  "infoThousands": ",",
		    	  "loadingRecords": "Cargando"
		    	},
		        language: {
		            searchPlaceholder: "Buscar  documentos",
		            "lengthMenu": "Mostrar _MENU_ registro por página",
		            "lengthMenu": "Mostrar _MENU_ registro por página",
		            "paginate":{'next':'Sig','previous':'Ant'},
		            "search": "Buscar:",
		            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		        }
		    } );
	    </script>
	     <!-- BS-Stepper -->
    	{{-- <script src="{{asset('../vendor/bs-stepper/js/bs-stepper.min.js')}}"></script> --}}
		{{--  <script>
		 
			document.addEventListener('DOMContentLoaded', function () {
		  	  window.stepper = new Stepper(document.querySelector('.bs-stepper'))
		  	})
		  	
		 </script> --}}
		 
    @stop
    
 @stop
