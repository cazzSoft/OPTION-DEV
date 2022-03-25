
<!-- Modal -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form method="POST" id="form_art">
        <div class="modal-header">
          <h5 class="modal-title text-info" id="exampleModalLabel">Editar Publicación </h5>
          <span class="p-2 ml-2 badge badge-pill badge-light text-red ">Campos obligatorios (*)</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="far fa-times-circle"></i>
          </button>
        </div>
        <div class="modal-body">
          @csrf

         
            {{-- Información Principal --}}
            <div class="card  collapsed-card card-control" id="card">
              <div class="card-header">
                <h3 class="card-title">Información Principal </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="collapse_form" data-card-widget="collapse" title="Collapse2">
                    <i class="fas fa-plus fas-control text-info_"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="titulo" >Nombre de la Publicación<span class="text-red">*</span></label>
                        <input id="titulo" type="text" class="form-control " name="titulo" value="" placeholder="Nombre de la Publicación" required  autocomplete="titulo" autofocus>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="area_desc" >Áreas directa o indirectamente relacionadas a la enfermedad / tema / contenido<span class="text-red">*</span></label>
                        <textarea class="form-control"  rows="4" placeholder="Ingrese áreas directa o indirectamente"  value="" name="area_desc"  autocomplete="area_desc" id="area_desc" autofocus value="" required></textarea>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="url_video" >Url del video<span class="text-red">*</span></label>
                        <input id="url_video" type="text" class="form-control " name="url_video" value="" placeholder="Ingrese Url del video" required autocomplete="url_video" autofocus>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="descripcion" > Texto a presentar en la Publicación <span class="text-red">*</span></label>
                        <textarea class="form-control"  rows="3" placeholder="Ingrese texto a presentar en la Publicación"  value="" name="descripcion"  autocomplete="descripcion" id="descripcion" autofocus value="" required></textarea>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="vinculo_art" >Url para mas información de la publicación</label>
                        <input id="vinculo_art" type="text" class="form-control " name="vinculo_art" value="" placeholder="Ingrese url para mas información de la publicación"  autocomplete="vinculo_art" autofocus>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="card  collapsed-card card-control" id="card">
              <div class="card-header">
                <h3 class="card-title">Información Complementaría  </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="collapse_form" data-card-widget="collapse" title="Collapse2">
                    <i class="fas fa-plus fas-control text-info_"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  {{-- Información Complementaría --}}
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="afecta_desc" >Sexo (Esta enfermedad afecta a ...) <span class="text-red">*</span></label>
                        <input id="afecta_desc" type="text" class="form-control " name="afecta_desc" value="" placeholder="Esta enfermedad afecta a" required autocomplete="afecta_desc" autofocus>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group ">
                      <label class="text-muted" for="edad_inicial" >Límite de edad (INICIA EN ) <span class="text-red">*</span></label>
                      <input id="edad_inicial" type="number" min="1" class="form-control " name="edad_inicial" value=""  required autocomplete="edad_inicial" autofocus>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group ">
                      <label class="text-muted" for="edad_final" >Límite de edad (TERMINA EN) <span class="text-red">*</span></label>
                      <input id="edad_final" type="number" min="1" class="form-control " name="edad_final" value="" required autocomplete="edad_final" autofocus>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="sintoma" >Síntomas<span class="text-red">*</span></label>
                        <textarea class="form-control"  rows="3" placeholder="Ingrese Síntomas"  value="" name="sintoma"  autocomplete="sintoma" id="sintoma" autofocus  required></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            

            <div class="card  collapsed-card card-control" id="card">
              <div class="card-header">
                <h3 class="card-title">Información Complementaría Final </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="collapse_form" data-card-widget="collapse" title="Collapse2">
                    <i class="fas fa-plus fas-control text-info_"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  {{-- Información Complementaría Final --}}
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="causas" >Causas </label>
                        <textarea class="form-control"  rows="3" placeholder="Ingrese Causas"  value="" name="causas"  autocomplete="causas" id="causas" autofocus ></textarea>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="tratamiento" >Tratamiento </label>
                        <textarea class="form-control"  rows="3" placeholder="Ingrese Tratamiento"  value="" name="tratamiento"  autocomplete="tratamiento" id="tratamiento" autofocus  ></textarea>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="diagnostico" >Diagnóstico</label>
                        <textarea class="form-control"  rows="3" placeholder="Ingrese Diagnóstico"  name="diagnostico"  autocomplete="diagnostico" id="diagnostico" autofocus value="" ></textarea>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group ">
                        <label class="text-muted" for="enfermedades" >Enfermedades relacionadas</label>
                        <textarea class="form-control"  rows="3" placeholder="Ingrese Enfermedades relacionadas"  name="enfermedades"  autocomplete="enfermedades" id="enfermedades" autofocus value="" ></textarea>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          
         </div>
        <div class="modal-footer text-center  d-flex justify-content-center">
          <button type="submit" class="btn bgz-info ">Guardar Cambios</button>
        </div>
      </form>  
    </div>
  </div>
</div>