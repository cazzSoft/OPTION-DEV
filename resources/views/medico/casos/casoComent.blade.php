@extends('homeOption2h')
@section('title','Detalle')

{{--para activar los plugin en la view  --}}

{{-- @section('plugins.Sweetalert2',true) --}}
@section('plugins.toastr',true)

{{-- cuerpo de la pagina --}}
@section('contenido')
  
  @movil
    <div class="row">
      <div class="col-md-12 ">
          <div class="flex_titulo">
           <a href="{{url('/casos')}}">  <p class=" text-lead h5 text-dark ">  <i class="fas fa-chevron-left  text-info_ float-left"></i> Casos Médicos</p></a>    
          </div>
      </div>
    </div>
  @else
    <div class="row justify-content-start">
      <div class="col text-center mt-5 ">
        <a href="{{asset('/casos')}}" class="text-leth float-left ">  <i class="fas fa-chevron-left  text-info_ fa-2x ml-2 mb-1 "></i></a>
        <p class="flex_titulo">Casos Médicos </p>
      </div>
    </div>
  @endmovil

  <div class="row">
    <div class="col  @movil @else pl-5 pr-5 pb-5 pt-2 @endmovil">
      <p><b>Información Principal</b></p>
      <div class="pl-4 pr-4 m-0 ">
        <p><b>Nombre del Caso:</b>  <span class="text-muted">Dr. Alex Uncuango</span></p>
        <p><b>Antecedentes del Paciente: Dr.</b> <span class="text-muted">Physicians Say Covid-19 Has Triggered a Drinking Problem</span></p>
        <p><b>Exámenes Fisicos del Paciente:</b> <span class="text-muted">Cardiología</span></p> 
        <p><b>Fecha de ingreso:</b> <span class="text-muted">del caso o del paciente</span></p> 
        <p><b>Especialidad del caso:</b> <span class="text-muted">Cardiología</span></p>  

        <p class="row ml-1"><b>Diagnóstico de ingreso:</b>
          <span class="text-muted description col">Fx desplazada de la base del 2do metatarsiano derecho
                                             Fx desplazada de la base del 3 metatarsiano derecho
                                             Fx del cuello del 2do metatarsiano derecho 
          </span>
        </p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col  @movil @else pl-5 pr-5  @endmovil">
      <p><b>Descripción del caso</b></p>
      <div class="mt-0 pl-4 pr-4 pt-0 mt-0">
        <p class="description text-justify">
          El día 9 de agosto se realiza la entrevista de pre medicación con la paciente, en donde se explica que  el plan anestésico consistirá en anestesia regional, se documenta que no existen antecedentes de importancia, hemograma y tiempos de coagulación en límites normales.

          Se deja  Unidosis por  tinzaparina 3500 U SC en pm, Ranitidina 50mg PO HS y AM, Metoclopramida 10mg PO HS y AM.

          Paciente se programa para el día 10 de agosto para intervención quirúrgica.

          ¿Antibiótico previo?

          Se ingresa a sala de operaciones en quirófano A4 a las 12:30min, en donde se evidencia paciente orientada en tiempo espacio y persona, se inicia el monitoreo básico en donde se documenta P/A 108/67 mmHg, Fc 88 x min, SO2 98%.

          Paciente se clasifica como ASA I con 60kg de peso, IMC: 25

          Se prepara equipo para una anestesia regional tipo raquídeo, en donde se coloca a la paciente en posición sentada, se palpan espacios adecuadamente; se procede a cargar jeringas con lidocaína sin epinefrina 80mg y otra jeringa con 25 mcg de fentanyl  más bupivacaina 10mg. Con técnica estéril se realiza asepsia y antisepsia, se inyecta anestésico local esperando el tiempo necesario para el efecto, se introduce trocar de aguja raquídea número 26; no se logra localizar espacio sub aracnoideo en el primer intento por lo que se recoloca el trocar y se localiza el espacio subaracnoideo  observando agua de roca sin presencia de eritrocitos, se inyecta anestésico (bupivacaina isobárica mas fentanyl), finaliza procedimiento si n complicaciones.

          Se posiciona a paciente en posición supina, monitoreo continua sin cambios.

          Se administra sedación 3mg midazolam

          15 minutos posteriores al bloqueo la paciente inicia súbitamente con dificultad a la respiración, rigidez mandibular con imposibilidad para colocar cánula oro faríngea, dado que no se logra ventilar a la paciente se administra 100mg de succinilcolina y se procede a intubar a paciente con tubo orotraqueal número 7, se administran 3mg de midazolam, no se auscultan ruidos pulmonares por lo que se administra 2 puff de salbutamol con lo que presente leve mejoría, auscultando sibilancias y estertores basales en ambos campos pulmonares, paciente hemodinamicamente inestable con hipotensión severa 60/40 mmHg  por lo que se administra 10mg de efederina intra venoso, se administra dexamentazona 8mg, paciente no recupera saturación de oxigeno la cual continua en 80%, se administran dos dosis más de efedrina 10mg y se traslada a recuperación a cargo de cuidado intensivo, sale de sala de operaciones con P/A 62/30 mmHg Fc. 123 x min y SO2 85%.

          Paciente se recibe en unidad de cuidados intensivos a cargo de cuidado crítico con ventilación mecánica y manejo de aminas vaso activas, sin embargo paciente permanece con saturación debajo de 90%.

          Posteriormente a las 18 horas es trasladada a unidad de cuidados intensivos del adulto cama # 6, en donde se le administra sedación con midazolam a 10cc/hr y tramadol a 10cc/h; continua con noreprinefrina a 25cc/hr (0.4 gamas), sus signos vitales son de 93/52 mmHg, Fc 160 x min, SO2 88%, bajo ventilación mecánica. La paciente presenta episodio de taquicardia supraventricular por lo cual se toma la decisión de cardio vertir e iniciar infusión de amiodarona; se inicia infusión de “lípidos” pensando en una “intoxicación por anestésico local” a 1.5 mg/kg.
        </p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col  @movil @else pl-5 pr-5 pb-5 pt-2 @endmovil">
      <p><b>Información complementaria final</b></p>
      <div class="pl-4 pr-4 m-0 ">
         
        <p class="row ml-1"><b>Tratamiento:</b>
          <span class="text-muted description col">Una vez que se ha determinado la causa de una enfermedad infecciosa, el médico comenzará el tratamiento. Se utilizará lo siguiente: Antibióticos: son usados para infecciones bacterianas, de hecho no tienen efecto en enfermedades virales.
          </span>
        </p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col  @movil @else pl-5 pr-5 pb-5 pt-2 @endmovil">
      <p><b>Documentación*</b></p>
      <div class="pl-4 pr-4 m-0 ">
         <ul class="list-unstyled">
           <li>
             <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Resultado Electrocardiograma.jpg</a>
           </li>
           <li>
             <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> Prueba emoglobina.pdf</a>
           </li>
           <li>
             <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Gasometria arterial.jpg</a>
           </li>
           <li>
             <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Gasometria arterial.jpg</a>
           </li>
           {{-- <li>
             <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
           </li> --}}
         </ul>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col  @movil @else pl-5 pr-5 pb-5 pt-2 @endmovil">
      <p><b>Comentarios:</b></p>
      <div class="pl-4 pr-4 m-0 ">
        <b>Dejar comentario</b>

        <div class="form-group mt-2">
           <textarea class="form-control shadow-sm border border-white"  rows="3" placeholder="Escribe aqui tu comentario."  name="comentario"  id="comentario"  autofocus  ></textarea>
        </div>
        <div class="form-group text-right ">
           <button class="btn btn-primary bgz-info pl-5 pr-5 border-0 rounded shadow-sm @movil  btn-block @endmovil" type="submit" id="btnsave">Publicar</button>
        </div>
      </div>
    </div>
  </div>

  {{-- lista de comentarios --}}

  <div class="row">
    <div class="col  @movil @else pl-5 pr-5 pb-5 pt-2 @endmovil">
    
      <div class="pl-4 pr-4 m-0 ">
        <p><b>Más relevantes</b></p>
        @if(isset($caso['comentarios']))

          @foreach($caso['comentarios'] as $cas)
            {{-- <div class="card-comment">
             
              <img class="img-circle img-sm" src="@if(isset($cas['usuario'][0]['img']) && $cas['usuario'][0]['img']!=null){{ \Storage::disk('wasabi')->temporaryUrl($cas['usuario'][0]['img'], now()->addMinutes(3600)  )  }} @else {{asset('ava1.png') }} @endif" alt="{{$cas['usuario'][0]['img']}}">
              <div class="comment-text">
                @if(auth()->user()->id==$cas['usuario'][0]['id'])
                  <span class="username">
                  @if(isset($cas['usuario'])) {{$cas['usuario'][0]['name']}} @endif
                  <span class="badge  btn badge-light float-right rounded text-primwary mr-1 border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-h"></i>  
                  </span>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item cursor" onclick="edit_coment('{{$cas->idaportaciones_encryp}}',this)"> editar</a>
                    <a class="dropdown-item cursor" onclick="delete_coment('{{$cas->idaportaciones_encryp}}',this)"> eliminar</a>
                  </div>
                </span>
                @endif
                <small class="users-list-date ">{{$cas->created_at->isoFormat('lll')}}</small>
                 <p class="input_coment">{{$cas->comentario}}</p> 
              </div>
            </div> --}}

            <div class="post callout clearfix callout-info shadow  bg-white ">
              <div class="user-block comment-text">
                <img class="img-circle img-bordered-sm" 
                    src="
                          @if(\Storage::disk('diskDocumentosPerfilUser')->exists($cas['usuario'][0]['img']))  
                              {{asset($cas['usuario'][0]['img'])}}
                          @else
                              {{ \Storage::disk('wasabi')->temporaryUrl($cas['usuario'][0]['img'], now()->addMinutes(3600) ) }}
                          @endif
                       "
                />
                <span class="username">
                  <a href="dd" class="text-dark font-weight-bold deco-none " style="text-decoration: none;cursor: pointer;">0</a>
                  @if(auth()->user()->id==$cas['iduser'])<button class="btn btn-xs   rounded ml-2" onclick="get_caso('1',this)"> <i class="fas fa-edit text-info_ fa-lg"></i> </button> @endif
                </span> 
                <span class="description ">dd - {{$cas->created_at->isoFormat('lll')}}</span>
              </div>
              <p>
               {{$cas['comentario']}}
              </p>
              <p class="mb-2">
                <span class=" text-sm mb-4"><i class="fas fa-heart"></i>  100</span>
                {{-- <span class=" text-sm ml-3"> <i class="far fa-comments mr-1"></i> Comments {{$item['comentarios_count']}}</span> --}}
              </p>
            </div>

          @endforeach

         

        @endif
      </div>
    </div>
  </div>

  {{-- <br>
  <br>
  <div class="invoice p-3 mb-3 ">
  
    <div class="row">
      <div class="col-12">
        <h2 class="text-primary">
          <i class="fas fa-capsules"></i> @if(isset($caso)) {{$caso->titulo}} @endif
           <small class="float-right h5 text-muted">Date:  @if(isset($caso)) {{$caso->created_at->isoFormat('lll')}} @endif</small>
        </h2>
      </div>
     
    </div>

    
    <div class="row invoice-info">
      <div class="col-sm-8 invoice-col">
        @if(isset($caso->descripcion))
          <address class="text-justify ">
            <strong class="text-muted profile-username">Descripción del caso </strong><br>
            <p>
              {{$caso->descripcion}} <br>
              <b class="text-muted ">Resultados de examenes</b>
              {{$caso->diagnostico}} 
              <b class="text-muted ">esta enfermedad afecta a</b>
              {{$caso->afecta_desc}} entre  {{$caso->edad_inicial}} y {{$caso->edad_final}} años.<br>
              <b class="text-muted ">Sintomas</b>
               {{$caso->sintoma}} <br>
               <b class="text-muted ">Causas </b>
               {{$caso->causas }} <br>
               <b class="text-muted ">Tratamientos Usados </b>
               {{$caso->tratamiento }} <br>
               <b class="text-muted ">Médicos visitados </b>
               {{$caso->medico_visitado }} <br>
            </p>
              <strong class="text-muted profile-username"></strong><br> 
          </address>
        @endif  
      </div>
     
      <div class="col-sm-4 invoice-col">
        <address>
          <strong class="text-muted">Video</strong><br>
          @if(isset($caso->url_video))
            <div class="embed-responsive embed-responsive-16by9 border border-primary">
              <iframe width="560" height="315" src="{{$caso->url_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          @endif
          
        </address>
      </div>
     
    </div>
  
    <div class="row">
      <div class="col-12 table-responsive">
        <div class="card-body">
          <button type="button" id="btn_coment" class="btn btn-default "><i class="fas fa-comments"></i> Responder</button>
         {{--  <button type="button" class="btn btn-default "><i class="far fa-thumbs-up"></i> Like</button> --}}
         {{--  <span class="float-right text-muted">
           <b>@if(isset($caso->visto)){{$caso['visto']}}@endif</b> visto - 
           <b id="t_coment" >@if(isset($caso->comentarios_count)){{$caso['comentarios_count']}} @endif </b> comments
         </span>
        </div>
      </div>
    </div>
    <div class="row">
      @if(isset($caso['comentarios']))
        <div class="col-md-12">
          <div class="card card-widget">
            <div class="card-footer card-comments" id="list_comets">
                @foreach($caso['comentarios'] as $cas)
                  <div class="card-comment">
                   
                    <img class="img-circle img-sm" src="@if(isset($cas['usuario'][0]['img']) && $cas['usuario'][0]['img']!=null){{ \Storage::disk('wasabi')->temporaryUrl($cas['usuario'][0]['img'], now()->addMinutes(3600)  )  }} @else {{asset('ava1.png') }} @endif" alt="{{$cas['usuario'][0]['img']}}">
                    <div class="comment-text">
                      @if(auth()->user()->id==$cas['usuario'][0]['id'])
                        <span class="username">
                        @if(isset($cas['usuario'])) {{$cas['usuario'][0]['name']}} @endif
                        <span class="badge  btn badge-light float-right rounded text-primwary mr-1 border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-h"></i>  
                        </span>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <a class="dropdown-item cursor" onclick="edit_coment('{{$cas->idaportaciones_encryp}}',this)"> editar</a>
                          <a class="dropdown-item cursor" onclick="delete_coment('{{$cas->idaportaciones_encryp}}',this)"> eliminar</a>
                        </div>
                      </span>
                      @endif
                      <small class="users-list-date ">{{$cas->created_at->isoFormat('lll')}}</small>
                       <p class="input_coment">{{$cas->comentario}}</p> 
                    </div>
                  </div>
                @endforeach
            </div>
            
           
            <div class="card-footer d-none f_coment">
              <form id="form_coment" action="{{url('gestion/coment')}}" method="POST">
                 {{ csrf_field() }}
                <img class="img-fluid img-circle img-sm" src="{{auth()->user()->img}}" alt="Alt Text">
                <div class="img-push">
                  <input type="text"  id="comentario" class="form-control form-control-sm" name="comentario" placeholder="Press enter to post comment">
                  <input type="hidden" id="idart" name="idart" value="{{$caso->idarticulo_encryp}}">
                </div>
              </form>
            </div>
           
          </div>
        </div>
      @endif
    </div>

    <div class="row">
      <div class="col-12">
        <span class="float-left text-muted">
          <a href="{{url('medico/casos_ex')}}"> <i class="fa fa-backward"></i> Regresar</a>
        </span>
      </div> 
    </div>
  </div>  --}}
  
@stop

{{-- Seccion para insertar css--}}
@section('include_css') 
  {{-- stilos casos detalle --}}
  <link rel="stylesheet" href="{{ asset('css/detalle_casos.css') }}">
@stop   

{{-- Seccion para insertar js--}}
@section('include_js')
  {{-- controlar imagen de rotas --}}
  <script src="{{ asset('/js/control_img_rotas.js') }}"></script>
  <script src="{{ asset('/js/casos_ex.js') }}"></script>
@stop