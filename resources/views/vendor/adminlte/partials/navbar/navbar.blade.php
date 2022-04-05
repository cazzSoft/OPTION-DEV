
 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white p-0  ">
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
          {{-- User menu link --}}
          @if(Auth::user())
            <li class="nav-item">
              <a  class=" btn bgz-info text-light btn-sm text-right mt-1 bt_coins " style="width:auto;">{{Auth::user()->coins() }} <i class="fas fa-coins"></i> </a>
            </li>

              @if(config('adminlte.usermenu_enabled'))
                  @include('adminlte::partials.navbar.menu-item-dropdown-user-menu') 
              @else
                  @include('adminlte::partials.navbar.menu-item-logout-link')
              @endif
          @else
               <li class="mr-2  p-0 item-nav">
                  <p class="text-info">¿Listo para tomar el control de tu salud y de los demás? INGRESA AQUÍ</p>
               </li>
               <li class=" bgz-info mr-2" >
                 <a class="btn  text-light  border-0 text-center btn-flat "   href="session"> <span>Registrate</span> </a>
               </li>
           
          @endif
        </ul>
    </div>
  </nav>
  