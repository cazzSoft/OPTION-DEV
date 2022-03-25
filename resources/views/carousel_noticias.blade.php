<div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
  <ol class="carousel-indicators ">
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
  <div class="carousel-inner ">
    @if(isset($listaNoticia))
      @foreach($listaNoticia as $key=>$noti)
          <div class="carousel-item  @if($loop->iteration==1) active @endif ">
            <div class="card rounded-0" >
              <div class="card-body row text-dark">
                <div class="col-md-7 col-sm-12 text-center ">
                  <div class="ml-5 mr-5 ">
                      <div   class="w-75 mx-auto    border border-white ">
                        <img class=" card-img-top" src=" @if(isset($noti[0]->img)){{asset('PortadaNoticia/'.$noti[0]->img)}}@else{{ asset('FotoPerfil/user.png')}} @endif " alt="Photo">
                      </div>
                      <h3 class="mt-4 ">
                        <strong>
                          <p>{{$noti[0]['titulo']}}</p>
                        </strong> 
                      </h3>
                      <p class="lead mb-5 mt-3 text-justify">
                        {{ Str::limit($noti[0]['descripcion'], 228,'.') }}... <br>
                        <a href="{{url('noticia/ver/'.$noti[0]['idnoticia_encryp'])}}">ver mas...</a>

                      </p>
                    
                  </div>   
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 {{-- pre-scrollable --}}" {{-- style="max-height: 640px;" --}}>
                  @if(isset($noti))
                    @foreach($noti->take(4) as $key=>$item)
                      
                      <div class="row ">
                        <div class="col-4">
                          <img class="img-fluid mb-3" src="{{asset('PortadaNoticia/'.$item['img'])}}" alt="Photo">
                        </div>
                       
                        <div class="col-8 ">
                          <div class="row justify-content-md-center mr-5 content-item-carrosel">
                            <p class="attachment-heading  align-content-md-center h4 attachment_titulo"> 
                              <a href="{{url('noticia/ver/'.$item['idnoticia_encryp'])}}" class="text-dark">{{$item['titulo']}}</a>
                            </p>
                            <p class="attachment-heading  align-content-md-left h5 text-muted attachment_desc">  {{ Str::limit($noti[0]['descripcion'], 68,'.') }}...</p>
                          </div>
                         
                        </div>
                      </div>  
                    @endforeach
                  @endif
                    

                </div>
              </div>
            </div>
          </div>
      @endforeach   
    @endif

    
    
   {{--  <div class="carousel-item">
      <div class="card rounded-0" >
        <div class="card-body row text-dark">
          <div class="col-md-7 col-sm-12 text-center ">
            <div class="ml-5 mr-5 ">
              <img class="img-fluid " src="/img/Imagen1.png" alt="Photo">
              <h3 class="mt-4 ">
                <strong>
                  <p>Physicians Say Covid-19 Has Triggered a 
                   Drinking Problem
                  </p>
                </strong> 
              </h3>
              <p class="lead mb-5 mt-3">
                The daily repetitiveness of the pandemic, the increase in stress, the decrease in seeing friends and family—these scenarios may have contributed to an increase in alcohol consumption for many people. For some, the sudden disappearance…
                Ver más...
              </p>
            </div>
                
          </div>
          <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="row">
              <div class="col-4">
                <img class="img-fluid mb-3" src="/img/photo2.png" alt="Photo">
              </div>
             
              <div class="col-8 ">
                <div class="row justify-content-md-center mr-5 ">
                  <p class="attachment-heading  align-content-md-center h4"> MENIEREENFERMEDAD DE MENIEREENFERMEDAD DE MENIERE <br> </p>
                  <p class="attachment-heading  align-content-md-center h5 text-muted"> DR. MATIAS HERNANDORENA ENFERMEDAD DE MENIERE</p>
                </div>
               
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <img class="img-fluid mb-3" src="/img/photo2.png" alt="Photo">
              </div>
             
              <div class="col-8 ">
                <div class="row justify-content-md-center mr-5 ">
                  <p class="attachment-heading  align-content-md-center h4"> MENIEREENFERMEDAD DE MENIEREENFERMEDAD DE MENIERE <br> </p>
                  <p class="attachment-heading  align-content-md-center h5 text-muted"> DR. MATIAS HERNANDORENA ENFERMEDAD DE MENIERE</p>
                </div>
               
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <img class="img-fluid mb-3" src="/img/photo2.png" alt="Photo">
              </div>
             
              <div class="col-8 ">
                <div class="row justify-content-md-center mr-5 ">
                  <p class="attachment-heading  align-content-md-center h4"> MENIEREENFERMEDAD DE MENIEREENFERMEDAD DE MENIERE <br> </p>
                  <p class="attachment-heading  align-content-md-center h5 text-muted"> DR. MATIAS HERNANDORENA ENFERMEDAD DE MENIERE</p>
                </div>
               
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <img class="img-fluid mb-3" src="/img/photo2.png" alt="Photo">
              </div>
             
              <div class="col-8 ">
                <div class="row justify-content-md-center mr-5 ">
                  <p class="attachment-heading  align-content-md-center h4"> MENIEREENFERMEDAD DE MENIEREENFERMEDAD DE MENIERE <br> </p>
                  <p class="attachment-heading  align-content-md-center h5 text-muted"> DR. MATIAS HERNANDORENA ENFERMEDAD DE MENIERE</p>
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
  </div>
  <a class="carousel-control-prev text-dark " style="width:60px; " href="#carouselExampleIndicators" role="button" data-slide="prev">
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