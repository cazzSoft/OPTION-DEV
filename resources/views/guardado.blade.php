@extends('homeOption2h')
@section('title','Art.guar.')

{{--para activar los plugin en la view  --}}
@section('plugins.Select2',false)
@section('plugins.Sweetalert2',false)
@section('plugins.toastr',true)


{{-- cuerpo de la pagina --}}
@section('contenido') 

    {{-- @section('content_header')
        <h1 ><b>Artículos Guardados</b> <i class="fa fa-save"></i> </h1>
    @stop --}}
       <div class="card">

         <div class="card-header">
            <div class="row">
              <div class="col-md-4">
                <form action="{{url('gestion/search_user_art')}}" method="POST"> 
                  {{ csrf_field() }}
                  <input id="method_" type="hidden" name="_method" value="POST"> 
                  <div class="input-group ">
                    <input type="Search" class="form-control" name="search_user" value="@if(isset($search_user)) {{$search_user}} @endif">
                    <div class="input-group-append">
                       <button class="input-group-text " type="submit"> <i class="fas fa-search"></i> </button>
                    </div>
                  </div>
                </form> 
              </div>
              <div class="col-md-8 text-right">
                <small class="text-muted mr-2">Lista de artículos guardado.</small>
              </div>
            </div>
            
         </div>
         @if (isset($listaGuar))
          <div class="card-body table-responsive">
            <div class="row">
              @foreach ($listaGuar as $art )
                @if(isset($art->articulo_user[0]))
                  <div class="col-lg-4 col-md-6  col-sm-12  d-flex align-items-stretch flex-column borrar">
                    <div class="card d-flex flex-fill card card-outline card-info mt-5 mr-5">
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
                              {{$art->articulo_user[0]->descripcion}} 
                              <a href="{{$art->articulo_user[0]->vinculo_art}}" target="_blank"  onclick="acctionVermas('{{encrypt($art->articulo_user[0]['idarticulo'])}}')">Ver más... 
                              </a>
                            </p> 
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
                                <a onclick="acctionCompartirF('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"  class="dropdown-item" type="button" href="https://www.facebook.com/sharer/sharer.php?u={{$art->articulo_user[0]['url_video']}}" target="_blank">
                                  <i class="fab fa-facebook" ></i> Facebook
                                </a>
                                 <a onclick="acctionCompartirW('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"  class="dropdown-item" type="button" href="https://api.whatsapp.com/send/?phone&text=Hola!.%20Te%20acabo%20de%20compartir%20*{{$art->articulo_user[0]['titulo']}}*%20creo%20que%20te%20podria%20interesar.%20Rev%C3%ADsala:%20https://option2health.com/share.html?prodId={{$art->articulo_user[0]['idarticulo']}}%20%20*Option2health*.&app_absent=0" target="_blank">
                                  <i class="fab fa-whatsapp"></i> Whatsapp 
                                </a>
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
                                <button class="dropdown-item" type="button" onclick="acctionContacOnline('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"><i class="fa fa-phone"></i> Contacto Online</button>
                                <button class="dropdown-item" type="button"  onclick="acctionContactW('{{encrypt($art->articulo_user[0]['idarticulo'])}}')"><i class="fab fa-whatsapp"></i> Contacto Whatsapp</button>
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
