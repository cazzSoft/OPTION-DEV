
@extends('adminlte::page')
  
  @section('content_header')
    <div class="row   nav_content " >
      @movil
      @else
        {{-- @auth
          <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ocult">
            <header>
               <nav class="navbar navbar-expand   mx-auto mt-3 mb-2 ocult ">
              
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav text-center">
                      <li class="nav-item ml-5">
                        <a class="nav-link  {{ Route::is('home') ? 'text-info_' : 'text-muted' }}" href="/"><i class="fa fa-home"></i> <b>Inicio </b> </a>
                      </li>
                      <li class="nav-item ">
                        <a class="nav-link {{ Route::is('nosotros_.index') ? 'text-info_' : 'text-muted' }} " href="{{url('nosotros_')}}"><i class="fa fa-notes-medical"></i> <b>¿Qué Somos?</b></a>  
                      </li>
                      <li class="nav-item ml-3 mr-3">
                        <a class="nav-link text-center {{ Route::is('coinsult.index') ? 'text-info_' : 'text-muted' }}" href="{{url('coinsult')}}"> 
                          <span class="ml-1  text-center mb-5">
                            <img src="{{asset('img/icon-coins-gris.png')}}" style="width: 18px; margin-top: -4px;" class="p-0 " alt="icon-coins">
                          </span> 
                          <b>Coinsults </b>
                        </a>
                      </li>
                      <li class="nav-item ml-2 mr-3">
                        <a class="nav-link {{ request()->is(['gestion/articulo_user*','gestion/search_user_art*']) ? 'text-info_' : 'text-muted' }} " href="{{url('gestion/articulo_user')}}"><i class="fas fa-fw fa-bookmark"></i> <b>Guardados</b></a>
                      </li>
                      <li class="nav-item ml-2 mr-3">
                        <a class="nav-link {{ request()->is(['biblioteca/*']) ? 'text-info_' : 'text-muted' }} " href="{{url('biblioteca/show')}}"><i class="fas fa-book-reader "></i> <b>Biblioteca</b></a>
                      </li>

                      @if(Auth::user()->type_user()=='dr' || Auth::user()->type_user()=='ad')
                      <li class="nav-item ml-3 mr-3">
                        <a class="nav-link  {{ request()->is(['gestion/user_casos*','medico/casos_ex*','gestion/search_caso*','gestion/caso*']) ? 'text-info_' : 'text-muted' }}  " href="{{url('gestion/user_casos')}}"><i class="fas fa-briefcase-medical"></i> <b>caso</b></a>
                      </li>
                      @endif
                      @if( Auth::user()->type_user()=='ad')
                      <li class="nav-item ml-3 mr-3">
                        <a class="nav-link  {{ request()->is(['noticia/*']) ? 'text-info_' : 'text-muted' }}  " href="{{url('noticia/new')}}"><i class="fas fa-book-reader "></i> <b>Noticia</b></a>
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
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                  <li class="nav-item  ml-3 mr-3">
                    <a class="nav-link  {{ request()->is('/') ? 'text-info_' : 'text-muted' }}" href="/"><i class="fa fa-home"></i> <b>Inicio </b> </a>
                  </li>
                  <li class="nav-item ml-3 mr-3">
                    <a class="nav-link {{ request()->is(['nosotros','nosotros_']) ? 'text-info_' : 'text-muted' }}  " href="{{url('nosotros')}}"><i class="fas fa-info  border border-segundary p-1 fa-xs"></i>  <b>¿Qué Somos?</b></a>
                  </li>
                  <li class="nav-item ml-3 mr-3">
                    <a class="nav-link  {{ request()->is('info-coinsults') ? 'text-info_' : 'text-muted' }}" href="{{url('info-coinsults')}}"> <span class="ml-1  text-center mb-5">
                          <img src="{{asset('img/icon-coins-gris.png')}}" style="width: 18px; margin-top: -4px;" class="p-0 " alt="icon-coins">
                        </span> <b>Coinsults</b></a>
                  </li>
                  
                </ul>
              </div>
            </nav>
          </header>  
        </div>
        @endauth --}}
      @endmovil
       
      @auth  
        <div class="col-lg-10 col-md-12 col-sm-12  text-center  justify-content-center  history m-auto">
          <div class="main-carousel  text-center main-carousel-dr" data-flickity='{ "cellAlign": "left", "contain": true }' style="height:70px">
            @if( Auth::user()->topMedicos() )
              @foreach(Auth::user()->topMedicos()->take(10) as $key=> $item)
                  <div class="carousel-cell text-center align-self-end mt-2 border-0">
                    <a class="navbar-brand_ text-center mr-3" onclick="getMedicoTop('{{encrypt($item->id)}}',`{{$img=\Storage::disk('wasabi')->temporaryUrl($item->img, now()->addMinutes(3600)  )}}` )"   href="#"  >
                      @if(isset($item['img'] ) && $item['img']!=null )
                        <img 
                            src="
                                  @if(\Storage::disk('diskDocumentosPerfilUser')->exists($item->img)) 
                                      {{asset($item->img)}}
                                  @else
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
      @else
        
        <div class="col-lg-10 col-md-12 col-sm-12  text-center  justify-content-center  history m-auto ">
          <div class="main-carousel  text-center main-carousel-dr " data-flickity='{ "cellAlign": "center", "contain": true }' style="height:70px">
            @if( isset($list_top_medico) )
              @foreach($list_top_medico->take(10) as $key=> $item)
                  <div class="carousel-cell text-center  align-self-end mt-2 border-0">
                    <a class="navbar-brand_ text-center mr-3"    href="#"  >
                      @if(isset($item['img'] ) && $item['img']!=null )
                        <img 
                            src="
                                  @if(\Storage::disk('diskDocumentosPerfilUser')->exists($item->img)) 
                                      {{asset('img/error.png')}}
                                  @else
                                      {{asset('img/error.png')}}
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
      @endauth
    </div>
  @endsection

  @section('content')
 		@yield('contenido')
    
    {{-- modales --}}
    @include('modalInfoMedico') 
    @include('modalTerminoCondiciones') 
    @include('modalLogout')   
  @stop

  
@section('css') 
	{{--  apartado para incluir mas css  --}}
    <style>
      .flickity-page-dots{
        display: none;
      }
      .flickity-button {
        display: none;
        background: hsl(190deg 86% 43% / 68%) !important;
        border: none;
        color: #fff;
      }
      .flickity-prev-next-button.next {
          right: -50px !important;
      }
      .flickity-prev-next-button.previous {
          left: -50px !important;
      }
      .flickity-viewport{
        border-radius: 30px !important;
          
      }
      /*.flickity-viewport {
          overflow: hidden;
          position: relative;
          height: 100%;
      }*/
    </style>
  {{--  configuraciones globales css --}}
  <link rel="stylesheet" href="{{ secure_asset('css/nav-side-bar.css') }}">
  <link rel="stylesheet" href="{{ secure_asset('css/appO2h.css') }}">
  
  @yield('include_css')
@stop

 @section('js') 
 	
  {{--  configuraciones globales js --}}
 	<script src="{{ asset('/js/confOption2h.js') }}"></script>
  
  <script>
    // para obtener informacion del nabegador
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




