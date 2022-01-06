
@extends('layouts.baseLogin')
@section('title','Registro')

@section('plugins.Select2',true)
{{-- class="hold-transition login-page" --}}
@section('content')
<div class="container col-md-6">
    <div class="row ">
        <div class="col-md-12 mt-1">
            <div class="register-logo">       
                <img class=" img-responsive  " src="{{asset('option2h.png')}}" height="300px">
                <h4><b>Bienvenido</b></h4>  
            </div>

            <div class="card card-outline card-info">
                <div class="bloq_"></div>
                <div class="card-header">
                   <div class="d-flex justify-content-between">
                       <h3 class="p2 card-title">Registro -
                            @if(isset($user_)) 
                                @if($user_=="empre")
                                    Productos y servicios
                                @else
                                    {{$user_}}
                                @endif
                                 
                            @endif
                        </h3>
                       <span class="p-2 border badge badge-pill badge-light text-red ">Campos obligatorios (*)
                       </span>
                   </div>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" name="tp" value="  @if(isset($user_)) {{encrypt($user_)  }} @endif ">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @if(isset($user_) && $user_=="empre")
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        
                                        <div class="card   mx-auto " style="width: 18rem;">
                                          <img class="card-img-top profile-user-img img-fluid img-circle mt-5" id="preViewImg" src="{{asset('ava1.png')}}" alt="imgLogo">
                                          <div class="card-body">
                                            
                                            <div class="input-group mb-3">
                                              <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="imgU">
                                                <label class="custom-file-label" for="imgU">Logo</label>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                       
                                        <div class="form-group ">
                                            <label class="text-muted" for="name" > @if($user_=='empre')Nombres de Contacto @else {{ __('Nombres Completos') }} @endif<span class="text-red">*</span></label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombres completos" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                       
                                        <div class="form-group ">
                                            <label class="text-muted" for="email" >{{ __('Email') }} <span class="text-red">*</span></label>
                                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Ingrese Email">
                                            @error('email')
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
                                            <label class="text-muted" for="telefono"> @if($user_=='Médico')Teléfono (que tenga habilitado whatsapp) @elseif($user_=='Usuario')Teléfono @elseif($user_=='empre') Teléfono de contacto @endif <span class="text-red">*</span></label>
                                            <input class="form-control  @error('telefono') is-invalid @enderror" name="telefono" id="telefono"
                                                placeholder="Número de teléfono " value="{{ old('telefono') }}"  autocomplete="telefono" autofocus>
                                            @error('telefono')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if($user_=="Médico" ||$user_=="empre" )
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="text-muted" for="cedula">@if($user_=="empre" ) Ruc de la Empresa @else Cédula de identidad @endif<span class="text-red">*</span></label>
                                            <input class="form-control  @error('cedula') is-invalid @enderror" name="cedula" id="cedula"
                                                placeholder="@if($user_=="empre" ) Ruc de la Empresa @else Cédula de identidad @endif" value="{{ old('cedula') }}"  autocomplete="cedula" autofocus>
                                            @error('cedula')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if($user_=="Médico"  )
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="idtitulo_profesional" class="text-muted">Seleccione Título Profesional <span class="text-red">*</span></label>
                                            <select  class="form-control  select2 @error('idtitulo_profesional') is-invalid @enderror" style="width: 100%;"
                                                data-placeholder="Seleccione su Título Profesional" name="idtitulo_profesional" id="idtitulo_profesional" >
                                                <option></option>
                                                @if(isset($lista_titu))
                                                    @foreach($lista_titu as $tit)
                                                    <option @if(old('idtitulo_profesional')==$tit->idtitulos)  selected="selected" @endif value="{{$tit->idtitulos}}">{{$tit->descripcion}}</option>
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
                                    @if($user_=="empre")
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="razon_socila" class="text-muted">Razón Social  <span class="text-red">*</span></label>
                                                <input type="text" class="form-control  @error('razon_socila') is-invalid @enderror" name="razon_socila" id="razon_socila"  placeholder="Razón Social"
                                                    value="{{ old('razon_socila') }}" >
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
                                            <label for="fecha_nacimiento" class="text-muted">@if($user_=="empre") Fecha de Nacimiento de la persona de contacto @else Fecha de Nacimiento @endif  <span class="text-red">*</span></label>
                                            <input type="date" class="form-control  @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" id="fecha_nacimiento"
                                                value="{{ old('fecha_nacimiento') }}" >
                                            @error('fecha_nacimiento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @if($user_=="Usuario" || $user_=="empre")
                                <div class="row">
                                     
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="genero" class="text-muted">@if($user_=="empre") Género del administrador de la cuenta @else Género @endif<span class="text-red">*</span></label>
                                            <select class="form-control  select2  @error('genero') is-invalid @enderror" style="width: 100%;"
                                                data-placeholder="Seleccione su género" name="genero" id="genero"  value="{{ old('genero') }}" >
                                                <option  ></option>
                                                <option @if(old('genero')==1) selected @endif  value="1">Masculino</option>
                                                <option @if(old('genero')==0) selected @endif value="0">Femenino</option>
                                               
                                            </select>
                                            @error('genero')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if($user_=="Usuario" )
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="idciudad" class="text-muted">Ciudad <span class="text-red">*</span></label>
                                            <select class="form-control  select2 @error('idciudad') is-invalid @enderror" style="width: 100%;"
                                                data-placeholder="Seleccione su ciudad" name="idciudad" id="idciudad" >
                                                <option></option>
                                                @if(isset($ciudades))
                                                    @foreach($ciudades as $ciu)
                                                    <option @if(old('idciudad')==$ciu->idciudad)  selected="selected" @endif value="{{$ciu->idciudad}}">{{$ciu->descripcion}}</option>
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

                                    @if($user_=="empre" )
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="nom_comercial" class="text-muted">Nombre Comercial <span class="text-red">*</span></label>
                                            <input class="form-control  @error('nom_comercial') is-invalid @enderror" type="text" name="nom_comercial" id="nom_comercial"
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
                                    @if($user_=="Usuario"|| $user_=="Médico")
                                    <div class="col-xs-12 col-sm-12  @if($user_=='Médico') col-md-12 @else col-md-6 @endif">
                                        <div class="form-group">
                                            <label for="nom_referido" class="text-muted">Nombres de tu Referido</label>
                                            <input class="form-control  @error('nom_referido') is-invalid @enderror" type="text" name="nom_referido" id="nom_referido"
                                                placeholder="Nombres de tu Referido" value="{{ old('nom_referido') }}">
                                            @error('nom_referido')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror    
                                        </div>
                                    </div>
                                    @endif 
                                    @if($user_=="Usuario")
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="tine_hijo" class="text-muted">Tienes Hijos? <span class="text-red">*</span></label>
                                            <select class="form-control  select2 @error('tine_hijo') is-invalid @enderror" style="width: 100%;"
                                                data-placeholder="Seleccione " name="tine_hijo" id="tine_hijo" >
                                                <option ></option>
                                                <option @if(old('tine_hijo')==1)  selected="selected" @endif value="1">Si</option>
                                                <option @if(old('tine_hijo')==0)  selected="selected" @endif value="0">No</option>
                                               
                                            </select>
                                            @error('tine_hijo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>   
                                    @endif  
                                    @if($user_=="empre")
                                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                                        <div class="form-group">
                                            <label for="link_web" class="text-muted">Pagina web</label>
                                            <input class="form-control  @error('link_web') is-invalid @enderror" type="url" name="link_web" id="link_web"
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
                                            <select multiple class="form-control  select2 @error('idarea') is-invalid @enderror" style="width: 100%;"
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
                                @if($user_=="empre")
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="link_fb" class="text-muted">Facebook</label>
                                            <input class="form-control  @error('link_fb') is-invalid @enderror" type="url" name="link_fb" id="link_fb"
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
                                            <input class="form-control  @error('link_tw') is-invalid @enderror" type="url" name="link_tw" id="link_tw"
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
                                            <input class="form-control  @error('link_lkd') is-invalid @enderror" type="url" name="link_lkd" id="link_lkd"
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
                                            <input class="form-control  @error('link_stg') is-invalid @enderror" type="url" name="link_stg" id="link_stg"
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
                                    @if($user_=="Médico")
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="text-muted" for="detalle_estudio">Ingrese una introducción de su perfil (se mostrará en la ficha personal) <span class="text-red">*</span></label>
                                            
                                            <textarea class="form-control @error('detalle_estudio') is-invalid @enderror"  rows="3" placeholder="Ej: soy una persona..."  value="{{ old('detalle_estudio') }}" name="detalle_estudio"  autocomplete="detalle_estudio" autofocus ></textarea>
                                            @error('detalle_estudio')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="idespecialidades" class="text-muted">Seleccione Áreas o especialidades de su interés <span class="text-red">*</span></label>
                                            <select multiple class="form-control  select2 @error('idespecialidades') is-invalid @enderror" style="width: 100%;"
                                                data-placeholder="Seleccione su ciudad" name="idespecialidades[]" id="idespecialidades" >
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
                                    @endif
                                   <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group ">
                                            <label for="password" class="text-muted">{{ __('Password') }} <span class="text-red">*</span></label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                   </div> 
                                   <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group ">
                                            <label for="password-confirm" class="text-muted">{{ __('Confirm Password') }} <span class="text-red">*</span></label>
                                            <input id="password-confirm" type="password" class="form-control " name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                   </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="termino" class="custom-control-input ng-dirty ng-valid-parse ng-touched ng-empty ng-invalid ng-invalid-required @error('termino') is-invalid @enderror" id="termino" ng-model="termino" onblur="$('#termino').val($('#termino:checked').val() ? 1 : 0)" required>
                                            <label class="custom-control-label text-muted" for="termino">Yo acepto los términos y condiciones de Option2health</label>
                                            @error('termino')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 offset-md-12">
                                                <button type="submit" class="btn btn-primary ">
                                                    {{ __('Registrar') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <p class="mb-0 text-right text-muted">
                                            Ya estoy registrado? 
                                          <a disabled="false" href="{{ url('login') }}" class="text-center btn btn-link ml-auto mb-0 text-sm"> Ingresar</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_info"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered bd-example-modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-warning"><i class="fa fa-info-circle"></i> @if($user_=='Médico' ) {{$user_}} @elseif($user_=='empre')Productos y Servicios @endif </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12  @if($user_=='Médico') col-md-6 @else col-md-12 @endif">
                    <img  class="img-responsive img-fluid img-rounded" src="{{asset('doc.png')}}" alt="">
                </div>

                <div class="col-xs-12 col-sm-12  @if($user_=='Médico') col-md-6 @else col-md-12 @endif">
                    <p class="text-muted m-4 text-justify" >
                    @if($user_=='Médico')
                      <b>  Recuerda ingresar información precisa y clara, para que sea mas fácil conocerte y contactarte.</b>
                      @else
                      <b>La información a continuación nos ayudará a que tu anuncio llegue de manera eficiente y personalizada a las personas que están buscando tus productos/servicios. Esta información no será comercializada de ninguna manera y se usará solamente con la finalidad de segmentar nuestra audiencia para que tu promoción sea más eficiente</b>
                    @endif
                    </p>
                </div>
            </div>
            
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- Button trigger modal -->

    
</div>


@endsection


 @section('adminlte_js')
  @if(isset($user_)) 
    @if($user_=='Médico' || $user_=='empre' )
        <script > $('#modal_info').modal('show');</script>
    @endif
   
  @endif
    <script >
         $(document).ready(function() {
             $('.select2').select2();
         });
    </script>
     <script src="{{ asset('/js/register.js') }}"></script>
 @stop