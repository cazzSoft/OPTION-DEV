@extends('homeOption2h')
@section('title','HOME')

{{--para activar los plugin en la view  --}}
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)


{{-- cuerpo de la pagina --}}
@section('contenido')
    <div class="container-fluid ">
        <div class="row  justify-content-start mt-3">
            <div class="col-xl-5 col-md-5 col-sm-12 ">
                <div class="row ">
                    <div class="col-12 p-4 ml-2">
                        <p class="h4"><strong>Datos Personales </strong></p> 
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 p-3 text-center">
                       <div class="text-center button-container dropdown show  ">
                             <img class=" img-fluid img-circle img-bordered-xs " src="{{asset(auth()->user()->adminlte_image())}}" alt="{{asset(auth()->user()->adminlte_image())}}" id="preViewImg2">
                             <span  class="bg-white p-2 img-circle elevation-3" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-plus text-info p-2 "></i></span> 
                             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                 <div class="dropdown-item bg-white mx-auto" >
                                    <form  method="POST" id="update_img_perfil" action="{{url('profile/update_photo')}}"  enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="POST">
                                        <label for="file-upload" class="custom-file-upload p-0">
                                            <i class="fa fa-cloud-upload"></i> Añadir foto
                                        </label>
                                        <input id="file-upload" name="img" class="p-0" type="file"/>
                                    </form>
                                 </div> 
                             </div>
                       </div>
                       {{-- <div class="dropdown show dropleft" >
                         <a class="btn btn-secondary " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           <i class="fas fa-plus text-info p-2 "></i>
                         </a>

                         <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                           <a class="dropdown-item" href="#">Action</a>
                           <a class="dropdown-item" href="#">Another action</a>
                           <a class="dropdown-item" href="#">Something else here</a>
                         </div>
                       </div> --}}
                    </div>
                    <div class="col col-lg-6 bg-white p-3 ">
                        <p class="h4" >  <b>{{$data->name}}</b>  <i class="far fa-edit ml-3 " style="cursor:pointer;" {{--  id="btn_action" --}} data-toggle="modal" data-target="#modal-edit-user"></i></p>
                        <div class="p-1 text-left info_p">
                            @if(isset($data))
                                <dl>
                                    <dd>Email:</dd>
                                    <dd class=" text-muted">{{$data->email}}</dd>
                                </dl>
                                <dl class="mt-4">
                                    <dd>Fecha de Nacimiento:</dd> 
                                    <dd class=" text-muted">{{$data->fecha_nacimiento}} Tienes: {{ \Carbon\Carbon::parse($data->fecha_nacimiento)->age}} años </dd>
                                </dl>
                                <dl class="mt-4">
                                    <dd>Télefono:</dd>
                                    <dd class=" text-muted">{{$data->telefono}} </dd>
                                </dl>
                                <dl class="mt-4">
                                    <dd>Genero:</dd>
                                    <dd class=" text-muted">@if($data->genero=='1') Masculino @else Femenino @endif </dd>
                                </dl>
                                @if($sigues!=0)
                                    <div class="product-info">
                                        <a  class="product-title username direct-chat-name hover">Personas a las que Sigues
                                            <span class="text-muted float-right text-red">
                                               <span class=" btn btn-sm img-fluid img-rounded bg-white border-info " id="btnModalSg"> <b>@if(isset($sigues)) {{$sigues}} @endif</b></span>
                                               
                                            </span>
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="p-0 text-left  form_p d-none">
                            @if(isset($data))
                                <form method="POST" action="{{ url('/profile/user/'.encrypt($data->id) ) }}">
                                    {{ csrf_field() }}
                                    <input id="method_" type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label class="text-muted" for="exampleInputPassword1">Nombres <span class="text-red">*</span> </label>
                                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Name" value="{{$data->name}}" requiered>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-muted" for="exampleInputEmail1">Email <span class="text-red">*</span></label>
                                        <input type="email"   name="email" class="form-control form-control-sm" id="emael" aria-describedby="emailHelp"
                                            placeholder="Enter email" value="{{$data->email}}" requiered  >
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-muted" for="exampleInputEmail1">Télefono  <span class="text-red">*</span></label>
                                                <input type="text"   name="telefono" class="form-control form-control-sm" id="emael" aria-describedby="emailHelp"
                                                    placeholder="Enter Télefono" value="{{$data->email}}" requiered>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-muted" for="exampleInputEmail1">Fecha de Nacimiento <span class="text-red">*</span></label>
                                                <input type="date"   name="fecha_nacimiento" class="form-control form-control-sm" id="emael" aria-describedby="emailHelp"
                                                    placeholder="Enter fecha" value="{{$data->fecha_nacimiento}}" requiered>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-muted" for="exampleInputEmail1">Genero  <span class="text-red">*</span></label>
                                                <select class="form-control select2 form-control-sm" style="width: 100%;"  name="genero">
                                                    <option @if($data->genero==1) selected="selected" @endif  value="1">Masculino</option>
                                                    <option @if($data->genero==0) selected="selected" @endif value="0">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label class="text-muted" for="exampleInputEmail1">Ciudad <span class="text-red">*</span></label>
                                                <select class="form-control select2 form-control-sm" style="width: 100%;"  name="idciudad" data-placeholder="Seleccione Ciudad" >
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
                                    <button type="submit" class="btn btn-info"> <i class=" fa fa-save"></i> Actualizar</button>
                                </form>
                            @endif

                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-xl-6 col-md-7 col-sm-12">
                <nav class="w-100 ">
                  <div class="nav nav-tabs d-flex justify-content-left tab_perfil nav nav-tabs" id="product-tab" role="tablist">
                    <a class=" h5 nav-item nav-link   mr-3 active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="false"> <p class="h4 text-center" ><b>Perfil</b></p></a>
                    <a class="h5 nav-item nav-link   " id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false"> <p class="h4 text-center" ><b>Publicaciones guardadas</b></p></a>
                  </div>
                </nav>
                <div class="tab-content p-0 mt-4" id="nav-tabContent">
                    <div class="tab-pane  show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                        <div class="card card-widget widget-user shadow-md mb-5">
                           
                            <div class="card-body elevation-1">
                                <p class="h5"><b>Datos Médicos</b>  <i class="far fa-edit ml-3 " style="cursor:pointer;"  data-toggle="modal" data-target="#modal-edit-user-dc"></i></p>   
                                <div class="row invoice-info mt-3 p-1">
                                   @if(isset($datos_m)) 
                                    <div class="col-sm-4 invoice-col">
                                      <address>
                                        <dd>Tipo de sangre</dd>
                                        {{$datos_m['tipo_sangre']}}
                                      </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col text-left">
                                      <address>
                                        <dd>Talla</dd>
                                        {{$datos_m['talla']}} m
                                      </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col text-left">
                                      <address>
                                        <dd>Peso</dd>
                                        {{$datos_m['peso']}} kg
                                      </address>
                                    </div>
                                   @endif
                                </div>
                                <div class="row invoice-info mt-4 p-1 mb-5">
                                
                                    <div class="col-sm-12 invoice-col text-muted">
                                      <address>
                                        <dd>Enfermedades en la familia</dd> 
                                         <ul>
                                            <li class="" style="white-space: pre-line;"> @if(isset($datos_m['enfermedades']))  {{$datos_m['enfermedades']}} @else no registrado @endif</li>
                                         </ul>
                                      </address>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                        {{-- <div class="card card-widget widget-user shadow-md">
                           
                            <div class="card-body elevation-1">
                                <p class="h5"><b>Datos Médicos</b>  <i class="far fa-edit ml-3 " style="cursor:pointer;"  id="btn_action"></i></p>   
                                <div class="row invoice-info mt-3 p-1">
                                    
                                    <div class="col-sm-4 invoice-col">
                                      <address>
                                        <dd>Tipo de sangre</dd>
                                        A+
                                      </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col text-left">
                                      <address>
                                        <dd>Talla</dd>
                                        1.76 m
                                      </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col text-left">
                                      <address>
                                        <dd>Peso</dd>
                                        75 kg
                                      </address>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <div class="row invoice-info mt-4 p-1 mb-5">
                                
                                    <div class="col-sm-6 invoice-col">
                                      <address>
                                        <dd>Enfermedades en la familia</dd> 
                                         <ul>
                                             <li>Abuelo con cancer de prostata</li>
                                         </ul>
                                      </address>
                                    </div>
                                    <div class="col-sm-6 invoice-col">
                                      <address>
                                        <dd>Enfermedades en la familia</dd> 
                                         <ul>
                                             <li>Abuelo con cancer de prostata</li>
                                         </ul>
                                      </address>
                                    </div>
                                
                                </div>
                              
                            </div>
                        </div> --}}
                    </div>
                    <div class="tab-pane fade " id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                        @if (isset($listaGuar) && $listaGuar!='[]') 
                            @foreach ($listaGuar as $art )
                                @if(isset($art->articulo_user[0]))
                                    <div class="card card-widget border-0">
                                        <div class="card-header">
                                            <div class="user-block text-dark">
                                                <a href="{{url('medico/info/'.encrypt($art->articulo_user[0]['iduser']))}}" >
                                                    <img class="img-circle" src="/img/user1-128x128.jpg" alt="User Image">
                                                
                                                    <span class="username">{{$art->articulo_user[0]['titulo']}}| Tratamiento</span>
                                                    <span class="description"><a href="{{url('medico/info/'.encrypt($art->articulo_user[0]['iduser']))}}">{{$art->articulo_user[0]['medico'][0]['name']}} </a>- {{$art->created_at->isoFormat('lll') }}</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <p class="   text-justify text-dark">
                                                {{$art->articulo_user[0]['descripcion']}} <a href="{{$art->articulo_user[0]['vinculo_art']}}" target="_blank" onclick="acctionVermas('{{encrypt($art->articulo_user[0]['idarticulo'])}}')">Ver más... </a>
                                            </p> 
                                            <div class="embed-responsive embed-responsive-16by9"  {{-- onmouseleave ="acctionVideo('{{encrypt($art['idarticulo'])}}',this)"  --}}>
                                                <iframe id=""  width="560" height="315" src="{{$art->articulo_user[0]['url_video']}}"  frameborder="0" allowtransparency="true" allowfullscreen ></iframe>
                                            </div>
                                        </div>
                                        <div class="card-footer p-0">
                                            <div class="row justify-content-end">
                                              <div class="col-lg-12 text-right p-0 ">
                                                <button type="button"  onclick="putLike_poin('{{encrypt($art->articulo_user[0]['idarticulo'])}}',this )" class=" btn btn-app border-0">
                                                    <i class=" fa fa-heartbeat @if(isset($art->articulo_user[0]['like'][0])) icon-info    @else   @endif  "></i>  {{-- {{$art['like_count']}} Me gusta --}}
                                                  <span >{{$art->articulo_user[0]['like_count']}} </span> Me gusta 
                                                </button>
                                               
                                                <div class="dropdown text-right float-right mr-4">
                                                  <button class="btn border-0 btn-app dropdown-toggle  btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class=" fa fa-bookmark"></i>Guardar
                                                  </button>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <button class="dropdown-item" type="button" onclick="saveArtUser('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"> <i class="fa fa-save"></i> Guardar</button>
                                                    <button class="dropdown-item" type="button" onclick="acctionContacOnline('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"><i class="fa fa-phone"></i> Contacto Online</button>
                                                    <button class="dropdown-item" type="button" onclick="acctionContactW('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"><i class="fab fa-whatsapp"></i> Contacto Whatsapp</button>
                                                  </div>
                                                </div>
                                                <div class="dropdown text-right float-right">
                                                  <button class="btn btn-app border-0 dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                                                  <i class="fa fa-share-alt"></i>  Compartir
                                                  </button>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <a onclick="acctionCompartirF('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"  class="dropdown-item" type="button" href="https://www.facebook.com/sharer/sharer.php?u={{$art->articulo_user[0]['url_video']}}" target="_blank">
                                                      <i class="fab fa-facebook" ></i> Facebook
                                                    </a>
                                                     <a onclick="acctionCompartirW('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"  class="dropdown-item" type="button" href="https://api.whatsapp.com/send/?phone&text=Hola!.%20Te%20acabo%20de%20compartir%20*{{$art->articulo_user[0]['titulo']}}*%20creo%20que%20te%20podria%20interesar.%20Rev%C3%ADsala:%20https://option2health.com/share.html?prodId={{ $art->articulo_user[0]['idarticulo_encryp']}}%20%20*Option2health*.&app_absent=0" target="_blank">
                                                      <i class="fab fa-whatsapp"></i> Whatsapp 
                                                    </a>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                            </div>
                                        </div>
                                   </div>
                                @endif   
                            @endforeach
                        @else 
                        <div class="card card-widget border-0 pt-5 ">
                            <div class="card-header">
                                <p class="lead text-center">Aun no tienes publicaciones guardadas</p>
                            </div>
                        </div>
                       
                        @endif 
                    </div>
                </div>
            </div>
        </div>  

    </div>


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
              {{-- <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> --}}
            </div>
          </div>
        </div>
    
    
    @include('modal_edit_user')
    @include('modal-edit-datos-clinico')
    @section('include_css') 
      <style>
        .ocult{
                display: none;
        }
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
        .button-container{
            display:inline-block;
            position:relative;
            text-align: center;
        }
          
        .button-container span{
            position: absolute;
            bottom:1em;
            right:1em;
            background-color:#8F0005;
            border-radius:1.5em;
            color:white;
            text-transform:uppercase;
            padding:1em 1.5em;
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
        #preViewImg2{
            width: 250px;
            height: 250px;
            object-fit: cover;
           
          }

         
         
      </style>
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
        {{-- Mensaje de informacion --}}
        @if(session()->has('info'))
           <script >
             mostrar_toastr('{{session('info')}}','{{session('estado')}}')
           </script>
        @endif

        {{-- textarea estan raros --}}
        @if( isset($datos_m) )
           <script>
                $('#enfermedades').val(`{{$datos_m->enfermedades}}`);
           </script>
        @endif

        <script>
            $('.select2').select2();
            $(".select2-mul").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
        </script>
        <script src="{{ asset('/js/controlLike.js') }}"></script>
        <script src="{{ asset('/js/gestionSaveArt.js') }}"></script>
        <script src="{{ asset('/js/register.js') }}"></script>
    @stop
@stop