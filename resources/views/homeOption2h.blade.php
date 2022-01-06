
 @extends('adminlte::page')
 	@section('content')
 		@yield('contenido')

        <footer class="main-footer">
          <div class="float-right d-none d-sm-block">
            <b>Option2health Version</b> 1.0.0
          </div>
          <strong>Copyright &copy; 2020-2030 <a href="https://adminlte.io">CAZZ</a>.</strong> All rights reserved.
        </footer>

  	@stop

 @section('css') 
	{{--  configuraciones globales css --}}
	<link rel="stylesheet" href="{{ asset('/css/appFacturacion.css') }}">
	{{--  apartado para incluir mas css  --}}
	@yield('include_css')
 @stop

 @section('js') 
 	{{--  cinfiguraciones globales js --}}
 	<script src="{{ asset('/js/confOption2h.js') }}"></script>
	 
	{{--  apartado para incluir mas js  --}}
	@yield('include_js')
 @stop




