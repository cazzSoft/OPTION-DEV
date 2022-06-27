@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@movil
    @auth

        @if (config('adminlte.usermenu_profile_url', false))
            @php( $profile_url = Auth::user()->adminlte_profile_url() )
        @endif
        <div class="user-block user_block mb-5 ">
            @if(config('adminlte.usermenu_image'))
            <a href="{{ url($profile_url) }}"> 
                <img class="img-circle direct-chat-img img_user_perfil_app" src="{{Auth::user()->adminlte_image()}}" alt="{{ Auth::user()->name }}">
            </a>
            @endif
            <span id="usernamePerfil" class="username" @if(config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
              <a href="{{ url($profile_url) }}" class="text-dark"> {{ Str::limit(Auth::user()->name, 20)}} </a> 
            </span>
            <span class="description" id="description" > {{ Auth::user()->adminlte_desc() }}</span>
        </div>

    @else
        <div class="ml-3 mt-3">
            <p class="text-new-user"> New  User</p>
            <div class="user-block">
                <a class="btn  btn-sm btn-registrate-app text-light text-center m-auto" href="session">Registrarse</a>
               
            </div>
        </div>
    @endauth

@else
    
    <a href=""  class="navbar-brand ">

        <img src="{{asset('/img/logo2.svg')}}"
             alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
             class="ml-4 mt-2"
            id="imaLogo2">

    </a>

@endmovil
