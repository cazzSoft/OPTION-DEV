@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@php( $password_email_url = View::getSection('password_email_url') ?? config('adminlte.password_email_url', 'password/email') )

@if (config('adminlte.use_route_url', false))
    @php( $password_email_url = $password_email_url ? route($password_email_url) : '' )
@else
    @php( $password_email_url = $password_email_url ? url($password_email_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.password_reset_message'))
{{-- Top Navbar --}}

  

   

@section('auth_body')

    @if(session('status'))
        <div class="alert alert-info">
            {{ session('status') }} 
        </div>
    @endif
    <p class="login-box-msg">¿Olvidaste tu contraseña? Aquí puede recuperar fácilmente una nueva contraseña.</p>
    <form action="{{ $password_email_url }}" method="post">
        {{ csrf_field() }}

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email') }}" placeholder="{{ __('Ingresa tu email') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>

        {{-- Send reset link button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-info') }}">
            <span class="fas fa-share-square"></span>
            {{ __('Solicitar nueva contraseña') }}
        </button>

    </form>
    <p class="mt-3 mb-1">
        <a href="/session">Iniciar sesión</a>
    </p>
   
@stop
