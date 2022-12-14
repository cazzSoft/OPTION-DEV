<div class="modal fade" id="modal-default">
 <div class="modal-dialog modal-lg ">
   <div class="modal-content border-0 border-white shadow-lg">
     <div class="modal-header text-center">
        <h4 class="modal-title text-center mx-auto "> 
            <i class="far fa-laugh-beam"></i> <span class="text-info_ text-center"> Bienvenido</span>
            @if(!Auth::guest()) {{auth()->user()->name}} @endif a <span class="text-info_">Option2health</span>
            <p class="lead text-center"> "te sugerimos completar los datos de tu perfil"</p>
        </h4>
 
       <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
        <i class="fas fa-times-circle"></i>
       </button>
     </div>

     <div class="modal-body"> 
        {{-- <p class="profile-username text-center mb-5 ">Registro de datos</p> --}}
        <form method="POST" @if($user_=='us') action="{{ url('/profile/user/'.encrypt(auth()->user()->id) ) }}" @else action="{{ url('/medico/perfil_complet/'.encrypt(auth()->user()->id) ) }}" @endif   enctype="multipart/form-data" >
            {{ csrf_field() }}

            {{-- foto de perfil --}} 
            <div class="form-group text-center m-auto" >
                <img class=" img-fluid img-circle  elevation-1 img-up-per" src="{{auth()->user()->adminlte_image()}}" alt="{{asset(auth()->user()->adminlte_image())}}" id="preViewImg2">
                <label for="file-upload" class="custom-file-upload p-0 bg-white p-2 img-circle elevation-2" id="dropdownMenuLinkImg">
                    <i class="fas fa-plus text-info p-1 fa-lg"></i>
                </label>
               
            </div>
            <div class="text-center  mt-4 mb-5 text-center">
                <label for="file-upload" class="custom-file-upload mr-3">
                    <i class="fa fa-cloud-upload"></i> Añadir foto*
                </label>
                <input id="file-upload" name="img"  type="file"/>   
           </div>
    
            <input id="method_" type="hidden" name="_method" value="PUT">
            <input type="hidden" name="tp" value=" @if(isset($user_)) {{encrypt($user_)  }} @endif ">
            <input type="hidden" class="form-control form-control-sm" id="name" name="name" placeholder="Name" value="{{auth()->user()->name}}">
            <input type="hidden"   name="email"  value="{{auth()->user()->email}}" >
            <div class="row">
                @if(isset($user_) && $user_=="em")
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="card   mx-auto " style="width: 18rem;">
                      <img class="card-img-top profile-user-img img-fluid img-circle mt-5" id="preViewImg" src="{{asset('ava1.png')}}" alt="imgLogo">
                      <div class="card-body">
                        <div class="input-group mb-3">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input border border-white shadow-sm" id="imgU">
                            <label class="custom-file-label" for="imgU">Logo</label>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                @endif
               
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label class="text-muted" for="telefono"> @if($user_=='dr')Teléfono (que tenga habilitado whatsapp) @elseif($user_=='us')Teléfono @elseif($user_=='em') Teléfono de contacto @endif <span class="text-red">*</span></label>
                        <input class="form-control border border-white shadow-sm  @error('telefono') is-invalid @enderror" name="telefono" id="telefono"
                            placeholder="Número de teléfono " value="{{auth()->user()->telefono }}"  autocomplete="telefono" autofocus required>
                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @if($user_=="dr" ||$user_=="em" )
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label class="text-muted" for="cedula">@if($user_=="em" ) Ruc de la Empresa @else Cédula de identidad @endif<span class="text-red">*</span></label>
                        <input class="form-control border border-white shadow-sm @error('cedula') is-invalid @enderror" name="cedula" id="cedula"
                            placeholder="@if($user_=="em" ) Ruc de la Empresa @else Cédula de identidad @endif" value="{{auth()->user()->cedula}}"  autocomplete="cedula" autofocus required>
                        @error('cedula')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @if($user_=="dr"  )
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="idtitulo_profesional" class="text-muted">Seleccione Título Profesional <span class="text-red">*</span></label>
                        <select  class="form-control  select2 border border-white shadow-sm @error('idtitulo_profesional') is-invalid @enderror" style="width: 100%;"
                            data-placeholder="Seleccione su Título Profesional" name="idtitulo_profesional" id="idtitulo_profesional" required>
                            <option></option>
                            @if(isset($lista_titu))
                                @foreach($lista_titu as $tit)
                                <option @if(auth()->user()->idtitulo_profesional == $tit->idtitulos)  selected="selected" @endif value="{{$tit->idtitulos}}">{{$tit->descripcion}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('idespecialidades')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @endif
                @if($user_=="em")
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="razon_socila" class="text-muted">Razón Social  <span class="text-red">*</span></label>
                            <input type="text" class="form-control border border-white shadow-sm  @error('razon_socila') is-invalid @enderror" name="razon_socila" id="razon_socila"  placeholder="Razón Social"
                                value="{{ auth()->user()->razon_socila }}" required>
                            @error('razon_socila')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @endif
                @endif
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="fecha_nacimiento" class="text-muted">@if($user_=="em") Fecha de Nacimiento de la persona de contacto @else Fecha de Nacimiento @endif  <span class="text-red">*</span></label>
                        <input type="date" class="form-control border border-white shadow-sm @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" id="fecha_nacimiento"
                            value="{{ auth()->user()->fecha_nacimiento  }}" required>
                        @error('fecha_nacimiento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            @if($user_=="us" || $user_=="em")
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="genero" class="text-muted">@if($user_=="em") Género del administrador de la cuenta @else Género @endif<span class="text-red">*</span></label>
                        <select class="form-control  select2 border border-white shadow-sm @error('genero') is-invalid @enderror" style="width: 100%;"
                            data-placeholder="Seleccione su género" name="genero" id="genero"  value="{{ auth()->user()->genero  }}" required>
                            <option  ></option>
                            <option @if(auth()->user()->genero ==1) selected @endif  value="1">Masculino</option>
                            <option @if(auth()->user()->genero ==0) selected @endif value="0">Femenino</option>
                            <option @if(auth()->user()->genero ==2) selected @endif value="2">Indefinido</option>
                           
                        </select>
                        @error('genero')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @if($user_=="us" ||  $user_=="dr")
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="idciudad" class="text-muted">Ciudad <span class="text-red">*</span></label>
                        <select class="form-control  select2 border border-white shadow-sm @error('idciudad') is-invalid @enderror" style="width: 100%;"
                            data-placeholder="Seleccione su ciudad" name="idciudad" id="idciudad" >
                            <option></option>
                            @if(isset($ciudades))
                                @foreach($ciudades as $ciu)
                                <option @if( auth()->user()->idciudad == $ciu->idciudad)  selected="selected" @endif value="{{$ciu->idciudad}}">{{$ciu->descripcion}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('idciudad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @endif

                @if($user_=="em" )
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="nom_comercial" class="text-muted">Nombre Comercial <span class="text-red">*</span></label>
                        <input class="form-control border border-white shadow-sm @error('nom_comercial') is-invalid @enderror" type="text" name="nom_comercial" id="nom_comercial"
                            placeholder="Nombre de la Empresa" value="{{ old('nom_comercial') }}">
                        @error('nom_comercial')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @endif

            </div>
             @endif
            <div class="row">
                @if($user_=="us"|| $user_=="dr")
                <div class="col-xs-12 col-sm-12   col-md-6 ">
                    <div class="form-group">
                        <label for="nom_referido" class="text-muted">Nombres de tu Referido</label>
                        <input class="form-control border border-white shadow-sm @error('nom_referido') is-invalid @enderror" type="text" name="nom_referido" id="nom_referido"
                            placeholder="Nombres de tu Referido" value="{{ auth()->user()->nom_referido }}">
                        @error('nom_referido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror    
                    </div>
                </div>
                @if($user_=="dr")
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="idciudad" class="text-muted">Ciudad <span class="text-red">*</span></label>
                        <select class="form-control  select2 border border-white shadow-sm @error('idciudad') is-invalid @enderror" style="width: 100%;"
                            data-placeholder="Seleccione su ciudad" name="idciudad" id="idciudad" >
                            <option></option>
                            @if(isset($ciudades))
                                @foreach($ciudades as $ciu)
                                <option @if(auth()->user()->idciudad == $ciu->idciudad)  selected="selected" @endif value="{{$ciu->idciudad}}">{{$ciu->descripcion}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('idciudad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @endif
                @endif 
                @if($user_=="us")
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="tine_hijo" class="text-muted">Tienes Hijos? <span class="text-red">*</span></label>
                        <select class="form-control border border-white shadow-sm select2 @error('tine_hijo') is-invalid @enderror" style="width: 100%;"
                            data-placeholder="Seleccione " name="tine_hijo" id="tine_hijo" >
                            <option ></option>
                            <option @if(auth()->user()->tine_hijo ==1)  selected="selected" @endif value="1">Si</option>
                            <option @if(auth()->user()->tine_hijo ==0)  selected="selected" @endif value="0">No</option>
                           
                        </select>
                        @error('tine_hijo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>   
                @endif  
                @if($user_=="em")
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <div class="form-group">
                        <label for="link_web" class="text-muted">Pagina web</label>
                        <input class="form-control border border-white shadow-sm @error('link_web') is-invalid @enderror" type="url" name="link_web" id="link_web"
                            placeholder="Url del sitio web" value="{{ old('link_web') }}">
                        @error('link_web')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror    
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="idarea" class="text-muted">Áreas relacionadas al giro de negocio de la empresa <span class="text-red">*</span></label>
                        <select multiple class="form-control border border-white shadow-sm select2 @error('idarea') is-invalid @enderror" style="width: 100%;"
                            data-placeholder="Seleccione Áreas" name="idarea[]" id="idarea" >
                            <option></option>
                            @if(isset($lista_area))
                                @foreach($lista_area as $area)
                                <option @if(old('idarea')==$area->idarea)  selected="selected" @endif value="{{$area->idarea}}">{{$area->descripcion}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('idarea')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @endif
            </div>
            @if($user_=="em")
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="link_fb" class="text-muted">Facebook</label>
                        <input class="form-control border border-white shadow-sm  @error('link_fb') is-invalid @enderror" type="url" name="link_fb" id="link_fb"
                            placeholder="Url Facebook" value="{{ old('link_fb') }}">
                        @error('link_fb')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror    
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="link_tw" class="text-muted">Twitter</label>
                        <input class="form-control border border-white shadow-sm @error('link_tw') is-invalid @enderror" type="url" name="link_tw" id="link_tw"
                            placeholder="Url Twitter" value="{{ old('link_tw') }}">
                        @error('link_tw')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="link_lkd" class="text-muted">Linkedin</label>
                        <input class="form-control border border-white shadow-sm @error('link_lkd') is-invalid @enderror" type="url" name="link_lkd" id="link_lkd"
                            placeholder="Url Linkedin" value="{{ old('link_lkd') }}">
                        @error('link_lkd')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror    
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="link_stg" class="text-muted">Instagram</label>
                        <input class="form-control border border-white shadow-sm @error('link_stg') is-invalid @enderror" type="url" name="link_stg" id="link_stg"
                            placeholder="Url Instagram" value="{{ old('link_stg') }}">
                        @error('link_stg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror    
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                @if($user_=="dr")
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="idespecialidades" class="text-muted">Seleccione Áreas o especialidades de su interés <span class="text-red">*</span></label>
                        <select multiple class="form-control  select2 border border-white shadow-sm @error('idespecialidades') is-invalid @enderror" style="width: 100%;"
                            data-placeholder="Seleccione" name="idespecialidades[]" id="idespecialidades" >
                            <option></option>
                            @if(isset($lista_especialidad))
                                @foreach($lista_especialidad as $espe)
                                <option  value="{{$espe->idespecialidades}}">{{$espe->descripcion}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('idespecialidades')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label class="text-muted" for="detalle_estudio">Ingrese una introducción de su perfil (se mostrará en la ficha personal) <span class="text-red">*</span></label>
                        
                        <textarea class="form-control border border-white shadow-sm @error('detalle_estudio') is-invalid @enderror"  rows="3" placeholder="Ej: soy una persona..."  value=" " name="detalle_estudio" id="detalle_estudio"  autocomplete="detalle_estudio" autofocus ></textarea>
                        @error('detalle_estudio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                 <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label class="text-muted" for="detalle_experiencia">Ingrese su experiencia profesional</label>
                        <textarea class="form-control border border-white shadow-sm @error('detalle_experiencia') is-invalid @enderror"  rows="3" placeholder="Ej: Médico especialista..."  value=" " 
                            name="detalle_experiencia" id="detalle_experiencia"  autocomplete="detalle_experiencia" autofocus required></textarea>
                        @error('detalle_experiencia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                   <div class="form-group ">
                       <label class="text-muted border border-white shadow-sm" for="direccion" > Dirección de su consultorio</label>
                       <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{auth()->user()->direccion}}" placeholder="Ingrese dirección de su consultorio"  autocomplete="direccion" autofocus required>

                       @error('direccion')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                       @enderror
                       
                   </div>
                </div>
                
                @endif    
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group row mb-0 text-center mt-4">
                        <div class="col-md-12 offset-md-12">
                            <button type="submit" class="btn bgz-info pl-5 pr-5">
                                {{ __('Guardar datos') }}
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
     </div>
   </div>
   <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
</div>