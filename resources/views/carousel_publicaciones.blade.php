<div id="sliderPubli" class="carousel slide   ml-5 mr-5 " data-ride="carousel">
  
  <ol class="carousel-indicators mt-5">
    @if(isset($articulos))
      @foreach($articulos as $key=>$art)
        @if($loop->iteration-1==0)
          <li data-target="#sliderPubli" data-slide-to="{{$loop->iteration-1}}" class="active bg-info rounded-circle" ></li> 
        @else
          <li data-target="#sliderPubli" data-slide-to="{{$loop->iteration-1}}" class="bg-info rounded-circle" ></li>
        @endif
      @endforeach   
    @endif
  </ol>
  <div class="carousel-inner">
    @if(isset($articulos)) 
      @foreach($articulos as $key=>$art)
          <div class="carousel-item  @if($loop->iteration==1) active @endif mb-5">
            @if(isset($art['medico'][0]['img']))
                <div class="card card-widget border-0 shadow w-50 m-auto ">
                  <div class="card-header border-0">
                    <div class="user-block text-dark">
                      <a href="{{url('medico/info/'.encrypt($art['iduser']))}}" >
                      <img class="img-circle" 
                        src="
                          @if(isset($art['medico'][0]['img']) && $art['medico'][0]['img']!=null)
                            @if(\Storage::disk('diskDocumentosPerfilUser')->exists($art['medico'][0]['img'])) 
                                {{ asset($art['medico'][0]['img'])}}
                            @else 
                              {{ \Storage::disk('wasabi')->temporaryUrl($art['medico'][0]['img'], now()->addMinutes(3600)  ) }}
                            @endif
                          @else 
                            {{ asset('img/user.png')}}
                          @endif
                          " 
                        alt="User Image">
                      </a>
                      <span class="username">{{$art['titulo']}}| Tratamiento</span>
                      <span class="description"><a href="{{url('medico/info/'.encrypt($art['iduser']))}}">{{$art['medico'][0]['name']}} </a>- @if(isset($art->created_at)) {{$art->created_at->isoFormat('lll') }} @endif </span>
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
                  
                  <div class="card-footer p-0 ">
                      <div class="row justify-content-end">
                        <div class="col-lg-12 text-right p-0">
                          <button type="button"  onclick="putLike_poin('{{encrypt($art['idarticulo'])}}',this )" class=" btn btn-app border-0">
                            <i class=" fa fa-heartbeat @if(isset($art['like'][0])) icon-info    @else   @endif  "></i>  {{-- {{$art['like_count']}} Me gusta --}}
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
          </div>
      @endforeach   
    @endif
  </div>

  <a class="carousel-control-prev " href="#sliderPubli" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon d-none" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#sliderPubli" role="button" data-slide="next">
    <span class="carousel-control-next-icon d-none" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>


</div>
<div class="form-group ml-5  m-auto text-center mb-5 pb-5">
  <a class="btn  bgz-info rounded  shadow-sm mt-1 pr-5 pl-5  btn-sm btn-ver-mas-publi" Width="208px"    href="session" >
    <b class="h6 text-calibri">Ver más</b>
  </a>
</div> 