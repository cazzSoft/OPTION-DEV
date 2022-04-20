
@extends('layouts.baseLogin')
@section('title','Password Reset')

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
                        <b class="tex-stile text-info_">{{ trans('code.title-rest') }}</b> <br>
                        <span class="text-muted">{{ trans('code.coment-reset') }}  @if(isset($email))<b> {{$email}} </b> @endif </span>
                       	<a disabled="false"  href="{{ url('password_reset') }}" class="text-muted text-center text-info_">
                       	  {{ trans('code.cambiar') }}
                       	</a>

                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ url('password_reset/'.encrypt($email)) }}"  enctype="multipart/form-data">
                            @csrf
                            <input  type="hidden" name="_method"  value="PUT">
                            <div class="form-group row form-group-md">
                                <input id="code" type="number"  class="form-control {{-- is-valid --}} @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" placeholder="{{trans('code.placeholder-input') }}" autofocus  @if(Session::get('language')=='en') oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" @endif >

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <a disabled="false"  class="text-muted text-center text-info_ mt-3 " onclick="resend_code(`{{encrypt($email)}}`)">
                       	  			{{ trans('code.renviar') }} 
                                    <div class=" float-right" id="spinner-code">
                                      {{--  <div class="spinner-border text-info_  ml-3 "  style="width: 1rem; height: 1rem;"  role="status"> </div>  --}}
                                    </div>
                                    
                       			</a>
                                
                            </div>

                            <div class="form-group mt-5 ">
                                <div class="text-center">
                                    <button type="submit" class="btn  bgz-info btn-lg">
                                       {{ trans('code.text-btn-reset') }}
                                    </button>
                                    <p class="text-muted ml-5 mr-5 mt-2 text-center">
                                    	<small class="text-cali text-justify">
                                    		 {{ trans('code.info-email') }}
                                    	</small>
                                    </p>	
                                   
                                    
                                </div>
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
    <script src="{{ asset('/js/password-reset.js') }}"></script>
@stop
