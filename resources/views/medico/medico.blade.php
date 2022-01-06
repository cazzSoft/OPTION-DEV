@extends('homeOption2h')
@section('title','Doctors')


{{--para activar los plugin en la view  --}}
@section('plugins.toastr',true)

{{-- cuerpo de la pagina --}}
@section('contenido')
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1"></div>
      <div class="col-xs-12 col-sm-12 col-md-3  text-center d-flex align-items-center justify-content-center">
        <div class="  " style="width: 18rem;">
          <img class="card-img-top  img-circle elevation-2" src="{{asset('ava1.png')}}" alt="Card image cap">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6">

        <div class="card-body">
                 
          <div class="attachment-pushed">
            <h2 class="attachment-heading"><a href=""><b>{{auth()->user()->name}}</b></a></h2>
            <strong><i class="fas fa-envelope-open-text mr-1"></i> {{auth()->user()->email}}</strong>
            <div class="attachment-text mt-3 text-justify mb-3">
                {{auth()->user()->detalle_estudio}} 
            </div>
           
          </div>
                          
            <button type="button" class="btn btn-default " id="btn_editArt"><i class="fas fa-edit"></i> Editar Perfil</button>
            <button type="button" class="btn btn-default "id="btn_addtArt"><i class="far fa-newspaper"></i> Add publicación</button>
            <span class="float-right text-info"><b>@if(isset($publicaciones)) {{$publicaciones}} @endif Publicaciones - @if(isset($seguidores)) {{$seguidores}} @endif Seguidores</b></span>
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-2">
        
      </div>
    </div>    
    <div class="row">
       <div class="col-md-12 col-sm-12 mt-4">
          <div class="card card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active text-info" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Publicaciones</a>
                </li> 
              </ul>
            </div>
            <div class="card-body ">
              <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active"  id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                      @if (isset($listaArt))
                       <div class="card-body table-responsive">
                         <div class="row">
                           @foreach ($listaArt as $key=> $art )
                             <div class="col-xs-12 col-sm-12 col-md-4 d-flex align-items-stretch flex-column rounded">
                               <div class="card d-flex flex-fill card card-outline card-info rounded">
                                 <div class="card-header  text-muted border-bottom-0">
                                     <div class="row">
                                         <div class="col-xs-12 col-sm-12 col-md-11 text-left stes">
                                           <h3 class="card-title text-muted" id="title{{$key}}">
                                               <b>{{$art->titulo}}</b>
                                           </h3>  
                                         </div>
                                         <div class="col-xs-12 col-sm-12 col-md-1 text-right">
                                             <button class="btn btn-xs btn-outline-info text-ligth rounded" onclick="getModalInfo('{{$art->idarticulo_encryp}}',{{$key}})"> <i class="fas fa-edit text-ligth"></i> </button>
                                             
                                         </div>
                                     </div> 
                                 </div>
                                 <div class="card-body pt-0 ">
                                   <div class="embed-responsive embed-responsive-16by9">
                                     <iframe width="560" height="315" src="{{$art->url_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                   </div>
                                 </div>
                                 
                                 <div class="card-footer">
                                    <p>
                                      <a class="link-black text-sm mr-2 text-info">
                                        <i class="fas fa-heartbeat mr-1"></i>  
                                       {{$art->like_count}} Me gusta
                                      </a>
                                    </p>
                                 </div>
                               </div>
                             </div>
                           @endforeach
                         </div>
                       </div>
                      @endif
                  </div>
                  
              </div>
            </div>
            <!-- /.card -->
          </div>
      </div>
    </div>    
    @include('medico.modalEdit')

    @section('include_css') 
       
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
      <script src="{{ asset('/js/medico.js') }}"></script>
      <script src="{{ asset('/js/gestionSaveArt.js') }}"></script>
    @stop


 @stop
