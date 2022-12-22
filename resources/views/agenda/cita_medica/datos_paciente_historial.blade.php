
  <div class="row  p-0 m-0 mt-3 " id="d_paciente_historial">
    <div class="col-md-6 col-sm-12 text-paciente">
      <dl class="row">
        <dt class="@movil col-5 @else col-md-4 col-sm-12 @endmovil">Nombres:</dt>
        <dd class="@movil col-7 @else col-md-8 col-sm-12 text-left @endmovil">
          <div class="form-group">
            <input type="text"  class="form-control form-control-sm shadow-sm border-white" onblur="obtener_datos_blur(this)"  name="name" placeholder="Ingrese nombre" value=" @if(asset($datos_p['name'])) {{$datos_p['name']}} @endif" requiered autocomplete="off">
          </div>
        </dd>
        <dt class=" @movil col-5 @else col-md-4 col-xs-12 @endmovil">Género:</dt>
        <dd class=" @movil col-7 @else col-md-8 col-sm-12 text-left  @endmovil">
          <div class="form-group">
            <select class="form-control select2 form-control-sm" onchange="obtener_datos_change(this)" name="genero" data-placeholder="Seleccione genero" style="width: 100%;" id="genero_h"  >
                <option @if(asset($datos_p['genero'])==1) selected="selected" @endif  value="1">Masculino</option>
                <option @if(asset($datos_p['genero'])==0) selected="selected" @endif value="0">Femenino</option>
                <option @if(asset($datos_p['genero'])==2) selected="selected" @endif value="2">No lo quiero decir</option> 
            </select>
          </div>
        </dd>
        <dt class=" @movil col-5 @else col-md-4 col-xs-12 @endmovil">CI o Pasaporte:</dt>
        <dd class="@movil col-7 @else col-md-8 col-sm-12  @endmovil">
          <div class="form-group">
            <input type="text"  class="form-control form-control-sm shadow-sm border-white" onblur="obtener_datos_blur(this)" name="cedula"placeholder="Ingrese cédula o pasaporte" value="@if(asset($datos_p['cedula'])) {{$datos_p['cedula']}} @endif" requiered>
          </div>
        </dd>

        <dt class=" @movil col-5 @else col-md-4 col-xs-12 @endmovil">Lugar de residencia:</dt>
        <dd class=" @movil col-7 @else col-md-8 col-sm-12  @endmovil">
           <div class="form-group">
             <input type="text" class="form-control form-control-sm shadow-sm border-white" onblur="obtener_datos_blur(this)" name="direccion" placeholder="Ingrese lugar de residencia" value=" @if(asset($datos_p['direccion'])) {{$datos_p['direccion']}} @endif" requiered>
           </div>
       </dd>

        <dt class=" @movil col-5 @else col-md-4 col-xs-12 @endmovil">Estado civil:</dt>
        <dd class=" @movil col-7 @else col-md-8 col-sm-12  @endmovil">
          <div class="form-group">
            <select class="form-control select2 form-control-sm" name="idestado_civil"  onchange="obtener_datos_change(this)" data-placeholder="Seleccione estado civil" style="width: 100%;"  id="idestado_civil_h" >
                <option ></option>
                @if(isset($lista_ecivil))
                  @foreach( $lista_ecivil as $e_item)
                    <option 
                      @if($datos_p['idestado_civil']==$e_item['idestado_civil']) selected @endif
                      value="{{$e_item['idestado_civil']}}">
                      {{$e_item['descripcion']}}
                    </option>
                  @endforeach
                @endif
            </select>
          </div>
        </dd>

        <dt class=" @movil col-5 @else col-md-4 col-xs-12 @endmovil">Nivel de instrucción:</dt>
        <dd class=" @movil col-7 @else col-md-8 col-sm-12  @endmovil">
          <div class="form-group">
            <select class="form-control select2 form-control-sm" name="idnivel_estudio" onchange="obtener_datos_change(this)" data-placeholder="Seleccione nivel de instruccion" style="width: 100%;"   id="idnivel_estudio_h">
              <option ></option>
              @if(isset($lista_nivel_e))
                @foreach( $lista_nivel_e as $nv_item)
                  <option 
                    @if($datos_p['idnivel_estudio']==$nv_item['idnivel_estudio']) selected @endif
                    value="{{$nv_item['idnivel_estudio']}}">
                    {{$nv_item['descripcion']}}
                  </option>
                @endforeach
              @endif
          </select>
          </div>
        </dd>

        <dt class=" @movil col-5 @else col-md-4 col-xs-12 @endmovil">Ocupación:</dt>
        <dd class=" @movil col-7 @else col-md-8 col-sm-12  @endmovil">
          <div class="form-group">
            <input type="text"    class="form-control form-control-sm shadow-sm border-white" onblur="obtener_datos_blur(this)" name="ocupacion" aria-describedby="ocupacion"placeholder="Ingrese aqui..." value="{{$datos_p['ocupacion']}}" requiered>
          </div>
         
        </dd>

        <dt class=" @movil col-5 @else col-md-4 col-xs-12 @endmovil">Religión:</dt> 
        <dd class=" @movil col-7 @else col-md-8 col-sm-12  @endmovil"> 
          <div class="form-group"> 
            <select class="form-control select2 form-control-sm" onchange="obtener_datos_change(this)" name="idreligion" data-placeholder="Seleccione una religión" style="width: 100%;"  id="idreligion_h">
              <option ></option>
             @if(isset($lista_religion))
                @foreach( $lista_religion as $reli)
                  <option 
                    @if($datos_p['idreligion']==$reli['idreligion']) selected @endif
                    value="{{$reli['idreligion']}}">
                    {{$reli['descripcion']}}
                  </option>
                @endforeach
              @endif
            </select> 
        </dd>

        <dt class=" @movil col-5 @else col-md-4 col-xs-12 @endmovil">Raza:</dt>
        <dd class=" @movil col-7 @else col-md-8 col-sm-12  @endmovil">
          <div class="form-group ">
            <select class="form-control select2 form-control-sm" onchange="obtener_datos_change(this)" style="width: 100%;"   name="idraza">
              @if(isset($lista_raza))
                 @foreach( $lista_raza as $raza)
                   <option 
                     @if($datos_p['idraza']==$raza['idraza']) selected @endif
                     value="{{$raza['idraza']}}">
                     {{$raza['descripcion']}}
                   </option>
                 @endforeach
               @endif    
            </select> 
          </div>
          
        </dd>
        
      </dl>
    </div>
    <div class="col-md-6 col-sm-12 text-paciente">
      <dl class="row">
        <dt class="@movil col-5 @else col-sm-3 col-xs-12 @endmovil">Apellidos:</dt>
        <dd class="@movil col-7 @else col-md-8 col-sm-12  @endmovil">
          <div class="form-group">
             <input type="text"  class="form-control form-control-sm shadow-sm border-white" onblur="obtener_datos_blur(this)" name="apellido" placeholder="Ingrese apellidos" value=" @if(asset($datos_p['apellido'])) {{$datos_p['apellido']}} @endif" requiered>
          </div>
        </dd>
        <dt class="@movil col-5 @else col-sm-3 col-xs-12 @endmovil">Edad:</dt>
        <dd class="@movil col-7 @else col-md-8 col-sm-12  @endmovil">
          <div class="form-group">
            <span class="edad">{{ \Carbon\Carbon::parse($datos_p->fecha_nacimiento)->age}} años</span>
          </div>
        </dd>

        <dt class="@movil col-5 @else col-sm-3 col-xs-12 @endmovil">Sexo:</dt>
        <dd class="@movil col-7 @else col-md-8 col-sm-12  @endmovil">
          <div class="form-group">
            <select class="form-control select2 form-control-sm" onchange="obtener_datos_change(this)"  data-placeholder="Seleccione sexo" style="width: 100%;"  name="sexo">
              <option></option>
              <option @if($datos_p['sexo']==1) selected="selected" @endif value="1">Hombre</option>
              <option @if($datos_p['sexo']==0) selected="selected" @endif value="0">Mujer</option> 
            </select>
          </div>
        </dd>

        <dt class="@movil col-5 @else col-sm-3 col-xs-12 @endmovil">Fecha de nacimiento::</dt>
        <dd class="@movil col-7 @else col-md-8 col-sm-12  @endmovil">
          <div class="form-group">
            <input type="date"  class="form-control form-control-sm" name="fecha_nacimiento" onchange="obtener_datos_change(this)" value="{{$datos_p->fecha_nacimiento}}" requiered>
          </div>
        </dd>
      </dl>
    </div>
  </div>

  

  

