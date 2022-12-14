
  <div class="row" id="d_paciente">
    <div class="col-6">
      <dl class="row">
        <dt class="col-sm-3">Nombres:</dt>
        <dd class="col-sm-8 text-left">
          <div class="form-group">
            <input type="hidden"  id="idp" value="{{encrypt($datos_p['id'])}}">
            <input type="text" name="name" onblur="obtener_datos_blur(this)" class="form-control form-control-sm shadow-sm border-white"  id="name" placeholder="Ingrese nombre" value=" @if(asset($datos_p['name'])) {{$datos_p['name']}} @endif" requiered autocomplete="off">
          </div>
        </dd>
        <dt class="col-sm-3">Género:</dt>
        <dd class="col-sm-8 text-left">
          <div class="form-group">
            <select class="form-control select2 form-control-sm" onchange="obtener_datos_change(this)" data-placeholder="Seleccione genero" style="width: 100%;" id="genero"  name="genero">
                <option @if(asset($datos_p['genero'])==1) selected="selected" @endif  value="1">Masculino</option>
                <option @if(asset($datos_p['genero'])==0) selected="selected" @endif value="0">Femenino</option>
                <option @if(asset($datos_p['genero'])==2) selected="selected" @endif value="2">No lo quiero decir</option> 
            </select>
          </div>
        </dd>
        <dt class="col-sm-3">CI o Pasaporte:</dt>
        <dd class="col-sm-8">
          <div class="form-group">
            <input type="text" name="cedula" onblur="obtener_datos_blur(this)" class="form-control form-control-sm shadow-sm border-white" id="cedula"placeholder="Ingrese cédula o pasaporte" value="@if(asset($datos_p['cedula'])) {{$datos_p['cedula']}} @endif" requiered>
          </div>
        </dd>

        <dt class="col-sm-3">Lugar de residencia:</dt>
        <dd class="col-sm-8">
           <div class="form-group">
             <input type="text" onblur="obtener_datos_blur(this)" name="direccion" class="form-control form-control-sm shadow-sm border-white" id="direccion"placeholder="Ingrese lugar de residencia" value=" @if(asset($datos_p['direccion'])) {{$datos_p['direccion']}} @endif" requiered>
           </div>
       </dd>

        <dt class="col-sm-3">Estado civil:</dt>
        <dd class="col-sm-8">
          <div class="form-group">
            <select class="form-control select2 form-control-sm" onchange="obtener_datos_change(this)" data-placeholder="Seleccione estado civil" style="width: 100%;"  name="idestado_civil" id="idestado_civil">
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

        <dt class="col-sm-3">Nivel de instrucción:</dt>
        <dd class="col-sm-8">
          <div class="form-group">
            <select class="form-control select2 form-control-sm" onchange="obtener_datos_change(this)" data-placeholder="Seleccione nivel de instruccion" style="width: 100%;"  name="idnivel_estudio" id="idnivel_estudio">
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

        <dt class="col-sm-3">Ocupación:</dt>
        <dd class="col-sm-8">
          <div class="form-group">
            <input type="text"  onblur="obtener_datos_blur(this)" name="ocupacion" class="form-control form-control-sm shadow-sm border-white" id="ocupacion" aria-describedby="emailHelp"placeholder="Ingrese aqui..." value="{{$datos_p['ocupacion']}}" requiered>
          </div>
         
        </dd>

        <dt class="col-sm-3">Religión:</dt> 
        <dd class="col-sm-8"> 
          <div class="form-group"> 
            <select class="form-control select2 form-control-sm" onchange="obtener_datos_change(this)" data-placeholder="Seleccione una religión" style="width: 100%;"  name="idreligion" id="idreligion">
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

        <dt class="col-sm-3">Raza:</dt>
        <dd class="col-sm-8">
          <div class="form-group ">
            <select class="form-control select2 form-control-sm" onchange="obtener_datos_change(this)" style="width: 100%;"  name="idraza" id="idraza">
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
    <div class="col-6">
      <dl class="row">
        <dt class="col-sm-4">Apellidos:</dt>
        <dd class="col-sm-8">
          <div class="form-group">
             <input type="text" onblur="obtener_datos_blur(this)" name="apellido" class="form-control form-control-sm shadow-sm border-white" id="apellido"placeholder="Ingrese apellidos" value=" @if(asset($datos_p['apellido'])) {{$datos_p['apellido']}} @endif" requiered>
           
          </div>
        </dd>
        <dt class="col-sm-4">Edad:</dt>
        <dd class="col-sm-8">
          <div class="form-group">
            <span class="edad">{{ \Carbon\Carbon::parse($datos_p->fecha_nacimiento)->age}} años</span>
          </div>
        </dd>

        <dt class="col-sm-4">Sexo:</dt>
        <dd class="col-sm-8">
          <div class="form-group">
            <select class="form-control select2 form-control-sm" onchange="obtener_datos_change(this)"  data-placeholder="Seleccione sexo" style="width: 100%;"  name="sexo" id="sexo">
              <option></option>
              <option @if($datos_p['sexo']==1) selected="selected" @endif value="1">Hombre</option>
              <option @if($datos_p['sexo']==0) selected="selected" @endif value="0">Mujer</option> 
            </select>
          </div>
        </dd>

        <dt class="col-sm-4">Fecha de nacimiento:</dt>
        <dd class="col-sm-8">
          <div class="form-group">
            <input type="date" onchange="obtener_datos_change(this)" name="fecha_nacimiento" class="form-control form-control-sm" id="fecha_nacimiento" aria-describedby="emailHelp" placeholder="Enter fecha" value="{{$datos_p->fecha_nacimiento}}" requiered>
          </div>
        </dd>
      </dl>
    </div>
  </div>

  

  

