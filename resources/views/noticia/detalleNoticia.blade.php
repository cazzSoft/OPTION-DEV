@extends('homeOption2h')
@section('title','Noticia Detalle')

@section('contenido')
  @movil
    <div class="row">
      <div class="col-12">
          <div class="d-flex justify-content-start  flex_titulo mb-3">
            <a href="/">  <p class=" text-lead h2 text-info_ ">  <i class="fas fa-chevron-left  text-info_ "></i>  Noticias  </p></a>    
          </div>
      </div>
      <div class="col">
         <p class="title_notice ">@if(isset($noticia)) {{$noticia['titulo']}} @endif</p>
      </div>
    </div>
  @else 
  <div class="row">
    <div class="col">
        <p class=" text-lead  text-info_ text-center mb-3 text-truncate flex_titulo">  
           <a href="/"> <i class="fas fa-chevron-left  text-info_ float-left  mr-2 mt-1"></i></a>
           <b class="text-center mr-5"> @if(isset($noticia)) {{$noticia['titulo']}} @endif </b>
        </p>
    </div>
  </div>
  @endmovil
  <div class="container ">
    <div class="row">
      <div class="col text-center">
        <div   class="w-75 mx-auto  border border-white ">
          <img class="img-fluid pad " src="{{ $img=\Storage::disk('wasabi')->temporaryUrl( $noticia['img'], now()->addMinutes(3600))}}" alt="Photo">
          <ul class="mt-2 mb-0 fa-ul text-muted text-center cita_notice">
            <li class="small"> <b>Fecha publicación:</b>{{$noticia->created_at->isoFormat('lll')}}</li>
            <li class="small"> <b>Autor:</b> {{$noticia['autor']}} </li>
            @if(isset($noticia['fuente']) && $noticia['fuente']!=null )
              <li class="small"> <b>Fuente:</b> {{$noticia['fuente']}}</li>
            @endif
            
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col ">
        <div class="description text-justify">
          {{$noticia['descripcion']}}
        </div>
      </div>
    </div>  
  </div>
  
  <div class=" container mt-5">
    <div class=" row col text-dark col align-self-end  h2">También te podría interesar</div>
  </div>

  <div class="container  mt-4 mb-5">
    @if(isset($recoment)) 
        @movil
          <div class="col-lg-12 col-md-5 col-sm-12  ">
            @if(isset($recoment))
              <div id="slider_noticia" class="draggable-slider slider" >
                <div class="inner">
                  @foreach($recoment as $key=>$item)
                      <a href="{{url('noticia/ver/'.$item['idnoticia_encryp'])}}" class="text-dark">
                        <div class="slider">
                          <img src="{{$img=\Storage::disk('wasabi')->temporaryUrl( $item['img'], now()->addMinutes(3600))}}" class="img_slide_noti" alt="">
                          <div class="slide_title_noti" >
                            {{ Str::limit($item['titulo'],68,'... ')}}
                          </div>
                        </div>
                      </a>
                  @endforeach   
                </div>
              </div>
            @endif 
          
          </div>
        @else
          <div class="col-lg-12 col-md-5 col-sm-12  ">
            <div class="row ">
              @foreach($recoment as $key=>$item)
                <div class="col-6">
                  <div class="row ">
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
                        </p>
                      </div>
                     
                    </div>
                  </div> 
                </div>
                 
              @endforeach
            </p>
         </div>  
        @endmovil
    @endif
  </div>


 
  {{-- Seccion para insertar css--}}
  @section('include_css') 
     {{-- aqui ingrese otros stilos --}}
       <link rel="stylesheet" href="https://unpkg.com/flickity@2.3.0/dist/flickity.css">
        <link rel="stylesheet" href="{{ asset('css/detalle_noticia.css') }}">
  @stop  

  {{-- Seccion para insertar js--}}
  @section('include_js')

    {{-- script para la gestion de noticias --}}
    <script src="{{ asset('/js/noticia.js') }}"></script>
    <script src="{{ asset('/js/slider.js') }}"></script> 
    <script src="https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js"></script>
    <script >
      $('.main-carousel').flickity({
        // options
        cellAlign: 'center',
        contain: true
      });
    </script>

    <script >
      const slider_noticia = new DraggableSlider('slider_noticia');
    </script>
  @stop


@stop
