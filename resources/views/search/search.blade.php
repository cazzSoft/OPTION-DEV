@extends('homeOption2h')
@section('title','Perfil-Médico')


{{--para activar los plugin en la view  perfil medico --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
{{-- cuerpo de la pagina --}}
@section('contenido')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-4">
                <a href="{{url('home')}}" class="mt-5">  <p class="ml-5 text-lead h4 text-info tex-sty">  <i class="fas fa-chevron-left mr-3 text-info"></i> <b>Resultados para Cancer</b> </p></a>
            </div>
            <div class="col-md-12 col-sm-12 mt-4 m-2">
                <div class="ml-5 mr-5 mt-4">
                    <p >Aquí tienes todos los resultados que tenemos disponible para ti.</p>
                    <p class=" text-lead h4 text-dark tex-sty mt-5 mb-5">
                       <b>Médicos </b>
                    </p>
                </div>
            </div>
        </div>
        <div class="row ml-5">
          <div class="col-md-1 col-sm-4 col-xs-6 text-right ">

            <img src="/img/user3-128x128.jpg" alt="User Image" class="img img-circle img-fluid">
            <a class="users-list-name" href="#"><b>Alexander Pierce</b></a>
           
          </div>
          <div class="col-md-1 col-sm-4 col-xs-6 text-left ">
            <img src="/img/user4-128x128.jpg" alt="User Image" class="img img-circle img-fluid ">
            <a class="users-list-name" href="#"><b>DR. FREDDY CANELAS</b></a>
          </div>
          <div class="col-md-1 col-sm-4 col-xs-6 text-left ">
            <img src="/img/user4-128x128.jpg" alt="User Image" class="img img-circle img-fluid">
            <a class="users-list-name" href="#"><b>DR. FREDDY CANELAS</b></a>
          </div>
        </div>
        <div class="row ">
            <div class="col-md-12 col-sm-4 col-xs-6 ">
                <div class="ml-5 mr-5 mb-5 mt-5">
                    <p class=" text-lead h4 text-dark tex-sty mt-5">
                    <b>Productos y Servicios </b>
                </p>
                </div>
            </div>
        </div> 
        <div class="row ml-5">   
            <div class="col-md-2 col-sm-2 col-xs-6 text-center">
                <div class="attachment-block clearfix  ">
                  <img class="img-fluid mb-3 " src="/img/photo2.png" alt="Photo">
                  <p>Seguro de vida Can</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-2col-xs-6 text-center">
                
                    <div class="attachment-block clearfix">
                      <img class="img-fluid mb-3" src="/img/photo2.png" alt="Photo">
                      <p>Farmacias Canhouse</p>
                    </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-6 text-center">
                <div class="attachment-block clearfix">
                  <img class="img-fluid mb-3" src="/img/photo2.png" alt="Photo">
                  <p>Seguro de Vida Equivida</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-6 text-center">
                <div class="attachment-block clearfix">
                  <img class="img-fluid mb-3" src="/img/photo2.png" alt="Photo">
                  <p>Seguro de Vida Equivida</p>
                </div>
            </div>
           
        </div>
        <div class="row ml-4">
            <div class="col-md-12 col-sm-4 col-xs-6 mt-5">
                <p class=" text-lead h4 text-dark tex-sty mt-5">
                   <b>Publicaciones </b>
                </p>
            </div>
            <div class="col-md-12 col-sm-4 col-xs-12 ">
                 <div class="container  mt-4">
                      @include('publicaciones')
                 </div>
            </div>
            
        </div>
    </div>
   {{--  <div class="row">
        <div class="col-md-4 col-sm-12">
            @if(isset($datos_p))
                <div class="card card-info card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                           src="https://option2health.com/assets/img/logo.png"
                           alt="User profile picture">
                    </div>
                    <h3 class="widget-user-username text-center text-info">{{$datos_p->name}}</h3>
                    <h5 class="widget-user-desc text-center text-muted">{{$datos_p->titulo['descripcion']}}</h5>
                    <div class="comment-text text-center m-4">
                      {{$datos_p->detalle_estudio}} 
                    </div>
                    @if(isset($user) && $user!='dr' )
                      <div class="text-center mt-2 text-light  ">  <a  onclick="gestionSeguir('{{encrypt($datos_p->id)}}',this)" class="btn btn-info btn-sm text-center"><b> <i class="fa fa-check"></i> @if(isset($sigue)) Dejar de seguir @else Seguir @endif</b></a>
                      </div>
                    @endif
                  </div>
                  <div class="card-footer">
                      <p class="text-muted text-center">Sígueme en:</p>
                      <div class="text-center mb-3">
                      
                        <a href="{{$datos_p->link_fb}}"  onclick="acctionSociales('{{encrypt($datos_p['id'])}}','Facebook')" target="_blank" class="btn btn-social-icon mr-1 btn-facebook ng-scope bg-indigo" ng-if="doctorsee.Facebook!==''">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="{{$datos_p->link_tw}}" onclick="acctionSociales('{{encrypt($datos_p['id'])}}','Instagram')" target="_blank" class="btn btn-social-icon mr-1 btn-instagram ng-scope bg-lightblue " ng-if="doctorsee.Instagram!==''">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="{{$datos_p->link_stg}}"  onclick="acctionSociales('{{encrypt($datos_p['id'])}}','Twitter')" target="_blank" class="btn btn-social-icon mr-1 btn-twitter ng-scope btn-primary" ng-if="doctorsee.Twitter!==''">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{$datos_p->link_lkd}}" onclick="acctionSociales('{{encrypt($datos_p['id'])}}','Linkedin')" target="_blank" class="btn btn-social-icon mr-1 btn-linkedin ng-scope bg-info" ng-if="doctorsee.Linkedin!==''">
                            <i class="fab fa-linkedin"></i>
                        </a>
                      </div>
                      <p class="text-muted text-center"><small>* Para editar tus redes sociales por favor ve a la pestaña de Acerca de mí</small></p>
                  </div>
                </div>  
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 col-md-6 col-sm-12 text-left">
                              <h3 class="card-title">
                                  <b>Datos Personales</b>
                              </h3>  
                            </div>
                            <div class="col-6 col-md-6 col-sm-12 text-right">
                                <button class="btn btn-xs btn-outline-info text-ligth rounded" id="btn_action_m"> <i class="fas fa-pen-alt text-ligth"></i> </button>
                            </div>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 form_medic d-none">
                                <div class="text-center">
                                  <img class="profile-user-img img-fluid img-circle" src="https://picsum.photos/300/300" alt="User profile picture">
                                </div>
                                <form method="POST" action="{{ url('/medico/perfil/'.encrypt($datos_p->id) ) }}">
                                    {{ csrf_field() }}
                                    <input id="method_" type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label class="text-muted" for="exampleInputPassword1">Nombres <span class="text-red">*</span> </label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$datos_p->name}}" requiered>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-muted" for="exampleInputEmail1">Email <span class="text-red">*</span></label>
                                        <input type="email"   name="email" class="form-control" id="emael" aria-describedby="emailHelp"
                                            placeholder="Enter email" value="{{$datos_p->email}}" requiered>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-muted" for="exampleInputEmail1">Télefono  <span class="text-red">*</span></label>
                                                <input type="text"   name="telefono" class="form-control" id="emael" aria-describedby="emailHelp"
                                                    placeholder="Enter Télefono" value="{{$datos_p->email}}" requiered>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-muted" for="exampleInputEmail1">Fecha de Nacimiento <span class="text-red">*</span></label>
                                                <input type="date"   name="fecha_nacimiento" class="form-control" id="emael" aria-describedby="emailHelp"
                                                    placeholder="Enter fecha" value="{{$datos_p->fecha_nacimiento}}" requiered>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-muted" for="exampleInputEmail1">Genero  <span class="text-red">*</span></label>
                                                <select class="form-control select2" style="width: 100%;"  name="genero">
                                                    <option @if($datos_p->genero==1) selected="selected" @endif  value="1">Masculino</option>
                                                    <option @if($datos_p->genero==0) selected="selected" @endif value="0">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label class="text-muted" for="idciudad">Ciudad <span class="text-red">*</span></label>
                                                <select class="form-control select2" style="width: 100%;"  name="idciudad" data-placeholder="Seleccione Ciudad" >
                                                    <option></option>
                                                    @if(isset($listaCiudad))
                                                        @foreach($listaCiudad as $item)
                                                            <option @if($datos_p->idciudad==$item->idciudad) selected="selected" @endif value="{{$item->idciudad}}">{{$item->descripcion}}</option>
                                                        @endforeach
                                                    @endif
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"> 
                                                <label class="text-muted" for="iduser_especialidad">Area o especilidades <span class="text-red">*</span></label>
                                                <select  multiple class="form-control select2 bg-info" style="width: 100%;"  name="iduser_especialidad[]" data-placeholder="Seleccione especialidades" required>
                                                    <option></option>
                                                    @if(isset($lista_especialidad))
                                                        @foreach($lista_especialidad as $item)
                                                            <option  
                                                                @if(isset($especialidad))
                                                                class="ddd" 
                                                                    @foreach($especialidad as $esp)
                                                                        @if($esp->idespecialidades==$item->idespecialidades)
                                                                            selected 
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                             value="{{$item->idespecialidades}}">
                                                                {{$item->descripcion}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                   
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info"> <i class=" fa fa-save"></i> Actualizar</button>
                                </form>
                            </div>
                            <div class="col-12 info_m">
                               @if(isset($datos_p))
                                    <div class="form-group mt-3">
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="product-info">
                                          <a  class="product-title username direct-chat-name">Nombres
                                            <span class="text-muted float-right">{{$datos_p->name}}</span></a>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="product-info">
                                          <a  class="product-title username direct-chat-name">Email
                                            <span class="text-muted float-right">{{$datos_p->email}}</span></a>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="product-info">
                                          <a  class="product-title username direct-chat-name">Télefono
                                            <span class="text-muted float-right">{{$datos_p->telefono}}</span></a>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="product-info">
                                          <a  class="product-title username direct-chat-name">Fecha de Nacimiento
                                            <span class="text-muted float-right">{{$datos_p->fecha_nacimiento}}</span></a>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="product-info">
                                          <a  class="product-title username direct-chat-name">Género
                                            <span class="text-muted float-right">@if($datos_p->genero=='1') Masculino @else Femenino @endif</span></a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group mt-3">
                                        <div class="product-info">
                                          <a  class="product-title username direct-chat-name">Áreas o título que tiene  experiencia
                                            @if(isset($especialidad))
                                                @foreach($especialidad as $item)
                                                    <span class="text-muted float-right">
                                                        {{$item['especialidades']['descripcion']}} <i class="fa fa-check text-success"></i> 
                                                    </span><br>
                                                @endforeach
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                               @endif
                            </div>
                        </div>      
                    </div>
                </div>   
            @endif
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card card-info card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active text-info" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Acerca de mí</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active  " id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                        @if(isset($datos_p))
                            <form method="POST" action="{{ url('/medico/perfil_/'.encrypt($datos_p->id) ) }}">
                                {{ csrf_field() }}
                                <input id="method_" type="hidden" name="_method" value="PUT">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                       <div class="form-group ">
                                           <label class="text-muted" for="num_licenciaMedica" > Número de licencia médica</label>
                                           <input id="num_licenciaMedica" type="text" class="form-control @error('num_licenciaMedica') is-invalid @enderror" name="num_licenciaMedica" value="{{$datos_p->num_licenciaMedica }}" placeholder="Ingrese número de licencia médica" required autocomplete="num_licenciaMedica" autofocus>

                                           @error('num_licenciaMedica')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                           
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="idtitulo_profesional" class="text-muted">Seleccione Título Profesional <span class="text-red">*</span></label>
                                            <select  class="form-control  select2 @error('idtitulo_profesional') is-invalid @enderror" style="width: 100%;" required 
                                                data-placeholder="Seleccione su Título Profesional" name="idtitulo_profesional" id="idtitulo_profesional" required>
                                                <option></option>
                                                @if(isset($lista_titu))
                                                    @foreach($lista_titu as $tit)
                                                    <option @if(old('idtitulo_profesional')==$tit->idtitulos || $datos_p->idtitulo_profesional==$tit->idtitulos)  selected="selected" @endif value="{{$tit->idtitulos}}">{{$tit->descripcion}}</option>
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
                                            <label class="text-muted" for="detalle_estudio">Ingresar estudios, cursos y certificaciones realizadas (se mostrará en la ficha personal) </label>
                                            <textarea class="form-control @error('detalle_estudio') is-invalid @enderror"  rows="3" placeholder="Ej: soy una persona..."  value="{{$datos_p->detalle_estudio}}"
                                             name="detalle_estudio" id="detalle_estudio" required></textarea>
                                            @error('detalle_estudio')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="text-muted" for="detalle_experiencia">Ingrese su experiencia profesional en el área (se mostrará en la ficha personal) </label>
                                            <textarea class="form-control @error('detalle_experiencia') is-invalid @enderror"  rows="3" placeholder="Ej: Médico especialista..."  value="212" 
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
                                           <label class="text-muted" for="direccion" > Dirección de su consultorio</label>
                                           <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $datos_p->direccion }}" placeholder="Ingrese dirección de su consultorio"  autocomplete="direccion" autofocus required>

                                           @error('direccion')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                           
                                       </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                       <div class="form-group ">
                                           <label class="text-muted" for="link_fb" > Facebook <i class="fab fa-facebook"></i></label>
                                           <input id="link_fb" type="text" class="form-control @error('link_fb') is-invalid @enderror" name="link_fb" value="{{ $datos_p->link_fb }}" placeholder="https://www.facebook.com"  autocomplete="link_fb" autofocus>

                                           @error('link_fb')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                           
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                       <div class="form-group ">
                                           <label class="text-muted" for="link_tw" > Twitter <i class="fab fa-twitter"></i></label>
                                           <input id="link_tw" type="text" class="form-control @error('link_tw') is-invalid @enderror" name="link_tw" value="{{ $datos_p->link_tw }}" placeholder="https://twitter.com/home"  autocomplete="link_tw" autofocus required>

                                           @error('link_tw')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                           
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                       <div class="form-group ">
                                           <label class="text-muted" for="link_stg" > Instagram <i class="fab fa-instagram"></i></label>
                                           <input id="link_stg" type="text" class="form-control @error('link_stg') is-invalid @enderror" name="link_stg" value="{{$datos_p->link_stg }}" placeholder="https://www.instagram.com"  autocomplete="link_stg" autofocus required>

                                           @error('link_stg')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                           
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                       <div class="form-group ">
                                           <label class="text-muted" for="link_lkd" > Linkedin <i class="fab fa-linkedin"></i> </label>
                                           <input id="link_lkd" type="text" class="form-control @error('link_lkd') is-invalid @enderror" name="link_lkd" value="{{ $datos_p->link_lkd }}" placeholder="https://ec.linkedin.com"  autocomplete="link_lkd" autofocus required>

                                           @error('link_lkd')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                           
                                       </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 offset-md-12">
                                                <button type="submit" class="btn btn-info  ">
                                                    Actualizar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        @endif
                    </div>
                  
                </div>
              </div>
              <!-- /.card -->
            </div>
        </div>
    </div>   --}}  

    @section('include_css') 
        <style>
            .ocult{
                display: none;
            }
        </style>
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
        {{-- textarea estan raros --}}
        @if( isset($datos_p) )
           <script>
                $('#detalle_experiencia').val('{{$datos_p->detalle_experiencia}}');
                $('#detalle_estudio').val('{{$datos_p->detalle_estudio}}');
           </script>
        @endif
        {{-- Mensaje de informacion --}}
          @if(session()->has('info'))
             <script >
               
               mostrar_toastr('{{session('info')}}','{{session('estado')}}')
             </script>
          @endif
       <script src="{{ asset('/js/medico.js') }}"></script>
       //activar select
       <script>
           $('.select2').select2();
       </script>
        <script src="{{ asset('/js/actionEvent.js') }}"></script>
    @stop


 @stop
