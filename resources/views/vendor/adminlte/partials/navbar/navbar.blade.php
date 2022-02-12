
<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white "  style="height: 79px;" >
  
    <a href="/" class="navbar-brand ml-4">
      <img src="/img/logo2.svg" alt="o2hLogo" class="profile-user-img border-0 " >
      {{-- <span class="brand-text font-weight-light">Option2health</span> --}}
    </a>

    <button class="navbar-toggler  px-0 mb-5 form-inline ml-0 ml-md-3" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3 ml-4" id="navbarCollapse">
     @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')
        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')
        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </div>

      
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto mr-4">
     
      {{-- User menu link --}}
      @if(Auth::user())
          @if(config('adminlte.usermenu_enabled'))
              @include('adminlte::partials.navbar.menu-item-dropdown-user-menu') 
          @else
              @include('adminlte::partials.navbar.menu-item-logout-link')
          @endif
      @else
         <div class="collapse navbar-collapse order-3 ml-4" id="navbarCollapse">
           <li class="nav-item dropdown user-menu mr-5 mt-2">
              <p class="text-info">¿Listo para tomar el control de tu salud y de los demás? INGRESA AQUÍ</p>
           </li>
           <li class="nav-item dropdown user-menu mr-3">
             <a class="nav-link btn btn-info text-light"  href="/session"> Registrate</a>
           </li>
        </div>
      @endif
    </ul>
 
</nav>
