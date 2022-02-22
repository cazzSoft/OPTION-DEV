@extends('homeOption2h')
@section('title','HOME')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',false)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.daterangepicker',false)
@section('plugins.Select2',true)
{{-- cuerpo de la pagina --}}
@section('contenido')
  
  <section class="">
    <div class="row ">
      <div class="col-12 col-xs-12 ">
        <p class="h4 text-info text-center mt-5" style="font-family:  Calibri; color: #13c6ef !important;"><b>Noticias</b></p>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 ">
        <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
          <ol class="carousel-indicators ">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active bg-info rounded-circle" style=" width:10px ; height: 10px; "></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1" class="bg-info rounded-circle" style=" width:10px ; height: 10px; "></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2" class="bg-info rounded-circle" style=" width:10px ; height: 10px; "></li>
          </ol>
          <div class="carousel-inner  ">
            <div class="carousel-item active  ">
              <div class="card rounded-0" >
                <div class="card-body row text-dark">
                  <div class="col-md-7 col-sm-12 text-center ">
                    <div class="ml-5 mr-5 ">
                      <img class="img-fluid " src="{{asset('/img/Imagen1.png')}}" alt="Photo">
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
            </div>
            <div class="carousel-item">
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
            </div>
            <div class="carousel-item">
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
            </div>
          </div>
         {{--  <a class="carousel-control-prev text-dark" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-custom-icon" aria-hidden="true">
              <i class="fas fa-chevron-left"></i>
            </span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-custom-icon" aria-hidden="true">
              <i class="fas fa-chevron-right"></i>
            </span>
            <span class="sr-only">Next</span>
          </a> --}}
        </div>

      </div>
    </div>
  </section> 

  <section>

    <div class="row mt-4">
      <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
        <nav class="w-100 ">
          <div class="nav nav-tabs border-0 d-flex justify-content-center " id="product-tab" role="tablist">
            <a class=" h5 nav-item nav-link  border-0 mr-3" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="false"> <p class="h4 text-center" style="font-family:  Calibri; "><b>Médicos</b></p></a>
            <a class="h5 nav-item nav-link  border-0 active" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false"> <p class="h4 text-center" style="font-family:  Calibri;"><b>Publicaciones</b></p></a>
          </div>
        </nav>
        <div class="tab-content p-3" id="nav-tabContent">
          <div class="tab-pane fade" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
            <div class="row mt-4">
              <div class="col-md-2 col-sm-4 col-xs-6 text-center mt-2">
                <img src="/img/user1-128x128.jpg" alt="User Image" class="img img-circle img-fluid">
                <a class="users-list-name" href="#">Alexander Pierce</a>
                <span class="users-list-date">Today</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 text-center">
                <img src="/img/user3-128x128.jpg" alt="User Image" class="img img-circle img-fluid">
                <a class="users-list-name" href="#">Alexander Pierce</a>
                <span class="users-list-date">Today</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 text-center">
                <img src="/img/user4-128x128.jpg" alt="User Image" class="img img-circle img-fluid">
                <a class="users-list-name" href="#">Alexander Pierce</a>
                <span class="users-list-date">Today</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 text-center">
                <img src="/img/user5-128x128.jpg" alt="User Image" class="img img-circle img-fluid">
                <a class="users-list-name" href="#">Alexander Pierce</a>
                <span class="users-list-date">Today</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 text-center">
                <img src="/img/user6-128x128.jpg" alt="User Image" class="img img-circle img-fluid">
                <a class="users-list-name" href="#">Alexander Pierce</a>
                <span class="users-list-date">Today</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 text-center">
                <img src="/img/user7-128x128.jpg" alt="User Image" class="img img-circle img-fluid">
                <a class="users-list-name" href="#">Alexander Pierce</a>
                <span class="users-list-date">Today</span>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-md-12 col-sm-12 col-xs-12 mt-3 mb-4">
                <p class="h4 text-info text-center" style="font-family:  Calibri; color: #13c6ef !important;"><b>Acerca de Nosotros</b></p>
              </div>
              <div class="col-md-12 col-sm-6 col-xs-12 mt-3 border-0">
                <div class="card-deck ml-4 mr-4 border-0">
                  <div class="card ml-5 border-0">
                    <img class="card-img-top" src="/img/a1.png" alt="Card image cap">
                    <div class="card-body border-0">
                       <h5 class=" h3 text-center mb-3 text-info">¡Option2Health, medicina en tus manos!</h5>
                       <p class="card-text text-justify">Option2health, un espacio digital innovador para médicos, pacientes y empresas.
                         Nuestra plataforma de salud está enfocada en la salud y educación para aquellas personas que buscan que buscan a través de la información, generar soluciones para enfrentar enfermedades y tener una mejor calidad de vida.
                       </p>
                    </div>
                  </div>
                  <div class="card ml-5 border-0">
                      <img class="card-img-top" src="/img/a2.png" alt="Card image cap">
                      <div class="card-body border-0">
                       <h5 class=" h3 text-center mb-3 text-info">¿Sabes cuál es el estado de tu salud? </h5>
                       <p class="card-text text-justify">¿Sabes cuál es el estado de tu salud? 
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

          <div class="tab-pane show active " id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
           
            <div class="container">
              <div class="row mt-3">
                
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

      {{-- <div class="card"> --}}

        {{--  <div class="card-header">
                <div class="row">
                  <div class="col-md-4">
                    <form action="{{url('gestion/search')}}" method="POST">
                      {{ csrf_field() }}
                      <input id="method_" type="hidden" name="_method" value="POST">                  <div class="input-group  ">
                        <input type="Search" class="form-control" name="q" value="@if(isset($valor)) {{$valor}} @endif">
                        <div class="input-group-append">
                           <button class="input-group-text " type="submit"> <i class="fas fa-search"></i> </button>
                          <span class="input-group-text"><i class="fas fa-check"></i></span>
                        </div>
                      </div>
                    </form> 
                  </div>
                  <div class="col-md-8 text-right">
                   {{  @if(isset($activeM))
                     <a class="text-muted text-primary" href="{{url('login')}}">¿Listo para tomar el control de tu salud y de los demás? INGRESA AQUÍ</a>
                     @else
                      <small class="text-muted">Estos artículos te pueden interesar.</small>
                     @endif
                    --}}
                 {{--  </div>
              </div>
            --}}

            {{-- </div> --}}
         
       {{-- </div> --}}
       <!-- Modal -->
      
        @if(isset($registro))
          @include('modalUpdate_users')
        @endif
     
    @section('include_css') 

      <style>
        .medico {
            position: absolute;
            border: 1px solid #10ADCF;
            text-align: center;
            right: 1vh;
            top: 1.8vh;
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

        /*slider home*/

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
            $('#modal-default').modal('show');
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
