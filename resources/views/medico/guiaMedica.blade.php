
@extends('homeOption2h')
@section('title','Perfil')

@section('contenido')
    
    @movil
        <div class="col-md-12 ">
            <div class="d-flex justify-content-start ml-4 mt-4 flex_titulo">
                <a href="/">  <p class=" text-lead h2 text-info_ ">  <i class="fas fa-chevron-left mr-3 text-info_"></i>  Guía Médica  </p></a>    
            </div>
        </div>
        <div class="row">
            <div class="col-12 ">
                <div class="row mt-2">
                    <div class="col-7 ">
                        <span class="text-filtro"><b>Filtro por especialidad</b></span>
                        <div class="form-group mt-4 botones ">
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" 
                                class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='A') text-info_ @else text-dark @endif">
                                <span>A</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('B'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='B') text-info_  @endif">
                                <span>B</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('C'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='C') text-info_  @endif">
                                <span>C</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('D'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='D') text-info_  @endif">
                                <span>D</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('E'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='E') text-info_  @endif">
                                <span>E</span>
                            </a>
                            
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('F'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='F') text-info_  @endif">
                                <span>F</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('G'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='G') text-info_  @endif">
                                <span>G</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('H'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='H') text-info_ @endif">
                                <span>H</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('I'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='I') text-info_ @endif">
                                <span>I</span>
                            </a>

                            <a href="{{url('medico/getMedico_filtro/'.encrypt('J'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='J') text-info_ @endif">
                                <span>J</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('K'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='K') text-info_ @endif">
                                <span>K</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('L'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='L') text-info_ @endif">
                                <span>L</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('M'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='M') text-info_ @endif">
                                <span>M</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('N'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='N') text-info_ @endif">
                                <span>N</span>
                            </a>
                            
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('O'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='O') text-info_ @endif">
                               <span>O</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('P'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='P') text-info_ @endif">
                                <span>P</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('Q'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='Q') text-info_ @endif">
                                <span>Q</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('R'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='R') text-info_ @endif">
                                <span>R</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('S'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='S') text-info_ @endif">
                                <span>S</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('T'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='T') text-info_ @endif">
                                <span>T</span>
                            </a>

                            <a href="{{url('medico/getMedico_filtro/'.encrypt('U'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='U') text-info_ @endif">
                               <span>U</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('V'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='V') text-info_  @endif">
                                <span>V</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('W'))}}" class="btn_filtro_espe  float-left shadow-sm mr-6 @if(isset($value) && $value=='W') text-info_  @endif">
                               <span> W</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('Y'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='X') text-info_  @endif">
                                <span>X</span>
                            </a>
                            <a href="{{url('medico/getMedico_filtro/'.encrypt('X'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='Y') text-info_  @endif">
                                 <span>Y</span>
                            </a>

                            <a href="{{url('medico/getMedico_filtro/'.encrypt('Z'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='Z') text-info_  @endif">
                                <span>Z</span>
                            </a>

                        </div>
                    </div>
                    <div class="col-5 ">
                        <span class="text-filtro mt-5"><b>Especialidades</b></span>
                        <div class="form-s mt-4  ml-3">
                            @if(isset($lista_espec))
                                @foreach($lista_espec->take(6) as $esp)
                                    <ul class="list-unstyled m-0">
                                        <li class="m-0 list_esp"> 
                                            <a href="{{url('medico/getMedico_filtro/'.encrypt($esp->descripcion))}}" class="@if(isset($value) && Str::is($value.'*', $esp->descripcion)) text-info_  @endif">
                                                 {{$esp->descripcion}} 
                                            </a>
                                        </li>
                                    </ul>
                                   
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row  mt-4">
                    @if(isset($medicos))
                        @foreach( $medicos as $key=>$item)
                            <div class="col-6  ">
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
                                       
                                        <small class="txt_titulo text-muted text-center"> 
                                            @if(isset($item['titulo']))
                                                  {{Str::limit($item['titulo']['descripcion'], 37,'...')}}. 
                                            @endif
                                            {{ Str::limit($item['detalle_experiencia'], 37,'...') }}
                                        </small><br>
                                        <small class="text-muted text-center">Teléfono: {{$item->telefono}}</small><br>
                                        <small class="text-muted">Email:  {{Str::limit($item->email, 27,'...')}}</small><br>
                                        <small class="text-muted"> {{Str::limit($item->direccion, 67,'...')}} </small><br>  
                                            
                                    </div>
                                    <div class="form-group row pt-0 pl-2 pr-2">
                                        <div class="col-md-12 offset-md-12">
                                            <a href="{{url('medico/info/'.encrypt($item->id))}}" type="submit" class="btn btn-xs bgz-info btn-block text_url  text-white rounded ">
                                                {{ __('Visitar perfil') }} 
                                            </a>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div> 
    @else

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
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('A'))}}" 
                                    class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='A') text-info_ @else text-dark @endif">
                                    <b>A</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('B'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='B') text-info_  @endif">
                                    <b>B</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('C'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='C') text-info_  @endif">
                                    <b>C</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('D'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='D') text-info_  @endif">
                                    <b>D</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('E'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='E') text-info_  @endif">
                                    <b>E</b>
                                </a>
                                
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('F'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='F') text-info_  @endif">
                                    <b>F</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('G'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='G') text-info_  @endif">
                                    <b>G</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('H'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='H') text-info_ @endif">
                                    <b>H</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('I'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='I') text-info_ @endif">
                                    <b>I</b>
                                </a>

                                <a href="{{url('medico/getMedico_filtro/'.encrypt('J'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='J') text-info_ @endif">
                                    <b>J</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('K'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='K') text-info_ @endif">
                                    <b>K</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('L'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='L') text-info_ @endif">
                                    <b>L</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('M'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='M') text-info_ @endif">
                                    <b>M</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('N'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='N') text-info_ @endif">
                                    <b>N</b>
                                </a>
                                
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('O'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='O') text-info_ @endif">
                                    <b>O</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('P'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='P') text-info_ @endif">
                                    <b>P</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('Q'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='Q') text-info_ @endif">
                                    <b>Q</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('R'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='R') text-info_ @endif">
                                    <b>R</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('S'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='S') text-info_ @endif">
                                    <b>S</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('T'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='T') text-info_ @endif">
                                    <b>T</b>
                                </a>

                                <a href="{{url('medico/getMedico_filtro/'.encrypt('U'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='U') text-info_ @endif">
                                    <b>U</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('V'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='V') text-info_  @endif">
                                    <b>V</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('W'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='W') text-info_  @endif">
                                    <b>W</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('Y'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='X') text-info_  @endif">
                                    <b>X</b>
                                </a>
                                <a href="{{url('medico/getMedico_filtro/'.encrypt('X'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='Y') text-info_  @endif">
                                    <b>Y</b>
                                </a>

                                <a href="{{url('medico/getMedico_filtro/'.encrypt('Z'))}}" class="btn_filtro_espe  float-left shadow-sm @if(isset($value) && $value=='Z') text-info_  @endif">
                                    <b>Z</b>
                                </a>

                            </div>
                        </div>
                        <div class="col-12 ">
                            <span class="text-filtro mt-5"><b>Especialidades</b></span>
                            <div class="form-s mt-4  ml-3">
                                @if(isset($lista_espec))
                                    @foreach($lista_espec->take(6) as $esp)
                                        <ul class="list-unstyled m-0">
                                            <li class="m-0 list_esp"> 
                                                <a href="{{url('medico/getMedico_filtro/'.encrypt($esp->descripcion))}}" class="@if(isset($value) && Str::is($value.'*', $esp->descripcion)) text-info_  @endif">
                                                     {{$esp->descripcion}} 
                                                </a>
                                            </li>
                                        </ul>
                                       
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9 col-md-8 col-sm-12">
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
                                                        <a href="{{url('medico/info/'.encrypt($item->id))}}" type="submit" class="btn btn-info btn-block text_url btn-xs text-white" style="background-color:#0FADCE;">
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
    @endmovil    
@stop

@section('include_css')
     <link rel="stylesheet" href="{{ asset('css/guiaMedica.css') }}">
@stop

@section('include_js')

@stop
