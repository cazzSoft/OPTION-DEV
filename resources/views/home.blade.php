@extends('homeOption2h')
@section('title','HOME')

{{--para activar los plugin en la view  --}}

@section('plugins.Sweetalert2',false)
@section('plugins.toastr',true)
@section('plugins.switchButton',false)
@section('plugins.daterangepicker',false)

{{-- cuerpo de la pagina --}}
@section('contenido')

    {{-- @section('content_header')
        <h1>hola</h1>
    @stop --}} 
       <div class="card">

         <div class="card-header">
            <div class="row">
              <div class="col-md-4">
                <form action="{{url('gestion/search')}}" method="POST">
                  {{ csrf_field() }}
                  <input id="method_" type="hidden" name="_method" value="POST">                  <div class="input-group  ">
                    <input type="Search" class="form-control" name="q" value="@if(isset($valor)) {{$valor}} @endif">
                    <div class="input-group-append">
                       <button class="input-group-text " type="submit"> <i class="fas fa-search"></i> </button>
                      {{-- <span class="input-group-text"><i class="fas fa-check"></i></span> --}}
                    </div>
                  </div>
                </form> 
              </div>
              <div class="col-md-8 text-right">
                 @if(isset($activeM))
                 <a class="text-muted text-primary" href="{{url('login')}}">¿Listo para tomar el control de tu salud y de los demás? INGRESA AQUÍ</a>
                 @else
                  <small class="text-muted">Estos artículos te pueden interesar.</small>
                 @endif
               
              </div>
            </div>
            

         </div>
          @if (isset($articulos))
          <div class="card-body table-responsive">
            <div class="row">
              @foreach ($articulos as $art )
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex align-items-stretch flex-column">
                  <div class="card d-flex flex-fill card card-outline card-info mt-5 mr-4">
                    <div class="card-header text-muted border-bottom-0">
                      <h1 class="card-title"> Option2Health </h1>
                     
                        <a href="{{url('medico/info/'.encrypt($art['iduser']))}}" >
                          <div class="medico" style="cursor: pointer;" >
                            <img src="https://option2health.com/assets/img/logo.png" class="rounded mx-auto d-block img2">
                            <small> <b>Dr. O2H</b> </small>
                          </div>
                        </a>

                    </div>
                    <div class="card-body pt-0 ">
                      <div class="row"   >
                        <div class="col-lg-12" >
                          <h2 class="lead"><b>{{$art['titulo']}}</b></h2>
                          <p class="text-muted text-sm text-justify">
                            {{$art['descripcion']}} <a href="{{$art['vinculo_art']}}" target="_blank" onclick="acctionVermas('{{encrypt($art['idarticulo'])}}')">Ver más... </a></p> 
                        </div>
                        <div class="embed-responsive embed-responsive-16by9"  onmouseleave ="acctionVideo('{{encrypt($art['idarticulo'])}}',this)" >
                          <iframe id=""  width="560" height="315" src="{{$art['url_video']}}"  frameborder="0" allowtransparency="true" allowfullscreen ></iframe>
                        
                        </div>
                      </div>
                    </div>
                    
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-2 card-outline ">
                          <button type="button"  onclick="putLike_poin('{{encrypt($art['idarticulo'])}}',this )" class="@if(isset($art['like'][0])) btn btn-block bg-gradient-info  @else btn btn-outline-info btn-block @endif "><i class=" fa fa-heartbeat"></i>
                            <span class="badge ">{{$art['like_count']}}</span>
                            Me gusta 
                          </button>

                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12  mb-2  ">
                          <div class="dropdown text-right">
                            <button class="btn btn-outline-info  dropdown-toggle btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                            <i class="fa fa-share-alt"></i> Compartir
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                              <a onclick="acctionCompartirF('{{encrypt($art['idarticulo'])}}')"  class="dropdown-item" type="button" href="https://www.facebook.com/sharer/sharer.php?u={{$art['url_video']}}" target="_blank">
                                <i class="fab fa-facebook" ></i> Facebook
                              </a>
                               <a onclick="acctionCompartirW('{{encrypt($art['idarticulo'])}}')"  class="dropdown-item" type="button" href="https://api.whatsapp.com/send/?phone&text=Hola!.%20Te%20acabo%20de%20compartir%20*{{$art['titulo']}}*%20creo%20que%20te%20podria%20interesar.%20Rev%C3%ADsala:%20https://option2health.com/share.html?prodId={{$art['idarticulo']}}%20%20*Option2health*.&app_absent=0" target="_blank">
                                <i class="fab fa-whatsapp"></i> Whatsapp 
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12  ">
                          <div class="dropdown text-right">
                            <button class="btn  btn-outline-info dropdown-toggle  btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-info-circle"></i> Ver más
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                              <button class="dropdown-item" type="button" onclick="saveArtUser('{{encrypt($art['idarticulo'])}}')"> <i class="fa fa-save"></i> Guardar</button>
                              <button class="dropdown-item" type="button" onclick="acctionContacOnline('{{encrypt($art['idarticulo'])}}')"><i class="fa fa-phone"></i> Contacto Online</button>
                              <button class="dropdown-item" type="button" onclick="acctionContactW('{{encrypt($art['idarticulo'])}}')"><i class="fab fa-whatsapp"></i> Contacto Whatsapp</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
                
            </div>
          </div>
         
            <div class="form-group text-center mx-auto ">
                 {{ $articulos->links() }}
            </div>
          
          @endif
       </div>
       <!-- Modal -->
      {{--  <div class="modal fade" id="modal-default">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h4 class="modal-title">Ayudemos a Samu! <i class="fa fa-smile-beam"></i></h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <a href="{{url('login')}}">
                 <img class="card-img-top" src="http://option2health.com/assets/img/samu.jpeg" alt="AdminLTELogo">
               </a>
             </div>
           </div>
           <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
       </div> --}}
    @section('include_css') 

      <style>
        .medico {
            position: absolute;
            border: 1px solid #10ADCF;
            text-align: center;
            right: -3vh;
            top: -3.8vh;
            background: #fff;
            border-radius: 4px;
            padding: 1vh;
            width: 7em;
            height: 6em;
            font-size: 1em;
            -moz-box-shadow: 0px 0px 9px -8px rgba(0,0,0,0.75);
            box-shadow: 0px 0px 19px -8px rgb(0 0 0 / 75%);
        }
        .img2{
          width: 67%;
        }
      </style>
    @stop   
    {{-- Seccion para insertar js--}}
    @section('include_js')
     {{-- @if(isset($activeM)) 

      <script > alert(2);$('#modal-default').modal('show');</script>
     @endif --}}
      <script src="{{ asset('/js/controlLike.js') }}"></script>
      <script src="{{ asset('/js/gestionSaveArt.js') }}"></script>
    @stop
    


 @stop
