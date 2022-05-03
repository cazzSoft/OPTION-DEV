@extends('homeOption2h')
@section('title','Noticia Detalle')

@section('contenido')
  
  <div class="row">
    <div class="col">
        <p class=" text-lead h3 text-info text-center mb-3">  
           <a href="/"> <i class="fas fa-chevron-left  text-info float-left ml-5"></i></a>
           <b class="text-center mr-5"> @if(isset($noticia)) {{$noticia['titulo']}} @endif </b>
        </p>
    </div>
  </div>
  <div class="container ">
    <div class="row">
      <div class="col text-center">
        <div   class="w-75 mx-auto  border border-white ">
          <img class="img-fluid pad" src="{{ $img=\Storage::disk('wasabi')->temporaryUrl( $noticia['img'], now()->addMinutes(3600))}}" alt="Photo">
          
          <ul class="mt-2 mb-0 fa-ul text-muted text-center">
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
        <div class="description text-justify" style="white-space: pre-line;">

          {{$noticia['descripcion']}}
          
        </div>
      </div>
    </div>  
  </div>
  
  <div class=" container mt-5">
    <div class=" row col text-dark col align-self-end  h2">También te podría interesar</div>
    
  </div>

  <div class="container  mt-5 mb-5">
    
    @if(isset($recoment))
     
         <div class="main-carousel " data-flickity='{ "cellAlign": "left", "contain": true }'>
          @foreach($recoment as $item)
            <div class="carousel-cell col-5">
              <div class="attachment-block clearfix border-0">
                <img class="attachment-img" src="{{$img=\Storage::disk('wasabi')->temporaryUrl( $item->img, now()->addMinutes(3600))}}" alt="Attachment Image">
                <div class="attachment-pushed">
                  <h4 class="attachment-heading"><a class="text-dark" href="{{url('noticia/ver/'.$item['idnoticia_encryp'])}}">
                    {{$item['titulo']}}</a></h4>
                  <div class="attachment-text">
                    {{ Str::limit($item['descripcion'], 40) }}
                  </div>
                  <!-- /.attachment-text -->
                </div>
                <!-- /.attachment-pushed -->
              </div>
            </div>
          @endforeach
        </div> 
      
    @endif

   
    
  </div>


 
  {{-- Seccion para insertar css--}}
  @section('include_css') 
     {{-- aqui ingrese otros stilos --}}
       <link rel="stylesheet" href="https://unpkg.com/flickity@2.3.0/dist/flickity.css">

     
  @stop  

  {{-- Seccion para insertar js--}}
  @section('include_js')

    {{-- script para la gestion de noticias --}}
    <script src="{{ asset('/js/noticia.js') }}"></script>
    <script src="https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js"></script>
    <script >
      $('.main-carousel').flickity({
        // options
        cellAlign: 'center',
        contain: true
      });
    </script>
  @stop


@stop
