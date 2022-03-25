@extends('homeOption2h')
@section('title','Coinsult')

{{-- cuerpo de la pagina --}}
@section('contenido')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-12 ">
                <div class="d-flex justify-content-start ml-4 mt-4 flex_titulo">
                    <a href="/">  <p class=" text-lead h2 text-info_ ">  <i class="fas fa-chevron-left mr-3 text-info_"></i>  Coinsults  </p></a>    
                </div>
            </div>
            <div class="col-lg-7  col-sm-12">
                <div class="d-flex justify-content-start ml-4 flex_content_coinsul">
                    <div class="card  border-0">
                        <div class="card-header mb-4">
                            
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="description-block info-box mb-3 border border-info p-0">
                                        <span class="description-text text-info_">Coinsults Actuales</span>
                                        <h4 class="description-text text-secondary">{{Auth::user()->coins()}}</h4>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="description-block info-box mb-3 border border-info">
                                        <span class="description-text text-info_">Movimientos</span>
                                        <h4 class="description-text text-secondary">{{Auth::user()->coins_movimiento()}}</h4>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            <!-- /.col -->
                            </div>
                        </div>
                        <div class="card-body pt-0 mb-3">
                            <div class="lead  text-justify text-muted">
                                <dl>
                                    <dt> ¿Sabes qué son los Coinsults?</dt>
                                    <dd class="mb-3"> Son los puntos que ganas cada vez que interactúas con esta plataforma.</dd>
                                    
                                    <dt> Como PACIENTE, podrás obtener Coinsults de las siguientes maneras:</dt>
                                    <dd>
                                        <ul class="list">
                                            <li> Al crear tu cuenta en Option2health, ganarás automáticamente 5 Coinsults de bienvenida.</li>
                                            <li> Primer “Like” en una publicación de la plataforma de Option2health. </li>
                                            <li> Cada vez que respondes a una de nuestras preguntas en la plataforma, entre otras.</li> 
                                        </ul>
                                    </dd>
                                    
                                    <dt class="ml-3"> ¿Cómo podrás usar tus Coinsults?</dt>
                                    <dd class="ml-3 mb-4 ">PRÓXIMAMENTE, tu salud mejorará gracias a los Coinsults que obtengas. Mientras más Coinsults acumules, mayores probabilidades tendrás de acceder a consultas médicas con tu médico preferido dentro de la plataforma, o incluso beneficiar a los miembros de tu familia o amigos, a quienes les puedas DONAR tus Coinsults y así apoyarlos en sus necesidades de salud.</dd>
                                 
                                    <dt> El MÉDICO, también podrá ganar Coinsults de las siguientes maneras:</dt>
                                    <dd>
                                        <ul class="mb-3 list">
                                            <li> Al crear tu cuenta en Option2health, ganarás automáticamente 5 Coinsults de bienvenida.</li>
                                            <li> Primer “Like” en una publicación de la plataforma de Option2health. </li>
                                            <li> Creación de contenido de valor para tus pacientes, entre otras.</li>
                                             
                                        </ul>
                                    </dd>
                                  
                                    <dt class="ml-3">¿Cómo podrás usar tus Coinsults?</dt>
                                    <dd class="ml-3">Como MÉDICO, podrás canjear tus Coinsults acumulados por más publicaciones pautadas en nuestra plataforma y de esta manera llegar a más usuarios y potenciales pacientes que requieran de tus servicios.</dd>    
                                </dl> 
                            </div> 
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5  col-sm-12">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-start ml-4 flex_titulo">
                            <p class=" text-lead h4 text-info_ text-muted">  </i>  Historial de Coinsults  Acumulados  </p>    
                        </div>
                    </div>
                </div> 
                <div class="timeline mt-4">
                    @if (isset($coinsult))
                        @foreach ($coinsult as $coin )
                            <div>
                                <i class="fas fa-{{$coin->detalle_coinsult[0]['icon']}} bg-{{$coin->detalle_coinsult[0]['color']}} fa-2x"></i>
                                <div class="timeline-item border-0">
                                    <span class="time"><i class="fas fa-clock"></i> {{ $coin->created_at->isoFormat('lll')}}</span>
                                    <h3 class="timeline-header text-muted"><b>Has ganado "{{ $coin->detalle_coinsult[0]['punto']}}" coinsults</b> </h3>

                                    <div class="timeline-body border-0">
                                        {{ $coin->detalle_coinsult[0]['descripcion']}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    @endif
                </div>
            </div>
        </div>
    </div>

            
        
    
    @section('include_css') 
     <style >
         
     </style>
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
        <style>
           .card {
               box-shadow: 0 0 0px rgb(0 0 0 / 0%), 0 1px 3px rgb(0 0 0 / 0%) !important;
               margin-bottom: 1rem !important;
           }  

           .timeline>div>.timeline-item>.timeline-header {
               border-bottom: 0px solid rgba(0,0,0,.125);
               
           }
            
        </style>
    @stop
    


 @stop
