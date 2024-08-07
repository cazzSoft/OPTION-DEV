@movil
    @php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
    @if (config('adminlte.use_route_url', false))
        @php( $logout_url = $logout_url ? route($logout_url) : '' )
    @else
        @php( $logout_url = $logout_url ? url($logout_url) : '' )
    @endif

    <aside class="main-sidebar main-sidebar-app  d-none mt-2  elevation-2  {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}" >
        <span  class=" bg-white ribbon text-center d-none" data-widget="pushmenu" id="dropdownMenuLink" >
            <i class="fas fa-angle-left fa-lg text-info_ mt-1 mr-1 ml-1"></i>
        </span>
       
        {{-- Sidebar brand logo --}}
        @if(config('adminlte.logo_img_xl'))
            @include('adminlte::partials.common.brand-logo-xl')
        @else
            @include('adminlte::partials.common.brand-logo-xs')
        @endif

        {{-- Sidebar menu --}}
        <div class="sidebar " >
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column nav-sidebar-app {{ config('adminlte.classes_sidebar_nav', '') }}"
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
                <ul class="nav nav-pills nav-sidebar flex-column mb-4 d-none footer_sidebar" style="position:fixed; bottom: 0; height:auto; width:auto;">
                    <li class="nav-item ml-3">
                        <span class="text-muted"> Idioma</span>
                        <a href="#" class="ml-2 @if(Session::get('language')=='es') text-info_ @endif "><b>Es</b></a>
                        <a href="#" class="ml-2 @if(Session::get('language')=='en') text-info_ @endif"><b>En</b></a>
                        <div class="p2 mt-5 text-muted">
                            <a href="{{url('nosotros')}}" class="text-pie-app text-muted d-block">ACERCA DE NOSOTROS </a>
                            <a href="{{url('info-coinsults')}}" class="text-pie-app text-muted d-block">COINSULTS </a>
                            <a href="#" onclick="openInfoTermiCondiciones()" class="text-pie-app text-muted d-block">TÉRMINOS Y CONDICIONES </a>
                            @auth
                                @if(Auth::user()->type_user()=='dr')
                                    <a href="{{url('horario/gestion')}}"  class="text-pie-app text-muted d-block">CONFIGURACIONES </a>
                                @endif
                            @endauth
                            @auth  
                                <a href="#" onclick="logout_session()" class=" text-muted d-block mt-3 logut-btn d-none">Cerrar sesión </a> 
                            @endauth                    
                        </div>

                        <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                            @if(config('adminlte.logout_method'))
                                {{ method_field(config('adminlte.logout_method')) }}
                            @endif
                            {{ csrf_field() }}
                        </form> 
                    </li>
                </ul>

            </nav>
        
        </div>
    </aside>
@else

    <aside class="main-sidebar main-sidebar_ sidebar-light-info sidebar_  {{-- {{ config('adminlte.classes_sidebar', 'sidebar-light-info') }} --}}">

        @if(config('adminlte.logo_img_xl'))
            @include('adminlte::partials.common.brand-logo-xl')
        @else
            @include('adminlte::partials.common.brand-logo-xs')
        @endif

   
        <div class="sidebar_2 sidebar m-0">
            <nav class="ml-1 mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column nav-sidebar-lg {{ config('adminlte.classes_sidebar_nav', '') }}"
                    data-widget="treeview" role="menu"
                    @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                        data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                    @endif
                    @if(!config('adminlte.sidebar_nav_accordion'))
                        data-accordion="false"
                    @endif>
                   
                    @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
                </ul>
            </nav>
        </div>

    </aside>


@endmovil


