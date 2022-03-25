@extends('homeOption2h')
@section('title','Noticia')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
{{-- cuerpo de la pagina --}}


@section('contenido')
  
  <div class="container">
    <h1>Gestión de noticias</h1>  
    <div class="card  collapsed-card card-control" id="card">
      <div class="card-header">
        <h3 class="card-title">Ingresar nueva noticia </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" id="collapse_form" data-card-widget="collapse" title="Collapse2">
            <i class="fas fa-plus fas-control"></i>
          </button>
         {{--  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times "></i>
          </button> --}}
        </div>
      </div>

      <div class="card-body">
        <div class="container col-md-8 ">
          <div class="row">
            <div class=" col-md-12 col-lg-12 order-1 order-md-2 ">
                <form method="POST" action="{{ url('noticia/new') }}" enctype="multipart/form-data" id="for_noticia" >
                  @csrf
                  <input  type="hidden" name="_method" id="method_noticia" value="POST">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                        <label class="text-muted" for="titulo">Titulo <span class="text-red">*</span></label>
                        <input class="form-control  @error('titulo') is-invalid @enderror" name="titulo" id="titulo"
                        placeholder="Ingrese nombre de la noticia " value="{{ old('titulo') }}"  autocomplete="titulo" autofocus>
                        @error('titulo')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group ">
                          <label class="text-muted" for="descripcion" >Descripción<span class="text-red">*</span></label>
                          <textarea class="form-control @error('descripcion') is-invalid @enderror "  rows="4" placeholder="Ingrese descripción de la noticia"  name="descripcion"  id="descripcion"  autofocus  required></textarea>

                        @error('descripcion')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                        <label for="idespecialidades" class="text-muted">Seleccione especialidad </label>
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
                      
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                        <label class="text-muted" for="orden">Orden <span class="text-red">*</span></label>
                        <input type="number" min="0"  class="form-control typ @error('orden') is-invalid @enderror" name="orden" id="orden"
                          placeholder="Ingrese orden de la noticia " value="{{ old('orden') }}"  autocomplete="orden" autofocus>
                        @error('orden')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>

                     
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group file_img input-group">
                        <input type="file" class=" form-control @error('img') is-invalid @enderror"  accept="image/* " id="img"  name="img" >
                         <div class="input-group-append d-none icon-input" onclick="minusInputFile()">
                          <span class="input-group-text btn"><i class="fas fa-folder-minus"></i></span>
                        </div>
                        @error('img')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>

                      <div class="input-group mb-3 d-none file_txt">
                        <input type="text" class="form-control" id="file_txt">
                        <div class="input-group-append" onclick="addinputFile()">
                          <span class="input-group-text btn"><i class="fas fa-folder-plus"></i></span>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                        <label class="text-muted" for="estado">Estado </label><br>
                        <input type="checkbox"  onchange="changeInput()" name="estado" id="estado"    data-bootstrap-switch data-off-color="secondary" data-on-color="success" data-inverse='true' data-on-text='Publico' data-off-text='Privado'>
                      </div>

                      <button class="btn btn-info" type="submit" id="btnsave">Guardar</button>
                      <button class="btn btn-secondary" type="button" id="btn_cancelar">Cancelar</button>  
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
        <h3 class="card-title">Lista de noticias </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button> --}}
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
                            <th width="140px">Titulo</th>
                            <th>Descripción</th>
                            <th>Especialidad  </th>
                            <th>Orden</th>
                            <th>Estado</th>
                           
                            <th >Portada  </th>
                            <th width="80px">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (isset($lista))
                          @foreach ($lista as $key => $item)
                            <tr>
                              <td>{{ $key + 1 }}</td>
                              <td style="vertical-align: middle; ">{{ $item['titulo'] }}</td>
                              <td style="vertical-align: middle;">{{Str::limit($item->descripcion, 40)}}</td> 
                              <td style="vertical-align: middle;">{{  $item['especialidad'][0]['descripcion'] }}</td>
                              <td style="vertical-align: middle;">{{ $item['orden'] }}</td>
                              
                              @if ($item['estado'])
                                  <td style="vertical-align: middle;" class="text-center text-success  "><i class="far fa-eye "></i> </td>
                              @else
                                  <td  style="vertical-align: middle;" class="text-center text-danger "> <i class="far fa-eye-slash "></i> </td>
                              @endif
                             
                              @if(isset($item['img']))
                                <td style="vertical-align: middle; cursor: pointer;" onclick="visor_show_nt('{{asset("PortadaNoticia/".$item->img)}}','{{$item['titulo']}}')"> 
                                  <div  class="product-image-thumb mx-auto"><img src="{{asset('PortadaNoticia/'.$item->img)}}" alt="Product Image"></div>
                                  {{-- <span class="mailbox-attachment-icon has-img"> --}}
                                  {{-- <img class="img img-fluid  " src="{{asset('PortadaNoticia/'.$item->img)}}" alt="Attachment"> --}}
                                </span>
                              </td>
                              @endif
                              <td style="vertical-align: middle;" class="text-center" style="vertical-align: middle;">
                                <form method="POST"  class="frm_eliminar_nt" action="{{url('noticia/new/'.$item->idnoticia_encryp)}}"  enctype="multipart/form-data">
                                    <div class="btn-group btn-group-sm">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="#card" class="btn btn-sm btn-primary " 
                                            onclick="editar_archivo_nt('{{ $item->idnoticia_encryp }}')"><i
                                                class="fa fa-edit"></i> </a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                          onclick="btn_eliminar_archivo_nt(this)"><i class="fa fa-trash"></i> </button>
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
  </div>
  

  
 @include('Repositorio.modal_visor')

  {{-- Seccion para insertar css--}}
  @section('include_css') 
     {{-- aqui ingrese otros stilos --}}
  @stop  

  {{-- Seccion para insertar js--}}
  @section('include_js')
    {{-- Mensaje de informacion --}}
    @if(session()->has('info'))
      <script >
       mostrar_toastr('{{session('info')}}','{{session('estado')}}')
      </script>
    @endif

    {{-- Detectar cualquier error de datos al ingreso en el formulario --}}
    @if($errors->any())
      <script>
        $('.card-control').removeClass('collapsed-card');
        $('.fas-control').removeClass('fa-plus');
        $('.fas-control').addClass('fa-minus'); 
      </script>
    @endif
    
    {{-- script de la view --}}
    

    {{-- script para la gestion de noticias --}}
    <script src="{{ asset('/js/noticia.js') }}"></script>
   
    <!-- Bootstrap Switch -->
    <script src="{{asset('/vendor/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <script>
      //se inicia el switch del estado del form
       $('#estado').bootstrapSwitch('state' , true);
        // $(this).bootstrapSwitch('state', $(this).prop('checked'));
      //asigan el valor que tenia cuando ocurre un error
       var txtt='{{old('descripcion')}}'; $("textarea#descripcion").val(txtt);
       $(document).ready(function() {
           $('.select22').select2();
       });    
         
         // $('#estado').bootstrapSwitch('state' , true);
         
    </script>
  @stop


 @stop
