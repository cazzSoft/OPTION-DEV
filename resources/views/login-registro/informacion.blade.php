
@extends('layouts.baseLogin')
@section('title','Registro')


@section('content')
    <div class="text-center  container col-md-12 ">
        <div class="row ">
            <div class="col-md-12  px-0 d-flex justify-content-end">
                <div class="d-flex flex-row-reverse mr-5">
                    <div class="p-2">
                        <select  class="form-control form-control-sm  d-inline  lead border-0" 
                        data-placeholder="Seleccione su Título Profesional" name="idtitulo_profesional" id="idtitulo_profesional" >
                            <option value="es"> ES</option>
                            <option value="en"> EN</option>
                        </select>
                    </div>
                    <div class="p-2 lead text-mutex">Idioma</div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-4 col-xs-12">
                <div class="register-logo d-flex justify-content-start ml-5 img_centrar">             
                   <a href="{{url('session')}}" class="linkce"> <img class=" img-fluid pad ml-2 imgl" src="{{asset('img/logolg.svg')}}" >  </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12 ">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 text-center ">
                        <a href="{{url('nosotros')}}"  class="nav-link "> 
                            <div class="@if( $data['tp']=='AN') text-info @else text-muted @endif"> ACERCA DE NOSOTROS</div>
                        </a> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                       <a href="{{url('info-coinsults')}} " class="nav-link"> 
                            <div class="@if( $data['tp']=='CO') text-info @else text-muted @endif"> COINSULTS</div>
                        </a> 
                    </div>
                </div>
            </div>
            <div class="col-md-12"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4">
           <a href="{{url('session')}}">  <p class="ml-5 text-lead h1 text-info tex-sty">  <i class="fas fa-chevron-left mr-3 text-info"></i> @if(isset($data))  {{$data['titulo']}} @endif </p></a>
        </div>
        <div class="col-md-12 mt-4">
            @if(isset($data['detalle']))
                {!!$data['detalle']!!}
            @endif 
        </div>
    </div>
@endsection

@section('adminlte_css') 
	<style>
		.text-info{
			color:#12adce !important;
		}
        .tex-sty{
            font-family: calibri;
        }
	</style>
@stop

