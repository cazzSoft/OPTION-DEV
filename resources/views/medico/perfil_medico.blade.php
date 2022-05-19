@extends('homeOption2h')
@section('title','Perfil-Médico')


{{--para activar los plugin en la view  perfil medico --}}
@section('plugins.toastr',true)
@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)
@section('plugins.Select2',true)
{{-- cuerpo de la pagina --}}
@section('contenido')
    
    <div class="row mt-1">
      <div class="col-md-3 col-sm-12 col-xs-12 "> 
        
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12 {{-- offset-md-2 --}} ">
        <div class="card card-widget widget-user ">
            <div class="widget-user-header text-white text-left" id="preViewPortada"
                style="
                    @if(isset($datos_p->img_portada) && $datos_p->img_portada!=null ) 
                        @if(\Storage::disk('diskDocumentosPerfilUser')->exists($datos_p->img_portada)) 
                            background: url('{{asset($datos_p->img_portada) }}')  center center; 
                        @else
                            background: url('{{ \Storage::disk('wasabi')->temporaryUrl($datos_p->img_portada,  now()->addMinutes(3600) )}}') center center; 
                        @endif
                    @else
                        background-color:#E0E0E0 !important
                    @endif">
               {{--  <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
                <h5 class="widget-user-desc text-right">Web Designer</h5> --}}
            </div>
            <div class="widget-user-image p-0  mr-5 " style="/*margin-left:-46%*/;">
                <img class="img-circle img-fluid p-1" id="preViewImg" src="{{auth()->user()->adminlte_image()}}" alt="{{$datos_p->img}}" >
                <div class="ribbon-wrapper ">
                  <div class="ribbon border-0" > 
                    <span  onclick="menu_perfil()" class="fas fa-plus elevation-2 p-1  img-circle text-info bz-white "  style="cursor: pointer;" ></span>
                  </div>
                </div>
                <div class="dropdown-menu  " id="myDropdown" style="margin-left: 110px; position: absolute;" >
                   {{--  <a href="#" class="dropdown-item nav-link text-info_"> Subir Foto de Portada</a>
                    <a href="#" class="dropdown-item nav-link text-info_"> Subir Foto de Perfil</a> --}}
                    {{-- <a href="#" class="dropdown-item nav-link text-info_"> Subir Historia</a> --}}
                    <div class="dropdown-item bg-white mx-auto" >
                       <form  method="POST" id="update_img_perfil" action="{{url('profile/update_photo')}}"  enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <input type="hidden" name="_method" value="POST">
                           <label for="file-upload" class="custom-file-upload p-0 text-info_">
                               <i class="fas fa-user-circle"></i> Subir Foto de Perfil
                           </label>
                           <input id="file-upload" name="img" class="p-0" type="file"/>
                       </form>
                    </div>
                    <div class="dropdown-item bg-white mx-auto" >
                       <form  method="POST" id="update_img_portada" action="{{url('medico/update_portada')}}"  enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <input type="hidden" name="_method" value="POST">
                           <label for="file2" class="custom-file-upload p-0 text-info_">
                            <i class="fas fa-cloud-upload-alt"></i> Subir Foto de Portada
                           </label>
                           <input id="file2" name="img_portada" class="p-0" type="file"/>
                       </form>
                    </div>
                </div> 
            </div>
          
            <div class="widget-user-header bg-white text-left " style="height: auto;">
               @if(isset($datos_p))
                <div class="row">
                    <div class="col-sm-12 mt-2">
                        <p class=" mt-5 ml-2 mb-3 h3 profile-username ">
                            <b>{{$datos_p->name}}  <small> <i class="fa fa-cog ml-3 text-info_" style="cursor:pointer;" {{--  id="btn_action" --}} data-toggle="modal" data-target="#modal-edit-user-md"></i></small>
                            </b>
                        </p>
                        <h6 class="widget-user-desc mx-0 ml-2">
                            @if(isset($datos_p['idtitulo_profesional'])) {{$datos_p->titulo['descripcion']}}  | @endif
                            <span class="ml-2 well well-sm shadow-none">Especialista en: </span>
                             @if(isset($especialidad))
                                 @foreach($especialidad as $key=>$item)
                                     <span class="text-muted ">
                                         @if($key!=0), @endif {{$item['especialidades']['descripcion']}}   
                                     </span>
                                 @endforeach <br>
                             @endif  
                        </h6>   
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8  col-sm-12">
                        <h6 class="widget-user-desc mx-0 ml-2">
                            <b>@if(isset($publicaciones)) {{$publicaciones}} @endif</b> publicaciones   
                            <span class="ml-4"><b>@if(isset($seguidores)) {{$seguidores}} @endif</b> @if($seguidores==1)seguidor @else seguidores @endif</span>
                        </h6>
                        <span class="ml-2 well well-sm shadow-none">Teléfono: {{$datos_p->telefono}}</span><br>
                        <span class="ml-2 well well-sm shadow-none">Email: {{$datos_p->email}}</span><br>
                        <span class="ml-2 tag tag-info">Dirección: {{$datos_p->direccion}}</span>
                        
                    </div>
                    <div class="col-md-4  mt-2 align-self-end col-sm-12">
                        <p class="text-muted text-leth">Sígueme en:</p>
                        <div class="text-leth mb-3 ">
                            <a  href="{{$datos_p->link_stg}}" onclick="acctionSociales('{{encrypt($datos_p['id'])}}','Twitter')" target="”_blank”" class="btn  border-0 " ng-if="doctorsee.Twitter!==''">
                              <i class="fab fa-instagram text-info fa-2x"></i>
                            </a>
                            <a href="{{$datos_p->link_fb}}" onclick="acctionSociales('{{encrypt($datos_p['id'])}}','Facebook')" target="”_blank”" class="btn  " ng-if="doctorsee.Facebook!==''">
                                <i class="fab fa-facebook text-info fa-2x"></i>
                            </a>
                            <a href="{{$datos_p->link_yt}}" onclick="acctionSociales('{{encrypt($datos_p['id'])}}','YouTube')" target="”_blank”" class="btn  " ng-if="doctorsee.YouTube!==''" >
                              <i class="fab fa-youtube text-info fa-2x "></i>
                            </a>
                        </div>
                    </div>
                </div>
              @endif
            </div>
        </div>

        <div class="card card-widget widget-user shadow-md">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="card-body">
            <p class=" h3 profile-username "><b>Acerca de mi</b> <i class="far fa-edit ml-3 text-info_ fa-sm" style="cursor:pointer;" {{--  id="btn_action" --}} data-toggle="modal" data-target="#modal-edit-user-md-dt"></i></p>
            <p class="description mb-2">{{$datos_p->detalle_estudio}} {{-- {{$datos_p->institucion}} --}}</p>

            <p class="h3 card-title profile-username "><b>Experiencia</b></p>
            <p class="description mb-5 ml-5 mt-5"><li class="ml-5 mt-5 mb-2">{{$datos_p->detalle_experiencia}}</li></p>
          </div>
        </div>
        <div class="card card-widget widget-user shadow-md ">
            <div class="card-header border-0">
                <h3 class="card-title h1"><b>Publicaciones</b>
                    <a href="{{url('gestion/listaPublicaciones')}}"><i class="far fa-edit ml-3 text-info_ fa-sm" style="cursor:pointer;"></i></a>
                     
                </h3>

                <div class="card-tools">
                    <a  class="btn btn-sm bgz-info nav-link" href="{{url('gestion/articulo')}}">Agrear Publicación</a>
                </div><br>
                  <small>Aqui tendras un listado de todas las publicaciones que has subido a O2H.</small>
            </div>
            <div class="card-body ">
               
                @if (isset($listaArt))
                    @foreach ($listaArt as $key=>$art )
                        <div class="card card-widget border-0 p-3 mx-3 mt-2 attachment-block clearfix mb-3">
                            <div class="card-header ">
                              <div class="user-block text-dark">
                                <a href="{{url('medico/info/'.encrypt($art['iduser']))}}" >
                                  <img class="img-circle elevation-1" src="@if(isset($art['medico'][0]['img']) && $art['medico'][0]['img']!=null){{ auth()->user()->adminlte_image() }}@else{{ asset('FotoPerfil/user.png')}} @endif" alt="User Image">
                                </a>
                                <span class="username">{{$art['titulo']}}</span>
                                <span class="description"><a href="">{{$art['medico'][0]['name']}} </a>- {{$art->created_at->isoFormat('lll') }}</span>
                              </div>
                              <div class="card-tools">
                                <button class="btn btn-xs o text-ligth   btn-tool" onclick="getModalInfo('{{$art['idarticulo_encryp']}}',{{$key}})"> <i class="fas fa-edit text-ligth  text-info_"></i> </button>
                                
                              </div> 
                            </div>

                            <div class="card-body  ">
                                <p class="   text-justify text-dark ">
                                    {{$art['descripcion']}} <a href="{{$art['vinculo_art']}}" target="_blank" onclick="acctionVermas('{{encrypt($art['idarticulo'])}}')">Ver más... </a>
                                </p> 
                               
                            </div>
                        </div>
                    @endforeach
                   
                  <div class="form-group text-center mx-auto ">
                     {{-- {{ $articulos->links() }} --}}
                  </div>
                @endif
            </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-12 col-xs-12 {{-- offset-md-2 --}} ">
        
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
    </div>    --}} 
    @include('medico.modalEdit')
    @include('medico.modal_edit_detalle_medico')
     
    @include('medico.modal_edit_medico')
    @section('include_css') 
    <link rel="stylesheet" href="{{ asset('css/nav-side-bar.css') }}">
        <style >
            .ocult{
              display: none;
            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #01b9e9;
                border-color: #c0cddc;
                color: #fff;
            }
            input[type="file"] {
                display: none;
            }
            .custom-file-upload {
                /*border: 1px solid #ccc;*/
                display: inline-block;
                padding: 1px ;
                cursor: pointer;
            }

            #preViewImg{
                width: 150px;
                height: 150px;
                object-fit: cover;
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
       <script src="{{ asset('/js/gestionSaveArt.js') }}"></script>
       {{-- //activar select --}}
        <script>
           $('.select2').select2();
        </script>
        <script src="{{ asset('/js/actionEvent.js') }}"></script>
        
       
    @stop


 @stop
