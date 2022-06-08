@extends('homeOption2h')
@section('title','Guardado')

{{--para activar los plugin en la view  --}}
@section('plugins.Select2',false)
@section('plugins.Sweetalert2',false)
@section('plugins.toastr',true)


{{-- cuerpo de la pagina --}}
@section('contenido') 
    <div class="container-fluid ">
      @movil
        <div class="row">
          <div class="col-md-12 ">
              <div class=" flex_titulo">
               <a href="/">  <p class=" text-lead h2 text-info_ ">  <i class="fas fa-chevron-left mr-3 text-info_"></i>  Publicaciones Guardadas  </p></a>    
              </div>
          </div>
        </div>
      @else
        <div class="row mt-4 mb-5">
          <div class="col-lg-1 col-xs-1">
            <a href="/" class="text-center " >  <i class="fas fa-chevron-left mr-3 text-info_ fa-2x ml-4"></i></a>    
          </div>
          <div class="col-lg-10">
            <a href="/" class="text-center " > <p class=" text-lead h4 text-info_  text-center">   Publicaciones Guardadas  </p></a> 
          </div>
        </div>
      @endmovil
      <div class="row mt-4 mb-4">
        <div class="col-md-3">
          <form action="{{url('gestion/search_user_art')}}" method="POST" class="ml-4 mb-3"> 
            {{ csrf_field() }}
            <input id="method_" type="hidden" name="_method" value="POST"> 
            <div class="input-group ">
              <input type="Search" class="form-control" name="search_user" value="@if(isset($search_user)) {{$search_user}} @endif" placeholder="Buscar  publicaciones guardadas">
              <div class="input-group-append">
                 <button class="input-group-text " type="submit"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
          </form> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 offset-md-3  ">
          <div class="mt-1">
            @if (isset($listaGuar) && $listaGuar!="[]")  
                @foreach ($listaGuar as $art )
                    @if(isset($art->articulo_user[0]))
                        <div class="card card-widget border-0">
                            <div class="card-header">
                                <div class="user-block text-dark">
                                    <a href="{{url('medico/info/'.encrypt($art->articulo_user[0]['iduser']))}}" >
                                        <img class="img-circle" src="@if(isset($art->articulo_user[0]['medico'][0]['img']) && $art->articulo_user[0]['medico'][0]['img'] !=null) {{\Storage::disk('wasabi')->temporaryUrl($art->articulo_user[0]['medico'][0]['img'], now()->addMinutes(3600) )}} @else {{asset('img/user.png')}}@endif" alt="User Image">
                                    
                                        <span class="username">{{$art->articulo_user[0]['titulo']}}| Tratamiento</span>
                                        <span class="description"><a href="{{url('medico/info/'.encrypt($art->articulo_user[0]['iduser']))}}">{{$art->articulo_user[0]['medico'][0]['name']}} </a>- {{$art->created_at->isoFormat('lll') }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body ">
                                <p class=" text-justify text-dark">
                                    {{$art->articulo_user[0]['descripcion']}} <a href="{{$art->articulo_user[0]['vinculo_art']}}" target="_blank" onclick="acctionVermas('{{encrypt($art->articulo_user[0]['idarticulo'])}}')">Ver más... </a>
                                </p> 
                                <div class="embed-responsive embed-responsive-16by9"  {{-- onmouseleave ="acctionVideo('{{encrypt($art['idarticulo'])}}',this)"  --}}>
                                    <iframe id=""  width="560" height="315" src="{{$art->articulo_user[0]['url_video']}}"  frameborder="0" allowtransparency="true" allowfullscreen ></iframe>
                                </div>
                            </div>
                            <div class="card-footer p-0">
                                <div class="row justify-content-end">
                                  <div class="col-lg-12 text-right p-0">
                                    <button type="button"  onclick="putLike_poin('{{encrypt($art->articulo_user[0]['idarticulo'])}}',this )" class=" btn btn-app border-0">
                                        <i class=" fa fa-heartbeat @if(isset($art->articulo_user[0]['like'][0])) icon-info    @else   @endif  "></i>  {{-- {{$art['like_count']}} Me gusta --}}
                                      <span >{{$art->articulo_user[0]['like_count']}} </span> Me gusta 
                                    </button>

                                    <div class="dropdown text-right float-right mr-4">
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
                                    <div class="dropdown text-right float-right">
                                      <button class="btn border-0 btn-app dropdown-toggle  btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class=" fa fa-bookmark"></i>Guardar
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <button class="dropdown-item" type="button" onclick="saveArtUser('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"> <i class="fa fa-save"></i> Guardar</button>
                                        <button class="dropdown-item" type="button" onclick="acctionContacOnline('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"><i class="fa fa-phone"></i> Contacto Online</button>
                                        <button class="dropdown-item" type="button" onclick="acctionContactW('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"><i class="fab fa-whatsapp"></i> Contacto Whatsapp</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                       </div>
                    @endif   
                @endforeach
            @else 
              
              <div class="alert alert-light alert-dismissible fade show h4 text-justify" role="alert">
                Aún no dispones de publicaciones guaradas. Para guardar las publicaciones que te gusten solo debes darle click al botón de guardar
                <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                @if (isset($mostrar))
                   {{--  @foreach ($mostrar as $art )
                      @if(isset($art['medico'][0]['img']))
                        <div class="card card-widget border-0 ">
                            <div class="card-header">
                              <div class="user-block text-dark">
                                <a href="{{url('medico/info/'.encrypt($art['iduser']))}}" >
                            <img class="img-circle" src="@if(isset($art['medico'][0]['img'])){{$art['medico'][0]['img']}}@else{{ asset('FotoPerfil/user.png')}} @endif" alt="User Image">
                                </a>
                                <span class="username">{{$art['titulo']}}| Tratamiento</span>
                                <span class="description"><a href="{{url('medico/info/'.encrypt($art['iduser']))}}">{{$art['medico'][0]['name']}} </a>- @if(isset($art->created_at)) {{$art->created_at->isoFormat('lll') }} @endif </span>
                              </div>
                              <div class="card-tools">
                               
                              </div> 
                            </div>
                            <div class="card-body ">
                        <p class="   text-justify text-dark">
                            {{$art['descripcion']}} <a href="{{$art['vinculo_art']}}" target="_blank" onclick="acctionVermas('{{encrypt($art['idarticulo'])}}')">Ver más... </a>
                          </p> 
                        <div class="embed-responsive embed-responsive-16by9"  >
                          <iframe id=""  width="560" height="315" src="{{$art['url_video']}}"  frameborder="0" allowtransparency="true" allowfullscreen ></iframe>
                        </div>
                            </div>
                          
                          <div class="card-footer p-0">
                              <div class="row justify-content-end">
                                <div class="col-lg-12 text-right p-0">
                                  <button type="button"  onclick="putLike_poin('{{encrypt($art['idarticulo'])}}',this )" class=" btn btn-app border-0">
                                    <i class=" fa fa-heartbeat @if(isset($art['like'][0])) icon-info    @else   @endif  "></i>  
                                    <span >{{$art['like_count']}} </span> Me gusta 
                                  </button>
                                  
                                  <div class="dropdown text-right float-right mr-4">
                                    <button class="btn border-0 btn-app dropdown-toggle  btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class=" fa fa-bookmark"></i>Guardar
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                      <button class="dropdown-item" type="button" onclick="saveArtUser('{{encrypt($art['idarticulo'])}}')"> <i class="fa fa-save"></i> Guardar</button>
                                      <button class="dropdown-item" type="button" onclick="acctionContacOnline('{{encrypt($art['idarticulo'])}}')"><i class="fa fa-phone"></i> Contacto Online</button>
                                      <button class="dropdown-item" type="button" onclick="acctionContactW('{{encrypt($art['idarticulo'])}}')"><i class="fab fa-whatsapp"></i> Contacto Whatsapp</button>
                                    </div>
                                  </div>
                                  <div class="dropdown text-right float-right ">
                                      <button class="btn btn-app border-0 dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                                        <i class="fa fa-share-alt"></i>  Compartir
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <a onclick="acctionCompartirF('{{encrypt($art['idarticulo'])}}')"  class="dropdown-item" type="button" href="https://www.facebook.com/sharer/sharer.php?u={{$art['url_video']}}" target="_blank">
                                            <i class="fab fa-facebook" ></i> Facebook
                                        </a>
                                        <a onclick="acctionCompartirW('{{encrypt($art['idarticulo'])}}')"  class="dropdown-item" type="button" href="https://api.whatsapp.com/send/?phone&text=Hola!.%20Te%20acabo%20de%20compartir%20*{{$art['titulo']}}*%20creo%20que%20te%20podria%20interesar.%20Rev%C3%ADsala:%20https://option2health.com/share.html?prodId={{ $art['idarticulo_encryp']}}%20%20*Option2health*.&app_absent=0" target="_blank">
                                            <i class="fab fa-whatsapp"></i> Whatsapp 
                                        </a>
                                      </div>
                                  </div>
                                </div>
                                
                              </div>
                          </div>
                        </div>
                        @endif
                    @endforeach --}}
                  <div class="form-group text-center mx-auto ">
                    
                  </div>
                @endif
            @endif
          </div>
        </div>
      </div>
    </div>
       

    @section('include_css') 
       <link rel="stylesheet" href="{{ asset('css/guardado.css') }}">
      <style>
        /*.medico {
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
        }*/
       /* .img2{
          width: 67%;
        }*/
      </style>
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
     <script src="{{ asset('/js/controlLike.js') }}"></script>
      <script src="{{ asset('/js/gestionSaveArt.js') }}"></script>
    @stop
    


 @stop
