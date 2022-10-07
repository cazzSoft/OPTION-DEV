@extends('homeOption2h')
@section('title','Pacientes')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.datatable',true)

@section('content_header')
    <div class="row ">
	    <div class="col text-center  @movil @else mt-5 @endmovil">
	        <a href="javascript: history.go(-1)" class="text-leth float-left ">  <i class="fas fa-chevron-left  text-info_ fa-2x ml-1 mb-1 "></i></a>
	    </div>
    </div>
@stop
{{-- cuerpo de la pagina --}}
@section('contenido')
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class=" col-md-12  ">
				    <div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 @movil p-0 @endmovil">
						    <div class="card card-default shadow-none @movil border-0 shadow-none mt-1 @endmovil">
							    
						      	<div class="card-body  @movil border-0 shadow-none p-0 @endmovil">

						      		<div class="table-responsive pb-2">
						      			<table id="table_publi_" class=" table table-sm border-0 text-center">
						      			    <thead>
						      			        <tr class="text-info">
						      			           
						      			            <th width="180px">Nombres </th>
						      			            <th>Télefono</th>
						      			            <th>Email</th>
						      			            <th>Ultima Cita</th>
						      			        </tr>
						      			    </thead>
						      			    <tbody>
						      			        @if (isset($listaPaciente))
						      			            @foreach ($listaPaciente as $key => $item)
						      			                <tr >
						      			                    
						      			                    <td>{{ $item->usuario[0]['name'] }}</td>
						      			                    <td>{{ $item->usuario[0]['telefono'] }}</td>
						      			                    <td>{{ $item->usuario[0]['email'] }}</td>
						      			                   	<td>{{$item->fecha }}</td>
						      			                    
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
