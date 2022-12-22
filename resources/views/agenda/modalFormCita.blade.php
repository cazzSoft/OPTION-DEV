<div class="modal fade" data-backdrop="true"  role="dialog" id="modal-form-cita" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md  modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-header bg-info p-2"> 
        <h5 class="modal-title m-auto text-center ml-5"> 
          <b class="">Nuevo evento</b>
        </h5>
        <span type="button" class="close2 text-white cerrar-form" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle text-white fa-lg"></i>
        </span>
        <span class="spinner-border d-none efect-cerrar" role="status" aria-hidden="true"></span>
      </div>
     
      <div class="modal-body border-info">
        <div class="card-body box-profile p-0">
          <div class="atenuar-modal-form "></div>
          <div class="row ">
            <div class="col-12  ">
              <form method="POST" action="{{ url('calendario') }}" enctype="multipart/form-data" id="formCita" autocomplete="off" >
                {!! csrf_field()!!}
                <input type="hidden" name="_method" id="method_cita" value="POST">
                <input type="hidden" name="iden" id="iden" value="{{ encrypt(Auth::user()->type_user()) }}">
                <input type="hidden" id="idcita">
                <!-- titulo -->
                <div class="form-group @movil @else pl-4 pr-4 @endmovil">
                  <input type="text" class="form-control"   placeholder="Agregue un título" id="titulo" name="titulo" value=""  >
                </div>

                <div class="row @movil @else pl-4 pr-4 @endmovil">
                  <div class="col-sm-6  col-sm-12">
                    <!-- fecha text-->
                    <div class="form-group " id="fecha_text">
                    </div>  
                  </div>
                  <div class=" col-sm-6 col-sm-12">
                     <!-- hora text-->
                    <small class=" border border-white" id="hora_select">{{date('h:m:A')}} - {{date('h:m:A')}} </small>
                  </div>
                  <div class="col-sm-6 col-sm-12">
                    <div class="form-group fecha d-none" >
                      <input type="date" class="form-control" id="fecha" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group hora d-none2" >
                      <select class="form-control select2 " data-placeholder="Seleccione un horario" value="" name="hora" id="hora"  >
                        <option></option>
                        @if(isset($horario_cita))
                          @foreach($horario_cita as $key=>$item)
                            <option  value="{{$item['valor_h']}}">{{$item['text_h']}}</option>
                          @endforeach
                        @endif
                      </select>
                     {{--  <input type="hidden" class="form-control" id="hora_inicio">
                      <input type="hidden" class="form-control" id="hora_fin"> --}}
                    </div>
                  </div>
                  
                </div>


                <!-- search user -->
                <div class="row search-usuario @movil @else pl-4 pr-4 @endmovil">
                  <div class="col-12 ">
                    <div class="form-group dropdown show">
                      <div class="input-group input-group-sm" data-toggle="dropdown" aria-expanded="true" id="dropdownContent">
                        <input type="hidden"  id="idpaciente" name="idpaciente">
                        <input class="form-control form-control-navbar rounded-left"  type="search" placeholder="Buscar paciente por nombre, apellido, télefono,  etc. " id="search-user"  >
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
                  <input type="text" class="form-control " placeholder="Nombre del Paciente" name="name" id="name" required autocomplete="off" readonly>
                </div>

                <!-- numero celular -->
                <div class="form-group @movil @else pl-4 pr-4 @endmovil">
                  <input type="text" maxlength="10" class="form-control " placeholder="Número de teléfono del paciente" id="telefono" name="telefono" required readonly>
                </div>

                <!-- Email -->
                <div class="form-group @movil @else pl-4 pr-4 @endmovil">
                  <input type="email" class="form-control " placeholder="E-mail del paciente" id="email" name="email" required readonly>
                </div>
          
                <div class="row  @movil mt-3 @else pl-4 pr-4 @endmovil">
                  <div class="col-12 ">
                    <select class="form-control select2" data-placeholder="Agregar canal" value="{{old('tipo_cita')}}" id="tipo_cita" name="tipo_cita" >
                      <option></option>
                      <option value="virtual">Cita virtual</option>
                      <option value="precencial">Cita en consultorio</option>
                    </select>
                  </div>
                </div>

                
                <!-- detalle de cita -->
                <div class="form-group mt-3 @movil @else pl-4 pr-4 @endmovil">
                  <input type="text" class="form-control d-none" placeholder="Aguegue direccion" id="detalle" name="detalle" required>
                </div>
                 
                <!-- lugar de agendamiento -->
                <div class="row  @movil mt-3 @else pl-4 pr-4 @endmovil">
                  <div class="col-12 ">
                    <select class="form-control select2" data-placeholder="Seleccione lugar de reserva de la cita" value="{{old('idmedio_reserva')}}" id="idmedio_reserva" name="idmedio_reserva" required>
                      <option></option>
                      @if(isset($lista_medio))
                        @foreach($lista_medio as $item)
                          {{-- @if($item->codigo!='O2H')  --}}
                            <option  value="{{$item->idmedio_reserva}}">{{$item->descripcion}}</option>
                          {{-- @endif --}}
                          
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>

                 <!-- botones -->
                <div class="form-group text-center mt-4 @movil @else pl-4 pr-4 @endmovil">
                  <button type="submit" class="btn border-info mr-2 d-none @movil @else pl-5 pr-5 @endmovil  btn-sm" id="btn-cancelar-cita-form" data-dismiss="modal" aria-label="Close" >Cancelar</button>
                  <button type="submit" class="btn btn-info @movil @else pl-5 pr-5 @endmovil  btn-sm" id="btn-save-cita-form">Guardar cita</button>
                </div>  
              </form> 
            </div>
          </div>    
        </div>
      </div>
    </div>
  </div>
</div>

