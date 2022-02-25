
<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white d-none"  style="height: 79px;" >
  
    <a href="/" class="navbar-brand ml-4">
      <img src="/img/logo2.svg" alt="o2hLogo" class="profile-user-img border-0 " >
      <span class="brand-text font-weight-light">Option2health</span>
    </a>

    <button class="navbar-toggler  px-0 mb-5 form-inline ml-0 ml-md-3" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3 ml-4" id="navbarCollapse">
     {{-- @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler') --}}
        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')
        {{-- Custom left links --}}
        {{-- @yield('content_top_nav_left') --}}
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
             <a class="nav-link btn btn-info text-light"  href="session"> Registrate</a>
           </li>
        </div>
      @endif
    </ul>
 
</nav>
 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white p-0">
    <div class=" container-fluid mr-4 ml-4">
        <a href="/" class="navbar-brand">
           <img src="/img/logo2.svg" alt="o2hLogo" class="profile-user-img border-0 img-fluid" >
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3 " id="navbarCollapse">
         
          <!-- SEARCH FORM -->
          {{-- @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item') --}}
          <form class="form-inline ml-0 ml-md-3" id="form_searc_general" >
            {{ csrf_field() }}
            <div class="input-group input-group-lg" data-toggle="dropdown">
              <div class="input-group-append">
                <button class="btn btn-navbar  btn-search" type="button" id="btn_submit_search">
                  <i class="fas fa-search"></i>
                </button>
              </div>
              <input class="form-control form-control-navbar search dropdown" id="inputSearch_" {{--  onkeypress="obtenerResulSearch()" --}} type="search" placeholder="Search option2health" aria-label="Search" autocomplete="of">
              
              <div class="dropdown-menu dropdown-menu-lgz dropdown-menu-right {{--  pre-scrollable --}}" id="dropdown-menu1">
               
               {{--  <span  class="dropdown-item2">
                  <div class="media">
                    <div class="media-body">
                      <dl>
                        <dd class="dropdown-item-title  text-muted">Médicos <span class="float-right text-sm text-info"><i class="fa fa-user-md"></i></span></dd>
                        <a href="gestion/resul" class="text-dark dropdown-item"><dt>Dr. O2H</dt></a>
                        <a href="" class="text-dark"><dt>Dr. O2H</dt></a>
                      </dl>
                    </div>
                  </div>
                </span> --}}

                {{-- <a href="#" class="dropdown-item2">
                  <div class="media">
                    <div class="media-body">
                      <h3 class="dropdown-item-title text-muted mt-1">
                        Publicaciones
                        <span class="float-right text-sm text-info"><i class="fab fa-bandcamp"></i></span>
                      </h3>
                      <span class="text-sm ml-1"><b>Cancer de piel</b></span><br>
                      <span class="text-sm ml-1"><b>Cancer de mama</b></span>
                    </div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="media">
                    <div class="media-body">
                      
                      <h3 class="dropdown-item-title text-muted mt-1">
                        Productos o Servicios
                        <span class="float-right text-sm text-info"><i class="fas fa-capsules"></i></span>
                      </h3>
                      <span class="text-sm ml-1"><b>Seguro de vida Can</b></span><br>
                      <span class="text-sm ml-1"><b>Farmacias Canhouse</b></span>
                    </div>
                  </div>
                </a> --}}
                {{-- <div class="dropdown-divider">dd</div> --}}
                 
                 {{-- <a href="#" class="dropdown-item dropdown-footer text-left p-2 text-info"><i class="fa fa-search bgz-info p-2 img-circle img-bordered-xs" ></i> Buscar <span id="buscar_txt"></span></a> --}}
              </div>
            </div>
          </form>
          
        </div>

        
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto mr-4">
          

          {{-- User menu link --}}
          @if(Auth::user())
            <li class="nav-item">
              <a href=""  class="mt-2 btn bgz-info  text-light btn-sm ">10.000 <i class="fas fa-coins"></i> </a>
            </li>

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
                 <a class="nav-link btn btn-info text-light"  href="session"> Registrate</a>
               </li>
            </div>
          @endif
        </ul>
    </div>
  </nav>
  
  <!-- /.navbar -->