
@extends('layouts.baseLogin')
@section('title','Preguntas interes')

@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)

@section('content')
	<div class="container col-xs-12 col-sm-12 col-md-8 mt-5" >
		<div class="row ">
		    <div class="col-md-12 mt-5 mb-2">
		        <div class="register-logo">       
		            <h1><b>Bienvenido a Option2health</b></h1>  
		        </div>
		    </div>
		</div>        
		
		<div class="card shadow p-3 mb-5 bg-white rounded">

			<div class="card-body">
				<div class="card-deck mb-4">
					<h4 class="text-muted">¿Te interesa alguno de estos temas? Selecciónalos</h4>
				</div> 	
				
			    <div class="row ">
		    		@if(isset($lista_temas))
			   		@foreach($lista_temas as $item)
	                <div class="col-xs-12 col-sm-12 col-md-4 " style="cursor: pointer;" >
	                 	<div class="card border border-info rounded" style="height: 12rem;" onclick ="get_input('{{encrypt($item->idtemas)}}',this)">
	                 	    <div class="custom-control custom-checkbox ml-2 mt-2 poner_input">
					         	
					        </div>
	                 	    <div class="card-body text-center">
	                 	      <p class="card-text h4">{{$item->descripcion}}</p>
	                 	    </div>
	                 	</div>
	               </div>
	              	@endforeach
					@endif
	            </div>
	            <div class="row mt-4">
	            	<div class="col-xs-6 col-sm-6 col-md-3 ">
	            		<button type="button" class="btn btn-warning  btn-lg btn-block">Omitir</button>
	            	</div>
	            	<div class="col-xs-6 col-sm-6 col-md-3 float-left ">
	            		<button type="button" class="btn btn-info  btn-lg  btn-block" id="btn_sig">Siguiente</button>
	            	</div>	
	            	
	            </div>
	          
			</div>
		</div>
	</div>

	<!-- Modal -->
    <div class="modal fade" id="modal_info"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            {{-- <h4 class="modal-title text-warning"><i class="fa fa-info-circle"></i> d </h4> --}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12  col-md-4 " >
                    <img  class="img-responsive img-fluid img-rounded" src="{{asset('doc.png')}}" alt="Option2health" >
                </div>

                <div class="col-xs-12 col-sm-12  col-md-8 ">
                    <p class="text-muted m-4 text-justify h4" >
                      ¡Bienvenido/a! a Option2health está diseñada para educar e informar. No pretende dar consejos médicos, y menos aún diagnosticar enfermedades o prescribir medicinas. Consulte siempre a su médico respecto a su salud o antes de comenzar cualquier tratamiento.
                    </p>
                </div>
            </div>
            
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- Button trigger modal -->
@endsection


 @section('adminlte_js')
    <script src="{{ asset('/js/register.js') }}"></script>
     <script > $('#modal_info').modal('show');</script>
 @stop