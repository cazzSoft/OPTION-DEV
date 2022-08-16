@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container' )
@else
    @php( $def_container_class = 'container-fluid' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop


@section('classes_body', $layoutHelper->makeBodyClasses()) 
@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">
        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')   
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')  {{-- menu --}}
        @endif

        {{-- Content Wrapper --}}
        <div class="content-wrapper {{--  {{ config('adminlte.classes_content_wrapper') ?? '' }} --}} " style="background:transparent;">

            {{-- Content Header --}}
            <div class="content-header {{-- header_content --}}">
                <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                    @yield('content_header') 
                </div>
            </div>

            {{-- Main Content --}}
            <div class="content ">
                <div class=" container-fluid {{ config('adminlte.classes_content') ?: $def_container_class }}" >
                    @yield('content')
                </div>
            </div>

        </div>

        {{-- Footer --}}
        {{-- @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif --}}

        {{-- Right Control Sidebar --}}
       {{--  @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif --}}
    </div>
    @section('footer_') 
        @guest
            <footer class="main-footer foot1 border-info" style="width: 100%; margin-left:0px !important ;">
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
                        <a href="#" class="text-muted text-dark ml-3" onclick="openInfoPoliticas()"> Política de Privacidad</a><br>
                        <a href="{{asset('nosotros')}}" class="text-muted text-dark ml-3"> Acerca de Nosotros</a><br>
                        <a href="{{asset('info-coinsults')}}" class="text-muted text-dark ml-3"> Coinsults</a><br>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <p class="text-info_ ml-3 contact_"><b>Contáctanos</b></p>
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
            @movil
                <footer class="main-footer_ p-0  text-center m-auto" >
                    <div class="row text-center mt-2">
                        <div class="col  align-self-center d-flex flex-column">
                            <a href="/" class="mx-auto text-center p-0 ">
                               <i class="fa fa-home  text-muted"></i>
                               <span class="d-flex flex-column text_item_footer  ">Home</span>
                               <div class="linea-icon  {{  request()->is('/') ? 'bgz-info' : 'text-muted' }}"></div> 
                           </a>
                        </div>
                        <div class="col  align-self-center d-flex flex-column"> 
                            <a href="{{url('info-coinsults')}}" class="mx-auto text-center p-0">
                               <span class="ml-1  text-center mb-5">
                                 <img src="{{asset('img/icon-coins-gris.png')}}" style="width: 18px; margin-top: -4px;" class="p-0 " alt="icon-coins">
                                </span> 
                                <span class="d-flex flex-column text_item_footer ">Coinsults</span>
                                <div class="linea-icon  {{  request()->is('info-coinsults') ? 'bgz-info' : 'text-muted' }}"></div>
                            </a>
                        </div>
                        <div class="col  align-self-center d-flex flex-column">
                            <a href="{{url('gestion/articulo_user')}}" class="mx-auto text-center p-0">
                                <i class="fas fa-fw fa-bookmark text-secondary  "></i>
                                <span class="d-flex flex-column text_item_footer ">Guardados</span>
                                <div class="linea-icon  {{  request()->is(['gestion/articulo_user*','gestion/search_user_art*']) ? 'bgz-info' : 'text-muted' }}"></div>
                            </a>
                        </div>
                        <div class="col align-self-center d-flex flex-column">
                            <a href="{{url('biblioteca/show')}}" class="mx-auto text-center p-0">
                                <i class="fas fa-book-reader text-secondary "></i>
                                <span class="d-flex flex-column text_item_footer {{ request()->is(['biblioteca/*']) ? 'text-info_' : 'text-dark' }}">Biblioteca</span>
                                <div class="linea-icon  {{  request()->is('biblioteca/*') ? 'bgz-info' : 'text-muted' }}"></div>
                            </a>
                        </div>
                        <div class="col-3 align-self-center d-flex flex-column  text-center">
                            <a href="{{url('empoderate')}}" class="m-auto text-center p-0">
                               <i class="fa-solid fa-hands-holding-circle text-muted "></i> 
                               <span class="d-flex flex-column text_item_footer ">Empoderate</span>
                               <div class="linea-icon  {{  request()->is(['empoderate*']) ? 'bgz-info' : 'text-muted' }}"></div> 
                            </a>
                        </div>
                    </div>
                </footer> 
            @endmovil
        @else
            @movil
                <footer class="main-footer_ p-0  text-center m-auto" >
                    <div class="row text-center mt-2">
                        <div class="col  align-self-center d-flex flex-column">
                            <a href="/" class="mx-auto text-center p-0 text-muted">
                               <i class="fa fa-home text-muted"></i>
                               <span class="d-flex flex-column text_item_footer  ">Home</span>
                               <div class="linea-icon  {{ Route::is('home') ? 'bgz-info' : '' }}"></div> 
                            </a>
                        </div>
                        <div class="col align-self-center d-flex flex-column"> 
                            <a href="{{url('coinsult')}}" class="mx-auto text-center p-0">
                               <span class="ml-1  text-center mb-5">
                                    <img src="{{asset('img/icon-coins-gris.png')}}" style="width: 18px; margin-top: -4px;" class="p-0 " alt="icon-coins">
                               </span> 
                               <span class="d-flex flex-column text_item_footer ">Coinsults</span>
                               <div class="linea-icon {{ Route::is('coinsult.index') ? 'bgz-info' : '' }}"></div> 
                            </a>
                        </div>
                        <div class="col  align-self-center d-flex flex-column">
                            <a href="{{url('gestion/articulo_user')}}" class="mx-auto text-center p-0">
                               <i class="fas fa-fw fa-bookmark text-muted"></i>
                               <span class="d-flex flex-column text_item_footer ">Guardados</span>
                               <div class="linea-icon {{ request()->is(['gestion/articulo_user*','gestion/search_user_art*']) ? 'bgz-info' : ' ' }}"></div> 
                            </a>
                        </div>
                        <div class="col  align-self-center d-flex flex-column">
                            <a href="{{url('biblioteca/show')}}" class="mx-auto text-center p-0">
                               <i class="fas fa-book-reader text-secondary "></i>
                               <span class="d-flex flex-column text_item_footer">Biblioteca</span>
                               <div class="linea-icon {{ request()->is(['biblioteca/*']) ? 'bgz-info' : '' }}"></div> 
                            </a>
                        </div>
                        @if(Auth::user()->type_user()!='dr')
                            <div class="col-3 align-self-center d-flex flex-column ">
                                <a href="#" class="mx-auto text-center p-0">
                                   <i class="fas fa-hand-holding-medical text-muted"></i>
                                   <span class="d-flex flex-column text_item_footer ">Empoderate</span>
                                   <div class="linea-icon"></div> 
                                </a>
                           </div>
                        @endif

                    </div>
                </footer> 
            @endmovil
        @endguest
    @stop
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
   
@stop
