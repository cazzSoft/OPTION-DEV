@extends('homeOption2h')
@section('title','HOME')

{{--para activar los plugin en la view  --}}

{{-- @section('plugins.Sweetalert2',true) --}}
@section('plugins.toastr',true)

{{-- cuerpo de la pagina --}}
@section('contenido')
  
  <div class="invoice p-3 mb-3 ">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="text-primary">
          <i class="fas fa-capsules"></i> @if(isset($caso)) {{$caso->titulo}} @endif
           <small class="float-right h5 text-muted">Date:  @if(isset($caso)) {{$caso->created_at->isoFormat('lll')}} @endif</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>

    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-8 invoice-col">
        @if(isset($caso->descripcion))
          <address class="text-justify ">
            <strong class="text-muted profile-username">Descripción del caso </strong><br>
            <p>
              {{$caso->descripcion}} <br>
              <b class="text-muted ">Resultados de examenes</b>
              {{$caso->diagnostico}} 
              <b class="text-muted ">esta enfermedad afecta a</b>
              {{$caso->afecta_desc}} entre  {{$caso->edad_inicial}} y {{$caso->edad_final}} años.<br>
              <b class="text-muted ">Sintomas</b>
               {{$caso->sintoma}} <br>
               <b class="text-muted ">Causas </b>
               {{$caso->causas }} <br>
               <b class="text-muted ">Tratamientos Usados </b>
               {{$caso->tratamiento }} <br>
               <b class="text-muted ">Médicos visitados </b>
               {{$caso->medico_visitado }} <br>
            </p>
              <strong class="text-muted profile-username"></strong><br> 
          </address>
        @endif  
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <address>
          <strong class="text-muted">Video</strong><br>
          @if(isset($caso->url_video))
            <div class="embed-responsive embed-responsive-16by9 border border-primary">
              <iframe width="560" height="315" src="{{$caso->url_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          @endif
          
        </address>
      </div>
     
    </div>
  
    <div class="row">
      <div class="col-12 table-responsive">
        <div class="card-body">
          <button type="button" id="btn_coment" class="btn btn-default "><i class="fas fa-comments"></i> Responder</button>
         {{--  <button type="button" class="btn btn-default "><i class="far fa-thumbs-up"></i> Like</button> --}}
          <span class="float-right text-muted">
           <b>@if(isset($caso->visto)){{$caso['visto']}}@endif</b> visto - 
           <b id="t_coment" >@if(isset($caso->comentarios_count)){{$caso['comentarios_count']}} @endif </b> comments
         </span>
        </div>
      </div>
    </div>
    <div class="row">
      @if(isset($caso['comentarios']))
        <div class="col-md-12">
          <div class="card card-widget">
            <div class="card-footer card-comments" id="list_comets">
                @foreach($caso['comentarios'] as $cas)
                  <div class="card-comment">
                    <img class="img-circle img-sm" src="{{$cas['usuario'][0]['img'] }}" alt="User Image">
                    <div class="comment-text">
                      @if(auth()->user()->id==$cas['usuario'][0]['id'])
                        <span class="username">
                        @if(isset($cas['usuario'])) {{$cas['usuario'][0]['name']}} @endif
                        <span class="badge  btn badge-light float-right rounded text-primwary mr-1 border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-h"></i>  
                        </span>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <a class="dropdown-item cursor" onclick="edit_coment('{{$cas->idaportaciones_encryp}}',this)"> editar</a>
                          <a class="dropdown-item cursor" onclick="delete_coment('{{$cas->idaportaciones_encryp}}',this)"> eliminar</a>
                        </div>
                      </span>
                      @endif
                      <small class="users-list-date ">{{$cas->created_at->isoFormat('lll')}}</small>
                       <p class="input_coment">{{$cas->comentario}}</p> 
                    </div>
                  </div>
                @endforeach
            </div>
            
            <!-- /.card-footer -->
            <div class="card-footer d-none f_coment">
              <form id="form_coment" action="{{url('gestion/coment')}}" method="POST">
                 {{ csrf_field() }}
                <img class="img-fluid img-circle img-sm" src="{{auth()->user()->img}}" alt="Alt Text">
                <div class="img-push">
                  <input type="text"  id="comentario" class="form-control form-control-sm" name="comentario" placeholder="Press enter to post comment">
                  <input type="hidden" id="idart" name="idart" value="{{$caso->idarticulo_encryp}}">
                </div>
              </form>
            </div>
            <!-- /.card-footer -->
          </div>
        </div>
      @endif
    </div>

    <div class="row">
      <div class="col-12">
        <span class="float-left text-muted">
          <a href="{{url('medico/casos_ex')}}"> <i class="fa fa-backward"></i> Regresar</a>
        </span>
      </div> 
    </div>
  </div>
  
@stop

@section('include_css') 
  <style >
    .cursor{
      cursor: pointer;
    }
  </style>
@stop   

{{-- Seccion para insertar js--}}
@section('include_js')
       <script src="{{ asset('/js/casos_ex.js') }}"></script>
@stop