@extends('homeOption2h')
{{-- @extends('layouts.baseLogin') --}}
@section('title','Password Reset')

@section('contenido')
    {{-- <div class="container-fluid  p-1 ">
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
    </div> --}}

    <div class="container mt-5 ">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="card  border-white shadow-md">
                    <div class="card-header border-0 "> 
                        <b class="tex-stile text-info_">{{ trans('passwords.title-rest') }}</b>
                        <p class="text-muted mt-2">{{ trans('passwords.coment-reset') }}</p>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert border border-info alert-dismissible">
                                <span  class="close pl-0 pr-0" data-dismiss="alert" aria-hidden="true"><i class="icon fas fa-times text-info_ fa-sm"></i></span>
                              
                              <h5 class="text-info_"><i class="icon fas fa-info text-info_"></i>  {{ __('passwords.alert') }}</h5>
                                {{ __('passwords.status') }}
                            </div>
                           
                        @endif

                        <form method="POST" action="{{ route('password_reset.store') }}">
                            @csrf
                            <div class="form-group row">
                                <input id="email" type="email" class="form-control {{-- is-valid --}} @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{trans('passwords.placeholder-input') }}" autofocus  @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" @endif >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ trans('passwords.user') }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group  ">
                                <div class="text-center">
                                    <button type="submit" class="btn  bgz-info btn-lg">
                                       {{ trans('passwords.text-btn-reset') }}
                                    </button>

                                    
                                </div>
                            </div>
                            <div class="form-group text-center mt-2">
                                <a disabled="false"  href="{{ url('session') }}" class="text-muted text-center text-info_">
                                  {{ trans('passwords.back') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

@endsection

@section('include_css') 
<style>
    .tex-stile{
        font-family: 'Calibri';
        font-style: normal;
        font-weight: 700;
        font-size: 22px;
        line-height: 22px;
        /*color: #0FADCE;*/
    }
    .container{
        margin-top: 100px !important;
    }
    .foot1, .nav_content  {
        display: none;
    }
    
    
</style>
@stop
@section('include_js') 
    <script src="{{ asset('/js/global.js') }}"></script>
@stop
