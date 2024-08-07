@extends('homeOption2h')
{{-- @extends('layouts.baseLogin') --}}
@section('title','Registro')

@section('plugins.Select2',true)
@section('plugins.toastr',true)
{{-- class="hold-transition login-page" --}}
@section('contenido')
    <div class="container col-md-12 ">
        <div class="row mt-5">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12  div-info-session">
                <div class="card-deck ml-5 mr-4 ">
                  <div class="card  border-0 col-sm-6 pl-0 pr-0">
                    <div class="card-body  border-0">
                       <h5 class=" h5 text-center mb-3  tex" style="color: #13c6ef !important;"><b>{{trans('session.medicina en tus manos') }}</b></h5>
                       <p class="card-text text-justify"> 
                        {{trans('session.text-medicina en tus manos') }}

                       </p>
                    </div>
                    <img class="card-img-top" src="{{asset('/img/op1.svg')}}" alt="Card image cap">
                  </div>
                  <div class="card  border-0 col-sm-6">
                      <div class="card-body border-0 ">
                       <h5 class=" h5 text-center mb-3 text-info" style="color: #13c6ef !important;"><b>{{trans('session.estado de salud') }}</b> </h5>
                       <p class="card-text text-justify">
                         {{trans('session.text-estado de salud') }} 
                       </p>
                     </div>
                      <img class="card-img-top" src="{{asset('/img/op2.svg')}}" alt="Card image cap">
                  </div>
                  <div class="card  border-0 col-sm-6">
                   
                    <div class="card-body border-0">
                       <h5 class=" h5 text-center  text-info" style="color: #13c6ef !important;"><b>{{trans('session.llegaran a ti') }}</b></h5>
                       <p class="card-text text-justify">
                        {{trans('session.text-llegaran a ti') }} 
                       </p>
                    </div>
                     <img class="card-img-top" src="{{asset('/img/op3.svg')}} " alt="Card image cap">
                  </div>
                 
                </div>
            </div>
            <div class="col-lg-3 col-md-12  ml-5 p-0 text-center">
                <a href="/">
                    <img src="{{asset('/img/logo2.svg')}}" alt="o2hLogo" class="profile-user-img border-0 img-fluid d-none" >
                </a>
                <p class="profile-username text-center text-info h1" style="color: #13c6ef !important;">{{trans('session.Bienvenido-a') }}</p>
                
                <div class="social-auth-links text-center mt-3 mb-5">
                  <p class="text-muted mt-3 mb-4  text-seleccione ">{{trans('session.Selecciona-una-opcion') }}</p>
                  <a disabled="true" href="{{ url('/log-in-paciente') }}" class="btn btn-outline-info btn-block btn-lg border-light shadow-sm "><i class="fas fa-user float-left ml-2 "></i> {{trans('session.paciente') }}</a>
                  <a disabled="false" href="{{ url('/log-in-medico') }}" class="btn btn-outline-info btn-block btn-lg border-light shadow-sm">
                    <i class="fas fa-user-md mr-2 float-left ml-2"></i>  {{trans('session.medico') }}
                  </a>
                  {{-- <a disabled="false"  href="{{ url('/log-in-empresa') }}" class="btn btn-outline-info btn-block btn-lg border-light shadow-sm">
                    <i class="fas fa-building float-left ml-2"></i> <span class="d-flex justify-content-center">{{trans('session.empresa') }}</span>
                  </a> --}}
                </div>

                <p  class="mb-2 mt-5 text-center h6 btn-regresar" >
                    <a disabled="false" class="mt-5" style="color: #13c6ef;" href="/" class="">
                     <i class="fas fa-arrow-circle-left"></i>   {{trans('session.regresar') }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    <footer class="main-footer  fixed-bottom text-center p-0 m-0 border-0 ">
        <div class="row p-0 mb-4 m-0">
            <div class="col-12 p-0 m-0">
                  <small class="text-calibri text-f1 d-block "> {{trans('log-in-paciente.al-crear-cuenta') }}</small>
                <a class="text-info_ text-calibri text-f2 d-block "  onclick="openInfoTermiCondiciones()">Términos y condiciones y Política de Privacidad </a>
            </div>
        </div>
    </footer>
    @include('modalTerminoCondiciones')
@endsection


@section('include_css') 
    <link rel="stylesheet" href="{{ asset('css/login-registro/info-login.css') }}">
    <style>
        .content-wrapper, body:not(.sidebar-mini-md) .main-footer, body:not(.sidebar-mini-md) .main-header {
            margin-left: 0px !important;
        }
        .sidebar_{
            /*display: none;*/
            margin-left: -250px;
        }
    </style>
@stop

@section('include_js') 
   
    {{-- <script src="{{ asset('/js/global.js') }}"></script> --}}
@stop
