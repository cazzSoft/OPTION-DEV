
@extends('homeOption2h')
@section('title','Perfil')

@section('contenido')
    <div class="row">
        <div class="col">
            <p class=" text-lead h3 text-info text-center mb-3">  
               <a href="/"> <i class="fas fa-chevron-left  text-info float-left ml-5"></i></a>
               <b class="text-center mr-5">  Guía Médica   </b>
            </p>
        </div>
    </div>

    <div class="container-fluid  ml-5 mt-4">
        <div class="row">
            <div class="col-3 ">
                <div class="row">
                    <div class="col-12 ">
                        <span class="text-filtro"><b>Filtro por especialidad</b></span>
                        <div class="form-group mt-4 botones ">
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>A</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>B</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>C</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>D</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>E</b></a>
                            
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>F</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>G</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>H</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>I</b></a>

                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>J</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>K</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>L</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>M</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>N</b></a>
                            
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>O</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>P</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>Q</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>R</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>S</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>T</b></a>

                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>U</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>V</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>W</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>X</b></a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>Y</b></a>

                            <a href="{{url('medico/getMedico_filtro/'.encrypt('Z'))}}" class="btn_filtro_espe  float-left shadow-sm"><b>Z</b></a>

                        </div>
                    </div>
                    <div class="col-12 ">
                        <span class="text-filtro mt-5"><b>Especialidades</b></span>
                        <div class="form-s mt-4  ml-3">
                            @if(isset($lista_espec))
                                @foreach($lista_espec->take(6) as $esp)
                                    <ul class="list-unstyled m-0">
                                        <li class="m-0 list_esp"> <a href="{{url('medico/getMedico_filtro/'.encrypt($esp->descripcion))}}" class="text-dark"> {{$esp->descripcion}}</a></li>
                                    </ul>
                                   
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 col-md-8 col-sm-12">
                <div class="row  m-auto">
                    @if(isset($medicos))
                        @foreach( $medicos as $key=>$item)
                            <div class="col  text-center m-auto">
                                <div class="guia shadow2 mb-4">
                                    <div class="name_medico text-truncate ">
                                        <b>{{ strtoupper( $item->name)}}</b>
                                    </div>
                                    <div class="text-center ">
                                        <img src="
                                                    @if(\Storage::disk('diskDocumentosPerfilUser')->exists($item->img)) 
                                                        {{asset($item->img)}}
                                                    @else
                                                        {{$img=\Storage::disk('wasabi')->temporaryUrl($item->img, now()->addMinutes(3600)  )}}
                                                    @endif
                                                "  alt="Product 1" class="img-circle img-size-32 mt-1 bg-light"> 
                                    </div>
                                    <div class="detalle_guia_medico ">
                                        <div class="card-body p-3">
                                            <small class="txt_titulo text-muted text-center"> 
                                                @if(isset($item['titulo']))
                                                      {{Str::limit($item['titulo']['descripcion'], 37,'...')}}. 
                                                @endif
                                                {{ Str::limit($item['detalle_experiencia'], 37,'...') }}
                                            </small><br>
                                            <small class="text-muted text-center">Teléfono: {{$item->telefono}}</small><br>
                                            <small class="text-muted">Email:  {{Str::limit($item->email, 27,'...')}}</small><br>
                                            <small class="text-muted"> {{Str::limit($item->direccion, 67,'...')}} </small><br>  
                                            
                                            <div class="form-group row mt-3">
                                                <div class="col-md-12 offset-md-12">
                                                    <a href="{{url('medico/info/'.encrypt(4))}}" type="submit" class="btn btn-info btn-block text_url btn-xs" style="background-color:#0FADCE;">
                                                        {{ __('Visitar perfil') }} 
                                                    </a>
                                                </div>
                                            </div>              
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>    
    </div>
       
@stop

@section('include_css')
     <link rel="stylesheet" href="{{ asset('css/guiaMedica.css') }}">
@stop

@section('include_js')

@stop
