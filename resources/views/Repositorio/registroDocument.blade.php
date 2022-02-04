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
      <h3 class="card-title">Ingresar nuevo documento </h3>
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
      <div class="container col-md-8 ">
        <div class="row">
          <div class=" col-md-12 col-lg-12 order-1 order-md-2 ">
              <form method="POST" action="{{ url('biblioteca/show') }}" enctype="multipart/form-data" id="for_archivo" >
                @csrf
                <input  type="hidden" name="_method" id="method_bibli" value="POST">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    
                    <div class="form-group file_img input-group">
                      {{-- <label class="text-muted" for="img">Seleccione Archivo <span class="text-red">*</span></label> <br> --}}
                      <input type="file" class=" form-control"  accept="application/pdf " id="img"  name="img" >
                       <div class="input-group-append d-none icon-input" onclick="minusInputFile()">
                        <span class="input-group-text btn"><i class="fas fa-folder-minus"></i></span>
                      </div>
                    </div>

                    <div class="input-group mb-3 d-none file_txt">
                      <input type="text" class="form-control" id="file_txt">
                      <div class="input-group-append" onclick="addinputFile()">
                        <span class="input-group-text btn"><i class="fas fa-folder-plus"></i></span>
                      </div>
                    </div>
                  </div>
                 
                  

                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label class="text-muted" for="titulo">Nombre del archivo <span class="text-red">*</span></label>
                      <input class="form-control  @error('titulo') is-invalid @enderror" name="titulo" id="titulo"
                      placeholder="Ingrese nombre del archivo " value="{{ old('titulo') }}"  autocomplete="titulo" autofocus>
                      @error('titulo')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <label class="text-muted" for="descripcion">Descripción del archivo </label>
                      <input class="form-control  @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion"
                      placeholder="Ingrese descripción del archivo " value="{{ old('descripcion') }}"  autocomplete="descripcion" autofocus>
                      @error('descripcion')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                   
                    
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="idespecialidades" class="text-muted">Seleccione especialidad <span class="text-red">*</span></label>
                      <select  class="form-control  select22 @error('idespecialidades') is-invalid @enderror" style="width: 100%;"
                      data-placeholder="Seleccione especialidad " name="idespecialidades" id="idespecialidades" >
                        <option></option>
                        @if(isset($lista_esp))
                          @foreach($lista_esp as $item)
                            <option  value="{{$item->idespecialidades}}">
                              {{$item->descripcion}}
                            </option>
                          @endforeach
                        @endif
                      </select>
                        @error('idespecialidades')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                  </div>
                    <button class="btn btn-primary" type="submit" id="btnsave">Guardar</button>
                    <button class="btn btn-warning" type="button" id="btn_cancelar">Cancelar</button>
                </div>
                  
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Lista de documentos </h3>
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
            <div class="col-12">
              
                 <div class="table-responsive">
                  <table id="table_publi" class=" data_table table table-sm table-bordered table-striped">
                    <thead>
                      <tr>
                          <th> # </th>
                          <th width="140px">Archivo</th>
                          <th>Titulo</th>
                          <th>Descripción</th>
                          <th >Especialidad  </th>
                          <th width="80px">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (isset($lista))
                        @foreach ($lista as $key => $item)
                          <tr>
                            <td>{{ $key + 1 }}</td>
                            @if($item->tipo=='IMG')
                              <td style="vertical-align: middle; cursor: pointer;" onclick="visor_show('{{$item->tipo}}','{{asset("DocumentosBiblioteca/".$item->ruta)}}','{{$item['titulo']}}')"> 
                                <span class="mailbox-attachment-icon has-img">
                                  <img class="img img-fluid mb-3" src="{{asset('DocumentosBiblioteca/'.$item->ruta)}}" alt="Attachment">
                                </span>
                               
                              </td>
                            @else
                              <td style="vertical-align: middle; cursor: pointer;" onclick="visor_show('{{$item->tipo}}','{{ asset("DocumentosBiblioteca/".$item->ruta)}}','{{$item['titulo']}}')"><span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                               
                              </td>
                            @endif
                           
                            <td style="vertical-align: middle; ">{{ $item['titulo'] }}</td>
                            <td style="vertical-align: middle;">{{ $item['descripcion'] }}</td>
                            <td style="vertical-align: middle;">{{ $item['especialidad']['descripcion'] }}</td>
                           
                            <td style="vertical-align: middle;" class="text-center" style="vertical-align: middle;">
                              <form method="POST"  class="frm_eliminar" action="{{url('biblioteca/show/'.$item->idbiblioteca_virtual_encryp)}}"  enctype="multipart/form-data">
                                  <div class="btn-group btn-group-sm">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="_method" value="DELETE">
                                      <a href="#for_archivo" class="btn btn-sm btn-primary "
                                          onclick="editar_archivo('{{ $item->idbiblioteca_virtual_encryp }}')"><i
                                              class="fa fa-edit"></i> </a>
                                      <button type="button" class="btn btn-sm btn-danger"
                                        onclick="btn_eliminar_archivo(this)"><i class="fa fa-trash"></i> </button>
                                  </div>
                              </form> 
                            </td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>    
                </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
 @include('Repositorio.modal_visor')

  @section('include_css') 
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      
  </style>
  @stop   
  {{-- Seccion para insertar js--}}
  @section('include_js')
    {{-- Mensaje de informacion --}}
    @if(session()->has('info'))
      <script >
       mostrar_toastr('{{session('info')}}','{{session('estado')}}')
      </script>
    @endif
    
     <script >
       $(document).ready(function() {
           $('.select22').select2();
       });
    </script>
    <script src="{{ asset('/js/biblioteca_virtual.js') }}"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
    </script>
    <script>
    var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1
    }

    // more code here
</script>
  @stop


 @stop
