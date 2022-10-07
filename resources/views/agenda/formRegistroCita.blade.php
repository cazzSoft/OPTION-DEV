@extends('homeOption2h')
@section('title','Calendario')

@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)
{{-- cuerpo de la pagina --}}
@section('contenido')
    <div class="row ">
	    <div class="col text-center  @movil @else mt-5  @endmovil">
	        <a href="{{url('/calendario')}}" class="text-leth float-left ">  <i class="fas fa-chevron-left  text-info_ fa-2x ml-1 mb-1 "></i></a>
	    </div>
    </div>

    <div class="row ">
      <div class="col-12  ">
        <form method="POST" action="{{ url('calendario') }}" enctype="multipart/form-data" id="formCita" autocomplete="off" >
          @csrf
           <input  type="hidden" name="_method" id="method_cita" value="POST">
          <div class="card border-0 shadow-none @movil @else p-4 @endmovil">
            <div class="card-header border-0">
              <p class="m-0 "> 
               <i class="fas fa-angle-down text-info_ mr-2 fa-lg"></i> 
                <span class="text-info_ text-mes text-capitalize">@if(isset($mes)) {{$mes}} @endif </span> 
                <span class="text-muted text-year ml-2">@if(isset($año)) {{$año}} @endif</span> 
                <span class="text-semana ml-5"> <i class="fas fa-angle-left fa-md"></i> Semana @if(isset($semana)) {{$semana}} @endif <i class="fas fa-angle-right fa-md"></i> </span>
              </p>
            </div>
            <div class="card-body">
              <!-- titulo -->
              <div class="form-group @movil @else pl-4 pr-4 @endmovil">
                <input type="text" class="form-control @error('img') is-invalid @enderror"   placeholder="Agregue un título" id="titulo" name="titulo" value="{{old('titulo')}}" required>
              </div>

              <!-- search user -->
              <div class="row @movil @else pl-4 pr-4 @endmovil">
                <div class="col-md-5 col-sm-6 ">
                  <div class="form-group dropdown show">
                    <div class="input-group input-group-sm" data-toggle="dropdown" aria-expanded="true" id="dropdownContent">
                      <input type="hidden"  id="idpaciente" name="idpaciente">
                      <input class="form-control form-control-navbar "  type="search" placeholder="Buscar paciente por nombre, apellido, télefono,  etc. " id="search-user"  >
                      <div class="input-group-append">
                        <button class="btn btn-navbar btn-search-user " type="b">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>

                    <div class="dropdown-menu dropdown-menu-cita   dropdown-menu-center " id="dropdownCita">
                    </div> 
                    
                  </div>  
                </div>
              </div>
              

              <!-- paciente name -->
              <div class="form-group @movil @else pl-4 pr-4 @endmovil">
                <input type="text" class="form-control " placeholder="Nombres" name="name" id="name" required>
              </div>

              <!-- numero celular -->
              <div class="form-group @movil @else pl-4 pr-4 @endmovil">
                <input type="text" maxlength="10" class="form-control " placeholder="Telefono" id="telefono" name="telefono" required >
              </div>

              <!-- Email -->
              <div class="form-group @movil @else pl-4 pr-4 @endmovil">
                <input type="email" class="form-control " placeholder="Email" id="email" name="email" required>
              </div>
             
              <div class="row @movil @else pl-4 pr-4 @endmovil">
                <div class="col-md-3 col-sm-6  ">
                  <!-- fecha -->
                  <div class="form-group ">
                    <input type="date" class="form-control " name="fecha" id="fecha"
                      @if(isset($fecha))
                        value="{{$fecha}}"
                      @else
                       value="{{old('fecha')}}"
                      @endif required>
                  </div>
                </div>
                <div class="col-md-2 col-sm-6  ">
                  <select class="form-control select2 " data-placeholder="Seleccione un horario" value="{{old('hora_inicio')}}" name="hora_inicio" >
                    <option></option>
                    <option @if($hora=='8:00')  selected  @endif value="08:00 09:00">08:00am - 09:00am</option>
                    <option @if($hora=='9:00')  selected  @endif value="09:00 10:00">09:00am - 10:00am</option>
                    <option @if($hora=='10:00') selected  @endif value="10:00 11:00">10:00am - 11:00am</option>
                    <option @if($hora=='11:00') selected  @endif value="11:00 12:00">11:00am - 12:00pm</option>
                    <option @if($hora=='12:00') selected  @endif value="12:00 13:00">12:00pm - 13:00pm</option>
                    <option @if($hora=='13:00') selected  @endif value="13:00 14:00">13:00pm - 14:00pm</option>
                    <option @if($hora=='14:00') selected  @endif value="14:00 15:00">14:00pm - 15:00pm</option>
                    <option @if($hora=='15:00') selected  @endif value="15:00 16:00">15:00pm - 16:00pm</option>
                    <option @if($hora=='16:00') selected  @endif value="16:00 17:00">16:00pm - 17:00pm</option>
                  </select>
                </div>
               
              </div>
              <div class="row  @movil mt-3 @else pl-4 pr-4 @endmovil">
                <div class="col-md-5 col-sm-6">
                  <select class="form-control select2" data-placeholder="Seleccione un tipo de cita" value="{{old('tipo_cita')}}" name="tipo_cita" >
                    <option></option>
                    <option value="virtual">Cita virtual</option>
                    <option value="precencial">Cita en consultorio</option>
                  </select>
                </div>
              </div>

              
              <!-- detalle de cita -->
              <div class="form-group mt-3 @movil @else pl-4 pr-4 @endmovil">
               <textarea class="form-control  @error('detalle') is-invalid @enderror"  rows="3" placeholder="Ej: soy una persona..."   name="detalle" id="detalle"   autofocus value="{{old('detalle')}}"></textarea>
              </div>
               
               <!-- botones -->
              <div class="form-group text-center mt-4 @movil @else pl-4 pr-4 @endmovil">
                <button type="button" class="btn btn-outline-dark mr-2 btn_cancelar @movil @else pl-5 pr-5 @endmovil btn-sm" >Cerrar</button>
                <button type="submit" class="btn btn-info @movil @else pl-5 pr-5 @endmovil  btn-sm">Guardar cita</button>
              </div> 
            </div>
            <!-- /.card-body -->
          </div> 
        </form> 
      </div>
    </div>

@stop

{{-- Seccion para insertar css--}}
@section('include_css') 
  <link rel="stylesheet" href="{{ asset('css/FormCitasRegistro.css') }}">
@stop 
 

{{-- Seccion para insertar js--}}
@section('include_js')
 
{{-- gestion js calendario --}}
  <script src="{{ asset('/js/gestionSaveAgenda.js') }}"></script>
@stop