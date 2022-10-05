
<!-- Modal -->
<div class="modal fade" id="modal_caso_ex" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form method="POST" id="form_caso">
        <div class="modal-header">
          <h5 class="modal-title text-info" id="exampleModalLabel">Publicar un caso excepcional</h5>
          <span class="p-2 ml-2 badge badge-pill badge-light text-red ">Campos obligatorios (*)</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group ">
                  <label class="text-muted" for="titulo" >Posible Nombre <span class="text-red">*</span></label>
                  <input id="titulo" type="text" class="form-control " name="titulo" value="" placeholder="Nombre de la Publicación" required  autocomplete="titulo" autofocus>
              </div>
            </div>
           
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group ">
                  <label class="text-muted" for="url_video" >Url del video<span class="text-red">*</span></label>
                  <input id="url_video" type="text" class="form-control " name="url_video" value="" placeholder="Ej: https://www.youtube.com/embed/go1VxrDbr8g" required autocomplete="url_video" autofocus>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group ">
                  <label class="text-muted" for="descripcion" > Tienes alguna descripción de la enfermedad? </label>
                  <textarea class="form-control"  rows="3" placeholder="Ingrese texto a presentar en la Publicación"  value="" name="descripcion"  autocomplete="descripcion" id="descripcion" autofocus value="" ></textarea>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group ">
                  <label class="text-muted" for="diagnostico" >Resultados de examenes</label>
                  <textarea class="form-control"  rows="3" placeholder="Ingrese Diagnóstico"  name="diagnostico"  autocomplete="diagnostico" id="diagnostico" autofocus value="" ></textarea>
              </div>
            </div>
           
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group ">
                  <label class="text-muted" for="afecta_desc" >Sexo (Esta enfermedad afecta a ...) <span class="text-red">*</span></label>
                  <input id="afecta_desc" type="text" class="form-control " name="afecta_desc" value="" placeholder="Esta enfermedad afecta a" required autocomplete="afecta_desc" autofocus>
              </div>
            </div>
          </div>
          <div class="row">
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
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group ">
                  <label class="text-muted" for="sintoma" >Síntomas<span class="text-red">*</span></label>
                  <textarea class="form-control"  rows="3" placeholder="Ingrese Síntomas"  value="" name="sintoma"  autocomplete="sintoma" id="sintoma" autofocus  required></textarea>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group ">
                  <label class="text-muted" for="causas" >Causas <span class="text-red">*</span></label>
                  <textarea class="form-control"  rows="3" placeholder="Ingrese Causas"  value="" name="causas"  autocomplete="causas" id="causas" autofocus required></textarea>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group ">
                  <label class="text-muted" for="tratamiento" >Tratamientos Usados </label>
                  <textarea class="form-control"  rows="3" placeholder="Ingrese Tratamientos Usados"  value="" name="tratamiento"  autocomplete="tratamiento" id="tratamiento" autofocus  ></textarea>
              </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group ">
                  <label class="text-muted" for="medico_visitado" >Médicos visitados</label>
                  <textarea class="form-control"  rows="3" placeholder="Ingrese Médicos visitados"  name="medico_visitado"  autocomplete="medico_visitado" id="medico_visitado" autofocus value="" ></textarea>
              </div>
            </div>
          </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Publicar</button>
        </div>
      </form>  
    </div>
  </div>
</div>