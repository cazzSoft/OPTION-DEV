@extends('homeOption2h')
@section('title','Casos')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
{{-- cuerpo de la pagina --}}
@section('contenido')
 
  <div class="row justify-content-start">
    <div class="col text-center mt-4">
      <a href="{{asset('/')}}" class="text-leth float-left ">  <i class="fas fa-chevron-left mr-3 text-info_ fa-2x ml-5 mb-5 "></i></a>
      <span class="text-info_ h5"><b> Casos Médicos </b></span>
    </div>
  </div>

  <div class="container-fluid ">

   <div class="media ml-5 mr-5">
     <div class="media-body ">
       <h5 class="mt-0 text-muted "><b>Ayúdanos a Ayudar</b></h5>
        <p class="text-justify">
           Hay millones de personas con enfermedades sin diagnóstico. Se parte de nuestra red de crowsourcirng conformada por especialistas médicos de todo el mundo y ayúdanos a analizar exámenes, sugerir diagnósticos y recomendar tratamientos en casos de difícil resolución. Para compartir n caso y que otros médicos te ayuden.
        </p>
        <div class="row no-print">
          <div class="col-12">
            {{-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> --}}
            <button type="button" class="btn btnx-info btn-info_ float-left text-light" id="btn_casos">Publicar caso </button>
           
          </div>
        </div>


     </div>
   </div>

   <div class="row ml-4 mr-4 mt-5">
     <div class="col-4 col-sm-6 col-md-4 col-xs-12 ">
       <div class="small-box   shadow  bg-white rounded ml-2 mr-2">
         <div class="inner">
           <h5><b>Nº de Casos de Estudio</b></h5>
           <div class="col-md-12">
             <p class="text-leth">
               <span>Número de casos ingresados el último mes por nuestors médicos especialistas.</span>
             </p>
             <div class="progress-group mb-3">
              <span class="text-muted"> <b>casos :</b> </span> 0
               <span class="float-right"><b>@if(isset($casos_publicado)) {{$casos_publicado}}@endif</b>/100</span>
               <div class="progress progress-sm">
                 <div class="progress-bar bg-info" style="width: @if(isset($porcent)) {{$porcent}}% @endif"></div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="col-4 col-sm-6 col-md-4 col-xs-12">
       <div class="small-box shadow  bg-white rounded ">
         <div class="inner ">
           <h5><b>Tus casos Excepcionales</b> </h5>
            <div class="col-md-12">
               <p class="text-leth">
                 <span>Aqui se mostrara una barrita con la cantidad de Casos Excepcionales que has publicado en la plataforma.</span>
               </p>
               <div class="progress-group mb-3">
                <span class="text-muted"> <b>Casos subidos por ti:</b> </span>
                 <span class="info-box-number  ">@if(isset($casos)) {{$casos}} @endif</span>
                 <span class="float-right"><b>@if(isset($casos_publicado)) {{$casos_publicado}}@endif</b>/100</span>
                 <div class="progress progress-sm">
                   <div class="progress-bar bg-info" style="width: @if(isset($porcent)) {{$porcent}}% @endif"></div>
                 </div>
               </div>
            </div>
         </div> 
      </div>
     </div>
   </div>

    <div class="card  bg-white rounded border-0 border-bottom-0 shadow-none bg-white rounded ml-3 mr-3">
      <div class="card-body border-bottom-0">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-8 ">
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
      <style >
        .btn-info_{
          width: 229px;
          height: 34px;
          left: 111px;
          top: 424px;

          /* O2H Turq */

          background: #0FADCE;
          box-shadow: 0px 1px 4px 2px rgba(0, 0, 0, 0.1);
          border-radius: 5px;
        }
        .small-box {
          /*background: #FFFFFF;*/
          /*box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25) !important;*/
          border-radius: 10px !important;
        }
        .history{
          display: none;
        }
        .callout.callout-info {
            border-left-color: #0FADCE !important;
        }
        .callout {
           border-radius: .56rem !important;
            /*box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);*/
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25) !important;
            border-left: 10px solid #e9ecef !important;
            
        }
      </style>
  </style>
  @stop   
  {{-- Seccion para insertar js--}}
  @section('include_js')
       <script src="{{ asset('/js/casos_ex.js') }}"></script>
  @stop


 @stop
