
@extends('layouts.baseLogin')
@section('title','Registro')

@section('plugins.Select2',true)
{{-- class="hold-transition login-page" --}}
@section('content')
<div class="container-fluid  p-1">
  <nav class=" navbar navbar-expand-lg navbar-light navbar-white p-0 border-bottom border-info ">
    <div class=" container-fluid ">
      <a href="{{url('/')}}" class="navbar-brand ml-4 imgSecion">
        <img src="/img/logo2.svg" alt="o2hLogo" class="profile-user-img border-0 img-fluid" id="imaLogo">
      </a>
        <ul class="order-1 order-md-4  navbar-nav navbar-no-expand ml-auto ">
            <li class="nav-item dropdown" >
                <div class="d-flex flex-row-reverse mr-3 idioma">
                    <div class="p-2">
                        <form method="POST" action="{{url('lang')}}" id="form-language">
                            {{ csrf_field() }}
                            <select  class="form-control form-control-sm  d-inline  lead border-0"  name="language" id="language" >
                               <option @if(Session::get('language')=='es') selected @endif value="es"> ES</option>
                               <option @if(Session::get('language')=='en') selected @endif value="en"> EN</option>
                           </select>
                        </form>
                    </div>
                    <div class="p-2 lead text-mutex">{{trans('informacion-view.Language') }}</div>
                </div>
                <div class="d-flex justify-content-end mr-3 options">
                  <div class="p-2 mr-3 "><a class=" text-muted "  href="{{url('nosotros')}}">{{trans('informacion-view.acerca de Nosotros') }} </a></div>
                  <div class="p-2"><a class=" text-muted " href="{{url('info-coinsults')}}">COINSULTS</a> </div>
                </div>
           </li>
        </ul>
    </div>
  </nav>     
</div>
<div class="container col-md-12">

    <div class="row mt-5">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ">
            <div class="card-deck ml-5 mr-4 ">
              <div class="card  border-0 col-sm-6">
                <div class="card-body  border-0">
                   <h5 class=" h5 text-center mb-3  tex" style="color: #13c6ef !important;"><b>{{trans('session.medicina en tus manos') }}</b></h5>
                   <p class="card-text text-justify"> 
                    {{trans('session.text-medicina en tus manos') }}
                   </p>
                </div>
                <img class="card-img-top" src="/img/op1.svg" alt="Card image cap">
              </div>
              <div class="card  border-0 col-sm-6">
                  <div class="card-body border-0 ">
                   <h5 class=" h5 text-center mb-3 text-info" style="color: #13c6ef !important;"><b>{{trans('session.estado de salud') }}</b> </h5>
                   <p class="card-text text-justify">
                     {{trans('session.text-estado de salud') }} 
                   </p>
                 </div>
                  <img class="card-img-top" src="/img/op2.svg" alt="Card image cap">
              </div>
              <div class="card  border-0 col-sm-6">
               
                <div class="card-body border-0">
                   <h5 class=" h5 text-center  text-info" style="color: #13c6ef !important;"><b>{{trans('session.llegaran a ti') }}</b></h5>
                   <p class="card-text text-justify">
                    {{trans('session.text-llegaran a ti') }} 
                   </p>
                </div>
                 <img class="card-img-top" src="/img/op3.svg" alt="Card image cap">
              </div>
             
            </div>
        </div>

        <div class="col-lg-3 col-md-12  ml-5 p-0">
            <p class="profile-username text-center text-info h1" style="color: #13c6ef !important;">{{trans('session.Bienvenido-a') }}</p>
            
            <div class="social-auth-links text-center mt-3 mb-5">
              <p class="text-muted mt-3 mb-4    ">{{trans('session.Selecciona-una-opcion') }}</p>
              <a disabled="true" href="{{ url('/log-in-paciente') }}" class="btn btn-outline-info btn-block btn-lg"><i class="fas fa-user float-left ml-2 "></i> {{trans('session.paciente') }}</a>
              <a disabled="false" href="{{ url('/log-in-medico') }}" class="btn btn-outline-info btn-block btn-lg">
                <i class="fas fa-user-md mr-2 float-left ml-2"></i>  {{trans('session.medico') }}
              </a>
              {{-- <a disabled="false"  href="{{ url('/log-in-empresa') }}" class="btn btn-outline-info btn-block btn-lg">
                <i class="fas fa-building float-left ml-2"></i> <span class="d-flex justify-content-center">{{trans('session.empresa') }}</span>
              </a> --}}
            </div>

            <p  class="mb-2 mt-5 text-center h6" >
                <a disabled="false" class="mt-5" style="color: #13c6ef;" href="/" class="">
                 <i class="fas fa-arrow-circle-left"></i>   {{trans('session.regresar') }}
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
@section('adminlte_js') 
    <script src="{{ asset('/js/global.js') }}"></script>
@stop
