
<aside class="main-sidebar   mt-2  elevation-2 d-none  {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}" >
   
     <span  class=" bg-white ribbon text-center d-none" data-widget="pushmenu" id="dropdownMenuLink" ><i class="fas fa-angle-left fa-lg text-info_ mt-1 mr-1 ml-1"></i></span>
   
  
    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar " >
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
            
            <ul class="nav nav-pills nav-sidebar flex-column mb-4" style="position:fixed; bottom: 0; height:auto; width:219px;">
                <li class="nav-item ml-3">
                   <span class="text-muted"> Idioma</span>
                    <a href="#" class="ml-2 @if(Session::get('language')=='es') text-info_ @endif "><b>Es</b></a>
                    <a href="#" class="ml-2 @if(Session::get('language')=='en') text-info_ @endif"><b>En</b></a>

                    <div class="p2 mt-5 text-muted">
                        <a href="{{url('nosotros')}}" class=" text-muted d-block">ACERCA DE NOSOTROS </a>
                        @guest
                             <a href="{{url('info-coinsults')}}" class=" text-muted d-block">COINSULTS </a>
                        @else
                             <a href="{{url('coinsult')}}" class=" text-muted d-block">COINSULTS </a>
                        @endguest
                       
                        <a href="#" onclick="openInfoTermiCondiciones()" class=" text-muted d-block">TÉRMINOS Y CONDICIONES </a>
                        @auth  
                            <a href="#" onclick="logout_session()" class=" text-muted d-block mt-3 logut-btn d-none">Cerrar sesión </a> 
                        @endauth                    
                    </div>
                </li>
            </ul>

        </nav>
    
    </div>

</aside>

