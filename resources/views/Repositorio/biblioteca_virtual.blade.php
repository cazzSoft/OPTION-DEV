@extends('homeOption2h')
@section('title','Perfil-Médico')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)
@section('plugins.Select2',true)
@section('plugins.Sweetalert2',true)
{{-- cuerpo de la pagina --}}
@section('contenido')
  
<div class="container-fluid">
  <h2 class="text-center display-4">Biblioteca virtual</h2>
  <form id="form_search_filtro" >
    <div class="row">
      <div class="col-md-12 offset-md-1">
        <div class="row">
          <div class="col-md-10 mb-0 mt-3">
            <div class="form-group">
              <div class="input-group input-group-lg">
                <input type="search" class="form-control form-control-lg" placeholder="Search document" id="search_archivo" value="">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-lg btn-default">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 mb-1 mt-0 offset-md-8 ">
        <div class="form-group ">
          <select  class="form-control  select2  @error('idespecialidades') is-invalid @enderror" style="width: 100%;"
          data-placeholder=" Filtrar por especialidades" name="idespecialidades" id="idespecialidades_filtro"  >
            <option></option>
             <option value=" ">Todos</option>
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
    </div>
  </form>
</div>  

  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12 ">
          <div class="row ">
            <div class="col-12 col-sm-12 col-xs-12">
             
                @if(isset($lista_archivo))
                  <div class="card-footer bg-white responsive" >
                    <ul class="mailbox-attachments d-flex align-items-stretch clearfix" id="contetResulFiltro">
                    @foreach($lista_archivo as $item)
                      @if($item['tipo']=='IMG')
                        <li>
                          <span class="mailbox-attachment-icon has-img"><img class="img" src="{{asset('DocumentosBiblioteca/'.$item->ruta)}}" alt="Attachment"></span>
                          <div class="mailbox-attachment-info">
                            <a href="{{asset('DocumentosBiblioteca/'.$item->ruta)}}" onclick="eventDocumeto('{{$item->idbibliotecavirtual_encryp}}')" target="_blank" class="mailbox-attachment-name"><i class="fas fa-camera"></i> {{$item['titulo']}}</a>
                              <span class="mailbox-attachment-size clearfix mt-1">
                                <span>{{$item['especialidad']['descripcion']}}</span>
                                <a href="{{asset('DocumentosBiblioteca/'.$item->ruta)}}" download="proposed_file_name" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                              </span>
                          </div>
                        </li>
                      @elseif($item['tipo']=='PDF')
                        <li>
                          <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                          <div class="mailbox-attachment-info">
                            <a href="{{asset('DocumentosBiblioteca/'.$item->ruta)}}"  onclick="eventDocumeto('{{$item->idbibliotecavirtual_encryp}}')" target="_blank" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> {{$item['titulo']}}.pdf</a>
                                <span class="mailbox-attachment-size clearfix mt-1">
                                  <span>{{$item['especialidad']['descripcion']}}</span>
                                  <a href="{{asset('DocumentosBiblioteca/'.$item->ruta)}}" download="proposed_file_name" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                                </span>
                          </div>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                  </div>
                
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
    <script >
    $(document).ready(function() {
       $('.select2').select2({
           
      });
    });
    </script>
    <script src="{{ asset('/js/biblioteca_virtual.js') }}"></script>

  @stop


 @stop
