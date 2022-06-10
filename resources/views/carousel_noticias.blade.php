<div id="carouselExampleIndicators" class="carousel slide  border-bottom  ml-5 mr-5 mb-4" data-ride="carousel">
  <ol class="carousel-indicators carousel-indicators_noti mt-5">
    @if(isset($listaNoticia))
      @foreach($listaNoticia as $key=>$noti)
        @if($loop->iteration-1==0)
          <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->iteration-1}}" class="active bg-info rounded-circle" ></li> 
        @else
          <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->iteration-1}}" class="bg-info rounded-circle" ></li>
        @endif
      @endforeach   
    @endif
  </ol>
  <div class="carousel-inner mb-5" >
    @if(isset($listaNoticia)) 
      @foreach($listaNoticia as $key=>$noti)
          <div class="carousel-item  @if($loop->iteration==1) active @endif ">
            <div class="s" >
              <div class="card-body row text-dark">
                <div class="col-md-7 col-sm-12 text-center ">
                  <div class="ml-5 mr-5 ">
                    <div  class="w-75 mx-auto    border border-white ">
                      <img class=" card-img-top img-not" src=" @if(isset($noti[0]->img)){{ $img=\Storage::disk('wasabi')->temporaryUrl( $noti[0]->img, now()->addMinutes(3600))}}@else{{ asset('img/error.png')}} @endif " alt="Photo">
                    </div>
                    <h3 class="mt-4 title-notice">
                      <strong>
                        <p>{{$noti[0]['titulo']}} | {{ Str::limit($noti[0]['autor'], 38,'...')}}</p>
                      </strong> 
                    </h3>
                    <p class=" mb-3 mt-3 text-justify detalle-notice">
                      {{ Str::limit($noti[0]['descripcion'], 228,'...') }}<br>
                      <a href="{{url('noticia/ver/'.$noti[0]['idnoticia_encryp'])}}">ver mas...</a>
                    </p>
                  </div>   
                </div>
                @movil
                  <div class="col-lg-5 col-md-5 col-sm-12  ">
                    @if(isset($noti))
                      <div id="slider_noticia" class="draggable-slider " >
                        <div class="inner">
                          @foreach($noti as $key=>$item)
                            {{-- @if($key!=0) --}}
                              <div class="slider">
                                <img src="{{$img=\Storage::disk('wasabi')->temporaryUrl( $item['img'], now()->addMinutes(3600))}}" class="img_slide_noti" alt="">
                                <div class="slide_title_noti" >
                                  {{ Str::limit($item['titulo'],55,'... ')}}
                                </div>
                                <div class="slide_des_noti">
                                  <small> {{ Str::limit($noti[0]['autor'], 50,'..') }}</small>
                                </div>
                                {{-- <span class="slide_des_noti">  </span> --}}
                              </div>
                             
                            {{-- @endif  --}}
                          @endforeach   
                        </div>
                      </div>
                    @endif 
                  
                  </div>
                @else
                  <div class="col-lg-5 col-md-5 col-sm-12  ">
                    @if(isset($noti))
                      @foreach($noti->take(4) as $key=>$item)
                        @if($key!=0)
                          <div class="row {{$key}}">
                            <div class="col-4">
                              <img class="img-fluid mb-3" src="{{$img=\Storage::disk('wasabi')->temporaryUrl( $item['img'], now()->addMinutes(3600))}}" alt="Photo">
                            </div>
                           
                            <div class="col-8 m-auto">
                              <div class="row  mr-5 content-item-carrosel m-auto">
                                <p class="attachment-heading  align-content-md-left h5 text-muted attachment_desc">
                                  <a href="{{url('noticia/ver/'.$item['idnoticia_encryp'])}}" class="text-dark">
                                    <b>{{$item['titulo']}}</b> <br>
                                    {{ Str::limit($item['autor'], 30,'...')}}
                                  </a>
                                  {{-- {{ Str::limit($noti[0]['descripcion'], 68,'.') }}...</p> --}}
                              </div>
                             
                            </div>
                          </div>  
                        @endif  
                      @endforeach
                    @endif
                  </div>
                @endmovil
              </div>
            </div>
          </div>
      @endforeach   
    @endif
  </div>
  <a class="carousel-control-prev text-dark d-none" style="width:60px; " href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-custom-icon d-none" aria-hidden="true">
      <i class="fas fa-chevron-left"></i>
    </span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" style="width:60px; " href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-custom-icon d-none" aria-hidden="true">
      <i class="fas fa-chevron-right"></i>
    </span>
    <span class="sr-only">Next</span>
  </a>
</div>

