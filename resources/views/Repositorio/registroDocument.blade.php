@extends('homeOption2h')
@section('title','Perfil-Médico')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
{{-- cuerpo de la pagina --}}
@section('contenido') 
  <div class="row justify-content-start">
    <div class="col text-center mt-4">
      <a href="{{asset('biblioteca/show')}}" class="text-leth float-left ">  <i class="fas fa-chevron-left mr-3 text-info_ fa-2x ml-5 mb-5 "></i></a>
      <span class="text-info_ h5"><b>Biblioteca</b></span>
    </div>
  </div>

  <div class="card ml-5 mr-5 shadow-sm  bg-white rounded">
    <div class="card-header  border-0">
      <h3 class="card-title text-secondary"><b>Ingresar nuevo documento</b> </h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus text-info_"></i>
        </button>
        
      </div>
    </div>

    <div class="card-body ">
      <div class="container col-md-10 ">
        <div class="row">
          <div class=" col-md-12 col-lg-12 order-1 order-md-2 ">
              <form method="POST" action="{{ url('biblioteca/show') }}" enctype="multipart/form-data" id="for_archivo" >
                @csrf
                <input  type="hidden" name="_method" id="method_bibli" value="POST">
                <div class="row">

                  <div class="col-xs-12 col-sm-12 col-md-6 mt-3">
                    <div class="form-group">
                      <label class="text-muted" for="titulo">Nombre del archivo <span class="text-red">*</span></label>
                      <input class="form-control border border-white shadow-sm  @error('titulo') is-invalid @enderror" name="titulo" id="titulo"
                      placeholder="Ingrese nombre del archivo " value="{{ old('titulo') }}" required  autocomplete="titulo" autofocus>
                      @error('titulo')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-6 mt-3">
                    <div class="form-group">
                      <label class="text-muted" for="descripcion">Descripción del archivo </label>
                      <input class="form-control  border border-white shadow-sm   @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion"
                      placeholder="Ingrese descripción del archivo " value="{{ old('descripcion') }}"  autocomplete="descripcion" autofocus>
                      @error('descripcion')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-xs-12 col-sm-12 col-md-6 mt-3">
                    <div class="form-group">
                      <label for="idespecialidades" class="text-muted">Seleccione especialidad <span class="text-red">*</span></label>
                      <select  class="form-control shadow-sm border border-white select22 @error('idespecialidades') is-invalid @enderror" style="width: 100%;"  data-placeholder="Seleccione especialidad " name="idespecialidades" id="idespecialidades" required >
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
                  </div>  

                  <div class="col-xs-12 col-sm-12 col-md-6 mt-3">
                    <div class="form-group file_img ">
                       <label for="img" class="text-muted">Documentación <span class="text-red">*</span></label>
                       <div class="input-group ">

                        <input type="file" class="form-control border border-white shadow-sm @error('img') is-invalid @enderror"  accept="application/pdf " id="img"  name="img" required >
                         @error('img')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                        <div class="input-group-append d-none icon-input" onclick="minusInputFile()">
                          <span class="input-group-text btn"><i class="fas fa-folder-minus"></i></span>
                        </div>
                      </div>  
                       
                    </div>

                    <div class="form-group mb-3 d-none file_txt ">
                      <label for="img" class="text-muted">Documentación <span class="text-red">*</span></label>
                      <div class="input-group ">
                        <input type="text" class="form-control  border border-white shadow-sm" id="file_txt">
                        <div class="input-group-append" onclick="addinputFile()">
                          <span class="input-group-text btn"><i class="fas fa-folder-plus"></i></span>
                        </div>
                      </div>
                    </div>
                    
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <div class="form-group text-center">
                      <button class="btn btn-outline-light pl-5 pr-5  text-info_ border border-info_" type="button" id="btn_cancelar">Cancelar</button>
                      <button class="btn btn-primary bgz-info pl-5 pr-5 border-0"  type="submit" id="btnsave" > <i class=" fa fa-save"></i> Guardar</button>
                    </div>
                  </div>
                
                </div>
                  
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="card ml-5 mr-5 shadow-sm  bg-white rounded">
    <div class="card-header border-0">
      <h3 class="card-title text-secondary"><b>Lista de documentos </b></h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12 ">
          <div class="row ">
            <div class="col-12">
              
                 <div class="table-responsive">
                  <table id="table_publi" class=" data_table table table-sm border-0 text-center" border="0" cellspacing="10">
                    <thead >
                      <tr class="text-info_ ">
                          <th> Num. </th>
                          <th width="140px">Archivo</th>
                          <th>Titulo</th>
                          <th>Descripción</th>
                          <th >Especialidad  </th>
                          <th width="80px">Opciones</th>
                      </tr>
                    </thead>
                    <tbody class="">
                      @if (isset($lista))
                        @foreach ($lista as $key => $item)
                          <tr>
                            <td>{{ $key + 1 }}</td>
                            @if($item->tipo=='IMG')
                              <td style="vertical-align: middle; cursor: pointer;" onclick="visor_show('{{$item->tipo}}','{{ $img=\Storage::disk('wasabi')->temporaryUrl( $item->ruta, now()->addMinutes(3600)) }}','{{$item['titulo']}}')"> 
                                <span class="mailbox-attachment-icon has-img">
                                  {{-- <img class="img img-fluid mb-3" src="{{asset('DocumentosBiblioteca/'.$item->ruta)}}" alt="Attachment"> --}}
                                   <img class="img img-fluid mb-3 rounded border border-info" src="{{ $img }}" alt="{{$item->titulo}}"/>
                                </span>
                               
                              </td>
                            @else
                              <td style="vertical-align: middle; cursor: pointer;" onclick="visor_show('{{$item->tipo}}','{{ $doc=\Storage::disk('wasabi')->temporaryUrl( $item->ruta, now()->addMinutes(3600)) }}','{{$item['titulo']}}')"><span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                               
                              </td>
                            @endif
                           
                            <td style="vertical-align: middle; ">{{ $item['titulo'] }}</td>
                            <td style="vertical-align: middle;">{{ $item['descripcion'] }}</td>
                            <td style="vertical-align: middle;">{{ $item['especialidad']['descripcion'] }}</td>
                           
                            <td style="vertical-align: middle;" class="text-center" style="vertical-align: middle;">
                              <form method="POST"  class="frm_eliminar" action="{{url('biblioteca/show/'.$item->idbiblioteca_virtual_encryp)}}"  enctype="multipart/form-data"> 
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-link text-info_ dropdown-toggle border border-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   Seleccione
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item text-info_" href="#for_archivo"  onclick="editar_archivo('{{ $item->idbiblioteca_virtual_encryp }}')"> Editar Documento</a>
                                    <a class="dropdown-item text-info_"  onclick="btn_eliminar_archivo(this)" href="#">Borrar Documento</a>
                                  </div>
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
      {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
      <style>
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #0FADCE transparent transparent transparent !important;

        }
        .select2-container--default .select2-selection--single {
          border-top: 0px solid #ced4da;
          border-right: 0px solid #ced4da;
          border-left: 0px solid #ced4da;
          border-bottom: 0px solid #ced4da;
          box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
        }
        table, tr, td,thead{
          border:none !important;
        }
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
    {{-- <script  src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"> </script> --}}
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
