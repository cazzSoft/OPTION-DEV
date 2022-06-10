@extends('homeOption2h')
{{-- @extends('layouts.baseLogin') --}}
@section('title','info')


@section('contenido')
    <div class="row" style="background: url('/img/fondo.png') center center; background-repeat: repeat; background-size: 100% auto;">
        <div class=" conten-info @if($data['tp']=='CO') container-fluid  @else container @endif ">
            <div class="col-md-12 mt-0">
                <a href="{{url('/')}}">
                    @movil
                        <p class=" text-lead h2 text-info_ ">  <i class="fas fa-chevron-left mr-3 text-info_"></i>  <b>@if(isset($data))  {{$data['titulo']}} @endif</b>  </p>
                    @else 
                        <p class="ml-5 text-lead h1 text-info_ tex-sty text-center">  @if(isset($data))  {{$data['titulo']}} @endif </p>
                    @endmovil
               </a> 
            </div>
            <div class="col-md-12 mt-3 mb-2 text-center detalle ">
                @if(isset($data['detalle']))
                    {!!$data['detalle']!!}
                @endif 
            </div>
            @if( $data['tp']=='AN')
                <div class="col-md-12 mt-1 detalle">
                    <h3 class="text-info_ text-center"><b> {{trans('informacion-view.vision') }}</b></h3>
                    <p class="lead ml-5 mr-5 p-2 text-center ">
                      {{trans('informacion-view.text-vision') }}
                    </p> 
                </div>
                <div class="col-md-12 mt-5 detalle">
                    <h3 class="text-info_ text-center"><b> {{trans('informacion-view.mision') }}</b></h3>
                    <p class="lead ml-5 mr-5 p-2 text-center">
                        {{trans('informacion-view.text-mision') }} 
                    </p> 
                </div>
                <div class="col-md-12 mt-3 mb-5 detalle">
                    <div class="lead ml-5 mr-5 p-2 mt-5 text-center mb-4 ">
                        <p class="text-info_ h4 mb-3"><b> {{trans('informacion-view.que-busca') }}</b></p>
                        <p ><b class="text-info_">{{trans('informacion-view.prevencion') }}</b>: {{trans('informacion-view.text-prevencion') }}</p>
                        <p ><b class="text-info_">{{trans('informacion-view.diagnostico') }}</b>: {{trans('informacion-view.text-diagnostico') }}</p>
                        <p ><b class="text-info_">{{trans('informacion-view.medico') }}</b>: {{trans('informacion-view.text-medico') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>                  
  
@endsection

@section('include_css') 
	<link rel="stylesheet" href="{{ asset('css/login-registro/informacion.css') }}">
@stop

@section('adminlte_js') 
    {{-- <script src="{{ asset('/js/global.js') }}"></script> --}}
@stop

