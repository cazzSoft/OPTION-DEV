@extends('homeOption2h')
@section('title','Noticia')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
{{-- cuerpo de la pagina --}}


@section('contenido')
  @movil
    <div class="row mb-4">
      <div class="col-md-12 ">
          <div class=" flex_titulo">
           <a href="/">  <p class=" text-lead h2 text-info_ ">  <b class="h4"><i class="fas fa-chevron-left mr-0 text-info_ float-left "></i></b>  Gestión de Noticia  </p></a> 
          </div>
      </div>
    </div>
  @else
    <div class="row ">
      <div class="col text-center mt-5">
        <a href="{{asset('/')}}" class="text-leth float-left ">  <i class="fas fa-chevron-left mr-3 text-info_ fa-2x ml-5 mb-5 "></i></a>
        <span class="text-info_ h5"><b>Gestión de Noticia</b></span>
      </div>
    </div>
  @endmovil

  {{-- <div class="row justify-content-start">
    <div class="col text-center mt-5">
      <a href="{{asset('/')}}" class="text-leth float-left ">  <i class="fas fa-chevron-left mr-3 text-info_ fa-2x ml-1 mb-5 "></i></a>
      <span class="text-info_ h5"><b> Gestión de Noticia</b></span>
    </div>
  </div>  --}}

  <div class="container-fluid ">
    
    <div class="card  collapsed-card card-control  shadow-sm  bg-white rounded  " id="card">
      <div class="card-header border-0">
        <h3 class="card-title text-secondary"> <b>Ingresar nueva noticia</b> </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" id="collapse_form" data-card-widget="collapse" title="Collapse2">
            <i class="fas fa-plus fas-control"></i>
          </button>
        </div>
      </div>

      <div class="card-body @movil p-0 @endmovil ">
        <div class="container col-md-10 ">
          <div class="row">
            <div class=" col-md-12 col-lg-12 order-1 order-md-2 ">
                <form method="POST" action="{{ url('noticia/new') }}" enctype="multipart/form-data" id="for_noticia" >
                  @csrf
                  <input  type="hidden" name="_method" id="method_noticia" value="POST">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group ">
                        <label class="text-muted" for="titulo">Titulo <span class="text-red">*</span></label>
                        <input class="form-control  border border-white shadow-sm   @error('titulo') is-invalid @enderror" name="titulo" id="titulo"
                        placeholder="Ingrese nombre de la noticia " value="{{ old('titulo') }}"  autocomplete="titulo" autofocus>
                        @error('titulo')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                        <label class="text-muted" for="autor">Autor <span class="text-red">*</span></label>
                        <input class="form-control  border border-white shadow-sm  @error('autor') is-invalid @enderror" name="autor" id="autor"
                        placeholder="Ingrese nombre del autor" value="{{ old('autor') }}"  autocomplete="autor" autofocus>
                        @error('autor')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group ">
                          <label class="text-muted" for="descripcion" >Descripción <span class="text-red">*</span></label>
                          <textarea class="form-control shadow-sm   border border-white  @error('descripcion') is-invalid @enderror "  rows="4" placeholder="Ingrese descripción de la noticia"  name="descripcion"  id="descripcion"  autofocus  required></textarea>

                        @error('descripcion')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                        <label for="idespecialidades" class="text-muted">Seleccione especialidad <span class="text-red">*</span></label>
                        <select  class="form-control shadow-sm   border border-white  select22 @error('idespecialidades') is-invalid @enderror" style="width: 100%;"
                        data-placeholder="Seleccione especialidad " name="idespecialidades" id="idespecialidades" >
                          <option></option>
                          @if(isset($lista_esp))
                            @foreach($lista_esp as $item)
                              <option  @if(old('idespecialidades')==$item->idespecialidades) selected @endif value="{{$item->idespecialidades}}">
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

                     <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group file_img input-group">

                        <label for="img" class="text-muted">Archivo <span class="text-red">*</span> </label>
                        <div class="input-group ">
                          <input type="file" class="shadow-sm border border-white form-control @error('img') is-invalid @enderror"  accept="image/* " id="img"  name="img" >
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

                      <div class="form-group file_txt d-none"> 
                         <label for="img" class="text-muted">Archivo <span class="text-red">*</span> </label> 
                        <div class="input-group mb-3 d-none file_txt">
                          <input type="text" class="form-control shadow-sm border border-white" id="file_txt">
                          <div class="input-group-append" onclick="addinputFile()">
                            <span class="input-group-text btn"><i class="fas fa-folder-plus"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <div class="form-group">
                        <label class="text-muted" for="orden">Orden <span class="text-red">*</span></label>
                        <input type="number" min="0"  class="form-control shadow-sm border border-white @error('orden') is-invalid @enderror" name="orden" id="orden"
                          placeholder="Ingrese orden de la noticia " value="{{ old('orden') }}"  autocomplete="orden" autofocus>
                        @error('orden')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <div class="form-group">
                        <label class="text-muted" for="estado">Estado </label><br>
                        <select name="estado" id="estado" class=" select22 form-control shadow-sm border border-white @error('estado') is-invalid @enderror" data-placeholder="Seleccione ">
                          <option></option>
                          <option @if(old('estado')==1) selected @endif value="1">Publico </option>
                          <option @if(old('estado')==0) selected @endif value="0">Privado </option>
                        </select>
                        @error('estado')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                        <label class="text-muted" for="fuente">Fuente <span class="text-red">*</span></label>
                        <input class="form-control  border border-white shadow-sm  @error('fuente') is-invalid @enderror" name="fuente" id="fuente"
                        placeholder="Ingrese fuente" value="{{ old('fuente') }}"  autocomplete="fuente" autofocus>
                        @error('fuente')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                  </div>

                  <div class="row">
                   
                      <div class=" @movil col @else col-6 mt-5 @endmovil ">
                        <div class="form-group text-right">
                          <button class="btn btn-outline-light pl-5 pr-5  text-info_ border border-info_ @movil  btn-block @endmovil" type="button" id="btn_cancelar">Cancelar</button> 
                       
                        </div>
                      </div>
                      <div class=" @movil col @else col-6 mt-5 @endmovil">
                        <div class="form-group text-left">
                          <button class="btn btn-primary bgz-info pl-5 pr-5 border-0 rounded shadow-sm @movil  btn-block @endmovil" type="submit" id="btnsave">Guardar</button>
                        </div>
                      </div>
                    
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div> 
    <div class="card   shadow-sm  bg-white rounded ">
      <div class="card-header border-0">
        <h3 class="card-title text-secondary"> <b>Lista de noticias </b></h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          
        </div>
      </div>

      <div class="card-body @movil p-0 @endmovil ">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12 ">
            <div class="row ">
              <div class="col-12">
                
                   <div class="table-responsive">
                    <table id="table_publi" class=" data_table table table-sm border-0 text-center">
                      <thead>
                        <tr class="text-info_ ">
                            <th>Num. </th>
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
                            <tr class="text-justify">
                              <td>{{ $key + 1 }}</td>
                              <td style="vertical-align: middle; ">{{ $item['titulo'] }}</td>
                              <td style="vertical-align: middle;">{{Str::limit($item->descripcion, 40)}}</td> 
                              <td style="vertical-align: middle;">{{  $item['especialidad'][0]['descripcion'] }}</td>
                              <td style="vertical-align: middle;">{{ $item['orden'] }}</td>
                              
                              @if ($item['estado'])
                                  <td style="vertical-align: middle;" class="text-center   "> Publicada</td>
                              @else
                                  <td  style="vertical-align: middle;" class="text-center  ">  Sin Publicada</td>
                              @endif
                             
                              @if(isset($item['img']) && $item['img']!= null)
                                <td style="vertical-align: middle; cursor: pointer;" onclick="visor_show_nt('{{$img=\Storage::disk('wasabi')->temporaryUrl( $item->img, now()->addMinutes(3600))}}','{{$item['titulo']}}')"> 
                                  <div  class="product-image-thumb mx-auto border-0">
                                    <img src="{{$img}}" alt="Product Image"></div>
                                </span>
                              </td>
                              @endif
                              <td style="vertical-align: middle;" class="text-center" style="vertical-align: middle;">
                                <form method="POST"  class="frm_eliminar_nt" action="{{url('noticia/new/'.$item->idnoticia_encryp)}}"  enctype="multipart/form-data">
                                    <div class="btn-group btn-group-sm">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </div>
                                    <div class="btn-group este">
                                      <button type="button" class="btn btn-link text-info_ dropdown-toggle border border-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Seleccione
                                      </button>
                                      <div class="dropdown-menu">
                                        @if($item->estado)
                                            <a class="dropdown-item text-info_ qbtn" href="#for_archivo"  onclick="aprobar_nt('{{ $item->idnoticia_encryp }}','{{encrypt(0)}}',this)"> Quitar Publicación</a>
                                        @else
                                            <a class="dropdown-item text-info_ qbtn" href="#for_archivo"  onclick="aprobar_nt('{{ $item->idnoticia_encryp }}','{{encrypt(1)}}',this)"> Aprobar Publicación</a>
                                        @endif
                                        <a class="dropdown-item text-info_" href="#for_archivo"  onclick="editar_archivo_nt('{{ $item->idnoticia_encryp }}')"> Editar Noticia</a>
                                        <a class="dropdown-item text-info_"  onclick="btn_eliminar_archivo_nt(this)" href="#">Eliminar</a>
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
  </div>
  

  
 @include('Repositorio.modal_visor')

  {{-- Seccion para insertar css--}}
  @section('include_css') 
    {{-- aqui ingrese otros stilos --}}
      <link rel="stylesheet" href="{{ asset('css/gestion_noticia.css') }}">
  @stop  

  {{-- Seccion para insertar js--}}
  @section('include_js')
    {{-- Mensaje de informacion --}}
    @if(session()->has('info'))
      <script >
       mostrar_toastr('{{session('info')}}','{{session('estado')}}')
       
      </script>
    @endif
    {{-- controlar imagen de rotas --}}
      <script src="{{ asset('/js/control_img_rotas.js') }}"></script>
    {{-- Detectar cualquier error de datos al ingreso en el formulario --}}
    @if($errors->any())
      <script>
        $('.card-control').removeClass('collapsed-card');
        $('.fas-control').removeClass('fa-plus');
        $('.fas-control').addClass('fa-minus'); 
      </script>
    @endif
    @if(old('descripcion'))
      <script>
        $('#descripcion').val({{old('descripcion')}});
      </script>
    @endif


    {{-- script de la view --}}
    <script>
      // funcion para encryptar
      function encrypt_(valorr) {
        return valor=`{{encrypt('`${valorr}`')}}`; 
      }
    </script>

    {{-- script para la gestion de noticias --}}
    <script src="{{ asset('/js/noticia.js') }}"></script>
   
    <!-- Bootstrap Switch -->
    <script src="{{asset('/vendor/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <script>
      $('#table_publi').addClass('pull-left');
      //asigan el valor que tenia cuando ocurre un error
       var txtt='{{old('descripcion')}}'; $("textarea#descripcion").val(txtt);
       $(document).ready(function() {
           $('.select22').select2();
       });    
         
         // $('#estado').bootstrapSwitch('state' , true);
         
    </script>
   
    
  @stop


 @stop
