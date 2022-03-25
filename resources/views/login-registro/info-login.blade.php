
@extends('layouts.baseLogin')
@section('title','Registro')

@section('plugins.Select2',true)
{{-- class="hold-transition login-page" --}}
@section('content')
<div class="container col-md-12">
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
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="register-logo d-flex justify-content-start ml-5 img_centrar">       
               <a href="{{url('/')}}" class="linkce"> <img class=" img-fluid pad ml-2 imgl" src="{{asset('img/logolg.svg')}}" >  </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 text-center ">
                    <a href="{{url('nosotros')}}"  class="nav-link "> 
                        <div class=" text-muted "> ACERCA DE NOSOTROS</div>
                    </a> 
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12  text-center">
                   <a href="{{url('info-coinsults')}} " class="nav-link"> 
                        <div class=" text-muted"> COINSULTS</div>
                    </a> 
                </div>
            </div>
        </div>
        <div class="col-md-12"></div>
        
    </div>

    <div class="row mt-5">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ">
            <div class="card-deck ml-5 mr-4 ">
              <div class="card  border-0 col-sm-6">
                <div class="card-body  border-0">
                   <h5 class=" h5 text-center mb-3  tex" style="color: #13c6ef !important;"><b>¡Option2Health, medicina en tus manos!</b></h5>
                   <p class="card-text text-justify">Option2health, un espacio digital innovador para médicos, pacientes y empresas.
                     Nuestra plataforma de salud está enfocada en la salud y educación para aquellas personas que buscan que buscan a través de la información, generar soluciones para enfrentar enfermedades y tener una mejor calidad de vida.
                   </p>
                </div>
                <img class="card-img-top" src="/img/op1.svg" alt="Card image cap">
              </div>
              <div class="card  border-0 col-sm-6">
                  <div class="card-body border-0 ">
                   <h5 class=" h5 text-center mb-3 text-info" style="color: #13c6ef !important;"><b>¿Sabes cuál es el estado de tu salud?</b> </h5>
                   <p class="card-text text-justify">¿Sabes cuál es el estado de tu salud? 
                     Al ser pioneros de la medicina preventiva, práctica y gratuita, te podremos ayudar a recuperar el control de tal manera que puedas llevar un estilo de vida más saludable, junto de la mano de los mejores médicos especialistas del país. 
                   </p>
                 </div>
                  <img class="card-img-top" src="/img/op2.svg" alt="Card image cap">
              </div>
              <div class="card  border-0 col-sm-6">
               
                <div class="card-body border-0">
                   <h5 class=" h5 text-center  text-info" style="color: #13c6ef !important;"><b>¡Los pacientes llegarán a ti a llenar tu agenda!</b></h5>
                   <p class="card-text text-justify">Los pacientes están buscándote ahora mismo.
                     ¡Y llegan a llenar tu agenda! Posiciona tu carrera profesional como uno de los mejores médicos especialistas, mejorando la relación médico-paciente y potenciando tu networking mediante colaboración con otros médicos especialistas.
                   </p>
                </div>
                 <img class="card-img-top" src="/img/op3.svg" alt="Card image cap">
              </div>
             
            </div>
        </div>

        <div class="col-lg-3 col-md-12  ml-5 p-0">
            <p class="profile-username text-center text-info h1" style="color: #13c6ef !important;">Bienvenido a Option2healths</p>
            
            <div class="social-auth-links text-center mt-3 mb-5">
              <p class="text-muted mt-3 mb-4    ">Selecciona una opción para ingresar</p>
              <a disabled="true" href="{{ url('/log-in-paciente') }}" class="btn btn-outline-info btn-block btn-lg"><i class="fas fa-user float-left ml-2 "></i> Paciente</a>
              <a disabled="false" href="{{ url('/log-in-medico') }}" class="btn btn-outline-info btn-block btn-lg">
                <i class="fas fa-user-md mr-2 float-left ml-2"></i>  Médico
              </a>
              {{-- <a disabled="false"  href="{{ url('/log-in-empresa') }}" class="btn btn-outline-info btn-block btn-lg">
                <i class="fas fa-building float-left ml-2"></i> <span class="d-flex justify-content-center">Empresa</span>
              </a> --}}
            </div>

            <p  class="mb-2 mt-5 text-center h6" >
                <a disabled="false" class="mt-5" style="color: #13c6ef;" href="/" class="">
                 <i class="fas fa-arrow-circle-left"></i>  Regresar
                </a>
            </p>
        </div>
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