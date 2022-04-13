
 @extends('adminlte::page')
  
  @section('content_header')
    <div class="row  ocult nav_content" >
        @auth
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ">
          <header>
             <nav class="navbar navbar-expand-lg navbar-light bg-white  mx-auto mt-3 mb-2 ocult">
                <a  class="navbar-brand ml-2 navbar-toggler border-0 text-secondary "
                      href="#" data-toggle="collapse" data-target="#navbarNav" >
                       <b class="text-muted h6"> <span class="navbar-toggler-icon mr-3"></span> Menu </b>
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav text-center">
                    <li class="nav-item ml-4 mr-2">
                      <a class="nav-link  {{ Route::is('home') ? 'text-info_' : '' }}" href="/"><i class="fa fa-home"></i> <b>Inicio </b> </a>
                    </li>
                    <li class="nav-item ml-2 mr-3">
                      <a class="nav-link" href="{{url('nosotros_')}}"><i class="fa fa-notes-medical"></i> <b>¿Qué Somos?</b></a>
                    </li>
                    <li class="nav-item ml-3 mr-3">
                      <a class="nav-link  {{ Route::is('coinsult.index') ? 'text-info_' : '' }}" href="{{url('coinsult')}}"><i class="fas fa-fw fa-coins"></i> <b>Coinsults </b></a>
                    </li>
                    <li class="nav-item ml-2 mr-3">
                      <a class="nav-link {{ request()->is(['gestion/articulo_user*','gestion/search_user_art*']) ? 'text-info_' : '' }} " href="{{url('gestion/articulo_user')}}"><i class="fas fa-fw fa-bookmark"></i> <b>Guardados</b></a>
                    </li>
                    <li class="nav-item ml-2 mr-3">
                      <a class="nav-link {{ request()->is('biblioteca/show*') ? 'text-info_' : '' }} " href="{{url('biblioteca/show')}}"><i class="fas fa-book-reader "></i> <b>Biblioteca</b></a>
                    </li>

                    @if(Auth::user()->type_user()=='dr' || Auth::user()->type_user()=='ad')
                    <li class="nav-item ml-3 mr-3">
                      <a class="nav-link  {{ request()->is(['gestion/user_casos*','medico/casos_ex*','gestion/search_caso*','gestion/caso*']) ? 'text-info_' : '' }}  " href="{{url('gestion/user_casos')}}"><i class="fas fa-book-reader "></i> <b>caso</b></a>
                    </li>
                    @endif
                    @if( Auth::user()->type_user()=='ad')
                    <li class="nav-item ml-3 mr-3">
                      <a class="nav-link  {{ request()->is(['noticia/*']) ? 'text-info_' : '' }}  " href="{{url('noticia/new')}}"><i class="fas fa-book-reader "></i> <b>Noticia</b></a>
                    </li>
                    @endif
                  </ul>
                </div>
            </nav>
          </header>   
        </div>
        @else
        <div class="col-lg-12 col-md-12 col-sm-12  ">
          <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-white  mx-auto mt-3 mb-2 ocult">
              <a  class="navbar-brand ml-2 navbar-toggler border-0 text-secondary " href="#" data-toggle="collapse" data-target="#navbarNav" ><b class="text-muted"> <span class="navbar-toggler-icon mr-3"></span> Menu </b></a>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                  <li class="nav-item  ml-3 mr-3">
                    <a class="nav-link text-info_ " href="/"><i class="fa fa-home"></i> <b>Inicio </b> </a>
                  </li>
                  <li class="nav-item ml-3 mr-3">
                    <a class="nav-link" href="{{url('nosotros')}}"><i class="fa fa-notes-medical"></i>  <b>¿Qué Somos?</b></a>
                  </li>
                  <li class="nav-item ml-3 mr-3">
                    <a class="nav-link" href="{{url('info-coinsults')}}"><i class="fa fa-coins"></i> <b>Coinsults</b></a>
                  </li>
                  <li class="nav-item ml-3 mr-3">
                    <a class="nav-link " href="{{url('gestion/articulo_user')}}"><i class="fas fa-fw fa-bookmark"></i> <b>Guardados</b></a>
                  </li>
                  <li class="nav-item ml-3 mr-3">
                    <a class="nav-link " href="{{url('biblioteca/show')}}"><i class="fas fa-book-reader "></i> <b>Biblioteca</b></a>
                  </li>
                </ul>
              </div>
            </nav>
          </header>  
        </div>
        @endauth
      
        @guest
          
        @else  
         <div class="col-lg-4 col-md-12 col-sm-12  text-center bg-white justify-content-center bg-info">
          <div class="main-carousel  text-center " data-flickity='{ "cellAlign": "center", "contain": true }'>
            @if( Auth::user()->topMedicos() )
              @foreach(Auth::user()->topMedicos() as $key=> $item)
                <div class="carousel-cell text-center @if($key==0) offset-md-1 @endif align-self-end mt-2">
                  <a class="navbar-brand text-center " onclick="getMedicoTop('{{encrypt($item->id)}}' )" href="#">
                    @if(isset($item['img'] ) && $item['img']!=null )
                      <img src="{{\Storage::disk('wasabi')->temporaryUrl($item->img, now()->addMinutes(3600)  )}}" alt="{{$item->img}}" class="img-circle  mr-4 imgTop" width="60" height="60" style=" border: 3px solid #0FADCE;">  
                    @else 

                    @endif
                  </a>
                </div>
              @endforeach
            @endif 
          </div>
        </div>
        @endguest
      
    </div>
  @endsection

  @section('content')
 		@yield('contenido')

      {{--   <footer class="main-footer">
          <div class="float-right d-none d-sm-block">
            <b>Option2health Version</b> 1.0.0
          </div>
          <strong>Copyright &copy; 2020-2030 <a href="https://adminlte.io">CAZZ</a>.</strong> All rights reserved.
        </footer> --}}
     @include('modalInfoMedico') 
     @include('modalTerminoCondiciones') 
     @include('modalLogout')   
  	@stop

 @section('css') 
	{{--  apartado para incluir mas css  --}}
	@yield('include_css')
   <style>
     .flickity-page-dots{
        display: none;
     }
     .flickity-button{
      display: none;
     }
   </style>
  {{--  configuraciones globales css --}}
  <link rel="stylesheet" href="{{ asset('css/appO2h.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/flickity@2.3.0/dist/flickity.css">
 @stop

 @section('js') 
 	{{--  cinfiguraciones globales js --}}
 	<script src="{{ asset('/js/confOption2h.js') }}"></script>
	<script src="https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js"></script>
  {{-- controlar imagen de rotas --}}
  <script type='text/javascript'>
    function ImagenOk(img) {
       if (!img.complete) return false;
       if (typeof img.naturalWidth != 'undefined' && img.naturalWidth == 0) return false;
       return true;
    }

    function RevisarImagenesRotas() {
       var replacementImg = `https://option2health.test/img/user.png`;
       for (var i = 0; i < document.images.length; i++) {
        if (!ImagenOk(document.images[i])) {
          document.images[i].src = replacementImg;
        }
      }
    }
    window.onload=RevisarImagenesRotas;
  </script>
	{{--  apartado para incluir mas js  --}}
	@yield('include_js')
 @stop




