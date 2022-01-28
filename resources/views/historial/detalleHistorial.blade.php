registro_actividad.blade.php
@extends('homeOption2h')
@section('title','HISTORIAL')

{{--para activar los plugin en la view  --}}

{{-- @section('plugins.Sweetalert2',true) --}}
@section('plugins.toastr',true)

{{-- cuerpo de la pagina --}}
@section('contenido')
  
  <div class="invoice p-3 mb-3 ">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="text-primary">
          <i class="fas fa-history"></i> @if(isset($detalle)) {{$detalle->descripcion}} @endif
        </h2>
      </div>
      <!-- /.col -->
    </div>

  
    <div class="row">
        <div class="col-12 table-responsive">
        <div class="card">
             
              <div class="card-body ">
                
                  @if(isset($detalle))
                    @foreach($detalle['detalle_historial'] as $item)
                      <div class="post border-0">
                        <div class="user-block p-2">

                          <img class="img-circle img-bordered-sm" src="{{asset('axc.bmp')}}" alt="user image">
                          <span class=" mt-1 username">{{$item->created_at->isoFormat('lll')}}</span>
                         {{--  <span class="description">
                            {{auth()->user()->name}}
                          </span> --}}
                          <span class="description">
                           {{$item->descripcion}}
                          </span>
                        </div>
                      </div>

                    @endforeach
                 @endif
               
              </div>

          </div>
        </div>
        
    </div>
    
     <div class="row">
      <div class="col-12">
        <span class="float-left text-muted">
          <a href="{{url('actividades/historial')}}"> <i class="fa fa-backward"></i> Regresar</a>
        </span>
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