<div class="modal fade"  id="modal-edit-user-md-dt" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  > 
 <div class="modal-dialog modal-lg">
   <div class="modal-content">
     <div class="modal-header  ">
        @movil
        <h4>Editar Datos del perfil medico</h4>
        @else
            <h4 class="modal-title text-center mx-auto ml-5">
                <span class=" text-center ml-5 pl-5">   Editar Datos del perfil medico</span> 
            </h4>
        @endmovil
     
       <button type="button border-0" class="close" data-dismiss="modal" aria-label="Close">
         <i class="far fa-times-circle"></i>
       </button>
     </div>
     <div class="modal-body">
       @if(isset($datos_p))
            <form method="POST" action="{{ url('/medico/perfil_/'.encrypt($datos_p->id) ) }}">
               {{ csrf_field() }}
               <input id="method_" type="hidden" name="_method" value="PUT">
               <div class="row">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="text-muted" for="detalle_estudio">Acerca de mi </label>
                            <textarea class="form-control @error('detalle_estudio') is-invalid @enderror"  rows="3" placeholder="Ej: soy una persona..."  value="{{$datos_p->detalle_estudio}}"
                             name="detalle_estudio" id="detalle_estudio" required></textarea>
                            @error('detalle_estudio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                       <div class="form-group">
                           <label class="text-muted" for="detalle_experiencia">Ingrese su experiencia profesional</label>
                           <textarea class="form-control @error('detalle_experiencia') is-invalid @enderror"  rows="3" placeholder="Ej: Médico especialista..."  value=" " 
                               name="detalle_experiencia" id="detalle_experiencia"  autocomplete="detalle_experiencia" autofocus required></textarea>
                           @error('detalle_experiencia')
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