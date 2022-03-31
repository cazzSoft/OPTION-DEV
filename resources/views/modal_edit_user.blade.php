<div class="modal fade"  id="modal-edit-user" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  > 
 <div class="modal-dialog modal-lg">
   <div class="modal-content">
     <div class="modal-header  ">
      <h3 class="modal-title  "> Editar datos     </h3>
     
       <button type="button border-0" class="close" data-dismiss="modal" aria-label="Close">
         <i class="far fa-times-circle"></i>
       </button>
     </div>
     <div class="modal-body">
       @if(isset($data))
           <form method="POST" action="{{ url('/profile/user/'.encrypt($data->id) ) }}">
               {{ csrf_field() }}
               <input id="method_" type="hidden" name="_method" value="PUT">
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="text-muted" for="exampleInputPassword1">Nombres <span class="text-red">*</span> </label>
                          <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Name" value="{{$data->name}}" requiered>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-muted" for="telefono">Télefono  <span class="text-red">*</span></label>
                            <input type="text"   name="telefono" class="form-control form-control-sm" id="telefono" aria-describedby="emailHelp"
                                placeholder="Enter Télefono" value="{{$data->telefono}}" requiered>
                        </div>
                    </div>    
               </div>
              

               
               <div class="row">
                  
                   <div class="col-md-6">
                       <div class="form-group">
                           <label class="text-muted" for="fecha_nacimiento">Fecha de Nacimiento <span class="text-red">*</span></label>
                           <input type="date"   name="fecha_nacimiento" class="form-control form-control-sm" id="fecha_nacimiento" aria-describedby="fecha_nacimiento"
                               placeholder="Enter fecha" value="{{$data->fecha_nacimiento}}" requiered>
                       </div>
                   </div>
                   <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-muted" for="email">Email <span class="text-red">*</span></label>
                            <input type="email"   name="email" class="form-control form-control-sm" id="email" aria-describedby="emailHelp"
                                placeholder="Enter email" value="{{$data->email}}" requiered  @if(isset(auth()->user()->social_id) && auth()->user()->social_id!= null) readonly @endif>
                        </div>
                       
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                           <label class="text-muted" for="genero">Genero  <span class="text-red">*</span></label>
                           <select class="form-control select2 form-control-sm" style="width: 100%;"  name="genero">
                               <option @if($data->genero==1) selected="selected" @endif  value="1">Masculino</option>
                               <option @if($data->genero==0) selected="selected" @endif value="0">Femenino</option>
                           </select>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group"> 
                           <label class="text-muted" for="idciudad">Ciudad <span class="text-red">*</span></label>
                           <select class="form-control select2 form-control-sm" style="width: 100%;"  name="idciudad" data-placeholder="Seleccione Ciudad" >
                               <option></option>
                               @if(isset($listaCiudad))
                                   @foreach($listaCiudad as $item)
                                       <option @if($data->idciudad==$item->idciudad) selected="selected" @endif value="{{$item->idciudad}}">{{$item->descripcion}}</option>
                                   @endforeach
                               @endif
                              
                           </select>
                       </div>
                   </div>
                    <div class="col-md-6">
                       <div class="form-group">
                           <label class="text-muted" for="nom_referido">Nombres de tu Referido  <span class="text-red">*</span></label>
                           <input type="nom_referido"   name="nom_referido" class="form-control form-control-sm" id="nom_referido" aria-describedby="nom_referido"
                                placeholder="Enter nombre referido" value="{{$data->nom_referido}}" requiered>
                       </div>
                   </div>
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="tine_hijo" class="text-muted">Tienes Hijos? <span class="text-red">*</span></label>
                            <select class="form-control  select2 @error('tine_hijo') is-invalid @enderror" style="width: 100%;"
                                data-placeholder="Seleccione " name="tine_hijo" id="tine_hijo" >
                                <option ></option>
                                <option @if($data['tine_hijo']==1)  selected="selected" @endif value="1">Si</option>
                                <option @if($data['tine_hijo']==0)  selected="selected" @endif value="0">No</option>
                               
                            </select>
                            @error('tine_hijo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                   </div>
               </div>
               <div class="form-group text-center">
                   <button type="submit" class="btn btn-info"> <i class=" fa fa-save"></i> Actualizar</button> <br>
                   <p class="mt-3"> <a href="" class="text-info mt-4">Cancelar</a> </p>
               </div>
               
           </form>
       @endif
       
     </div>
   </div>
   <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
</div>