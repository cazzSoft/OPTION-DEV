
@extends('layouts.baseLogin')
@section('title','Registro')

{{-- @section('plugins.toastr',true) --}}
{{-- class="hold-transition login-page" --}}
@section('content')
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
                  <div class="p-2 mr-3 "><a class=" text-muted "  href="{{url('nosotros')}}">{{trans('informacion-view.acerca de Nosotros') }}  </a></div>
                  <div class="p-2"><a class=" text-muted " href="{{url('info-coinsults')}}">COINSULTS</a> </div>
                </div>
           </li>
        </ul>
    </div>
  </nav>     
</div>

<div class="row p-5">
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ">
        
        <div class="row ">
            <div class="col-lg-4 col-md-4 col-sm-12">
                 <p class="text-center text-info h2 " style="color:#13c6ef !important;"><b>{{trans('log-in-paciente.Beneficios al Registrarte') }}</b></p>
                <div class="text-center">
                    @if(isset($data))
                      {!!$data['img']!!}
                    @endif
                </div>
            </div>
           
            <div class="col-lg-8 col-md-8 col-sm-12 ">
               @if(isset($data))
                {!!$data['detalle']!!}
               @endif
            </div>
           
        </div>
    </div>
    <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 "></div>
    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 ">

        <p class=" text-center text-info h4 mb-4 txt_log" style="color: #13c6ef !important;"> @if(isset($data)) {!!$data['icono']!!} @endif  {{trans('log-in-paciente.iniciar-session') }} </p> 
        @if(isset($data))
            @if($data['tipo']=='P') 
                <div class="mt-5 border-0  d-none form_login" >
                  <div class="   border-0 mt-3">
                        <form method="POST" action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="" style="color: #13c6ef;"> {{trans('log-in-paciente.email') }}</label>
                                <input type="email"  id="email_"  name="email" class="form-control  @error('email') is-invalid @enderror  border-right-0 border-left-0 border-top-0" placeholder="{{trans('log-in-paciente.placeholder-email') }}"  autocomplete="Email" value="{{old('email')}}" required 
                                @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" @endif >
                            </div>
                            <div class="form-group">
                                <label for="password"  style="color: #13c6ef;">{{trans('log-in-paciente.password') }}</label>
                                <input type="password" id="password" class="form-control  border-right-0 border-left-0 border-top-0  @error('email') is-invalid @enderror"  name="password" required autocomplete="current-password" placeholder="{{trans('log-in-paciente.placeholder-password') }}"
                                 @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);"  @endif >
                               @error('email')
                                    <span class=" invalid-feedback" role="alert">
                                      <strong>{{ trans('auth.failed') }}</strong>
                                    </span>
                                  @enderror
                            </div>
                            <div class="row  justify-content-md-center">
                               <div class="col-xl-12 col-sm-12">
                                 <div class="icheck-primary">
                                     <p class="mb-1 text-info">
                                       <a class="btn btn-link ml-auto mb-0 text-sm " href="{{ url('password_reset') }}"> {{trans('log-in-paciente.olvidaste') }} </a>
                                     </p>
                                 </div>
                               </div> 
                              <div class="col-xl-12 col-md-12 col-sm-12 text-center">
                                <button type="submit" class="btn  btn-outline-secondary btn-block  btn-md">{{trans('log-in-paciente.iniciar-se') }}</button>
                              </div>
                            </div>

                        </form>
                        <p class="mt-4 text-center">
                            - O -
                        </p>
                        <p  class="mb-2 mt-3 text-center h5" >
                            <a disabled="false" style="color: #13c6ef;" class="btn_registrate btn " data-user="{{$data['tipo']}}">
                                 {{trans('log-in-paciente.registrate') }}
                            </a>
                        </p>

                        <p  class="mb-2 mt-3 text-right h6" >
                            <a disabled="false" style="color: #13c6ef;" href="" class="">
                               <i class="fas fa-sign-in-alt"></i>  {{trans('log-in-paciente.elegir-opcion') }}
                            </a>
                        </p>
                  </div>
                </div>
                <div class="mt-5 border-0 d-none form_register" >
                  <div class="   border-0 mt-3">
                        <form method="POST" action="{{ route('register') }}"  method="post">
                            @csrf
                            <input type="hidden" name="tp" value="{{encrypt($data['tipo']) }}">
                            <div class="form-group">
                                <label for="name" class="" style="color: #13c6ef;"> {{trans('log-in-paciente.name') }} <span class="text-red">*</span></label>
                                <input type="text"  id="name"  name="name" class="form-control  @error('name') is-invalid @enderror  border-right-0 border-left-0 border-top-0" placeholder="{{trans('log-in-paciente.placeholder-name') }}" autofocus autocomplete="name" value="{{ old('name') }}" 
                                 @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);"  @endif required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="" style="color: #13c6ef;">{{trans('log-in-paciente.email') }} <span class="text-red">*</span></label>
                                <input type="email"  id="email"  name="email" class="form-control  @error('email') is-invalid @enderror  border-right-0 border-left-0 border-top-0" placeholder="{{trans('log-in-paciente.placeholder-email') }}" autofocus autocomplete="email" value="{{ old('email') }}" required   @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" @endif>
                                @error('email')
                                    <span class="invalid-feedback alertError" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password"   style="color: #13c6ef;">{{trans('log-in-paciente.password') }} <span class="text-red">*</span></label>
                                <input type="password" id="password" class="form-control  border-right-0 border-left-0 border-top-0  @error('password') is-invalid @enderror"  name="password" required autocomplete="new-password" placeholder="{{trans('log-in-paciente.placeholder-password') }}" 
                                 @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);"  @endif >
                               @error('password')
                                    <span class=" invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                            </div>
                           
                            {{--  <div class="form-group">
                                <label for="password-confirm"  style="color: #13c6ef;">Confirmar Contraseña <span class="text-red">*</span></label>
                                <input type="password" id="password-confirm" class="form-control  border-right-0 border-left-0 border-top-0  @error('password_confirmation') is-invalid @enderror"  name="password_confirmation" required autocomplete="new-password" placeholder="Ingresa una contraseña" >
                                @error('password_confirmation')
                                    <span class=" invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div> --}}
                            <div class="row  justify-content-md-center">
                              <div class="col-xl-10 col-md-12 col-sm-12 text-center">
                                <button type="submit" class="btn btn-block btn-outline-secondary btn-md  mt-4"> {{trans('log-in-paciente.registrar') }}</button>
                                <div class="mt-3 ">
                                   <span class="text-muted">  {{trans('log-in-paciente.al-crear-cuenta') }}</span> <br>
                                    <a class="text-info_ btn"  onclick="openInfoTermiCondiciones()">{{trans('log-in-paciente.acepta-los') }}</a>
                                </div>
                              </div>
                              
                            </div>
                        </form>
                        
                        <p  class="mb-2 mt-5 text-center h5" >
                            <a disabled="false" style="color: #13c6ef;" href="/log-in-paciente" class="">
                               <i class="fas fa-sign-in-alt"></i>  {{trans('log-in-paciente.iniciar-session') }}
                            </a>
                        </p>
                  </div>
                </div>
                <div class="social-auth-links text-center mt-5 btn_sociales">
                    <a href="{{url('login/google')}}" class="btn btn-block btn-outline-danger">
                        <i class="fab fa-google-plus float-left  ml-5 mt-1"></i>
                        {{trans('log-in-paciente.ingresar-google') }}
                    </a>
                    <a href="{{url('login/facebook')}}" class="btn btn-block btn-outline-primary">
                        <i class="fab fa-facebook float-left  ml-5 mt-1"></i>
                         {{trans('log-in-paciente.ingresar-facebook') }}
                    </a>
                    <button type="button" class="btn btn-block btn-outline-info" id="btn_ingreso_email"> 
                        <i class="fas fa-envelope float-left  ml-5 mt-1"></i>
                         {{trans('log-in-paciente.ingresar-email') }}
                    </button>
                </div>
            @elseif($data['tipo']=='M')
                <div class="mt-5 border-0  form_login" >
                  <div class="   border-0 mt-3">
                        <form method="POST" action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="" style="color: #13c6ef;">{{trans('log-in-paciente.email') }}</label>
                                <input type="email"  id="email_"  name="email" class="form-control  @error('email') is-invalid @enderror  border-right-0 border-left-0 border-top-0" placeholder="{{trans('log-in-paciente.placeholder-email') }}"  autocomplete="Email" value="{{old('email')}}" 
                                 @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" @endif required>
                            </div>
                            <div class="form-group">
                                <label for="password"  style="color: #13c6ef;">{{trans('log-in-paciente.password') }}</label>
                                <input type="password" id="password" class="form-control  border-right-0 border-left-0 border-top-0  @error('email') is-invalid @enderror"  name="password" required autocomplete="current-password" placeholder="{{trans('log-in-paciente.placeholder-password') }}" 
                                 @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);"  @endif >
                               @error('email')
                                    <span class=" invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                            </div>
                            <div class="row  justify-content-md-center">
                                <div class="col-xl-12 col-sm-12">
                                    <div class="icheck-primary">
                                        <p class="mb-1 text-info">
                                           <a class="btn btn-link ml-auto mb-0 text-sm " href="{{ route('password.request') }}">  {{trans('log-in-paciente.olvidaste') }} </a>
                                        </p>
                                    </div>
                                </div> 
                                <div class="col-xl-12 col-md-12 col-sm-12 text-center">
                                    <button type="submit" class="btn  btn-outline-secondary btn-block  btn-md">{{trans('log-in-paciente.iniciar-se') }} </button>
                                </div>
                            </div>
                        </form>
                        <p class="mt-4 text-center">
                            - O -
                        </p>
                        <p  class="mb-2 mt-3 text-center h5" >
                            <a disabled="false"  style="color: #13c6ef;" class="btn_registrate btn " data-user="{{$data['tipo']}}">
                                  {{trans('log-in-paciente.registrate') }}
                            </a>
                        </p>


                       
                  </div>
                </div>
                <div class="mt-5 border-0 d-none form_register" >
                  <div class="   border-0 mt-3">
                        <form method="POST" action="{{ route('register') }}"  method="post">
                            @csrf
                            <input type="hidden" name="tp" value=" {{encrypt($data['tipo'])  }}">
                            <div class="form-group">
                                <label for="name" class="" style="color: #13c6ef;">{{trans('log-in-paciente.name') }}<span class="text-red">*</span></label>
                                <input type="text"  id="name"  name="name" class="form-control  @error('name') is-invalid @enderror  border-right-0 border-left-0 border-top-0" placeholder="{{trans('log-in-paciente.placeholder-name') }}" autofocus autocomplete="name" value="{{ old('name') }}" 
                                 @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);"  @endif required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="" style="color: #13c6ef;">{{trans('log-in-paciente.email') }} <span class="text-red">*</span></label>
                                <input type="email"  id="email"  name="email" class="form-control  @error('email') is-invalid @enderror  border-right-0 border-left-0 border-top-0" placeholder="{{trans('log-in-paciente.placeholder-email') }}" autofocus autocomplete="email" value="{{ old('email') }}" 
                                  @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" @endif required>
                                @error('email')
                                    <span class="invalid-feedback alertError" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password"   style="color: #13c6ef;">{{trans('log-in-paciente.password') }} <span class="text-red">*</span></label>
                                <input type="password" id="password" class="form-control  border-right-0 border-left-0 border-top-0  @error('password') is-invalid @enderror"  name="password" required autocomplete="new-password" placeholder="{{trans('log-in-paciente.placeholder-password') }}" 
                                 @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);"  @endif >
                               @error('password')
                                    <span class=" invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                            </div>
                           
                            {{--  <div class="form-group">
                                <label for="password-confirm"  style="color: #13c6ef;">Confirmar Contraseña <span class="text-red">*</span></label>
                                <input type="password" id="password-confirm" class="form-control  border-right-0 border-left-0 border-top-0  @error('password_confirmation') is-invalid @enderror"  name="password_confirmation" required autocomplete="new-password" placeholder="Ingresa una contraseña" >
                                @error('password_confirmation')
                                    <span class=" invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div> --}}
                            <div class="row  justify-content-md-center">
                              <div class="col-xl-10 col-md-12 col-sm-12 text-center">
                                <button type="submit" class="btn btn-block btn-outline-secondary btn-md  mt-4">{{trans('log-in-paciente.registrar') }}</button>
                                <div class="mt-3 ">
                                   <span class="text-muted"> {{trans('log-in-paciente.al-crear-cuenta') }}  </span> <br>
                                    <a class="text-info_ btn"  onclick="openInfoTermiCondiciones()">{{trans('log-in-paciente.acepta-los') }}</a>
                                </div>
                                
                                
                              </div>
                              
                            </div>
                        </form>
                        
                        <p  class="mb-1 mt-3 text-center h5" >
                            <a disabled="false" style="color: #13c6ef;" href="/log-in-medico" class="">
                               <i class="fas fa-sign-in-alt"></i> {{trans('log-in-paciente.iniciar-session') }}
                            </a>
                        </p>
                  </div>
                </div>
            @elseif($data['tipo']=='E')
                <div class="mt-5 border-0  form_login" >
                  <div class="   border-0 mt-3">
                        <form method="POST" action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="" style="color: #13c6ef;">{{trans('log-in-paciente.email') }}</label>
                                <input type="email"  id="email_"  name="email" class="form-control  @error('email') is-invalid @enderror  border-right-0 border-left-0 border-top-0" placeholder="{{trans('log-in-paciente.placeholder-email') }}"  autocomplete="Email" value="{{old('email')}}" 
                                  @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" @endif required>
                            </div>
                            <div class="form-group">
                                <label for="password"  style="color: #13c6ef;">{{trans('log-in-paciente.password') }}</label>
                                <input type="password" id="password" class="form-control  border-right-0 border-left-0 border-top-0  @error('email') is-invalid @enderror"  name="password" required autocomplete="current-password" placeholder="{{trans('log-in-paciente.placeholder-password') }}" 
                                 @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);"  @endif >
                               @error('email')
                                    <span class=" invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                            </div>
                            <div class="row  justify-content-md-center">
                                <div class="col-xl-12 col-sm-12">
                                    <div class="icheck-primary">
                                        <p class="mb-1 text-info">
                                           <a class="btn btn-link ml-auto mb-0 text-sm " href="{{ route('password.request') }}"> {{trans('log-in-paciente.olvidaste') }} </a>
                                        </p>
                                    </div>
                                </div> 
                                <div class="col-xl-12 col-md-12 col-sm-12 text-center">
                                    <button type="submit" class="btn  btn-outline-secondary btn-block  btn-md"> {{trans('log-in-paciente.iniciar-se') }}</button>
                                </div>
                            </div>
                        </form>
                        <p class="mt-4 text-center">
                            - O -
                        </p>
                        <p  class="mb-2 mt-3 text-center h5" >
                            <a disabled="false"  style="color: #13c6ef;" class="btn_registrate btn " data-user="{{$data['tipo']}}">
                                 {{trans('log-in-paciente.registrate') }}
                            </a>
                        </p>

                       
                  </div>
                </div>
                <div class="mt-5 border-0 d-none form_register" >
                  <div class="   border-0 mt-3">
                        <form method="POST" action="{{ route('register') }}"  method="post">
                            @csrf
                            <input type="hidden" name="tp" value=" {{encrypt($data['tipo'])  }}">
                            <div class="form-group">
                                <label for="name" class="" style="color: #13c6ef;">  {{trans('log-in-paciente.name') }} <span class="text-red">*</span></label>
                                <input type="text"  id="name"  name="name" class="form-control  @error('name') is-invalid @enderror  border-right-0 border-left-0 border-top-0" placeholder="{{trans('log-in-paciente.placeholder-name') }}" autofocus autocomplete="name" value="{{ old('name') }}" 
                                 @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);"  @endif required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="" style="color: #13c6ef;">{{trans('log-in-paciente.email') }}<span class="text-red">*</span></label>
                                <input type="email"  id="email"  name="email" class="form-control  @error('email') is-invalid @enderror  border-right-0 border-left-0 border-top-0" placeholder="{{trans('log-in-paciente.placeholder-email') }}" autofocus autocomplete="email" value="{{ old('email') }}" 
                                  @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" @endif required>
                                @error('email')
                                    <span class="invalid-feedback alertError" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password"   style="color: #13c6ef;">{{trans('log-in-paciente.password') }} <span class="text-red">*</span></label>
                                <input type="password" id="password" class="form-control  border-right-0 border-left-0 border-top-0  @error('password') is-invalid @enderror"  name="password" required autocomplete="new-password" placeholder="{{trans('log-in-paciente.placeholder-password') }}" 
                                 @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);"  @endif  >
                               @error('password')
                                    <span class=" invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                            </div>
                           
                           {{--   <div class="form-group">
                                <label for="password-confirm"  style="color: #13c6ef;">Confirmar Contraseña <span class="text-red">*</span></label>
                                <input type="password" id="password-confirm" class="form-control  border-right-0 border-left-0 border-top-0  @error('password_confirmation') is-invalid @enderror"  name="password_confirmation" required autocomplete="new-password" placeholder="Ingresa una contraseña" >
                                @error('password_confirmation')
                                    <span class=" invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div> --}}
                            <div class="row  justify-content-md-center">
                              <div class="col-xl-10 col-md-12 col-sm-12 text-center">
                                <button type="submit" class="btn btn-block btn-outline-secondary btn-md  mt-4"> {{trans('log-in-paciente.registrar') }}</button>
                              </div>
                              
                            </div>
                        </form>
                        
                        <p  class="mb-2 mt-5 text-center h5" >
                            <a disabled="false" style="color: #13c6ef;" href="/log-in-empresa" class="">
                               <i class="fas fa-sign-in-alt"></i>  {{trans('log-in-paciente.iniciar-session') }}
                            </a>
                        </p>
                  </div>
                </div>
            @endif
        @endif    
        <p class="mb-2 mt-4 text-center h6" >
            <a disabled="false" class="mt-5" style="color: #13c6ef;" href="/session" class="">
              <i class="fas fa-arrow-circle-left"></i> {{trans('log-in-paciente.elegir otro') }}
            </a>
        </p>
    </div>
</div>
@include('modalTerminoCondiciones')
@endsection


 @section('adminlte_js')
    <script >
        // variavle global
        var txt_tit=`{{trans('log-in-paciente.registrate') }}`;
    </script>
 
           {{-- mostrar errores form login Paciente--}}
          
           @error('email') 
                @if($message=='El correo electrónico ya ha sido registrado.')
                    <script >     
                        $('.btn_sociales').addClass('d-none');
                        $('.form_login').addClass('d-none');
                        $('.form_register').removeClass('d-none');
                    </script>
                @else
                    <script >      
                       $('.btn_sociales').addClass('d-none');
                       $('.form_login').removeClass('d-none');
                    </script>
                @endif
               
           @enderror

            {{-- mostrar errores form register --}}
            @error('name') 
               <script >     
                   $('.btn_sociales').addClass('d-none');
                   $('.form_login').addClass('d-none');
                   $('.form_register').removeClass('d-none');
               </script>
           @enderror
           @error('password_confirmation') 
               <script >     
                   $('.btn_sociales').addClass('d-none');
                   $('.form_login').addClass('d-none');
                   $('.form_register').removeClass('d-none');
               </script>
           @enderror

           @error('password') 
               <script >     
                   $('.btn_sociales').addClass('d-none');
                   $('.form_login').addClass('d-none');
                   $('.form_register').removeClass('d-none');
               </script>
           @enderror 
        
            <script >
                function InvalidMsg(textbox) { 
                    if (textbox.value == '') {
                        textbox.setCustomValidity('please fill in the field'); 
                     } else if (textbox.validity.typeMismatch){
                         textbox.setCustomValidity('please enter a valid email address');
                     } else { textbox.setCustomValidity(''); }
                      return true; 
                }

    

            </script>
    

    @if(session()->has('info'))
         <script >

            alert('{{session('info')}}');
           // mostrar_toastr('{{session('info')}}','{{session('estado')}}')
         </script>
    @endif
    {{-- <script > mostrar_toastr('qweqwe','error')</script> --}}
    <script src="{{ asset('/js/register.js') }}"></script>
     <script src="{{ asset('/js/global.js') }}"></script>
 @stop