
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
                <div class="register-logo d-flex justify-content-start ml-5 img_centrar ">             
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
   
    <div class="row" style="background: url('/img/fondo.png') center center; background-repeat: repeat; background-size: 100% auto;">
        <div class="col-md-12 mt-3">
           <a href="{{url('session')}}">  <p class="ml-5 text-lead h1 text-info_ tex-sty">  <i class="fas fa-chevron-left mr-3 text-info"></i> @if(isset($data))  {{$data['titulo']}} @endif </p></a>
        </div>
        <div class="col-md-12 mt-3 mb-2">
            @if(isset($data['detalle']))
                {!!$data['detalle']!!}
            @endif 
        </div>
        @if( $data['tp']=='AN')
            <div class="col-md-12 mt-1">
                <h3 class="text-info_ text-center">Visión</h3>
                <p class="lead ml-5 mr-5 p-2 text-center">
                  
                    Ser la compañía proveedora de servicios de salud más grande a nivel mundial.

                </p> 
            </div>
            <div class="col-md-12 mt-4">
                <h3 class="text-info_ text-center">MISIÓN</h3>
                <p class="lead ml-5 mr-5 p-2 text-center">
                    Facilitar herramientas a través de la educación y la innovación digital médica que permitan a todas las personas tomar el control de su salud, así como tener acceso a médicos y tratamientos de forma oportuna y eficiente. 
                </p> 
            </div>
            <div class="col-md-12 mt-3 mb-5">
                <div class="lead ml-5 mr-5 p-2 text-justify">
                    <p class="text-info_ h4 mb-3"><b>¿Que es lo que buscamos con Option2health?</b></p>
                    <p ><b class="text-info_">PREVENCIÓN</b>: Aprende todo lo relacionado a tu salud.¡Prevenir enfermedades está en tus manos!</p>
                    <p ><b class="text-info_">DIAGNÓSTICO</b>: Conocer tus factores de riesgo e identificar síntomas a tiempo pueden salvar tu vida, o la de los tuyos. </p>
                    <p ><b class="text-info_">MÉDICOS</b>: No todos los médicos son para todos los pacientes. Conócelos y elige al indicado para ti.</p>
                </div>
            </div>
        @endif
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

