@extends('homeOption2h')
@section('title','Perfil-Médico')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
{{-- cuerpo de la pagina --}}
@section('contenido')
  
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Casos Excepcionales</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-8 ">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-6">
              <div class="small-box bg-teal">
                <div class="inner">
                  <h4><b>Nº de CASOS DE ESTUDIO</b></h4>
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Nº de casos ingresados el último mes</strong>
                    </p>
                    <div class="progress-group mb-3">
                     casos
                      <span class="float-right"><b>@if(isset($casos_publicado)) {{$casos_publicado}}@endif</b>/100</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: @if(isset($porcent)) {{$porcent}}% @endif"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6">
              <div class="small-box bg-purple ">
                <div class="inner ">
                  <h4><b>TUS CASOS EXCEPCIONALES</b> </h4>
                  <span class="info-box-number h4 ">@if(isset($casos)) {{$casos}} @endif</span>
                  <p>Para revisar tus casos excepcionales publicados y los comentarios que hay de ellos. haz clic a aquí.</p>
                  
                </div>
                <div class="icon ">
                  <i class="fas fa-chart-pie"></i>
                </div> 
             </div>
            </div>
          </div>
          @include('medico.lista_casos')
        </div>
        <div class=" col-md-12 col-lg-4 order-1 order-md-2">
          <h3 class="text-primary"><i class="fas fa-hands-helping"></i> AYÚDANOS A AYUDAR</h3>
          <p class="text-muted text-justify">Hay millones de personas con enfermedades sin diagnóstico. Se parte de nuestra red de crowdsourcing conformada por especialistas médicos de todo el mundo, y ayúdanos a analizar exámenes, sugerir diagnósticos y recomendar tratamientos en casos de difícil resolución. Para compartir un caso y que otros médicos te ayuden.</p>
          {{-- <div class="text-muted">
            <p class="text-sm">Option2health
              <b class="d-block">Aún no tenemos ningún caso excepcional publicado. Puedes ser el primero y publicar uno.</b>
            </p>
          </div> --}}
          <div class="text-center mt-1 mb-3">
            <a  id="btn_casos" class="btn btn-sm btn-primary text-light ">Publicar caso</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  @include('medico.modalCaso')
  @include('medico.modalEditCaso')

  @section('include_css') 
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      
  </style>
  @stop   
  {{-- Seccion para insertar js--}}
  @section('include_js')
       <script src="{{ asset('/js/casos_ex.js') }}"></script>
  @stop


 @stop
