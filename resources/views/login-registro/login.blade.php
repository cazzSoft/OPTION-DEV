
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
            <div class="register-logo d-flex justify-content-start ml-5">       
                <img class=" img-fluid pad ml-2" src="{{asset('img/logolg.svg')}}" >  
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 text-center text-muted mt-2">
                   <a href="#" class="text-muted"> <div class="p-2"> ACERCA DE NOSOTROS</div></a> 
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12  text-muted mt-2">
                   <a href="#" class="text-muted"> <div class="p-2  text-center"> COINSUL</div></a> 
                </div>
            </div>
        </div>
        <div class="col-md-12"></div>
        
    </div>

    <div class="row mt-5">
        <div class="col-md-8 col-sm-8 col-xs-12">
        	 <p class=" text-left text-info h1 ml-5 p-2 mb-4" style="color: #13c6ef !important;"><b>Beneficios al Registrarte</b></p>
        	<div class="row mb-3">
	            <div class="col-sm-6">
	             	<div class="ml-5">
	             		 <img class="img-fluid" src="/img/op2.svg" alt="Photo">
	             	</div>
	            </div>
	            <!-- /.col -->
	            <div class="col-sm-6">
	             	<ul class="list-group lead text-justify mr-5">
	             		<li>Encontrar al profesional de la salud indicado para ti y tus necesidades.</li>
	             		<li>Conocer más acerca de la carrera y el perfil de tu médico mediante la visualización de sus publicaciones  informativas en el área de salud subidas en nuestra plataforma.</li>
	             		<li>Mantenerte informado/a mediante el acceso a la información profesional y científica sobre temas de salud de tu interés.</li>
	             		<li>Ganar CoinSsults e intercambiarlos por consultas médicas o incluso donarlos a un familiar o amigo</li>
	             	</ul>
	             	
	            </div>
	            <!-- /.col -->
	        </div>
        </div>

        <div class="col-md-3  ml-5 p-0">
            <p class="profile-username text-center text-info h1" style="color: #13c6ef !important;">Inicia sesión</p>
            
            <div class="social-auth-links text-center mt-5 ">
            	<a href="#" class="btn btn-block btn-danger">
            		<i class="fab fa-google-plus mr-2"></i>
            		Ingresa con Google
            	</a>
            	<a href="#" class="btn btn-block btn-primary">
            		<i class="fab fa-facebook mr-2"></i>
            		Ingresa con Facebook
            	</a>
            	<a href="#" class="btn btn-block btn-light">
            		<i class="fas fa-envelope mr-2"></i>
            		Ingresa  con tu email
            	</a>
              
            </div>
        </div>
    </div>
    
    
</div>


@endsection


 @section('adminlte_js')
    <script src="{{ asset('/js/register.js') }}"></script>
 @stop