@extends('homeOption2h')
@section('title','Biblioteca')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)


{{-- cuerpo de la pagina --}}
@section('contenido')
  
<div class="container-fluid mt-4">
  @movil
    <div class="row mb-4">
      <div class="col-md-12 ">
          <div class=" flex_titulo">
           <a href="/">  <p class=" text-lead h2 text-info_ ">  <b class="h4"><i class="fas fa-chevron-left mr-3 text-info_ "></i></b>  Biblioteca  </p></a> 
          </div>
      </div>
    </div>
  @else
    <div class="row mt-4 mb-5">
      <div class="col-lg-1 col-xs-1">
        <a href="/" class="text-center " >  <i class="fas fa-chevron-left mr-3 text-info_ fa-2x ml-4"></i></a>    
      </div>
      <div class="col-lg-10">
        <a href="/" class="text-center " > <h4 class="text-center text-info_"><b>Biblioteca</b></h4></a> 
      </div>
    </div>
  @endmovil
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 ">
      <form id="form_search_filtro" >
       <div class="form-group ml-2">
         <div class="input-group ">
           <input type="search" class="form-control " placeholder="Buscar documentos" id="search_archivo" autocomplete="off" value="">
           <div class="input-group-append">
             <button type="submit" class="btn btn-sm btn-default">
               <i class="fa fa-search"></i>
             </button>
           </div>
         </div>
       </div>
      </form>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12 ">
      <div class="form-group ">
        <select  class="form-control  select2  @error('idespecialidades') is-invalid @enderror" style="width: 100%;"
        data-placeholder=" Filtrar por especialidades" name="idespecialidades" id="idespecialidades_filtro"  >
          <option></option>
          <option @if(old('idespecialidades')==0)  selected="selected" @endif value="0">Todos</option>
            @if(isset($lista_esp))
              @foreach($lista_esp as $item)
                <option @if(old('idespecialidades')==$item->idespecialidades)  selected="selected" @endif value="{{$item->idespecialidades}}">
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

    <div class="col-lg-7 col-md-4 col-sm-12 col-xs-12 ">
      @if(Auth::user()->type_user()=='dr' || Auth::user()->type_user()=='ad')
        <a href="{{url('biblioteca/repositorio')}}" class="btn btn-outline-info float-right mr-4"><b>Nuevo documento</b></a>
      @endif
    </div>
  </div>
</div>  

@movil
  <div class="row   "> 
    <div class="col-12">
      @if(isset($lista_archivo))
          <div class="row " id="contetResulFiltro">
            @foreach($lista_archivo as $item)
              <div class="col text-center m-auto">
                  <div class="card  text-center" >
                    @if($item['tipo']=='IMG')
                     
                      <img class="card-img-top objetfit btn btn-outline-light p-0" src=" {{ $img=\Storage::disk('wasabi')->temporaryUrl( $item->ruta, now()->addMinutes(3600)) }}" alt="{{$item->titulo}} " onclick="showModal(`{{ $img }}`,'{{$item['titulo']}}')" onclick="eventDocumeto('{{$item->idbibliotecavirtual_encryp}}')" />
                      <div class="card-footer text-muted p-0 mt-1">
                        <span class="mailbox-attachment-size text-muted text-left p-1"><i class="fas fa-camera"></i> {{Str::limit($item['titulo'],60) }}</span>
                        <span class="mailbox-attachment-size clearfix mt-0 pl-1 pr-1 pb-1 text-muted">
                          <span>{{ Str::limit($item['especialidad']['descripcion'],20,'...') }}</span>
                          <a onclick="downloade(this,`{{$item->idbiblioteca_virtual_encryp}}`)" download="download-img" class="btn bgz-info btn-sm float-right"><i class="fas fa-cloud-download-alt fa-xs"></i></a>
                        </span>
                      </div>
                    @elseif($item['tipo']=='PDF')
                      <a href="{{url('biblioteca/view_documento/'.$item->idbiblioteca_virtual_encryp)}}" target="_blank" class=" btn mt-0 p-0 ">
                        <span class="mailbox-attachment-icon mb-1"><i class="far fa-file-pdf fa-lg"></i></span>
                      </a>
                      <div class="card-footer mt-0 p-0 text-left">
                        <a href="{{url('biblioteca/view_documento/'.$item->idbiblioteca_virtual_encryp)}}" target="_blank" class="mailbox-attachment-size text-muted p-1 "><i class="fas fa-paperclip"></i>  {{Str::limit($item['titulo'],60,'...') }}</a>
                          
                        <span class="mailbox-attachment-size clearfix mt-0 pl-1 pr-1 pb-1 text-muted"> 
                          <span> {{ Str::limit($item['especialidad']['descripcion'],20,'...') }} </span>
                          <a  ref="#" {{--  href="{{url('biblioteca/download_documento/'.$item->idbiblioteca_virtual_encryp)}}" --}} onclick="downloade(this,`{{$item->idbiblioteca_virtual_encryp}}`)" download="download-pdf" class="btn bgz-info btn-sm float-right spinnet_down"><i class="fas fa-cloud-download-alt fa-xs"></i></a>
                        </span>
                      </div>
                    @endif
                  </div>
              </div>
            @endforeach
          </div>
      @else
        <div class="alert alert-light mt-4 " role="alert">
          No se obtubo ningún resultado
        </div>
      @endif 
    </div>
    <div class=" col-md-12 col-lg-4 order-1 order-md-2">
      
    </div>
  </div>
@else
  <div class="row   "> 
    <div class="col-lg-10  offset-md-1 mt-5 offset-sm-0">
      @if(isset($lista_archivo))
          <div class="row " id="contetResulFiltro">
            @foreach($lista_archivo as $item)
              <div class=" col-md-2 col-xs-12 col-sm-12 content_class" >
                  <div class="card " >
                    @if($item['tipo']=='IMG')
                      {{-- <img class="card-img-top objetfit" src="{{asset('DocumentosBiblioteca/'.$item->ruta)}}" alt="Card image "> --}}
                      <img class="card-img-top objetfit btn btn-outline-light p-0" src=" {{ $img=\Storage::disk('wasabi')->temporaryUrl( $item->ruta, now()->addMinutes(3600)) }}" alt="{{$item->titulo}} " onclick="showModal(`{{ $img }}`,'{{$item['titulo']}}')" onclick="eventDocumeto('{{$item->idbibliotecavirtual_encryp}}')" />
                      <div class="card-footer text-muted p-2">
                        <span class="mailbox-attachment-size text-muted "><i class="fas fa-camera"></i> {{Str::limit($item['titulo'],35,'...') }}</span>
                        <span class="mailbox-attachment-size clearfix mt-0 ">
                          <span>{{$item['especialidad']['descripcion']}}</span>
                          <a onclick="downloade(this,`{{$item->idbiblioteca_virtual_encryp}}`)" download="download-img" class="btn bgz-info btn-sm float-right"><i class="fas fa-cloud-download-alt "></i></a>
                        </span>
                      </div>
                    @elseif($item['tipo']=='PDF')
                      <a href="{{url('biblioteca/view_documento/'.$item->idbiblioteca_virtual_encryp)}}" target="_blank" class=" btn ">
                        <span class="mailbox-attachment-icon mb-2"><i class="far fa-file-pdf fa-2x"></i></span>
                      </a>
                      <div class="card-footer mt-2 p-2">
                        <a href="{{url('biblioteca/view_documento/'.$item->idbiblioteca_virtual_encryp)}}" target="_blank" class="mailbox-attachment-size text-muted "><i class="fas fa-paperclip"></i>  {{Str::limit($item['titulo'],35,'...') }}</a>
                          
                        <span class="mailbox-attachment-size clearfix mt-0"> 
                          <span>{{$item['especialidad']['descripcion']}}</span>
                          <a  ref="#" {{--  href="{{url('biblioteca/download_documento/'.$item->idbiblioteca_virtual_encryp)}}" --}} onclick="downloade(this,`{{$item->idbiblioteca_virtual_encryp}}`)" download="download-pdf" class="btn bgz-info btn-sm float-right spinnet_down"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                      </div>
                    @endif
                  </div>
              </div>
            @endforeach
          </div>
      @else
        <div class="alert alert-light mt-4 " role="alert">
          No se obtubo ningún resultado
        </div>
      @endif 
    </div>
    <div class=" col-md-12 col-lg-4 order-1 order-md-2">
      
    </div>
  </div>
@endmovil
{{-- modal --}}
  <div id="modalImage" class="modal-image">
    <div class="modal-content-img" id="modal-image-content">
    </div>
  </div>

{{-- Seccion para insertar css--}}
  @section('include_css') 
    <link rel="stylesheet" href="{{ asset('css/biblioteca.css') }}">
      <!-- Ionicons -->
    
  @stop   

  {{-- Seccion para insertar js--}}
  @section('include_js')
    <script src="{{ asset('/js/casos_ex.js') }}"></script>
    <script>
      $(document).ready(function() {
         $('.select2').select2({
             
        });
      });

      @movil
        var movil=1;
      @else
        var movil=0;
      @endmovil
    </script>

    <script src="{{ asset('/js/biblioteca_virtual.js') }}"></script>
  @stop

@stop
