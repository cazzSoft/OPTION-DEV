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
  
   
  <section class="content">
    
    <div class="row ">
      <div class="col-lg-12 col-xs-12 ">
        <p class="h4 text-info text-center mt-5" style="font-family:  Calibri; color: #13c6ef !important;"><b>Noticias</b></p>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        @include('carousel_noticias')
      </div>
    </div>
  </section> 

  <section>
    <div class="row mt-4">
      <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
        <nav class="w-100 ">
          <div class="nav nav-tabs  d-flex justify-content-center  border-0 " id="custom-tabs-four-tab" role="tablist">
            <a class=" h5 nav-item nav-link   mr-3 active border-0 btn-tab  " id="medico-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="false"> <p class="h4 text-center" style="font-family:  Calibri; "><b>Médicos</b></p></a>
            <a class="h5 nav-item nav-link  border-0 ml-3 btn-tab" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false"> <p class="h4 text-center" style="font-family:  Calibri;"><b>Publicaciones</b></p></a>
          </div>
        </nav>
        <div class="tab-content p-0" id="nav-tabContent">
          <div class="tab-pane  show active " id="product-desc" role="tabpanel" aria-labelledby="medico-desc-tab">
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
            <div class="row mt-5">
              <div class="col-md-12 col-sm-12 col-xs-12 mt-3 mb-4">
                <p class="h4 text-info text-center" style="font-family:  Calibri; color: #13c6ef !important;"><b>Acerca de Nosotros</b></p>
              </div>
              <div class="col-md-12 col-sm-6 col-xs-12 mt-3 border-0">
                <div class="card-deck ml-4 mr-4 border-0 mb-5">
                  <div class="card ml-5 border-0">
                    <img class="card-img-top" src="/img/a1.png" alt="Card image cap">
                    <div class="card-body border-0">
                       <h5 class=" h3 text-center mb-3 text-info">¡Option2Health, medicina en tus manos!</h5>
                       <p class="card-text text-justify">Option2health, un espacio digital innovador para médicos, pacientes y empresas.
                         Nuestra plataforma de salud está enfocada en la salud y educación para aquellas personas que buscan a través de la información, generar soluciones para enfrentar enfermedades y tener una mejor calidad de vida.
                       </p>
                    </div>
                  </div>
                  <div class="card ml-5 border-0">
                      <img class="card-img-top" src="/img/a2.png" alt="Card image cap">
                      <div class="card-body border-0">
                       <h5 class=" h3 text-center mb-3 text-info">¿Sabes cuál es el estado de tu salud? </h5>
                       <p class="card-text text-justify">
                         Al ser pioneros de la medicina preventiva, práctica y gratuita, te podremos ayudar a recuperar el control de tal manera que puedas llevar un estilo de vida más saludable, junto de la mano de los mejores médicos especialistas del país. 
                       </p>

                     </div>
                  </div>
                  <div class="card ml-5 border-0">
                    <img class="card-img-top" src="/img/a3.png" alt="Card image cap">
                    <div class="card-body border-0">
                       <h5 class=" h3 text-center mb-3 text-info">¡Los pacientes llegarán a ti a llenar tu agenda!</h5>
                       <p class="card-text text-justify">Los pacientes están buscándote ahora mismo.
                         ¡Y llegan a llenar tu agenda! Posiciona tu carrera profesional como uno de los mejores médicos especialistas, mejorando la relación médico-paciente y potenciando tu networking mediante colaboración con otros médicos especialistas.
                       </p>
                    </div>
                  </div>
                  <div class="card ml-5 mr-5 border-0">
                    <img class="card-img-top" src="/img/a4.png" alt="Card image cap">
                    <div class="card-body border-0">
                     <h5 class=" h3 text-center mb-3 text-info">Lleva tu marca empresarial al siguiente nivel con Option2health.</h5>
                     <p class="card-text text-justify">Nuestra plataforma te permitirá posicionar tu marca, obtener datos y estadísticas de tu alcance, encontrar al cliente ideal, optimizando recursos y conectando con aliados estratégicos del sector de la salud.

                     </p>

                   </div>
                  </div>
                </div>
              </div>  
            </div>
          </div>

          <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
            <div class="container">
              <div class="row mt-5">
                <div class="col-md-8 col-sm-12 col-xs-12 offset-md-2 ">
                 @include('publicaciones')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>   

     
      
  @if(isset($registro))
    @include('modalUpdate_users')
  @endif
  
  {{-- Seccion para insertar css--}}    
  @section('include_css') 
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
      #preViewImg2{
                width: 150px;
                height: 150px;
                object-fit: cover;
            }
      input[type="file"] {
          display: none;
      }
      .custom-file-upload {
          /*border: 1px solid #ccc;*/
          display: inline-block;
          padding: 1px ;
          cursor: pointer;
      }
      #dropdownMenuLink{
        position: absolute;
       /* width: 25px;
        height: 30px;*/

        margin-top:118px;
        margin-left: -42px;
        margin-right: auto;
      }
      /*slider home*/
      .rounded-circle {
          border-radius: 50%!important;
          width: 12px !important;
          height: 12px  !important;
      }
      #img_doc{
        width: 220px;
        height: 220px;
        object-fit: cover;
       
      }
      .imgran{
      
        width: 687.55px;
        height: 459.05px;
        left: 577.51px;
        top: 189.95px;
      }

      
    </style>
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
  @stop
    
@stop
