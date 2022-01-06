@extends('homeOption2h')
@section('title','HOME')

{{--para activar los plugin en la view  --}}
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)


{{-- cuerpo de la pagina --}}
@section('contenido')
    <div class="row">
        <div class="col-xl-4 col-sm-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-md-6 col-sm-12 text-left">
                          <h3 class="card-title">
                              <b>Datos Personales</b>
                          </h3>  
                        </div>
                        <div class="col-6 col-md-6 col-sm-12 text-right">
                            <button class="btn btn-xs btn-outline-info text-ligth rounded" id="btn_action"> <i class="fas fa-pen-alt text-ligth"></i> </button>
                            
                        </div>
                    </div> 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 form_p d-none">
                            <div class="text-center">
                              <img class="profile-user-img img-fluid img-circle" src="https://picsum.photos/300/300" alt="User profile picture">
                            </div>
                            @if(isset($data))
                                <form method="POST" action="{{ url('/profile/user/'.encrypt($data->id) ) }}">
                                    {{ csrf_field() }}
                                    <input id="method_" type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label class="text-muted" for="exampleInputPassword1">Nombres <span class="text-red">*</span> </label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$data->name}}" requiered>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-muted" for="exampleInputEmail1">Email <span class="text-red">*</span></label>
                                        <input type="email"   name="email" class="form-control" id="emael" aria-describedby="emailHelp"
                                            placeholder="Enter email" value="{{$data->email}}" requiered>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-muted" for="exampleInputEmail1">Télefono  <span class="text-red">*</span></label>
                                                <input type="text"   name="telefono" class="form-control" id="emael" aria-describedby="emailHelp"
                                                    placeholder="Enter Télefono" value="{{$data->email}}" requiered>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-muted" for="exampleInputEmail1">Fecha de Nacimiento <span class="text-red">*</span></label>
                                                <input type="date"   name="fecha_nacimiento" class="form-control" id="emael" aria-describedby="emailHelp"
                                                    placeholder="Enter fecha" value="{{$data->fecha_nacimiento}}" requiered>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-muted" for="exampleInputEmail1">Genero  <span class="text-red">*</span></label>
                                                <select class="form-control select2" style="width: 100%;"  name="genero">
                                                    <option @if($data->genero==1) selected="selected" @endif  value="1">Masculino</option>
                                                    <option @if($data->genero==0) selected="selected" @endif value="0">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label class="text-muted" for="exampleInputEmail1">Ciudad <span class="text-red">*</span></label>
                                                <select class="form-control select2" style="width: 100%;"  name="idciudad" data-placeholder="Seleccione Ciudad" >
                                                    <option></option>
                                                    @if(isset($listaCiudad))
                                                        @foreach($listaCiudad as $item)
                                                            <option @if($data->idciudad==$item->idciudad) selected="selected" @endif value="{{$item->idciudad}}">{{$item->descripcion}}</option>
                                                        @endforeach
                                                    @endif
                                                   
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                    <button type="submit" class="btn btn-primary"> <i class=" fa fa-save"></i> Actualizar</button>
                                </form>
                            @endif
                        </div>
                        <div class="col-12 info_p">
                           @if(isset($data))
                                <div class="form-group mt-3">
                                    <div class="product-info">
                                      <a  class="product-title username direct-chat-name hover">Seguidos
                                        <span class="text-muted float-right text-red">
                                            <button class="btn btn-xs btn-info img-fluid " id="btnModalSg"> <b>@if(isset($sigues)) {{$sigues}} @endif</b></button>
                                        </span></a>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="product-info">
                                      <a  class="product-title username direct-chat-name">Nombres
                                        <span class="text-muted float-right">{{$data->name}}</span></a>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="product-info">
                                      <a  class="product-title username direct-chat-name">Email
                                        <span class="text-muted float-right">{{$data->email}}</span></a>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="product-info">
                                      <a  class="product-title username direct-chat-name">Télefono
                                        <span class="text-muted float-right">{{$data->telefono}}</span></a>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="product-info">
                                      <a  class="product-title username direct-chat-name">Fecha de Nacimiento
                                        <span class="text-muted float-right">{{$data->fecha_nacimiento}}</span></a>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="product-info">
                                      <a  class="product-title username direct-chat-name">Género
                                        <span class="text-muted float-right">@if($data->genero=='1') Masculino @else Femenino @endif</span></a>
                                    </div>
                                </div>
                           @endif
                            
                        </div>
                    </div>
                       
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-md-12 col-sm-12">
            <div class="card card-info card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Publicaciones guardadas</a>
                  </li>
                  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                        @if (isset($listaGuar))
                         <div class="card-body table-responsive">
                           <div class="row">
                             @foreach ($listaGuar as $art )
                               @if(isset($art->articulo_user[0]))
                                 <div class="col-xl-6 col-sm-12 col-md-6  d-flex align-items-stretch flex-column borrar">
                                   <div class="card d-flex flex-fill card card-outline card-primary mt-3 mr-3">
                                     <div class="card-header text-muted border-bottom-0">
                                        <h1 class="card-title"> Option2Health </h1>
                                        <a href="{{url('medico/info/'.encrypt($art->articulo_user[0]['iduser']))}}">
                                           <div class="medico" style="cursor: pointer;" >
                                             <img src="https://option2health.com/assets/img/logo.png" class="rounded mx-auto d-block img2">
                                               <small> <b>Dr. O2H</b> </small>
                                           </div>
                                        </a>
                                     </div>
                                     <div class="card-body pt-0 ">
                                       <div class="row">
                                         <div class="col-lg-12">
                                           <h2 class="lead mt-3"><b>{{$art->articulo_user[0]['titulo']}}</b></h2>
                                           <p class="text-muted text-sm text-justify">
                                             {{$art->articulo_user[0]->descripcion}} <a href="{{$art->articulo_user[0]->vinculo_art}}" target="_blank">Ver más... </a></p> 
                                         </div>
                                         <div class="embed-responsive embed-responsive-16by9">
                                           <iframe width="560" height="315" src="{{$art->articulo_user[0]->url_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                         
                                         </div>
                                       </div>
                                     </div>
                                     
                                     <div class="card-footer">
                                       <div class="row">
                                         <div class="col-lg-4 col-md-4 col-sm-12 mb-2 card-outline ">
                                           <button type="button" onclick="putLike_poin('{{encrypt($art->articulo_user[0]->idarticulo)}}',this )"  class=" @if(isset($art->articulo_user[0]->like[0])) btn btn-block btn-sm bg-gradient-info btn-sm @else btn btn-outline-info btn-block btn-sm @endif "> <i class=" fa fa-heartbeat"></i>
                                             <span class="badge ">{{$art->articulo_user[0]->like_count}}</span>
                                             like 
                                           </button>

                                         </div>
                                         <div class="col-lg-4 col-md-4 col-sm-12  mb-2  ">
                                           <div class="dropdown text-right">
                                             <button class="btn btn-outline-info  dropdown-toggle btn-sm btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fa fa-share-alt"></i> Compartir
                                             </button>
                                             <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                               <button class="dropdown-item" type="button"> <i class="fab fa-facebook"></i> Facebook</button>
                                               <button class="dropdown-item" type="button"><i class="fab fa-whatsapp"></i> Whatsapp</button>
                                             </div>
                                           </div>
                                         </div>
                                         <div class="col-lg-4 col-md-4 col-sm-12  ">
                                           <div class="dropdown text-right">
                                             <button class="btn  btn-outline-info dropdown-toggle  btn-sm btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fa fa-info-circle"></i> Ver más
                                             </button>
                                             <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                               <button class="dropdown-item" type="button" onclick="quitarArt('{{encrypt($art->articulo_user[0]->idarticulo)}}',this)"> <i class="fa fa-eraser"></i> Quitar</button>
                                               <button class="dropdown-item" type="button"><i class="fa fa-phone"></i> Contacto Online</button>
                                               <button class="dropdown-item" type="button"><i class="fab fa-whatsapp"></i> Contacto Whatsapp</button>
                                             </div>
                                           </div>
                                         </div>
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                               @endif
                                   
                             @endforeach
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

    {{-- Modal --}}
        <!-- Modal -->
        <div class="modal fade" id="modalSg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h5 class="modal-title text-center" id="exampleModalLabel">Seguidos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pre-scrollable" id="asingSe">
                <div class="form-group mt-3">
                    <div class="product-info">
                      <a  class="product-title username direct-chat-name hover">Seguidos
                        <span class="text-muted float-right text-red">
                           <button type="button"  class="btn btn-block btn-outline-secondary btn-sm">Siguiendo</button>
                        </span></a>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
              </div>
            </div>
          </div>
        </div>
    <!-- Modal -->
    

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
    <script>
        $('.select2').select2();
    </script>
        <script src="{{ asset('/js/controlLike.js') }}"></script>
        <script src="{{ asset('/js/gestionSaveArt.js') }}"></script>
    @stop
@stop