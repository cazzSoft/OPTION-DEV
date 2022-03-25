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
          <img class="img-fluid pad" src="{{asset('PortadaNoticia/'.$noticia['img'])}}" alt="Photo">
          
          <ul class="mt-2 mb-0 fa-ul text-muted text-center">
            <li class="small"> <b>Fecha publicación:</b>{{$noticia->created_at->isoFormat('lll')}}</li>
            <li class="small"> <b>Autor:</b> {{$noticia['autor']}} </li>
            <li class="small"> <b>Fuente:</b> {{$noticia['fuente']}}</li>
          </ul>
          
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col ">
        <div class="description text-justify" style="white-space: pre-line;">

          {{$noticia['descripcion']}}
          En las próximas semanas, seremos médicos residentes de cuarto año. El último para muchas especialidades, el penúltimo para otras. Me refiero a todos los médicos graduados que comenzamos la especialidad en el mes de mayo de 2019 y que vimos como unos meses después de comenzar se unía, como coR inesperado, un nuevo compañero: el virus SARS-Cov-2.  

          Y es que aunque se incorporó con retraso a nuestras vidas de residente, lo hizo de forma estrepitosa y revolucionaria, y ha marcado, para siempre, nuestra formación como médicos especialistas(1). 

          En estas líneas reflexiono sobre las consecuencias de la pandemia por COVID19 en nuestra vida profesional como residentes de un hospital de tercer nivel de Madrid. Preguntas como: ¿Cómo ha afectado a nuestra formación? ¿Ha sido todo negativo? ¿Para que nos ha servido? ¿Qué hemos aprendido? 

          En definitiva, preguntas que nos hemos estado haciendo todos los residentes que hemos vivido esta situación y que seguramente no tienen respuestas unívocas. Precisamente por esto, pienso que cada experiencia personal aporta una visión valiosa de la que podemos extraer enseñanzas para nuestro futuro y esta es la motivación para compartir mi vivencia. 

          Lo primero fueron los cambios. ¿Acabábamos de empezar y ya había cambios? Por suerte no nos habíamos acostumbrado a nada, todavía.

          Una de las primeras medidas fue la reorganización de personal del hospital, dejábamos de pertenecer a nuestros servicios y pasábamos a formar parte de un pull global de facultativos dispuestos a luchar contra lo que venía. Sin importar especialidad ni cargo.  Tampoco era un mal plan para un R1 recién llegado ¿no? Al menos ese fue mi planteamiento, como algo que podía enriquecer mi experiencia sanitaria y asistencial más allá de lo que me iba a ofrecer mi propia especialidad que apenas había tenido oportunidad de conocer aún. 

          Esto implico trabajar, mano a mano, con residentes mayores, adjuntos, jefes de sección y de servicio, de cualquier especialidad allá donde hiciera falta. Medicina de guerra lo llamaban ¿en La Paz? Todo un guiño del destino. 
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
                <img class="attachment-img" src="{{asset('PortadaNoticia/'.$item['img'])}}" alt="Attachment Image">
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
