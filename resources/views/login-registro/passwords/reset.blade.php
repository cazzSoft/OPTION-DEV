
@extends('layouts.baseLogin')
@section('title','reset')

@section('content')
    <div class="container-fluid  p-1 ">
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
                      <div class="p-2 mr-3 "><a class=" text-muted "  href="{{url('nosotros')}}">{{trans('informacion-view.acerca de Nosotros') }}  </a></div>
                      <div class="p-2"><a class=" text-muted " href="{{url('info-coinsults')}}">COINSULTS</a> </div>
                    </div>
               </li>
            </ul>
        </div>
      </nav>     
    </div>

    <div class="container mt-5 ">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="card border-0">
                    <div class="card-header border-0 "> 
                        <b class="tex-stile text-info_"> {{ __('adminlte::adminlte.title_name') }} </b> <br>
                        <span class="text-muted">{{ __('adminlte::adminlte.coment_reset') }}  </span>
                       
                    </div>

                    <div class="card-body">
                       
                      <form {{-- action="{{ $password_reset_url }}" --}}  action="{{ url('reset') }}"  method="post">
                            {{ csrf_field() }}

                            {{-- Token field --}}
                            <input type="hidden" name="token" value="{{ $token }}">

                            {{-- Email field --}}
                            <input type="hidden" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    value="{{ $email ?? old('email') }}"  {{--  value="{{ old('email') }}" --}} placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
                           
                            {{-- Password field --}}
                            <div class="input-group mb-3 ">
                                <input type="password" name="password"
                                       class="form-control form-control-lg {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                       placeholder="{{ __('adminlte::adminlte.password') }}">
                               
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>

                            {{-- Password confirmation field --}}
                            <div class="input-group mb-3">
                                <input type="password" name="password_confirmation"
                                       class="form-control form-control-lg {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                       placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                                
                                @if($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                            </div>

                            {{-- Confirm password reset button --}}
                            <div class="form-group text-center mt-5">
                                <button type="submit" class="btn btn-lg bgz-info">
                                    <span class="fas fa-sync-alt"></span>
                                    {{ __('adminlte::adminlte.reset_password') }} 
                                </button>   
                            </div>
                           

                        </form>
                      
                    </div>
                </div>
            </div>
        </div>
        
    </div>

@endsection

@section('adminlte_css') 
<style>
    .tex-stile{
        font-family: 'Calibri';
        font-style: normal;
        font-weight: 700;
        font-size: 24px;
        line-height: 22px;
        /*color: #0FADCE;*/
    }
    .container{
        margin-top: 100px !important;
        
    }
    .text-cali{
    	font-family: 'Calibri';
    	font-style: normal;
    	
    }
    
</style>
@stop
@section('adminlte_js') 
    <script src="{{ asset('/js/global.js') }}"></script>
@stop
