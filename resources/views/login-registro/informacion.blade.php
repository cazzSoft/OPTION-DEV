
@extends('layouts.baseLogin')
@section('title','Registro')


@section('content')
    <!-- Just an image -->
   <div class="container-fluid  p-1">
     <nav class=" navbar navbar-expand-lg navbar-light navbar-white p-0 border-bottom border-info ">
       <div class=" container-fluid ">
         <a href="{{url('session')}}" class="navbar-brand ml-4 imgSecion">
           <img src="/img/logo2.svg" alt="o2hLogo" class="profile-user-img border-0 img-fluid" id="imaLogo">
         </a>
           <ul class="order-1 order-md-4  navbar-nav navbar-no-expand ml-auto ">
               <li class="nav-item dropdown" >
                   <div class="d-flex flex-row-reverse mr-3 idioma">
                       <div class="p-2">
                           <select  class="form-control form-control-sm  d-inline  lead border-0" 
                           data-placeholder="Seleccione su Título Profesional" name="idtitulo_profesional" id="idtitulo_profesional" >
                               <option value="es"> ES</option>
                               <option value="en"> EN</option>
                           </select>
                       </div>
                       <div class="p-2 lead text-mutex">Idioma</div>
                   </div>
                   <div class="d-flex justify-content-end mr-3 options">
                     <div class="p-2 mr-3 "><a class="{{ request()->is('nosotros') ? 'text-info_' : 'text-muted' }} "  href="{{url('nosotros')}}">ACERCA DE NOSOTROS  </a></div>
                     <div class="p-2"><a class=" {{ request()->is('info-coinsults') ? 'text-info_' : 'text-muted' }} " href="{{url('info-coinsults')}}">COINSULTS</a> </div>
                   </div>
              </li>
           </ul>
       </div>
     </nav>     
   </div>
    {{-- <div class="text-center  container col-md-12 ">
        <div class="row border-bottom border-info p-0">
            <div class="col-md-12  px-0 d-flex justify-content-end">
                <div class="d-flex flex-row-reverse mr-4">
                    <div class="p-0">
                        <select  class="form-control form-control-sm  d-inline  lead border-0" 
                        data-placeholder="Seleccione su Título Profesional" name="idtitulo_profesional" id="idtitulo_profesional" >
                            <option value="es"> ES</option>
                            <option value="en"> EN</option>
                        </select>
                    </div>
                    <div class="p-1 lead text-mutex">Idioma</div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-4 col-xs-12">
                <div class="register-logo d-flex justify-content-start ml-5 img_centrar ">             
                   <a href="{{url('session')}}" class="linkce"> <img class=" img-fluid pad ml-2 imgl" width="60%" style="position: relative; margin-top: -30px" src="{{asset('img/logolg.svg')}}" >  </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12 ">
                <div class="row p-0">
                    <div class="col-md-9 col-sm-6 col-xs-12 text-right ">
                        <a href="{{url('nosotros')}}"  class="nav-link "> 
                            <div class="@if( $data['tp']=='AN') text-info_ @else text-muted @endif"> ACERCA DE NOSOTROS</div>
                        </a> 
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 ">
                       <a href="{{url('info-coinsults')}} " class="nav-link text-right"> 
                            <div class="@if( $data['tp']=='CO') text-info_ @else text-muted @endif"> COINSULTS</div>
                        </a> 
                    </div>
                </div>
            </div>
           
        </div>
    </div> --}}
   
    <div class="row" style="background: url('/img/fondo.png') center center; background-repeat: repeat; background-size: 100% auto;">
        <div class=" @if($data['tp']=='CO') container-fluid  @else container @endif">
            <div class="col-md-12 mt-5">
               <a href="{{url('session')}}">  <p class="ml-5 text-lead h1 text-info_ tex-sty text-center">  @if(isset($data))  {{$data['titulo']}} @endif </p>
               </a>
            </div>
            <div class="col-md-12 mt-3 mb-2 text-center">
                @if(isset($data['detalle']))
                    {!!$data['detalle']!!}
                @endif 
            </div>
            @if( $data['tp']=='AN')
                <div class="col-md-12 mt-1">
                    <h3 class="text-info_ text-center"><b>Visión</b></h3>
                    <p class="lead ml-5 mr-5 p-2 text-center">
                      
                        Ser la compañía proveedora de servicios de salud más grande a nivel mundial.

                    </p> 
                </div>
                <div class="col-md-12 mt-5">
                    <h3 class="text-info_ text-center"><b>MISIÓN</b></h3>
                    <p class="lead ml-5 mr-5 p-2 text-center">
                        Facilitar herramientas a través de la educación y la innovación digital médica que permitan a todas las personas tomar el control de su salud, así como tener acceso a médicos y tratamientos de forma oportuna y eficiente. 
                    </p> 
                </div>
                <div class="col-md-12 mt-3 mb-5">
                    <div class="lead ml-5 mr-5 p-2 mt-5 text-center">
                        <p class="text-info_ h4 mb-3"><b>¿QUÉ ES LO QUE BUSCAMOS?</b></p>
                        <p ><b class="text-info_">PREVENCIÓN</b>: Aprende todo lo relacionado a tu salud.¡Prevenir enfermedades está en tus manos!</p>
                        <p ><b class="text-info_">DIAGNÓSTICO</b>: Conocer tus factores de riesgo e identificar síntomas a tiempo pueden salvar tu vida, o la de los tuyos. </p>
                        <p ><b class="text-info_">MÉDICOS</b>: No todos los médicos son para todos los pacientes. Conócelos y elige al indicado para ti.</p>
                    </div>
                </div>
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

