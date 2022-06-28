@extends('homeOption2h')
@section('title','Médico-info')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)

{{-- cuerpo de la pagina --}}
@section('contenido') 
  
  <div class="row mt-0 justify-content-md-center">
    {{-- <div class="col-lg-3 col-md-1 col-sm-12 col-xs-12 ">
      
    </div> --}}
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 div-perfil " > 
      <div class="card card-widget widget-user ">
          <div class="widget-user-header text-white text-left" 
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
              {{-- <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
              <h5 class="widget-user-desc text-right">Web Designer</h5> --}}
          </div>
          <div class="widget-user-image p-0  mr-5 " style="/*margin-left:-46%*/;">
            @if(asset($datos_p['img']) && $datos_p['img']!=null)
              <img class="img-circle img-fluid p-1 bg-light" id="preViewImg" 
                src="
                      @if(\Storage::disk('diskDocumentosPerfilUser')->exists($datos_p->img)) 
                        {{ asset($datos_p->img)}}
                      @else 
                        {{ \Storage::disk('wasabi')->temporaryUrl($datos_p->img, now()->addMinutes(3600)  )}}
                      @endif
                    " 
                alt="User-perfil" 
              >
            @else 
              <img class="img-circle img-fluid p-1" id="preViewImg" src="{{asset('img/user.png')}}" alt="User-perfil" >
            @endif
          </div>
        
          <div class="widget-user-header  text-left mt-3" style="height: auto;">
             @if(isset($datos_p))
              <div class="row">
                <div class="col-sm-12 mt-2 ">
                    <p class=" mt-5 ml-2 mb-3 h3 profile-username text-truncate">
                        <b>{{$datos_p->name}} 
                        </b>
                    </p>
                    <h6 class="widget-user-desc mx-0 ml-2 detalle-perfil">
                      @if(isset( $datos_p['idtitulo_profesional'] ))
                        {{$datos_p->titulo['descripcion']}}
                      @endif  |
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
                  <div class="col-md-7  col-sm-12 detalle-perfil">
                      <h6 class="widget-user-desc mx-0 ml-2">
                          <span class="detalle-perfil">@if(isset($publicaciones))  <b>{{$publicaciones}}</b> @endif</span> publicaciones   
                          <span class="ml-4 detalle-perfil"><b>@if(isset($seguidores)) {{$seguidores}} @endif</b> @if($seguidores==1)seguidor @else seguidores @endif</span>
                      </h6>
                      <span class="ml-2 well well-sm shadow-none">Teléfono: {{$datos_p->telefono}}</span><br>
                      <span class="ml-2 well well-sm shadow-none">Email: {{$datos_p->email}}</span><br>
                      <span class="ml-2 tag tag-info">Dirección: {{$datos_p->direccion}}</span>
                      
                  </div>
                  <div class="col-md-5  mt-2 align-self-end col-sm-12  ">
                      <p class="text-muted text-letf ml-2 detalle-perfil">Sígueme en:</p>
                      <div class="text-leth mb-3 redes-icons">
                          <a  href="{{$datos_p->link_stg}}" onclick="acctionSociales('{{encrypt($datos_p['id'])}}','Twitter')" target="”_blank”" class="btn  border-0 p-1" ng-if="doctorsee.Twitter!==''">
                            <i class="fab fa-instagram text-info fa-2x"></i>
                          </a>
                          <a href="{{$datos_p->link_fb}}" onclick="acctionSociales('{{encrypt($datos_p['id'])}}','Facebook')" target="”_blank”" class="btn  p-1" ng-if="doctorsee.Facebook!==''">
                              <i class="fab fa-facebook text-info fa-2x"></i>
                          </a>
                          <a href="{{$datos_p->link_lkd}}" onclick="acctionSociales('{{encrypt($datos_p['id'])}}','Linkedin')" target="”_blank”" class="btn p-1 " ng-if="doctorsee.Linkedin!==''" >
                            <i class="fab fa-youtube text-info fa-2x "></i>
                          </a>
                          @if(auth()->user()->id!=$datos_p->id )
                            <a  onclick="gestionSeguir('{{encrypt($datos_p->id)}}',this)" id="btn_seg" class="btn @if(isset($sigue)) btn_seg2 @else btn_seg1 text-white @endif btn-sm pr-5 pl-5 ml-3">
                              <b>    @if(isset($sigue)) Dejar de seguir @else Seguir @endif</b>  
                            </a>
                            
                          @endif
                      </div>
                  </div>
              </div>
            @endif
          </div>
      </div>
      <div class="card card-widget widget-user shadow-md border-white">
        <div class="card-body">
          <p class="title-segn"><b>Acerca de mi</b></p>
          <p class="description">{{$datos_p->detalle_experiencia}} {{$datos_p->institucion}}</p>
          <p class="title-segn"><b>Experiencia</b></p>
          <p class="description">
            @if(isset($datos_p->des_perfil)  )
              <li class="description"> {{$datos_p->des_perfil}}</li>
            @endif
          </p>
        </div>
      </div>
      <div class="card card-widget widget-user shadow-md  card_perf border-white">
        <div class="card-header border-white">
          <p class="h3 title-segn">Publicaciones </p>
          <div class="description_">Aqui tendras un listado de todas las publicaciones que has subido a O2H.</div>
          {{-- <span class="description_">Aqui tendras un listado de todas las publicaciones que has subido a O2H.</span> --}}
        </div>
          @if (isset($listaArt))
            @foreach ($listaArt as $art )
             {{--  <div class="card card-widget  p-3 mx-3 mt-2 border-white shadow-md">
                <div class="card-header border-0 pb-0">
                  <div class="user-block text-dark">
                    <a href="{{url('medico/info/'.encrypt($art['iduser']))}}" >
                      <img class="img-circle img-md" src="@if(isset($art['medico'][0]['img']) && $art['medico'][0]['img'] !=null){{  \Storage::disk('wasabi')->temporaryUrl($art['medico'][0]['img'], now()->addMinutes(3600)  )}} @else {{asset('img/user.phg')}} @endif" alt="User Image">
                    </a>
                    <span class="username">{{$art['titulo']}}| <small><b>Tratamiento</b></small></span>
                    <span class="description"><a href="#">{{$art['medico'][0]['name']}} </a>- {{$art->created_at->isoFormat('lll') }}</span>
                  </div> 
                </div>

                <div class="card-body card-body-perf">
                  <p class="text-justify text-dark text-descript-publicaciones">
                    {{$art['descripcion']}} <a href="{{$art['vinculo_art']}}" target="_blank" onclick="acctionVermas('{{encrypt($art['idarticulo'])}}')">Ver más... </a>
                  </p> 
                  <div class="embed-responsive embed-responsive-16by9"  onmouseleave ="acctionVideo('{{encrypt($art['idarticulo'])}}',this)" >
                    <iframe id=""  width="560" height="315" src="{{$art['url_video']}}"  frameborder="0" allowtransparency="true" allowfullscreen ></iframe>
                  </div>
                </div>
                
                <div class="card-footer p-0">
                  <div class="row justify-content-end">
                    <div class="col-lg-12 text-right p-0 ">
                      <button type="button"  onclick="putLike_poin('{{encrypt($art['idarticulo'])}}',this )" class=" btn btn-app border-0">
                        <i class=" fa fa-heartbeat @if(isset($art['like'][0])) icon-info    @else   @endif  "></i> 
                        <span >{{$art['like_count']}} </span> Me gusta 
                      </button>
                    
                    
                      <div class="dropdown text-right float-right mr-4">
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
                    
                    
                      <div class="dropdown text-right float-right">
                        <button class="btn border-0 btn-app dropdown-toggle  btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class=" fa fa-bookmark"></i>Guardar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                          <button class="dropdown-item" type="button" onclick="saveArtUser('{{encrypt($art['idarticulo'])}}')"> <i class="fa fa-save"></i> Guardar</button>
                          <button class="dropdown-item" type="button" onclick="acctionContacOnline('{{encrypt($art['idarticulo'])}}')"><i class="fa fa-phone"></i> Contacto Online</button>
                          <button class="dropdown-item" type="button" onclick="acctionContactW('{{encrypt($art['idarticulo'])}}')"><i class="fab fa-whatsapp"></i> Contacto Whatsapp</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> --}}

              <div class="jumbotron jumbotron-fluid m-4">
                {{-- <div class="container p-0"> --}}
                  <h1 class="titulo_publicacion m-0 p-0">  
                    <span class="username">{{$art['titulo']}}</span><br>
                  </h1>
                  <span class="description mt-4 mb-4">
                   <small>{{$art->created_at->isoFormat('lll') }}</small>
                  </span>
                  <p class="description mt-3">{{$art['descripcion']}} {{-- <a href="{{$art['vinculo_art']}}" target="_blank" onclick="acctionVermas('{{encrypt($art['idarticulo'])}}')">Ver más... </a> --}}</p>
                  <p class="description mt-3">{{$art->causas}} </p>
                  <p class="description mt-3"> Afecta {{$art->afecta_desc}} </p>
                {{-- </div> --}}
              </div>

            @endforeach
             
            <div class="form-group text-center mx-auto ">
               {{-- {{ $articulos->links() }} --}}
            </div>
          @endif
      </div>
    </div>
  </div>



    @section('include_css') 
      <link rel="stylesheet" href="{{ asset('css/info_doc.css') }}">
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')

      {{-- controlar imagen de rotas --}}
       <script src="{{ asset('/js/control_img_rotas.js') }}"></script>
       
      <script src="{{ asset('/js/controlLike.js') }}"></script>
      <script src="{{ asset('/js/gestionSaveArt.js') }}"></script>
    @stop


@stop
