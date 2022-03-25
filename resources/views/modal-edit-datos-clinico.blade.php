<div class="modal fade"  id="modal-edit-user-dc" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  > 
 <div class="modal-dialog modal-lg">
   <div class="modal-content">
     <div class="modal-header  ">
      <h3 class="modal-title  "> Editar Datos Médicos     </h3>
     
       <button type="button border-0" class="close" data-dismiss="modal" aria-label="Close">
         <i class="far fa-times-circle"></i>
       </button>
     </div>
     <div class="modal-body">
       @if(isset($datos_m))
           <form method="POST" action="{{ url('/profile/perfil/'.encrypt($datos_m->iddatos_medico) ) }}">
               {{ csrf_field() }}
               <input id="method_" type="hidden" name="_method" value="PUT">
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="text-muted" for="tipo_sangre">Tipo de sangre <span class="text-red">*</span> </label>
                          <input type="text" class="form-control form-control-sm" id="tipo_sangre" name="tipo_sangre" placeholder="A+" value=" {{$datos_m['tipo_sangre']}}" requiered>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-muted" for="talla">Talla  <span class="text-red">*</span></label>
                            <input type="number" step="0.001"  name="talla" class="form-control form-control-sm" id="talla" aria-describedby="talla"
                                placeholder="1.75" value="{{$datos_m['talla']}}" requiered>
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-muted" for="peso">Peso  <span class="text-red">*</span></label>
                            <input type="number" step="0.001"   name="peso" class="form-control form-control-sm" id="peso" aria-describedby="peso"
                                placeholder="45" value="{{$datos_m['peso']}}" requiered>
                        </div>
                    </div>   
               </div>
              

               
              	<div class="form-group">
                    <label class="text-muted" for="enfermedades">Enfermedades en la familia <span class="text-red"></span></label>
                    <textarea class="form-control @error('enfermedades') is-invalid @enderror "  rows="4" placeholder="Ejem: Madre con hipertensión, etc.."  name="enfermedades"  id="enfermedades"   ></textarea>
                </div>
               {{--  <div class="form-group">
                    <label class="text-muted" for="exampleInputEmail1">Enfermedades en la familia* <span class="text-red"></span></label>
                    <select class="form-control select2-mul" multiple="multiple" name="select_enf[]">
                        @if(isset($lista_enf))

                            @foreach($lista_enf as $item)
                                 <option selected="selected">{{$item}}</option>
                            @endforeach
                        @endif
                     
                      <option selected="selected">Madre con hipertensión</option>
                      <option selected="selected">Padre con hipertensión</option>
                    </select>
                </div> --}}
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