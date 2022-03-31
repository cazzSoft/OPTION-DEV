<div class="modal fade"  id="modal-edit-user-md" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  > 
 <div class="modal-dialog modal-lg">
   <div class="modal-content">
     <div class="modal-header text-center">
        <h4 class="modal-title text-center mx-auto ml-5">
            <span class=" text-center ml-5 pl-5">   Editar Datos del perfil medico</span> 
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times-circle"></i>
        </button>
     </div>
     <div class="modal-body">
       @if(isset($datos_p))
           <form method="POST" action="{{ url('/medico/perfil/'.encrypt($datos_p->id) ) }}">
               {{ csrf_field() }}
               <input id="method_" type="hidden" name="_method" value="PUT">
               <div class="form-group">
                   <label class="text-muted" for="exampleInputPassword1">Nombres <span class="text-red">*</span> </label>
                   <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$datos_p->name}}" requiered>
               </div>
               

               <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="idtitulo_profesional" class="text-muted">Seleccione Título Profesional <span class="text-red">*</span></label>
                            <select  class="form-control  select2 @error('idtitulo_profesional') is-invalid @enderror" style="width: 100%;" required 
                                data-placeholder="Seleccione su Título Profesional" name="idtitulo_profesional" id="idtitulo_profesional" required>
                                <option></option>
                                @if(isset($lista_titu))
                                    @foreach($lista_titu as $tit)
                                    <option @if(old('idtitulo_profesional')==$tit->idtitulos || $datos_p->idtitulo_profesional==$tit->idtitulos)  selected="selected" @endif value="{{$tit->idtitulos}}">{{$tit->descripcion}}</option>
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
                    <div class="col-xs-12 col-sm-12 col-md-12   ">
                        <div class="form-group"> 
                            <label class="text-muted" for="iduser_especialidad">Especialidades <span class="text-red">*</span></label>
                            <select  multiple class="form-control select2 bg-info" style="width: 100%;"  name="iduser_especialidad[]" data-placeholder="Seleccione especialidades" required>
                                <option></option>
                                @if(isset($lista_especialidad))
                                    @foreach($lista_especialidad as $item)
                                        <option  
                                            @if(isset($especialidad))
                                            class="ddd" 
                                                @foreach($especialidad as $esp)
                                                    @if($esp->idespecialidades==$item->idespecialidades)
                                                        selected 
                                                    @endif
                                                @endforeach
                                            @endif
                                         value="{{$item->idespecialidades}}">
                                            {{$item->descripcion}}
                                        </option>
                                    @endforeach
                                @endif
                               
                            </select>
                        </div>
                    </div>
                   <div class="col-md-6">
                        <div class="form-group">
                           <label class="text-muted" for="telefono">Télefono  <span class="text-red">*</span></label>
                           <input type="text"   name="telefono" class="form-control" id="telefono" aria-describedby="telefono"
                               placeholder="Enter Télefono" value="{{$datos_p->telefono}}" requiered>
                        </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                          <label class="text-muted" for="email">Email <span class="text-red">*</span></label>
                          <input type="email"   name="email" class="form-control" id="emael" aria-describedby="emailHelp"
                              placeholder="Enter email" value="{{$datos_p->email}}" requiered @if(isset(auth()->user()->social_id) && auth()->user()->social_id!= null) readonly @endif >
                      </div>
                   </div>
                  {{--  <div class="col-md-6">
                       <div class="form-group">
                           <label class="text-muted" for="exampleInputEmail1">Fecha de Nacimiento <span class="text-red">*</span></label>
                           <input type="date"   name="fecha_nacimiento" class="form-control" id="emael" aria-describedby="emailHelp"
                               placeholder="Enter fecha" value="{{$datos_p->fecha_nacimiento}}" requiered>
                       </div>
                   </div> --}}
                  {{--  <div class="col-md-6">
                       <div class="form-group">
                           <label class="text-muted" for="exampleInputEmail1">Genero  <span class="text-red">*</span></label>
                           <select class="form-control select2" style="width: 100%;"  name="genero">
                               <option @if($datos_p->genero==1) selected="selected" @endif  value="1">Masculino</option>
                               <option @if($datos_p->genero==0) selected="selected" @endif value="0">Femenino</option>
                           </select>
                       </div>
                   </div> --}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                       <div class="form-group ">
                           <label class="text-muted" for="direccion" > Dirección de su consultorio</label>
                           <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $datos_p->direccion }}" placeholder="Ingrese dirección de su consultorio"  autocomplete="direccion" autofocus required>

                           @error('direccion')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                           
                       </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                       <div class="form-group ">
                           <label class="text-muted" for="link_stg" > Instagram <i class="fab fa-instagram"></i></label>
                           <input id="link_stg" type="text" class="form-control @error('link_stg') is-invalid @enderror" name="link_stg" value="{{$datos_p->link_stg }}" placeholder="https://www.instagram.com"  autocomplete="link_stg" autofocus required>

                           @error('link_stg')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                       <div class="form-group ">
                           <label class="text-muted" for="link_fb" > Facebook <i class="fab fa-facebook"></i></label>
                           <input id="link_fb" type="text" class="form-control @error('link_fb') is-invalid @enderror" name="link_fb" value="{{ $datos_p->link_fb }}" placeholder="https://www.facebook.com"  autocomplete="link_fb" autofocus>

                           @error('link_fb')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                           
                       </div>
                    </div>
                     <div class="col-xs-12 col-sm-12 col-md-12">
                       <div class="form-group ">
                           <label class="text-muted" for="link_yt" > YouTube <i class="fab fa-youtube"></i></label>
                           <input id="link_yt" type="text" class="form-control @error('link_yt') is-invalid @enderror" name="link_yt" value="{{ $datos_p->link_yt }}" placeholder="https://www.youtube.com"  autocomplete="link_fb" autofocus>

                           @error('link_yt')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                           
                       </div>
                    </div>
               </div>
               <div class="form-group text-center mt-3">
                   <button type="submit" class="btn bgz-info"> <i class=" fa fa-save"></i> 
                        Actualizar</button> 
                   <p class="mt-3"> <a href="#" data-dismiss="modal" aria-label="Close" class="text-info mt-4">Cancelar</a> </p>
               </div>
              
           </form>
       @endif
       
     </div>
   </div>
   <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
</div>