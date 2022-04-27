@extends('homeOption2h')
@section('title','Doctors')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)

{{-- cuerpo de la pagina --}}
@section('contenido')
  
  <div class="row mt-1">
    <div class="col-md-3 col-sm-12 col-xs-12 ">
      
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12 {{-- offset-md-2 --}} "> 
     
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
            @if(asset($datos_p->img) && $datos_p['img']!=null)
              <img class="img-circle img-fluid p-1" id="preViewImg" 
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
        
          <div class="widget-user-header bg-white text-left mt-3" style="height: auto;">
             @if(isset($datos_p))
              <div class="row">
                    <div class="col-sm-12 mt-2">
                        <p class=" mt-5 ml-2 mb-3 h3 profile-username ">
                            <b>{{$datos_p->name}} 
                            </b>
                        </p>
                        <h6 class="widget-user-desc mx-0 ml-2">
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
                  <div class="col-md-7  col-sm-12 ">
                      <h6 class="widget-user-desc mx-0 ml-2">
                          <b>@if(isset($publicaciones)) {{$publicaciones}} @endif</b> publicaciones   
                          <span class="ml-4"><b>@if(isset($seguidores)) {{$seguidores}} @endif</b> @if($seguidores==1)seguidor @else seguidores @endif</span>
                      </h6>
                      <span class="ml-2 well well-sm shadow-none">Teléfono: {{$datos_p->telefono}}</span><br>
                      <span class="ml-2 well well-sm shadow-none">Email: {{$datos_p->email}}</span><br>
                      <span class="ml-2 tag tag-info">Dirección: {{$datos_p->direccion}}</span>
                      
                  </div>
                  <div class="col-md-5  mt-2 align-self-end col-sm-12  ">
                      <p class="text-muted text-leth">Sígueme en:</p>
                      <div class="text-leth mb-3 ">
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
                            <a  onclick="gestionSeguir('{{encrypt($datos_p->id)}}',this)" class="btn text-info btn_seg @if(isset($sigue)) btn-outline-info @else bgz-info text-white @endif btn-sm pr-5 pl-5 ml-3">
                              <b>    @if(isset($sigue)) Dejar de seguir @else Seguir @endif</b>  
                            </a>
                            
                          @endif
                      </div>
                  </div>
              </div>
            @endif
          </div>
      </div>
      <div class="card card-widget widget-user shadow-md">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="card-body">
          <p><b>Acerca de mi</b></p>
          <p class="description">{{$datos_p->detalle_experiencia}} {{$datos_p->institucion}}</p>

          <p><b>Experiencia</b></p>
          <p class="description"><li>{{$datos_p->detalle_experiencia}} {{$datos_p->des_perfil}}</li></p>

        </div>
        
      </div>
      <div class="card card-widget widget-user shadow-md">
        <div class="card-header">
          <p class="h3">Publicaciones </p>
          <small>Aqui tendras un listado de todas las publicaciones que has subido a O2H.</small>
        </div>
          @if (isset($listaArt))
              @foreach ($listaArt as $art )
                  <div class="card card-widget border-0 p-3 mx-3 mt-2">
                    
                      <div class="card-header">
                        <div class="user-block text-dark">
                          <a href="{{url('medico/info/'.encrypt($art['iduser']))}}" >
                            <img class="img-circle img-md" src="@if(isset($art['medico'][0]['img']) && $art['medico'][0]['img'] !=null){{  \Storage::disk('wasabi')->temporaryUrl($art['medico'][0]['img'], now()->addMinutes(3600)  )}} @else {{asset('img/user.phg')}} @endif" alt="User Image">
                          </a>
                          <span class="username">{{$art['titulo']}}| Tratamiento</span>
                          <span class="description"><a href="">{{$art['medico'][0]['name']}} </a>- {{$art->created_at->isoFormat('lll') }}</span>
                        </div>
                        <div class="card-tools">
                          {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button> --}}
                        </div> 
                      </div>

                      <div class="card-body ">
                    <p class="   text-justify text-dark">
                      {{$art['descripcion']}} <a href="{{$art['vinculo_art']}}" target="_blank" onclick="acctionVermas('{{encrypt($art['idarticulo'])}}')">Ver más... </a>
                    </p> 
                  <div class="embed-responsive embed-responsive-16by9"  {{-- onmouseleave ="acctionVideo('{{encrypt($art['idarticulo'])}}',this)"  --}}>
                    <iframe id=""  width="560" height="315" src="{{$art['url_video']}}"  frameborder="0" allowtransparency="true" allowfullscreen ></iframe>
                  </div>
                      
                      </div>
                    
                    <div class="card-footer">
                        <div class="row float-right">
                          <div class="col-lg-4 col-md-6 col-sm-12 card-outline ">
                            <button type="button"  onclick="putLike_poin('{{encrypt($art['idarticulo'])}}',this )" class=" btn btn-app border-0">
                              <i class=" fa fa-heartbeat @if(isset($art['like'][0])) icon-info    @else   @endif  "></i>  {{-- {{$art['like_count']}} Me gusta --}}
                              <span >{{$art['like_count']}} </span> Me gusta 
                            </button>
                           
                          </div>
                          <div class="col-lg-4 col-md-6 col-sm-12  ">
                            <div class="dropdown text-right">
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
                          <div class="col-lg-4 col-md-6 col-sm-12  ">
                            <div class="dropdown text-right">
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
                        {{-- <div class="bg-primary float-right">
                          <button type="button"  onclick="putLike_poin('{{encrypt($art['idarticulo'])}}',this )" class="@if(isset($art['like'][0]))btn btn-default btn-sm float-right  @else btn btn-outline-info btn-block @endif "><i class=" fa fa-heartbeat"></i> <br>
                            <span class="badge ">{{$art['like_count']}}</span>
                            Me gusta 
                          </button>

                        </div> --}}
                        
                        
                        {{-- <span class="float-right text-muted">127 likes - 3 comments</span> --}}
                    </div>
                  </div>
              @endforeach
             
            <div class="form-group text-center mx-auto ">
               {{-- {{ $articulos->links() }} --}}
            </div>
          @endif
      </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 {{-- offset-md-2 --}} ">
      
    </div>
  </div>



    
        
    

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
          #preViewImg{
                width: 150px;
                height: 150px;
                object-fit: cover;
            }
        </style>
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
      <script src="{{ asset('/js/controlLike.js') }}"></script>
      <script src="{{ asset('/js/gestionSaveArt.js') }}"></script>
      
    @stop


 @stop
