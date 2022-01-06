@extends('homeOption2h')
@section('title','Doctors')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)

{{-- cuerpo de la pagina --}}
@section('contenido')
    <div class="row">
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
                    <div class="comment-text text-justify m-4">
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
                      
                        <a href="{{$datos_p->link_fb}}" target="”_blank”" class="btn btn-social-icon mr-1 btn-facebook ng-scope bg-indigo" ng-if="doctorsee.Facebook!==''">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="{{$datos_p->link_tw}}" target="”_blank”" class="btn btn-social-icon mr-1 btn-instagram ng-scope bg-lightblue " ng-if="doctorsee.Instagram!==''">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="{{$datos_p->link_stg}}" target="”_blank”" class="btn btn-social-icon mr-1 btn-twitter ng-scope btn-primary" ng-if="doctorsee.Twitter!==''">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{$datos_p->link_lkd}}" target="”_blank”" class="btn btn-social-icon mr-1 btn-linkedin ng-scope bg-info" ng-if="doctorsee.Linkedin!==''">
                            <i class="fab fa-linkedin"></i>
                        </a>
                      </div>
                  </div>
                </div>  
                <div class="card card-info card-outline">
                    <div class="card-header">
                         <h3 class="profile-username text-leth">Datos personales</h3>
                    </div>
                  <div class="card-body box-profile bg-light">
                    <div class="form-group mt-3">
                        <div class="product-info">
                          <a  class="product-title username direct-chat-name">Cumpleaños
                            <span class="text-muted float-right">{{$datos_p->fecha_nacimiento}}</span></a>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="product-info">
                          <a  class="product-title username direct-chat-name ">Teléfono
                            <span class="text-muted float-right">{{$datos_p->telefono}}</span></a>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="product-info">
                          <a  class="product-title username direct-chat-name">Email
                            <span class="text-muted float-right">{{$datos_p->email}}</span></a>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="product-info">
                          <a  class="product-title username direct-chat-name">Dirección Consultorio
                            <span class="text-muted float-right">{{$datos_p->direccion}}</span></a>
                        </div>
                    </div>
                    <div class="form-group mt-4 mb-5">
                        <div class="product-info">
                          <a  class="product-title username direct-chat-name">Celular
                            <span class="text-muted float-right">{{$datos_p->num_celular}}</span></a>
                        </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>  
            @endif
        </div>
         <div class="col-md-8 col-sm-12">
            <div class="card card-info card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Publicaciones</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Conóceme</a>
                  </li>
                  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                        @if (isset($listaArt))
                         <div class="card-body table-responsive">
                           <div class="row">
                             @foreach ($listaArt as $art )
                               <div class="col-xl-6 col-md-12  d-flex align-items-stretch flex-column">
                                 <div class="card d-flex flex-fill card card-outline card-primary mt-4 mr-4 mb-4">
                                   <div class="card-header text-muted border-bottom-0">
                                     <h1 class="card-title"> Option2Health </h1>
                                       <a href="{{url('medico/info/'.encrypt($art->iduser))}}">
                                         <div class="medico" style="cursor: pointer;" >
                                           <img src="https://option2health.com/assets/img/logo.png" class="rounded mx-auto d-block img2">
                                           <small> <b>Dr. O2H</b> </small>
                                         </div>
                                       </a>
                                   </div>
                                   <div class="card-body pt-0 ">
                                     <div class="row">
                                       <div class="col-lg-12">
                                         <h2 class="lead"><b>{{$art->titulo}}</b></h2>
                                         <p class="text-muted text-sm text-justify">
                                           {{$art->descripcion}} <a href="{{$art->vinculo_art}}" target="_blank">Ver más... </a></p> 
                                       </div>
                                       <div class="embed-responsive embed-responsive-16by9">
                                         <iframe width="560" height="315" src="{{$art->url_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                       
                                       </div>
                                     </div>
                                   </div>
                                   
                                   <div class="card-footer">
                                     <div class="row">
                                       <div class="col-lg-4 col-md-6 col-sm-12 mb-2 card-outline ">
                                         <button type="button"  onclick="putLike_poin('{{encrypt($art->idarticulo)}}',this )" class="@if(isset($art->like[0])) btn btn-block bg-gradient-info  @else btn btn-outline-info btn-block @endif "><i class=" fa fa-heartbeat"></i>
                                           <span class="badge ">{{$art->like_count}}</span>
                                           Me gusta 
                                         </button>

                                       </div>
                                       <div class="col-lg-4 col-md-6 col-sm-12  mb-2  ">
                                         <div class="dropdown text-right">
                                           <button class="btn btn-outline-info  dropdown-toggle btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           <i class="fa fa-share-alt"></i> Compartir
                                           </button>
                                           <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                             <button class="dropdown-item" type="button"> <i class="fab fa-facebook"></i> Facebook</button>
                                             <button class="dropdown-item" type="button"><i class="fab fa-whatsapp"></i> Whatsapp</button>
                                           </div>
                                         </div>
                                       </div>
                                       <div class="col-lg-4 col-md-6 col-sm-12  ">
                                         <div class="dropdown text-right">
                                           <button class="btn  btn-outline-info dropdown-toggle  btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           <i class="fa fa-info-circle"></i> Ver más
                                           </button>
                                           <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                             <button class="dropdown-item" type="button" onclick="saveArtUser('{{encrypt($art->idarticulo)}}')"> <i class="fa fa-save"></i> Guardar</button>
                                             <button class="dropdown-item" type="button"><i class="fa fa-phone"></i> Contacto Online</button>
                                             <button class="dropdown-item" type="button"><i class="fab fa-whatsapp"></i> Contacto Whatsapp</button>
                                           </div>
                                         </div>
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                             @endforeach
                           </div>
                         </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                        @if(isset($datos_p))
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <dt class="text-muted ng-binding text-center">Nombres</dt>
                                    <dd class="text-center">{{$datos_p->name}}</dd> 
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <dt class="text-muted ng-binding text-center">Celular</dt>
                                    <dd class="text-center">{{$datos_p->num_celular}}</dd> 
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <dt class="text-muted ng-binding text-center">Email</dt>
                                    <dd class="text-center">{{$datos_p->email}}</dd> 
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <dt class="text-muted ng-binding text-center">Ubicación</dt>
                                    <dd class="text-center">@if($datos_p->ciudad->descripcion) {{$datos_p->direccion}} @endif</dd> 
                                </div>

                            </div>
                            <p class="text-muted mt-5">{{$datos_p->des_perfil}}</p>
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <dt class=" lead product-title  direct-chat-name text-muted">Educación</dt>
                                    <dd class="text-muted ">{{$datos_p->institucion}}</dd>
                                </div>
                                <div class="col-md-12 mt-4 mb-4">
                                    <dt class="text-muted direct-chat-name  text-leth lead">Experiencia</dt>
                                    <dd class="text-muted">{{$datos_p->detalle_experiencia}}</dd>
                                </div>
                            </div>
                        @endif
                    </div>
                  
                </div>
              </div>
              <!-- /.card -->
            </div>
        </div>
    </div>    
        
    

    @section('include_css') 
        <style>
          .medico {
              position: absolute;
              border: 1px solid #10ADCF;
              text-align: center;
              right: -3vh;
              top: -3.8vh;
              background: #fff;
              border-radius: 4px;
              padding: 1vh;
              width: 7em;
              height: 6em;
              font-size: 1em;
              -moz-box-shadow: 0px 0px 9px -8px rgba(0,0,0,0.75);
              box-shadow: 0px 0px 19px -8px rgb(0 0 0 / 75%);
          }
          .img2{
            width: 67%;
          }
        </style>
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
      <script src="{{ asset('/js/controlLike.js') }}"></script>
      <script src="{{ asset('/js/gestionSaveArt.js') }}"></script>
    @stop


 @stop
