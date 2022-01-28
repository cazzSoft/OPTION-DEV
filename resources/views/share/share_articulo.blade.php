
@extends('layouts.baseLogin')
@section('title','Información')

{{-- @section('plugins.Sweetalert2',true)
@section('plugins.toastr',true) --}}

@section('content')
	<div class="container col-xs-12 col-sm-12 col-md-6 mt-5 " >
		<div class="row ">
		    <div class="col-md-12 mt-3 mb-2">
		        <div class="register-logo">       
		           	<img class=" img-responsive  " src="{{asset('option2h.png')}}" height="200px">
		        </div>
		    </div>
		</div>        
		
		<div class="card  bg-white  card-outline card-info rounded mb-0">
			<div class="card-body  p-0">	
				<div class="row ">
					<div class="col-md-5 p-1">
						@if(isset($data))
							<p class="ml-3 mt-2 muted text-justify"><b>{{$data['Nombre_video']}}</b></p>
							<hr class="ml-3">
							<p class=" text-indent text-sm text-justify p-3">
							  {{$data['descripcion']}} <a href="{{$data['vinculo_art']}}" target="_blank" onclick="acctionVermas('{{encrypt($data['idarticulo'])}}')">Ver más... </a></p> 
							  <div class="form-group text-center mb-4">
							  	<a class="btn btn-primary " href="https://option2health.com" role="button"  style="border-radius: 122px;">
							  	    Mas información
							  	 </a>
							  </div>
						@endif
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 ">
						
						  @if(isset($data->url_video))
						    <div class="mt-0 mb-0">
						      <iframe width="100%" height="414" src="{{$data->url_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
						    </div>
						  @endif
						  
						
					</div>
				</div>
			    
	            
			</div>
		</div>
		<div class="text-center">
			<p class="text-muted">Copyright © Option2health 2022</p>
		</div>
	</div>

	
@endsection


 @section('adminlte_js')
    <script src="{{ asset('/js/register.js') }}"></script>
 
 @stop