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
      <h3 class="card-title">Repositorio </h3>
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
        <div class="col-12 col-md-12 col-lg-12 ">
          <div class="row ">
            <div class="col-md-2 mb-2 mt-3">
              <div class="btn-group b" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filtrar por especialidades
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    @if(isset($lista_esp))
                      @foreach($lista_esp as $item)
                         <a class="dropdown-item" href="#">{{$item['descripcion']}}</a>
                      @endforeach
                    @endif
                     

                  </div>
              </div>
            </div>
            <div class="col-md-10 mt-3">
              <form action="" method="POST">
                {{ csrf_field() }}
                <input id="method_" type="hidden" name="_method" value="POST">                  
                <div class="input-group  ">
                  <input type="Search" class="form-control" name="search_caso" value="" >
                  <div class="input-group-append">
                     <button class="input-group-text " type="submit"> <i class="fas fa-search"></i> </button>
                  </div>
                </div>
              </form> 
            </div>

            <div class="col-12">
             
                @if(isset($lista_casos))
                  @foreach($lista_casos as $item)
                    
                  @endforeach
                    
 
                @else
                  <div class="alert alert-light mt-4 " role="alert">
                    No se obtubo ningún resultado
                  </div>
                @endif
                
            </div>

          </div>
        </div>
        <div class=" col-md-12 col-lg-4 order-1 order-md-2">
          
        </div>
      </div>
    </div>
  </div>
  
 

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
