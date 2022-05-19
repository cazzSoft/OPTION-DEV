
 @extends('adminlte::page')
  
  @section('content_header')
    <div class="row   nav_content" >
        @auth
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ocult">
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
                      <a class="nav-link text-center {{ Route::is('coinsult.index') ? 'text-info_' : '' }}" href="{{url('coinsult')}}"> 
                        <span class="ml-1  text-center mb-5">
                          <img src="{{asset('img/icon-coins-gris.png')}}" style="width: 18px; margin-top: -4px;" class="p-0 " alt="icon-coins">
                        </span> 
                        <b>Coinsults </b>
                      </a>
                    </li>
                    <li class="nav-item ml-2 mr-3">
                      <a class="nav-link {{ request()->is(['gestion/articulo_user*','gestion/search_user_art*']) ? 'text-info_' : '' }} " href="{{url('gestion/articulo_user')}}"><i class="fas fa-fw fa-bookmark"></i> <b>Guardados</b></a>
                    </li>
                    <li class="nav-item ml-2 mr-3">
                      <a class="nav-link {{ request()->is(['biblioteca/*']) ? 'text-info_' : '' }} " href="{{url('biblioteca/show')}}"><i class="fas fa-book-reader "></i> <b>Biblioteca</b></a>
                    </li>

                    @if(Auth::user()->type_user()=='dr' || Auth::user()->type_user()=='ad')
                    <li class="nav-item ml-3 mr-3">
                      <a class="nav-link  {{ request()->is(['gestion/user_casos*','medico/casos_ex*','gestion/search_caso*','gestion/caso*']) ? 'text-info_' : '' }}  " href="{{url('gestion/user_casos')}}"><i class="fas fa-briefcase-medical"></i> <b>caso</b></a>
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
                    <a class="nav-link" href="{{url('nosotros')}}"><i class="fas fa-info  border border-segundary p-1 fa-xs"></i>  <b>¿Qué Somos?</b></a>
                  </li>
                  <li class="nav-item ml-3 mr-3">
                    <a class="nav-link" href="{{url('info-coinsults')}}"> <span class="ml-1  text-center mb-5">
                          <img src="{{asset('img/icon-coins-gris.png')}}" style="width: 18px; margin-top: -4px;" class="p-0 " alt="icon-coins">
                        </span> <b>Coinsults</b></a>
                  </li>
                  
                </ul>
              </div>
            </nav>
          </header>  
        </div>
        @endauth
      
        @guest
          
        @else  
         <div class="col-lg-4 col-md-12 col-sm-12  text-center  justify-content-center  history">
          <div class="main-carousel  text-center " data-flickity='{ "cellAlign": "center", "contain": true }'>
            @if( Auth::user()->topMedicos() )
              @foreach(Auth::user()->topMedicos()->take(10) as $key=> $item)
               
                  <div class="carousel-cell text-center @if($key==0) offset-md-1 @endif align-self-end mt-2 border-0">
                    <a class="navbar-brand text-center " onclick="getMedicoTop('{{encrypt($item->id)}}',`{{$img=\Storage::disk('wasabi')->temporaryUrl($item->img, now()->addMinutes(3600)  )}}` )"   href="#"  >
                      @if(isset($item['img'] ) && $item['img']!=null )
                        <img 
                            src="
                                  @if(\Storage::disk('diskDocumentosPerfilUser')->exists($item->img)) 
                                      {{asset($item->img)}}
                                  @else
                                    {{-- {{\Storage::disk('wasabi')->temporaryUrl($item->img, now()->addMinutes(9600)  )}} --}}
                                      {{$img}}
                                  @endif
                                " 
                              alt="{{$item->img}}"
                              class="img-circle  mr-2 imgTop" width="60" height="60" style=" border: 3px solid #0FADCE;" 
                        >  
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

      @guest
        <footer class="main-footer border-info">
          <div class="row">
            <div class="col-md-3 col-sm-12 text-center footer-div-1">
              <img src="{{asset('img/logo2.svg')}}" alt="" class="mt-2 img-logo-f">
              <div class="text-leth mb-3 p-3 ">
                <a  href="https://twitter.com/mikec84" target="_blank" class="btn  border-0 p-1" >
                  <i class="fab fa-twitter fa-lg text-info_"></i>
                </a>
                <a  href="https://www.instagram.com/option2health/" target="_blank" class="btn  border-0 p-1" >
                  <i class="fab fa-instagram text-info_ fa-lg"></i>
                </a>
                 <a href="https://www.youtube.com/channel/UC13o92F3ZetJ4sIC_dln7HA"  target="_blank" class="btn p-1 "  >
                    <i class="fab fa-youtube text-info_  fa-lg"></i>
                  </a>
                   <a href="https://www.linkedin.com/in/mike-cardenas-077a1978/"  target="_blank" class="btn p-1 "  >
                    <i class="fab fa-linkedin-in text-info_  fa-lg"></i> 
                  </a>
                  <a href="https://www.facebook.com/Option2health"  target="_blank" class="btn  p-1" >
                    <i class="fab fa-facebook text-info_ fa-lg"></i>
                  </a>
                  <a href="https://api.whatsapp.com/send?phone=593969331727&app=facebook&entry_point=page_cta&fbclid=IwAR28kSawtc8mna9gxDocZrOBZtt2wCrmqrR8QYUK4QNhYQnvcon_DMLy_qY"  target="_blank" class="btn  p-1" >
                    <i class="fab fa-whatsapp text-info_ fa-lg"></i> 
                  </a>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 border-right border-info border-left bordes-footer">
              <p class="text-info_  ml-3"><b>Legal</b></p>
              <a href="{{asset('#')}}" class="text-muted text-dark ml-3" onclick="openInfoTermiCondiciones()"> Términos y Condiciones </a> <br>
              <a href="{{asset('#')}}" class="text-muted text-dark ml-3"> Política de Privacidad</a><br>
              <a href="{{asset('nosotros')}}" class="text-muted text-dark ml-3"> Acerca de Nosotros</a><br>
              <a href="{{asset('info-coinsults')}}" class="text-muted text-dark ml-3"> Coinsults</a><br>
            </div>
            <div class="col-md-3 col-sm-12">
              <p class="text-info_  ml-3"><b>Contáctanos</b></p>
                <form id="contac" action="POST" method="POST">
                  <div class="card-body m-0 p-0">
                    <div class="form-group row m-0 text-right">
                      <label for="email" class="col-sm-4 col-form-label"><small><b>E-mail</b></small></label>
                      <div class="col-sm-7">
                        <input type="email" class="form-control form-control-sm" id="email" required>
                      </div>
                    </div>
                    <div class="form-group row m-0 text-right">
                      <label for="name" class="col-sm-4 col-form-label"><small><b>Nombres</b></small></label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" id="name" required>
                      </div>
                    </div>
                    <div class="form-group row m-0 text-right">
                      <label for="telefono" class="col-sm-4 col-form-label"><small><b>Número Telefonico</b></small></label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" id="telefono" required>
                      </div>
                    </div>
                     <div class="form-group row m-0 text-right btn-form">
                      <div class="col-sm-11 text-right">
                        <button type="submit" class="btn bgz-info btn-xs pl-5 pr-5" id="btn-contac"> Enviar </button>
                      </div>
                    </div>
                   
                  </div>
                </form>
             
            </div>
          </div>
        </footer>
      @else
        <footer class="main-footer_ p-0  text-center m-auto" >
         <div class="row text-center mt-2">
           <div class="col-3  align-self-center d-flex flex-column">
             <a href="/" class="mx-auto text-center p-0 {{ Route::is('home') ? 'text-info_' : '' }}">
               <i class="fa fa-home  {{ Route::is('home') ? 'text-info_' : 'text-dark' }}"></i>
               <span class="d-flex flex-column text_item_footer  ">Home</span>
             </a>
           </div>
           <div class="col-3  align-self-center d-flex flex-column"> 
             <a href="{{url('coinsult')}}" class="mx-auto text-center p-0">
               <span class="ml-1  text-center mb-5">
                 <img src="{{asset('img/icon-coins-gris.png')}}" style="width: 18px; margin-top: -4px;" class="p-0 " alt="icon-coins">
               </span> 
               <span class="d-flex flex-column text_item_footer {{ Route::is('coinsult.index') ? 'text-info_' : 'text-dark' }}">Coinsults</span>
             </a>
           </div>
           <div class="col-3  align-self-center d-flex flex-column">
             <a href="{{url('gestion/articulo_user')}}" class="mx-auto text-center p-0">
               <i class="fas fa-fw fa-bookmark text-secondary {{ request()->is(['gestion/articulo_user*','gestion/search_user_art*']) ? 'text-info_' : '' }}"></i>
               <span class="d-flex flex-column text_item_footer {{ request()->is(['gestion/articulo_user*','gestion/search_user_art*']) ? 'text-info_' : 'text-dark' }}">Guardados</span>
             </a>
           </div>
           <div class="col-3  align-self-center d-flex flex-column">
             <a href="{{url('biblioteca/show')}}" class="mx-auto text-center p-0">
               <i class="fas fa-book-reader text-secondary {{ request()->is(['biblioteca/*']) ? 'text-info_' : '' }}"></i>
               <span class="d-flex flex-column text_item_footer {{ request()->is(['biblioteca/*']) ? 'text-info_' : 'text-dark' }}">Biblioteca</span>
             </a>
           </div>
         </div>
        </footer> 
      @endguest
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
  <script>
    $(function () {
      var nua = navigator.userAgent
      var isAndroid = (nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1)
      if (isAndroid) {
        $('select.form-control').removeClass('form-control').css('width', '100%')
      }
    })
  </script>
	{{--  apartado para incluir mas js  --}}
	@yield('include_js')
 @stop




