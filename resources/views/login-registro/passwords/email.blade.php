
@extends('layouts.baseLogin')
@section('title','Password Reset')


@section('content')

<!-- Navbar -->
<div class="container-fluid  p-1">
  <nav class=" navbar navbar-expand-lg navbar-light navbar-white p-0 border-bottom border-info ">
    <div class=" container-fluid ">
      <a href="/" class="navbar-brand ml-4 imgSecion">
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
                  <div class="p-2 mr-3 "><a class="text-info_"  href="">ACERCA DE NOSOTROS  </a></div>
                  <div class="p-2"><a class="text-info_" href="">COINSULTS</a> </div>
                </div>
           </li>
        </ul>
    </div>
  </nav>     
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

