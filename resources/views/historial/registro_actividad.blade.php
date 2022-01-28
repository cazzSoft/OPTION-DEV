registro_actividad.blade.php
@extends('homeOption2h')
@section('title','HISTORIAL')

{{--para activar los plugin en la view  --}}

{{-- @section('plugins.Sweetalert2',true) --}}
@section('plugins.toastr',true)


@section('content_header')
      <h1 class="text-primary"> <i class="fas fa-history"></i> Registro de actividades</h1>
@stop 
{{-- cuerpo de la pagina --}}
@section('contenido')
  
  <div class="invoice p-3 mb-3 ">
    
    <div class="row">
      	<div class="col-12 table-responsive">
  			  <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Actividades</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
              	@if(isset($lista_histo))
            		@foreach($lista_histo as $item)
            			<li class="nav-item active">
            			  <a href="{{url('actividades/historialDetail/'.encrypt($item->idregistro_actividad))}}" class="nav-link p-3">
            			  	<span class="bg-{{$item->color}} btn "><i class="{{$item->icon}} b"> </i></span>
            			   	{{$item->descripcion}}
            			    <span class="float-right"><i class="fas fa-angle-right"></i></span>
            			  </a>
            			</li>
            		@endforeach
            	@endif
              </ul>
            </div>
          </div>
      	</div>
      	<div class="col-12 table-responsive">
      		<div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-text-width"></i>
                	Historial del usuario
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <ul>
               @if(isset($lista))
               		@foreach($lista as $item)
               			
               			{{-- colorear sessiones --}}
               			@if($item['last_login']!="")
               				<li class="text-success"><b>{{$item['descripcion']}} </b> <b class="text-primary">{{ \Carbon\Carbon::parse($item['last_login'])->diffForHumans()}}</b></li>
               			@else
               				@if($item['last_logged_at']!="")
               					<li class="text-danger"><b>{{$item['descripcion']}} </b> {{ \Carbon\Carbon::parse($item['last_logged_at'])->diffForHumans()}}</li> 
               				@else 
               				 <li >{{$item['descripcion']}} <span class="text-fuchsia">{{$item['created_at']->diffForHumans()}}</span></li>
               				@endif
               			@endif
               			

               			{{-- recorrer lista --}}
               			@if($item['desub_actividad']!="[]")
               				{{-- <li>{{$item['descripcion']}}</li> --}}
               				<ul>
               					@foreach($item['desub_actividad'] as $item1)
               						<li>{{$item1['descripcion']}} <span class="text-fuchsia">{{$item1['created_at']->diffForHumans()}}</span></li>
               						@if($item1['desub_actividad']!="[]")
               							<ul>
               								@foreach($item1['desub_actividad'] as $item2)
               							  	<li>{{$item2['descripcion']}} <span class="text-fuchsia">{{$item2['created_at']->diffForHumans()}}</span></li>
               							  	@if($item2['desub_actividad']!="[]")
               							  		<ul>
               							  			@foreach($item2['desub_actividad'] as $item3)
               							  				<li>{{$item3['descripcion']}} <span class="text-fuchsia">{{$item3['created_at']->diffForHumans()}}</span></li>
               							  			@endforeach
               							  		</ul>
               							  	@endif
               								@endforeach
               							</ul>
               						@endif
               					@endforeach
               				</ul>
               				
               			@endif

               			
               		@endforeach
               @endif
              </ul>

            </div>
            <!-- /.card-body -->
          </div>
      	</div>
    </div>
  </div>
  
@stop

@section('include_css') 
  <style >
    .cursor{
      cursor: pointer;
    }
  </style>
@stop   

{{-- Seccion para insertar js--}}
@section('include_js')
       <script src="{{ asset('/js/casos_ex.js') }}"></script>
@stop