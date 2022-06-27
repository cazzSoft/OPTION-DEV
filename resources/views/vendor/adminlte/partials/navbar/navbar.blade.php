
 
@movil 
  @if(!request()->is(['session','log-in-medico','log-in-paciente']))
    <nav class="main-header navbar  navbar-expand   navbar-white navbar_sm shadow-sm"> 
      <ul class="navbar-nav float-left">
          @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')
      </ul>
      <div class="d-flex  justify-content-end">
        <div class="p-1">
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item mt-1 p-0">
              <form class="form-inline ml-0 ml-md-3 item_input float-left d-none" id="form_searc_general_app">
                {{ csrf_field() }}  
                <input type="hidden" id="tpch_app" value="@if(Auth::user()) 1 @else 0 @endif">
                <div class="input-group input-group-sm " data-toggle="dropdown">
                   <input class="form-control form-control-navbar search_app dropdown" id="inputSearch_app" placeholder="Search Option2health" type="search" placeholder="Search" aria-label="Search" autocomplete="of">
                   <div class="input-group-append p-0 btn_icon_search">
                     <button class="btn btn-navbar btn_search_in" type="button"  data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
                       <i class="fas fa-search"></i>
                     </button>
                   </div> 
                </div>
                <div class="dropdown-menu dropdown-menu-lgz dropdown-menu-right " id="dropdown-menu1_app">
                </div>
              </form> 
              <button class="btn btn-default text-center  btn_search m-auto btn_search_in"  type="button" >
                 <i class="fas fa-search fa-sm"></i>
              </button> 
            </li>
            @if(Auth::user())
              <li class="nav-link mr-0 text-right item_coins">
                <a href="{{url('coinsult')}}">
                  <span class="fa "> <img src="{{asset('img/icon-coins-gris.png')}}" class="" style="width: 24px;"  class="p-0 " alt="icon-coins"> </span>
                  <span class="badge  navbar-badge  badge-info idcoins" >{{Auth::user()->coins() }}</span>
                </a>
              </li>
              <li class="nav-link p-0 mt-1 ml-0 mr-0 item_noti">
                  <a class="nav-link dropdown p-0 mt-2" data-toggle="dropdown" href="#" onclick="notyfyEstado()">
                      <i class="far fa-bell fa-lg text-gray"></i>
                      @if(Auth::user()->notify()['count_notify']!=0)
                        <span class="badge badge-danger navbar-badge" id="badgeNoty"> {{Auth::user()->notify()['count_notify']}} </span>
                      @else
                        <span class="badge badge-danger navbar-badge d-none" id="badgeNoty">  </span>
                      @endif
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right dropdown-menu-notify" id="listNotify">
                      <span class="dropdown-header">{{-- {{Auth::user()->notify()['count_notify']}}  --}}Notificaciones</span>
                      @if(isset(Auth::user()->notify()['listaNotify']))
                          @foreach(Auth::user()->notify()['listaNotify'] as $item)
                              <div class="dropdown-divider"></div>
                              <a href="{{asset($item['detalle_notificacion'][0]['url'])}}" class="dropdown-item2 text-dark " onclick="notify('{{ $item['detalle_notificacion'][0]['code']}}')"> 
                                <i class="{{$item['detalle_notificacion'][0]['icon']}} mr-2 text-warning"></i> {{$item['detalle_notificacion'][0]['descripcion']}}
                                <span class="float-right text-muted text-sm">{{ $item['created_at']->isoFormat('l') }}</span>
                              </a>
                          @endforeach
                      @endif
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
                  </div>
                  
              </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>
  @endif
@else
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white p-0  navbar_lg ">
    <div class=" container-fluid ml-0">
      {{-- Left sidebar toggler link --}}
      @if(request()->is(['session','log-in-medico','log-in-paciente','password_reset','password_reset*','profile/perfil','medico/info*','medico/perfil']) )
        <a href="/"  class="navbar-brand2 ">
            <img src="{{asset('/img/logo2.svg')}}"
                 alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
                 class="ml-4 mt-2"
                id="imaLogo2">
        </a>
      @else
        <a class="nav-link text-dark " data-widget="pushmenu" style="cursor: pointer;" 
            @if(config('adminlte.sidebar_collapse_remember'))
                data-enable-remember="true"
            @endif
            @if(!config('adminlte.sidebar_collapse_remember_no_transition'))
                data-no-transition-after-reload="false"
            @endif
            @if(config('adminlte.sidebar_collapse_auto_size'))
                data-auto-collapse-size="{{ config('adminlte.sidebar_collapse_auto_size') }}"
            @endif>
            <i class="fas fa-bars"></i>
        </a>
      @endif
     
      
      <div class="collapse navbar-collapse order-3  mb-3 mt-1 " id="navbarCollapse">
        <form class="ml-0 ml-md-3" id="form_searc_general" >
          {{ csrf_field() }}  
          <input type="hidden" id="tpch" value="@if(Auth::user()) 1 @else 0 @endif">
          <div class="input-group input-group-lg dropdown mt-2" data-toggle="dropdown">
            <div class="input-group-append">
              <button class="btn btn-navbar  btn-search" type="button" id="btn_submit_search">
                <i class="fas fa-search"></i>
              </button>
            </div>
            <input class="form-control form-control-navbar search dropdown " id="inputSearch_" type="search" placeholder="Search Option2health" aria-label="Search" autocomplete="of">
            <div class="dropdown-menu dropdown-menu-lgz dropdown-menu-right " id="dropdown-menu1">
            </div>
          </div>
        </form>
      </div>
        <ul class="order-1 order-md-4  navbar-nav navbar-no-expand ml-auto ">
         
          @if(Auth::user())
            <li class="nav-item  {{-- text-right  --}} m-auto2 mt-2 text-right">
               <a href="{{url('coinsult')}}" class="" >
                <div class="d-inline shadow-sm bt_coins btn text-light text-center" {{-- style="margin-top: -111px;" --}}>
                  <span class="idcoins">{{Auth::user()->coins() }} </span>
                  <span class="ml-1 mr-0">
                    <img src="{{asset('img/icon-coins.png')}}" style="width: 20%;margin-top: -6px;" class="p-0" alt="icon-coins">
                  </span>
                </div>
              </a>
            </li>

              @if(config('adminlte.usermenu_enabled'))
                  @include('adminlte::partials.navbar.menu-item-dropdown-user-menu') 
              @else
                  @include('adminlte::partials.navbar.menu-item-logout-link')
              @endif
          @else
              @if( !request()->is(['session','log-in-medico','log-in-paciente','password_reset/*']))
    
               <li class=" item-nav m-auto "> 
                  <p class="mt-2 text-register ">¿Listo para tomar el control de tu salud y de tu Familia? <span class="text-info_">INGRESA AQUÍ</span></p>
               </li>
               <li class="item-nav  " >
                 <a class="btn ml-2 mr-0 text-light  border-0 text-center btn-registrate "   href="session"> <span>Regístrate</span> </a>
               </li>
              @endif
               {{-- <ul class="order-1 order-md-4  navbar-nav navbar-no-expand ml-auto "> --}}
                   <li class="item-nav " >
                       <div class="d-flex flex-row-reverse ml-0  mr-3 idioma">
                           <div class="p-0">
                                <form method="POST" action="{{url('lang')}}" id="form-language">
                                    {{ csrf_field() }}
                                    <select  class="form-control form-control-sm  d-inline  lead border-0"  name="language" id="language" >
                                       <option @if(Session::get('language')=='es') selected @endif value="es"> ES</option>
                                       <option @if(Session::get('language')=='en') selected @endif value="en"> EN</option>
                                   </select>
                                </form>
                           </div>
                           <div class="p-0 lead text-mutex"> {{trans('informacion-view.Language') }}</div>
                       </div>

                  </li>
               {{-- </ul> --}}
          @endif
        </ul>
    </div>
  </nav>
@endmovil