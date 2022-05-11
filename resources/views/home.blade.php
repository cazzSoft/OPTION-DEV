@extends('homeOption2h')
@section('title','Inicio')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',false)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.daterangepicker',false)
@section('plugins.Select2',true)
{{-- cuerpo de la pagina --}}
@section('contenido')
  
  @guest
    <section class="content">
      <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12"> 
          @include('carousel_info')
        </div>
      </div>
    </section> 
  @endguest

    
  <section class="content">
    <div class="row ">
      <div class="col-lg-12 col-xs-12 text-center">
        <p class="h4 text-info text-center mt-5" style="font-family:  Calibri; color: #13c6ef !important;"><b>Noticias</b></p>
        <p class="h4 text-center lead mb-2 desc-noticia" style="width: 680px; margin:auto;">
          En esta seccion encontraras las más novedosas noticias sobre la comunidad medica, desde nuevos descubrimientos hasta datos curiosos.
        </p>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        @include('carousel_noticias')
      </div>
    </div>
  </section> 

  @auth
    <section>
      <div class="row mt-4 mb-5  border-bottom ml-5 mr-5 mb-5">
        <div class="col-lg-12 col-xs-12 text-center">
          <p class="h4 text-info text-center mt-5" style="font-family:  Calibri; color: #13c6ef !important;"><b>Médicos</b></p>
          <p class="h4 text-center lead mb-2 desc-noticia" style="width: 680px; margin:auto;">
           En esta seccion encontraras un directorio con todos los médicos especialistas disponibles.  <a href="" class="text-info_">ver todos</a>
          </p>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="row mt-5  justify-content-start">
            @if(isset($list_top_medico))
              @foreach($list_top_medico->take(5) as $key=> $item)
                <div class="col-md-2 col-sm-3 col-xs-12 text-left  @if($key<1) offset-md-1  @endif  text-center mb-3">
                  @if(isset($item->img) && $item['img']!=null) 
                    <img src="{{ \Storage::disk('wasabi')->temporaryUrl($item->img, now()->addMinutes(3600)  )}}" alt="{{$item->img}}" id="img_doc" class=" img-circle img-fluid p-0 elevation-1">
                  @else 
                     <img src="{{asset('img/user.png') }}" alt="{{$item->img}}" id="img_doc"  class=" img-circle img-fluid p-0 elevation-1">
                  @endif
                  <a class="users-list-name mt-3 mb-2" href="{{url('medico/info/'.encrypt($item['id']))}}"><b class="h5">{{$item->name}}</b></a>
                </div>

              @endforeach
            @endif
          </div>
        </div>
      </div>
    </section>   
  @endauth
   
  @auth
    <section>
      <div class="row mt-4 mb-5  border-bottom ml-5 mr-5 mb-5">
        <div class="col-lg-12 col-xs-12 text-center">
          <p class="h4 text-info text-center mt-5" style="font-family:  Calibri; color: #13c6ef !important;"><b>Publicaciones</b></p>
          <p class="h4 text-center lead mb-2 desc-publica" style="width: 680px; margin:auto;">
           En esta seccion encontraras las publicaciones e investigaciones realizadas por nuestros médicos
          </p>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="container">
            <div class="row mt-5">
              <div class="col-md-8 col-sm-12 col-xs-12 offset-md-2 ">
                @include('publicaciones')
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>   
  @endauth 

  @guest
    <section class="content">
      <div class="row mt-4 mb-5  border-bottom ml-5 mr-5 mb-1">
        <div class="col-lg-12 col-xs-12 text-center">
          <p class="h4 text-info text-center mt-5" style="font-family:  Calibri; color: #13c6ef !important;"><b>Publicaciones</b></p>
          <p class="h4 text-center lead mb-2 desc-publica" style="width: 680px; margin:auto;">
           En esta seccion encontraras las publicaciones e investigaciones realizadas por nuestros médicos
          </p>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          @include('carousel_publicaciones')
        </div>
      </div>
    </section> 
  @endguest

  @guest
    <section class="content">
      <div class="row mt-1 mb-5   ml-5 mr-5 mb-5">
        <div class="col-lg-12 col-xs-12 text-center">
          <p class="h4 text-info text-center mt-5" style="font-family:  Calibri; color: #13c6ef !important;"><b>Acerca de Nosotros</b></p>
         
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="row mt-5">
            <div class="col-md-10 col-sm-6 col-xs-12 mt-3 border-0 offset-md-1">
              <div class="card-deck ml-4 mr-4 border-0 mb-5">
               
                <div class="card ml-5 border-0 shadow-none" >
                    <img class="card-img-top" src="/img/a2.png" alt="Card image cap">
                    <div class="card-body border-0">
                     <h5 class=" h4 text-center mb-3 text-info_">¿Sabes cuál es el estado de tu salud? </h5>
                     <p class="card-text text-justify">
                       Al ser pioneros de la medicina preventiva, práctica y gratuita, te podremos ayudar a recuperar el control de tal manera que puedas llevar un estilo de vida más saludable, junto de la mano de los mejores médicos especialistas del país. 
                     </p>

                   </div>
                </div>
                <div class="card ml-5 border-0 shadow-none">
                  <img class="card-img-top" src="/img/a3.png" alt="Card image cap">
                  <div class="card-body border-0">
                     <h5 class=" h4 text-center mb-3 text-info_">¡Los pacientes llegarán a ti a llenar tu agenda!</h5>
                     <p class="card-text text-justify">Los pacientes están buscándote ahora mismo.
                       ¡Y llegan a llenar tu agenda! Posiciona tu carrera profesional como uno de los mejores médicos especialistas, mejorando la relación médico-paciente y potenciando tu networking mediante colaboración con otros médicos especialistas.
                     </p>
                  </div>
                </div>
                <div class="card ml-5 mr-5 border-0 shadow-none">
                  <img class="card-img-top" src="/img/a4.png" alt="Card image cap">
                  <div class="card-body border-0">
                   <h5 class=" h4 text-center mb-3 text-info_">Lleva tu marca empresarial al siguiente nivel con Option2health.</h5>
                   <p class="card-text text-justify">Nuestra plataforma te permitirá posicionar tu marca, obtener datos y estadísticas de tu alcance, encontrar al cliente ideal, optimizando recursos y conectando con aliados estratégicos del sector de la salud.

                   </p>

                 </div>
                </div>
              </div>
            </div>  
        </div>
        </div>
      </div>
    </section> 
  @endguest

  
      
  @if(isset($registro))
    @include('modalUpdate_users')
  @endif
  
  {{-- Seccion para insertar css--}}    
  @section('include_css') 
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  @stop 

  {{-- Seccion para insertar js--}}
  @section('include_js')
    {{-- Mensaje de informacion --}}
      @if(session()->has('info'))
         <script >
           mostrar_toastr('{{session('info')}}','{{session('estado')}}')
         </script>
      @endif

     @if(isset($registro))
      @if(!$registro)
        <script > 
          // control de modal de actualizacion de datos de perfil del usuario
            $('#modal-default').modal('show');
            $('#modal-default').on('hidden.bs.modal', function (e) {
              @if(auth::user()->type_user()=='dr')
                  $('#modal-default').modal('show');
              @endif
            })

            // carga de datos de los text tarea
             @if(isset(auth()->user()->detalle_estudio)) 
               $('#detalle_estudio').val(`{{auth()->user()->detalle_estudio}}`);
             @endif 
             @if(isset( auth()->user()->detalle_experiencia ) )
               $('#detalle_experiencia').val(`{{auth()->user()->detalle_experiencia}}`);
             @endif 

            //inicializacion de estilos del select2
            $(document).ready(function() {
              $('.select2').select2();
            });
        </script>
        
      @endif 
     @endif
     

      <script src="{{ asset('/js/controlLike.js') }}"></script>
      <script src="{{ asset('/js/gestionSaveArt.js') }}"></script>
      <script src="{{ asset('/js/register.js') }}"></script>
      <script src="{{ asset('/js/actionEvent.js') }}"></script>
      {{-- para dar stilos responsive --}}
      <script src="{{ asset('/js/screen/screen_home.js') }}"></script>
  @stop
    
@stop
