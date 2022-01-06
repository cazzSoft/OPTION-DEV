@extends('homeOption2h')
@section('title','Coinsult')

{{-- cuerpo de la pagina --}}
@section('contenido')
    <div class="row">
        <div class="col-12 col-sm-8">
            <h2 class="text-primary">
                  Coinsults 02H
            </h2>
            <div class="card d-flex flex-fill card card-outline card-info mt-5 ">
                <div class="card-header text-muted border-bottom-0 mb-4">
                    <div class="icom-coin widget-user-image" >
                        <img src="http://option2health.com/assets/img/coinsults.jpeg" class="img-circle elevation-2 img2">
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <span class="description-text">Coinsults Actuales</span>
                                <h4 class="description-text text-info">6</h4>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <div class="description-block">
                                <span class="description-text">Movimientos</span>
                                <h5 class="description-header">2</h5>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    <!-- /.col -->
                    </div>
                </div>
                <div class="card-body pt-0 ">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-coins"></i>¿Sabes qué son los <span class="text-info">Coinsults ?</span> 
                            {{-- <small class="float-right">Date: 2/10/2014</small> --}}
                        </h4>
                        
                    </div>
                    <div class="col-12">
                        <p class=" text-justify">
                            Son los puntos que ganas cada vez que interactúas con esta plataforma. Algunas maneras de obtener Coinsults son:
                        </p>
                        <p>
                            <i class="fa fa-check text-success"></i>  Al crear tu cuenta en Option2health con lo cual ganas 5 <span class="text-info">Coinsults</span> de bienvenida.
                        </p>
                        <p>
                            <i class="fa fa-check text-success"></i> Primer “Like” en una publicación de la plataforma de Option2health.
                        </p>
                        <p>
                            <i class="fa fa-check text-success"></i> Creación de contenido de valor para tus pacientes, entre otras.
                        </p>
                    </div>
                    <div class="col-12">
                        <h4>
                            ¿Para qué sirven? 
                        </h4>
                        <p class="mt-2 text-justify">
                            Con tus Coinsults acumulados pordrás canjearlos por más publicaciones pautadas en nuestra plataforma y de esta manera llegar a más usuarios y potenciales pacientes que requieran de tus servicios.
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
         <div class="col-12 col-sm-4">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h2 class="text-primary">  Tus Movimientos</h2>
                </div>
                <div class="col-sm-12">
                   <p class="text-muted">En esta sección podrás encontrar los movimientos realizados en tu cuenta O2h</p>
                </div>
            </div> 
            <div class="timeline">
                @if (isset($coinsult))
                    @foreach ($coinsult as $coin )
                        <div>
                            <i class="fas fa-{{$coin->detalle_coinsult[0]['icon']}} bg-{{$coin->detalle_coinsult[0]['color']}}"></i>
                            <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> {{ $coin->created_at->isoFormat(' lll')}}</span>
                            <h3 class="timeline-header"><a href="#">Has ganado "{{ $coin->detalle_coinsult[0]['punto']}}" coinsult</a> </h3>

                            <div class="timeline-body">
                               {{ $coin->detalle_coinsult[0]['descripcion']}}
                            </div>
                            </div>
                        </div>
                    @endforeach
                    
                @endif
            </div>

        </div>
    </div>    
        
    

    @section('include_css') 
     
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
        <style>
            .icom-coin {
                position: absolute;
                left: 3vh;
                top: -4.8vh;
                width: 8em;
                height: 8em; 
            }
            .img2{
            width: 80%;
            }
        </style>
    @stop
    


 @stop
