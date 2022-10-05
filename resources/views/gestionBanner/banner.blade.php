@extends('homeOption2h')
@section('title','Banner')


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
           <a href="/">  <p class=" text-lead h2 text-info_ ">  <b class="h4"><i class="fas fa-chevron-left mr-0 text-info_ float-left "></i></b>  Administrador de Banners  </p></a> 
          </div>
      </div>
    </div>
  @else
    <div class="row ">
      <div class="col text-center mt-5">
        <a href="{{asset('/')}}" class="text-leth float-left ">  <i class="fas fa-chevron-left mr-3 text-info_ fa-2x ml-5 mb-5 "></i></a>
        <span class="text-info_ h5"><b>Administrador de Banners</b></span>
      </div>
    </div>
  @endmovil

  

  <div class="container-fluid ">
    {{-- formulario banner --}}
    <div class="card shadow-none bg-white rounded  d-none" id="card_banner_form">
      <div class="card-body @movil p-0 @endmovil ">
        <div class="container col-md-8 col-sm-10 col-xs-12 ">
          <div class="row">
            <div class=" col-12 order-1 order-md-2 ">
              <form method="POST" action="{{ url('banner/') }}"  enctype="multipart/form-data" id="form_banner" >
                @csrf
                <input  type="hidden" name="_method" id="method_banner" value="POST">
                <div class="form-group row">
                  <label for="nombre_banner" class="col-sm-3 col-form-label text-muted">Nombre banner:<span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control shadow-sm  border-white @error('nombre_banner') is-invalid @enderror" id="nombre_banner" name="nombre_banner" placeholder="Ingrese nombre" value="{{ old('nombre_banner') }}"  autocomplete="nombre_banner" autofocus required_>
                    @error('nombre_banner')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row file_img input-group">
                  <label for="img" class="text-muted col-sm-3 col-form-label">Imagen <span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <div class="input-group ml-1">
                      <input type="file" class="shadow-none border border-white form-control rounded @error('img') is-invalid @enderror"  accept="image/* " id="img"  name="img" required_>
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
                </div>

                <div class="form-group row file_txt d-none"> 
                  <label for="img" class="text-muted col-sm-3 col-form-label">Imagen <span class="text-red">*</span> </label> 
                  <div class="col-sm-8"> 
                    <div class="input-group mb-3 d-none file_txt">
                      <input type="text" class="form-control shadow-none border border-white" id="file_txt">
                      <div class="input-group-append" onclick="addinputFile()">
                        <span class="input-group-text btn"><i class="fas fa-folder-plus"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="text-muted col-sm-3 col-form-label" for="aling_img">Aliniar imagen:<span class="text-red">*</span> </label>
                  <div class="col-sm-8">
                    <select name="aling_img" id="aling_img" class=" select22 form-control shadow-sm border border-white @error('aling_img') is-invalid @enderror" data-placeholder="Seleccione " required_>
                      <option></option>
                      <option @if(old('aling_img')=='left') selected @endif value="left">Izquierda </option>
                      <option @if(old('aling_img')=='right') selected @endif value="right">Derecha </option>
                    </select>
                    @error('aling_img')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="text-muted col-sm-12 col-form-label" >Texto opcional 1:</label>
                </div>
                <div class="form-group row">
                  <label class="text-muted col-sm-3 col-form-label" for="text_opcional1" >ES </label>
                  <div class="col-sm-8">
                     <textarea class="form-control shadow-sm border border-white"  rows="2" placeholder="Ingrese texto"  name="text_opcional1"  id="text_opcional1"  autofocus  ></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="text-muted col-sm-3 col-form-label" for="text_opcional1_en" >EN </label>
                  <div class="col-sm-8">
                     <textarea class="form-control shadow-sm border border-white "  rows="2" placeholder="Ingrese texto"  name="text_opcional1_en"  id="text_opcional1_en"  autofocus  ></textarea>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="text-muted col-sm-12 col-form-label" >Texto Principal:<span class="text-red">*</span></label>
                </div>
                <div class="form-group row">
                  <label class="text-muted col-sm-3 col-form-label" for="text_principal" >ES </label>
                  <div class="col-sm-8">
                     <textarea class="form-control shadow-sm   border border-white  @error('text_principal') is-invalid @enderror "  rows="2" placeholder="Ingrese texto"  name="text_principal"  id="text_principal"  autofocus  required_ ></textarea>
                    @error('text_principal')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="text-muted col-sm-3 col-form-label" for="text_principal_en" >EN </label>
                  <div class="col-sm-8">
                     <textarea class="form-control shadow-sm border border-white  @error('text_principal_en') is-invalid @enderror "  rows="2" placeholder="Ingrese texto"  name="text_principal_en"  id="text_principal_en"  autofocus  required_></textarea>
                    @error('text_principal_en')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="text-muted col-sm-12 col-form-label" >Texto opcional 2:</label>
                </div>
                <div class="form-group row">
                  <label class="text-muted col-sm-3 col-form-label" for="text_opcional2" >ES </label>
                  <div class="col-sm-8">
                     <textarea class="form-control shadow-sm   border border-white"  rows="2" placeholder="Ingrese texto"  name="text_opcional2"  id="text_opcional2"  autofocus  required_></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="text-muted col-sm-3 col-form-label" for="text_opcional2_en" >EN </label>
                  <div class="col-sm-8">
                     <textarea class="form-control shadow-sm border border-white"  rows="2" placeholder="Ingrese texto"  name="text_opcional2_en"  id="text_opcional2_en"  autofocus  required_></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="text-muted col-sm-12 col-form-label" >Texto en el botón:<span class="text-red">*</span></label>
                </div>

                <div class="form-group row">
                  <label for="text_btn" class="col-sm-3 col-form-label text-muted">ES</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control shadow-sm border border-white  @error('text_btn') is-invalid @enderror" id="text_btn" name="text_btn" placeholder="Ingrese texto">
                    @error('text_btn')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="text_btn_en" class="col-sm-3 col-form-label text-muted">EN</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control shadow-sm border border-white  @error('text_btn_en') is-invalid @enderror" id="text_btn_en" name="text_btn_en" placeholder="Ingrese texto">
                    @error('text_btn_en')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="text-muted col-sm-3 col-form-label" for="orden">Orden <span class="text-red">*</span></label>
                  <div class="col-sm-8">
                    <input type="number" min="0"  class="form-control shadow-sm border border-white @error('orden') is-invalid @enderror" name="orden" id="orden"
                      placeholder="Ingrese orden de la noticia " value="{{ old('orden') }}"  autocomplete="orden" autofocus>
                    @error('orden')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="text-muted col-sm-3 col-form-label" for="orden">Activo: <span class="text-red">*</span></label>
                  <div class=" col-sm-8">
                    
                    <div class="icheck-info">
                        <input type="checkbox" id="estado" checked name="estado" />
                        <label for="estado"></label>
                    </div>
                  </div>
                </div>
                 
                

                <div class="row">
                    <div class=" @movil col @else col-6 mt-5 @endmovil ">
                      <div class="form-group text-right">
                        <button class="btn btn-outline-light pl-5 pr-5  text-info_ border border-info_ @movil  btn-block @endmovil" type="reset" id="btn_cancelar_banner">Cancelar</button> 
                     
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

    {{-- tabla de lista de banner --}}
    <div class="card shadow-sm  bg-white rounded" id="card_banner_table">
      <div class="card-header border-0">
        <h3 class="card-title text-secondary btn_nuevo_banner" > <b class="btn btn-info">Ingresar nueva banner</b> </h3>
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
                            <th>ID </th>
                            <th width="140px">Fecha</th>
                            <th>Nombre del Banner</th>
                            <th>Texto a presentar en el banner  </th>
                            <th>Visible</th>
                            <th>Imagen</th>
                            <th width="80px">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (isset($lista))
                          @foreach ($lista as $key => $item)
                            <tr class="text-justify">
                              <td style="vertical-align: middle; ">{{ $key + 1 }}</td>
                              <td style="vertical-align: middle; ">{{$item->created_at->isoFormat('lll') }}</td>
                              <td style="vertical-align: middle; ">{{ $item['nombre_banner'] }}</td>
                              <td style="vertical-align: middle;">{{Str::limit($item->text_principal, 40)}}</td> 
                             
                              @if ($item['estado'])
                                  <td style="vertical-align: middle;" class="text-center"> Si</td>
                              @else
                                  <td  style="vertical-align: middle;" class="text-center"> No</td>
                              @endif
                              
                              @if(isset($item['img']) && $item['img']!= null) 
                                <td style="vertical-align: middle; cursor: pointer;" onclick="visor_show_banner('{{$img=\Storage::disk('wasabi')->temporaryUrl( $item->img, now()->addMinutes(3600))}}','{{$item['titulo']}}')"> 
                                  <div  class="product-image-thumb mx-auto border-0">
                                    <img src="@if(\Storage::disk('wasabi')->exists($item->img)) 
                                                  {{$img}}
                                              @else
                                                  {{asset('img/error.png')}}
                                              @endif" alt="img-{{$item['nombre_banner']}}">

                                  </div>
                                  
                                </td>
                              @else
                                <td style="vertical-align: middle; cursor: pointer;" > 
                                  <div  class="product-image-thumb mx-auto border-0">
                                    <p>{{$item['img']}}</p>
                                  </div>
                                  
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
                                       
                                        <a class="dropdown-item text-info_ qbtn" href="#for_archivo"  onclick="aprobar_nt('{{ $item->idnoticia_encryp }}','{{encrypt(0)}}',this)"> Editar Banner</a>
                                        
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
  
  @include('gestionBanner.modalVisor')

  {{-- Seccion para insertar css--}}
  @section('include_css') 
    {{-- aqui ingrese otros stilos --}}
      <link rel="stylesheet" href="{{ asset('css/banner.css') }}">
      <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  @stop  

  {{-- Seccion para insertar js--}}
  @section('include_js')
    {{-- Mensaje de informacion --}}
    @if(session()->has('info'))
      <script>
        sweetalert('{{session('info')}}','{{session('estado')}}');
        if({{session('estado')}}=='success'){
          $('#card_banner_form').addClass('d-none');
          $('#card_banner_table').removeClass('d-none');
        }
         $('#card_banner_form').removeClass('d-none');
         $('#card_banner_table').addClass('d-none');
      </script>
    @endif

    {{-- Detectar cualquier error de datos al ingreso en el formulario --}}
    @if($errors->any())
      <script>
        $('#card_banner_form').removeClass('d-none');
        $('#card_banner_table').addClass('d-none'); 
      </script>
    @endif

    {{-- controlar imagen de rotas --}}
      {{-- <script src="{{ asset('/js/control_img_rotas.js') }}"></script> --}}
    
    

  {{-- recordar campos ingresado anteriormente  --}}
    @if(old('text_opcional1'))
      <script>
        $('#text_opcional1').val( @json(old('text_opcional1')) );
      </script>
    @endif
    @if(old('text_opcional1_en'))
      <script>
         $('#text_opcional1_en').val( @json(old('text_opcional1_en')) );
      </script>
    @endif
    
    @if(old('text_principal'))
      <script>
        $('#text_principal').val( @json(old('text_principal')) );
      </script>
    @endif
    @if(old('text_principal_en'))
      <script>
        $('#text_principal_en').val( @json(old('text_principal_en')) );
      </script>
    @endif

     @if(old('text_opcional2'))
      <script>
        $('#text_opcional2').val( @json(old('text_opcional2')) );
      </script>
    @endif
    @if(old('text_opcional2_en'))
      <script>
         $('#text_opcional2_en').val( @json(old('text_opcional2_en')) );
      </script>
    @endif

    @if(old('text_btn'))
      <script>
        $('#text_btn').val( @json(old('text_btn')) );
      </script>
    @endif
    @if(old('text_btn_en'))
      <script>
        $('#text_btn_en').val( @json(old('text_btn_en')) );
      </script>
    @endif
    
    @if(old('estado'))
      <script>
        console.log(@json(old('estado')));
      </script>
    @else
      <script>
        document.querySelector('#estado').checked = false;
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
    {{-- <script src="{{ asset('/js/noticia.js') }}"></script> --}}
    <script src="{{ asset('/js/gestionBanner.js') }}"></script>
   
   
    <!-- Bootstrap Switch -->
    {{-- <script src="{{asset('/vendor/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script> --}}
    <script>
      // $('#table_publi').addClass('pull-left');
      //asigan el valor que tenia cuando ocurre un error
       // var txtt='{{old('descripcion')}}'; $("textarea#descripcion").val(txtt);
       $(document).ready(function() {
           $('.select22').select2();
       });    
         
         // $('#estado').bootstrapSwitch('state' , true);
         
    </script>

  @stop


 @stop
