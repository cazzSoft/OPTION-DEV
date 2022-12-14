@extends('homeOption2h')
@section('title','Publicaciones')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',true)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.Select2',true)

@section('content_header')
  <div class="container-fluid">
    @movil
      <div class="row">
        <div class="col-md-12 ">
            <div class="flex_titulo">
             <a href="{{url('/calendario/')}}">  <p class=" text-lead h2 text-info_ ">  <i class="fas fa-chevron-left mr-3 text-info_"></i>  Cita médica  </p></a>
            </div>
        </div>
      </div>
    @else
      <div class="row mt-5 mb-3 ">
        <div class="col-lg-1 col-xs-1">
          <a href="{{url('/calendario/')}}" class="text-center ml-1" >  <i class="fas fa-chevron-left mr-3 text-info_ fa-2x "></i></a>    
        </div>
        <div class="col-lg-10">
          <a href="{{url('/calendario')}}" class="text-center " > <p class="flex_titulo text-info_  text-center">   Cita médica  </p></a> 
        </div>
      </div>
    @endmovil
  </div>
@stop
{{-- cuerpo de la pagina --}}
@section('contenido')
 
    <div class="row justify-content-md-left @movil @else p-3 @endmovil">
      <div class=" @movil col-12 @else col-11 @endmovil">
        <div class="card shadow-none  rounded">
          <div class="atenuar-datos">
                   
          </div>
          <div class="card-header p-0   ">
            <ul class="nav nav-tabs " id="custom-tabs-inicio-cita" role="tablist">
              <li class="nav-item ">
                <a class="nav-link active" id="custom-tabs-paciente" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="false">Información del paciente</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link  " id="custom-tabs-historial" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="true">Historial del paciente</a>
              </li>
            </ul>
          </div>
          <div class="card-body border-top-0 border border-light shadow-sm rounded" >

            <div class="tab-content" id="custom-tabs-three-tabContent">
              <div class="tab-pane active show " id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-paciente">
                <div class="post clearfix">
                  
                  {{-- datos del paciente --}}
                  @include('agenda.cita_medica.datos_paciente')
                  {{-- datos de cita  --}}
                  <form method="POST" action="{{ url('cita/save') }}" enctype="multipart/form-data" id="form_cita_medica" autocomplete="off" >
                    @csrf
                    <input  type="hidden" name="_method" id="method_cita_medica" value="POST">
                    <input type="hidden" id="idcita_medica" name="idcita_medica" value="{{encrypt($idcita)}}">
                    
                    {{-- motivo consulta --}}
                    <div class="row">
                      <dt class="col-sm-12">
                        @if(isset($fecha)) <span class="text-capitalize">Cita {{$fecha}} </span> <input type="hidden" value="{{$fecha}}" name="fecha_inicio_cita">  @endif
                      </dt>
                      <dd class="col-sm-12 mt-3">
                        <div class="form-group">
                          <label class="text-muted" for="motivo_cita" >Motivo de cosulta <span class="text-red">*</span></label>
                          <textarea class="form-control shadow-sm   border border-white  @error('motivo_cita') is-invalid @enderror "  rows="4" placeholder="Ingrese el motivo de la consulta"   name="motivo_cita"  id="motivo_cita"  ></textarea>
                          @error('motivo_cita')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                       
                        {{-- archivos del paciente --}}
                        @if(isset($datos_sgd['arch']) && $datos_sgd['arch']!=null)
                            <div class="form-group">
                              <label class="text-muted" for="motivo_cita" >Exámenes médicos del paciente </label>
                                <ul style="cursor: pointer;">
                                  @foreach($datos_sgd['arch'] as $key=>$archivo)
                                     <li class="text-info_"  onclick="showModal(`{{$archivo['url']}}`,'{{$archivo['name']}}','{{$archivo['ext']}}')"><u>{{$archivo['name']}}</u></li>
                                  @endforeach
                                 
                                </ul>
                            </div>
                        @endif
                      </dd>
                    </div>

                    {{-- secciones de preguntas autogenerada por el sis o2h--}}
                    @include('agenda.cita_medica.secciones_pregunta_cita')
                    
                    {{-- Seccion Diagnóstico presuntivo --}}
                    <div class="row">
                      <dd class="col-sm-12 mt-3" >
                        <div class="form-group">
                          <label class="text-muted" for="diagnostico_presuntivo" >Diagnóstico presuntivo: <span class="text-red">*</span></label>
                          <textarea class="form-control shadow-sm border border-white @error('diagnostico_presuntivo') is-invalid @enderror"  rows="4"  name="diagnostico_presuntivo"  id="diagnostico_presuntivo"  
                          placeholder="Fx desplazada de la base del 2do metatarsiano derecho..."     
                            ></textarea>
                           @error('diagnostico_presuntivo')
                             <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                             </span>
                           @enderror
                        </div>
                      </dd>
                    </div>

                    {{-- Sección Receta que se va a administrar al paciente --}}
                    <div class="row">
                      <dd class="col-sm-12 mt-3">
                        <div class="form-group">
                          <label class="text-muted" for="img_receta">Receta que se va a administrar al paciente: <span class="text-red">*</span> </label>
                        </div>
                        <div class="form-group p-2 ">
                          <label for="img_receta" class="custom-img_receta text-left text-muted btn border-dark p-2">
                            <i class="fas fa-image text-info_ fa-lg mr-2"></i> Adjuntar 
                            <i class="fa-solid fa-circle-arrow-up text-info_ fa-lg ml-5 pl-4"></i>
                          </label>
                          <input  accept="image/*,.pdf" name="img_receta" id="img_receta" class=""  onchange="previewImage(event, '#imgPreview')" type="file"/>
                          <br>
                          @error('img_receta')
                             <span class="text-red text-description" role="alert">
                               <strong> <small> <b>{{ $message }}</b></small> </strong>
                             </span>
                           @enderror
                           <br> <img src=""  id="imgPreview" class="d-none">
                        </div>
                      </dd>
                    </div>

                    {{-- boton --}}
                    <div class="row ">
                       <div class="m-auto @movil col-12 @else col-3 @endmovil">
                         <div class="form-group p-2 ">
                            <button type="submit" class="btn btn-block bgz-info  rounded">Guardar</button>
                         </div>
                       </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="tab-pane fade " id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-historial">
                <div class="post clearfix">
                  {{-- datos segunda cita --}}
                  @if(isset($datos_sgd))
                    {{-- datos del paciente --}}
                    @include('agenda.cita_medica.datos_paciente_historial')
                    
                    {{-- datos de cita  --}}
                    <form method="POST" onsubmit="atenuarView()" action="{{ url('cita/save/'.encrypt($datos_sgd['datos_cita_last']['datos_cita']->idcita_medica)) }}" enctype="multipart/form-data" id="form_cita_medica_historial" >
                      @csrf
                      <input  type="hidden" name="_method" id="method_cita_medica_historial" value="PUT">
                      <input type="hidden" id="idcita_medica_last" name="idcita_medica_last" value="{{encrypt($datos_sgd['datos_cita_last']['idcita'])}}">
                     
                      {{-- motivo consulta --}}
                      <div class="row">
                        <dt class="col-sm-12">
                          @if(isset($datos_sgd['datos_cita_last']['fecha'])) 
                            <span class="text-capitalize">Cita {{$datos_sgd['datos_cita_last']['fecha']}} </span>  
                          @endif
                        </dt>
                        <dd class="col-sm-12 mt-3">
                          <div class="form-group">
                            <label class="text-muted" for="motivo_cita_h" >Motivo de cosulta <span class="text-red">*</span></label>
                            <textarea class="form-control shadow-sm   border border-white  @error('motivo_cita_h') is-invalid @enderror "  rows="4" placeholder="Ingrese el motivo de la consulta"   name="motivo_cita_h"  id="motivo_cita_h"  ></textarea>
                            @error('motivo_cita_h')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          
                          {{-- archivos del paciente --}}
                          @if(isset($datos_sgd['datos_cita_last']['arch']) && $datos_sgd['datos_cita_last']['arch']!=null)
                              <div class="form-group">
                                <label class="text-muted" for="motivo_cita" >Exámenes médicos del paciente </label>
                                  <ul style="cursor: pointer;">
                                    @foreach($datos_sgd['datos_cita_last']['arch'] as $key=>$archivo)
                                       <li class="text-info_"  onclick="showModal(`{{$archivo['url']}}`,'{{$archivo['name']}}','{{$archivo['ext']}}')"><u>{{$archivo['name']}}</u></li>
                                    @endforeach
                                  </ul>
                              </div>
                          @endif
                        </dd>
                      </div>
                      
                      {{-- secciones de preguntas autogenerada por el sis o2h--}}
                      @include('agenda.cita_medica.secciones_pregunta_historial')
                      
                      {{-- Seccion Diagnóstico presuntivo --}}
                      <div class="row">
                        <dd class="col-sm-12 mt-3" >
                          <div class="form-group">
                            <label class="text-muted" for="diagnostico_presuntivo_h" >Diagnóstico presuntivo: <span class="text-red">*</span></label>
                            <textarea class="form-control shadow-sm border border-white @error('diagnostico_presuntivo_h') is-invalid @enderror"  rows="4"  name="diagnostico_presuntivo_h"  id="diagnostico_presuntivo_h"  
                            placeholder="Fx desplazada de la base del 2do metatarsiano derecho..."     
                              ></textarea>
                             @error('diagnostico_presuntivo_h')
                               <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                               </span>
                             @enderror
                          </div>
                        </dd>
                      </div>
                    </form>
                    {{-- boton --}}
                    <div class="row ">
                       <div class=" col-3 m-auto">
                         <div class="form-group p-2 ">
                            <button type="button" class="btn btn-block bgz-info  rounded" id="btn_historial">Guardar cambios</button>
                         </div>
                       </div>
                    </div>
                  @else
                    <div class="row">
                      <div class="col-md-8 col-sm-12 m-auto text-center ">
                         <img class="img_gris text-center mt-5 p-2" src="{{asset('img/o2h_gris.png')}}" alt="img_o2h">  
                      </div>
                      <div class="col-md-6 col-sm-12 text-center m-auto p-2 ">
                         <p class="font-msm text-muted text-secondary ">
                            No se encontraron datos para mostrar..
                         </p>
                      </div>  
                    </div>
                  @endif
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    {{-- modal --}}
    <div id="modalImage" class="modal-image">
      <div class="modal-content-img" id="modal-image-content">
      </div>
    </div>

   

@stop

@section('include_css') 
  <link rel="stylesheet" href="{{ asset('css/inicio_cita.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">

  {{-- stilos de secciones de pregunta --}}
  <link rel="stylesheet" href="{{ asset('css/seccion_pregunta.css') }}">
@stop  

{{-- Seccion para insertar js--}}
@section('include_js')
  {{-- js de secciones de pregunta --}}
  <script src="{{asset('js/seccion_pregunta.js')}}"></script> 

  {{-- recordar campos ingresado anteriormente  --}}
  @if(old('diagnostico_presuntivo'))
    <script>
      $('#diagnostico_presuntivo').val( @json(old('diagnostico_presuntivo')) );
    </script>
  @endif

  @if(old('motivo_cita'))
    <script>
       $('#motivo_cita').val( @json(old('motivo_cita')) );
    </script>
  @endif

  @if(isset($datos_cita))
    <script>
      $('#motivo_cita').val(@json($datos_cita['detalle']));
    </script>
  @endif
  
  {{-- datos last cita --}}
  @if(isset($datos_sgd['datos_cita_last']['datos_cita']))
    <script>
      $('#motivo_cita_h').val(@json($datos_sgd['datos_cita_last']['datos_cita']->motivo_cita));
    </script>
  @endif
  @if(isset($datos_sgd['datos_cita_last']['datos_cita']))
    <script>
      $('#diagnostico_presuntivo_h').val(@json($datos_sgd['datos_cita_last']['datos_cita']->diagnostico_presuntivo));
    </script>
  @endif

  @if ($errors->any())
     <script>
          sweetalert('Por favor llenar campos requeridos...','error');
     </script>
  @endif
       
  {{-- Mensaje de informacion --}}
  @if(isset($info))
    <script>
      sweetalert('{{$info}}','{{$estado}}');
    </script>
  @endif
  
  {{-- iniciar cita js --}}
  <script src="{{asset('js/iniciar_cita.js')}}"></script> 
@stop
    
 
