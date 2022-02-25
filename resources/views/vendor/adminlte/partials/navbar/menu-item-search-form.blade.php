
  <form class="form-inline ml-3"  method="POST"  >
     {{ csrf_field() }}
    <div class="input-group input-group-lg dropd" data-toggle="dropdown">
      <div class="input-group-append" >
        <button class="btn btn-navbar btn-search" type="button" id="btn_submit_search" >
          <i class="fas fa-search"></i>
        </button>
      </div>
     {{--  <input class="form-control form-control-navbar search nav-item dropdown" type="search" placeholder="search option2health" aria-label="Search"  name="{{ $item['input_name'] }}"   placeholder="{{ $item['text'] }}" aria-label="{{ $item['aria-label'] ?? $item['text'] }}" autocomplete="of" data-toggle="dropdown"> --}}
     <input class="form-control form-control-navbar search  " type="search" placeholder="search option2health" {{-- aria-label="Search" --}}  name="q"  {{-- aria-label="{{ $item['aria-label'] ?? $item['text'] }}" --}}  id="inputSearch" onkeypress="obtenerResulSearch()"  >
      {{-- dropdown-menu-lg --}}
      <div class="dropdown-menu dropdown-menu-lgz dropdown-menu-right" id="dropdown-menu2">
        
        <a href="#" class="dropdown-item2">
          <!-- Message Start --> 
          <div class="media">
            <div class="media-body">
              <h3 class="dropdown-item-title text-muted">
                Médicos
                <span class="float-right text-sm text-info"><i class="fas fa-user-md"></i></span>
              </h3>
              <span class="text-sm ml-1"><b>Dr. O2H</b></span><br>
              <span class="text-sm ml-1"><b>Dr. Cazz</b></span>

              <h3 class="dropdown-item-title text-muted mt-1">
                Publicaciones
                <span class="float-right text-sm text-info"><i class="fab fa-bandcamp"></i></span>
              </h3>
              <span class="text-sm ml-1"><b>Cancer de piel</b></span><br>
              <span class="text-sm ml-1"><b>Cancer de mama</b></span>

              <h3 class="dropdown-item-title text-muted mt-1">
                Productos o Servicios
                <span class="float-right text-sm text-info"><i class="fas fa-capsules"></i></span>
              </h3>
              <span class="text-sm ml-1"><b>Seguro de vida Can</b></span><br>
              <span class="text-sm ml-1"><b>Farmacias Canhouse</b></span>

            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        
        {{-- <a href="#" class="dropdown-item dropdown-footer">See All Messages</a> --}}
      </div>
    </div>
  </form>

</script>