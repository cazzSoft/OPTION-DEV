@extends('homeOption2h')
@section('title','Casos')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
{{-- cuerpo de la pagina --}}
@section('contenido')
  @movil
    <div class="row">
      <div class="col-md-12 ">
          <div class="flex_titulo">
           <a href="{{url('/')}}">  <p class=" text-lead h5 text-dark ">  <i class="fas fa-chevron-left  text-info_ float-left"></i> Casos Médicos</p></a>    
          </div>
      </div>
    </div>
  @else
    <div class="row justify-content-start">
      <div class="col text-center mt-4 ">
        <a href="{{asset('/')}}" class="text-leth float-left ">  <i class="fas fa-chevron-left  text-info_ fa-2x ml-2 mb-5 "></i></a>
        <p class="flex_titulo">Casos Médicos </p>
      </div>
    </div>
  @endmovil
 

  <div class="container-fluid ">
    @movil
      <div class="row mt-3">
        <div class="col-10">
          <form action="{{url('gestion/search_caso')}}" method="POST">
            {{ csrf_field() }}
            <input id="method_" type="hidden" name="_method" value="POST">                  
            <div class="input-group  ">
              <input type="Search" class="form-control" name="search_caso" value="@if(isset($valor)) {{$valor}} @endif" placeholder="Buscar documentos" >
              <div class="input-group-append">
                 <button class="input-group-text " type="submit"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
          </form> 
        </div>
        <div class="col-2">
          <div class="btn-group dropleft" role="group">
              <button id="btnGroupDrop1" type="button" class="btn   text-info_" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-stream"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-left" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="{{url('gestion/last_month')}}">Ultimo mes</a>
                  <a class="dropdown-item" href="{{url('gestion/user_casos')}}">Mis casos</a>
                  <a class="dropdown-item" href="{{url('medico/casos_ex')}}">Todos</a>
              </div>
          </div>
        </div>
      </div>
    @endmovil

   <div class="media @movil mt-4 @endmovil ">
     <div class="media-body ">
       <h5 class="mt-0 text-muted "><b>Ayúdanos a Ayudar</b></h5>
        <p class="text-justify">
           Hay millones de personas con enfermedades sin diagnóstico. Se parte de nuestra red de crowsourcirng conformada por especialistas médicos de todo el mundo y ayúdanos a analizar exámenes, sugerir diagnósticos y recomendar tratamientos en casos de difícil resolución. Para compartir n caso y que otros médicos te ayuden.
        </p>
        @movil
        @else 
          <div class="row no-print">
            <div class="col-12">
             {{--  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> --}}
              <button type="button" class="btn btnx-info btn-info_ float-left text-light" id="btn_casos">Publicar caso </button>
            </div>
          </div>
        @endmovil
     </div>
   </div>

   <div class="row @movil mt-1 @else mt-5 @endmovil ">
     <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12 ">
       <div class="small-box   shadow  bg-white rounded ml-2 mr-2">
         <div class="inner">
           <h5><b>Nº de Casos de Estudio</b></h5>
           <div class="col-md-12">
             <p class="text-leth ">
               <span>Número de casos ingresados el último mes por nuestors médicos especialistas.</span>
             </p>
             <div class="progress-group mt-4 ">
              <span class="text-muted"> <b>casos :</b> {{$casos_publicado}}</span> 
               <span class="float-right"><b>@if(isset($casos_publicado)) {{$casos_publicado}}@endif</b>/100</span>
               <div class="progress progress-sm">
                 <div class="progress-bar bg-info"{{--  style="width:10%" --}}   style="width:@if(isset($porcent)) {{$porcent}}% @endif "></div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
       <div class="small-box shadow  bg-white rounded ">
         <div class="inner ">
           <h5><b>Tus casos Excepcionales</b> </h5>
            <div class="col-md-12">
               <p class="text-left ">
                 <span>Aqui se mostrara una barrita con la cantidad de Casos Excepcionales que has publicado en la plataforma.</span>
               </p>
               <div class="progress-group ">
                <span class="text-muted"> <b>Casos subidos por ti:</b> </span>
                 <span class="info-box-number  ">@if(isset($casos)) {{$casos}} @endif</span>
                 <span class="float-right"><b>@if(isset($casos_publicado)) {{$casos_publicado}}@endif</b>/100</span>
                 <div class="progress progress-sm">
                   <div class="progress-bar bg-info" {{-- style="width:30%" --}} style="width: @if(isset($porcent)) {{$porcent}}% @endif"></div>
                 </div>
               </div>
            </div>
         </div> 
      </div>
     </div>
   </div>

    <div class="card  bg-white rounded border-0 border-bottom-0 shadow-none bg-white rounded @movil p-0 @endmovil">
      <div class="card-body border-bottom-0 @movil p-0 @endmovil">
        <div class="row">
          <div class="col-lg-8 col-md-12 col-sm-12 ">
            @include('medico.lista_casos')
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
      <link rel="stylesheet" href="{{ asset('css/gestion_caso.css') }}">
     
  </style>
  @stop   
  {{-- Seccion para insertar js--}}
  @section('include_js')

    
      {{-- controlar imagen de rotas --}}
    <script src="{{ asset('/js/control_img_rotas.js') }}"></script>
    <script src="{{ asset('/js/casos_ex.js') }}"></script>
     @movil
      <script >
        var boton_p=`
             <div class="row mt-3">
               <div class="col-10 m-auto">
                 <button type="button" class="btn bgz-info btn-block modal_caso_ex" onclick="$('#modal_caso_ex').modal('show');" id="modal_caso_ex" data-target="#modal_caso_ex">Publicar caso </button>
               </div>
             </div>
        `;
        $('.main-footer_').html(boton_p);
      </script>
    @endmovil
  @stop


 @stop
