
 
@movil 
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
                  <span class="fa "> <img src="{{asset('img/icon-coins-gris.png')}}" class="" style="width: 24px;"  class="p-0 " alt="icon-coins"> </span>
                  <span class="badge  navbar-badge  badge-info" >{{Auth::user()->coins() }}</span>
              </li>
              <li class="nav-link p-0 mt-1 ml-0 mr-0 item_noti">
                  <a class="nav-link dropdown p-0 mt-2" data-toggle="dropdown" href="#" onclick="notyfyEstado_app()">
                      <i class="far fa-bell fa-lg text-gray"></i>
                      @if(Auth::user()->notify()['count_notify']!=0)
                          <span class="badge badge-danger navbar-badge" id="badgeNoty_app">{{Auth::user()->notify()['count_notify']}}</span>
                      @endif
                     
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right dropdown-menu-notify">
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
@else
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white p-0  navbar_lg shadow-sm">
    <div class=" container-fluid ml-5">
      <a href="/" class="navbar-brand">
        <img src="/img/logo2.svg" alt="o2hLogo" class="profile-user-img border-0 img-fluid" id="imaLogo">
      </a>
      <button class="navbar-toggler btn-lg  btn-flat btn-default btn_icon " style="border-radius:500px; height: 42px; margin-left: -34px;" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
        <span class="fas fa-search "></span>
      </button>
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
            <li class=" mt-2 text-right">
              <div class="d-inline  bgz-info text-white bt_coins btn text-center" style="margin-top: -111px;">
                <span class="">{{Auth::user()->coins() }} </span>
                <span class="ml-1">
                  <img src="{{asset('img/icon-coins.png')}}" style="width: 20%;margin-top: -6px;" class="p-0" alt="icon-coins">
                </span>
              </div>
            </li>

              @if(config('adminlte.usermenu_enabled'))
                  @include('adminlte::partials.navbar.menu-item-dropdown-user-menu') 
              @else
                  @include('adminlte::partials.navbar.menu-item-logout-link')
              @endif
          @else
               <li class=" item-nav m-auto"> 
                  <p class="mt-1 text-register">¿Listo para tomar el control de tu salud y de tu Familia? <span class="text-info_">INGRESA AQUÍ</span></p>
               </li>
               <li class="item-nav" >
                 <a class="btn ml-3 text-light  border-0 text-center btn-registrate "   href="session"> <span>Registrate</span> </a>
               </li>
               {{-- <ul class="order-1 order-md-4  navbar-nav navbar-no-expand ml-auto "> --}}
                   <li class="item-nav" >
                       <div class="d-flex flex-row-reverse ml-0  mr-2 idioma">
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