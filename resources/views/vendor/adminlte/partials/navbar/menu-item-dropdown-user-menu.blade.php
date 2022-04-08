@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.usermenu_profile_url', false))
    @php( $profile_url = Auth::user()->adminlte_profile_url() )
@endif

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif
{{-- <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#"> 
       <i class="far fa-comment"></i>
        <span class="badge badge-danger navbar-badge">0</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Hola como podemos ayudarte.</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          
        </a>
        
        
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
</li> --}}
<li class="nav-item dropdown">
    <a class="nav-link mr-1" data-toggle="dropdown" href="#" onclick="notyfyEstado()">
        <i class="far fa-bell "></i>
        @if(Auth::user()->notify()['count_notify']!=0)
            <span class="badge badge-danger navbar-badge" id="badgeNoty">{{Auth::user()->notify()['count_notify']}}</span>
        @endif
       
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
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
<li class=" ">
    <div class="user-block">
        @if(config('adminlte.usermenu_image'))
        <a href="{{ $profile_url }}"> 
            <img class="img-circle  direct-chat-img" src="{{asset(Auth::user()->adminlte_image())}}" alt="{{ Auth::user()->name }}">
        </a>
        @endif
        <span id="usernamePerfil" class="username" @if(config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
          <a href="{{ $profile_url }}" class="text-dark"> {{ Str::limit(Auth::user()->name, 20)}} </a> 
        </span>
        <span class="description" id="description" > {{ Auth::user()->adminlte_desc() }}</span>
    </div>
</li>
<li class="nav-item dropdown" style="margin-top: 8px;">
    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2" >
        <a class="dropdown-item   btn-block text-info_"
           href="#" onclick="openInfoTermiCondiciones()">
         {{--   <i class="far fa-closed-captioning"></i> --}}
            Términos & Condiciones
        </a>
         <a class="dropdown-item   btn-block text-info_"
           href="#" onclick="logout_session()">
         {{--   <i class="far fa-closed-captioning"></i> --}}
            Cerrar sesión
        </a>
       
        
        <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
            @if(config('adminlte.logout_method'))
                {{ method_field(config('adminlte.logout_method')) }}
            @endif
            {{ csrf_field() }}
        </form>
    </div>
</li>
