
 @extends('adminlte::page')
 	


  @section('content')
    <div class="row mb-0 mt-2 " >
      <div class="col-lg-6 col-md-6 col-sm-12 ">
        <nav class="navbar navbar-expand-lg navbar-light bg-white  ml-2">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active ">
                <a class="nav-link text-info" href="#"><i class="fa fa-home"></i> Inicio </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-notes-medical"></i> ¿Que Somos?</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-fw fa-coins"></i> Coinsults</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#"><i class="fas fa-fw fa-bookmark"></i> Guardados</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12  text-center ">
        <!-- Just an image -->
        <nav class="navbar navbar-light bg-white ">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active ml-5 mb-5">
                <a class="navbar-brand" href="#">
                  <img src="img/user1-128x128.jpg" alt="..." class="img-circle  mr-4 " width="50" height="50" style=" border: 3px solid #0FADCE;">
                </a>
                <a class="navbar-brand" href="#">
                  <img src="img/user4-128x128.jpg" alt="..." class="img-circle  mr-4 " width="50" height="50" style=" border: 3px solid #0FADCE;">
                </a>
                <a class="navbar-brand" href="#">
                  <img src="img/user3-128x128.jpg" alt="..." class="img-circle  mr-4 " width="50" height="50" style=" border: 3px solid #0FADCE;">
                </a>
                <a class="navbar-brand" href="#">
                  <img src="img/user4-128x128.jpg" alt="..." class="img-circle  mr-4 " width="50" height="50" style=" border: 3px solid #0FADCE;">
                </a>
                <a class="navbar-brand" href="#">
                  <img src="img/user5-128x128.jpg" alt="..." class="img-circle  mr-4 " width="50" height="50" style=" border: 3px solid #0FADCE;">
                </a>
                <a class="navbar-brand" href="#">
                  <img src="img/user6-128x128.jpg" alt="..." class="img-circle  mr-4 " width="50" height="50" style=" border: 3px solid #0FADCE;">
                </a>
                <a class="navbar-brand" href="#">
                  <img src="img/user7-128x128.jpg" alt="..." class="img-circle  mr-4 " width="50" height="50" style=" border: 3px solid #0FADCE;">
                </a>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </nav>
        
      </div>
    </div>
 		@yield('contenido')

      {{--   <footer class="main-footer">
          <div class="float-right d-none d-sm-block">
            <b>Option2health Version</b> 1.0.0
          </div>
          <strong>Copyright &copy; 2020-2030 <a href="https://adminlte.io">CAZZ</a>.</strong> All rights reserved.
        </footer> --}}

  	@stop

 @section('css') 
	
	{{--  apartado para incluir mas css  --}}
	@yield('include_css')

  {{--  configuraciones globales css --}}
  <link rel="stylesheet" href="{{ asset('/css/appO2h.css') }}">
 @stop

 @section('js') 
 	{{--  cinfiguraciones globales js --}}
 	<script src="{{ asset('/js/confOption2h.js') }}"></script>
	 
	{{--  apartado para incluir mas js  --}}
	@yield('include_js')
 @stop




