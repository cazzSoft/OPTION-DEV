<div class="modal fade bd-example-modal-lg"  role="dialog" id="modal-info-cita" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border border-white pl-4 pr-2 pt-1 pb-1"> 
        <h6 class="modal-title text-left "> 
          Agenda Médica
        </h6>
        <span type="button" class="close p-0 m-0 text-white "  id="btn-eliminar-cta" >
          <i class="fa-regular fa-trash-can text-info_ fa-xs"></i> 
        </span> 
        <div class="spinner-border text-info spinner-border-sm  mt-1 mr-1 d-none efect-eliminar"  role="status">
        </div>
      </div>
      <div class="modal-body   ">
        <div class="card-body p-0 ">
          <div class="atenuar-modal-info"> </div>
          <div class="row">
            <div class="col-12">
              <span class="title-cita"></span>
            </div>
            <div class="col mt-3" id="text-fecha-info"><i class="fa-regular fa-clock"></i> Lunes, 26 de Septiembre</div>
            <div class="col mt-3" id="text-hora-info"> 9:00 am - 10:00 am</div>
            <div class="col-12 row mt-3">
              <div class="col"> <button class="btn btn-info btn-block btn-sm" id="btn-iniciar-cita" onclick="iniciar_cita()">Iniciar cita</button></div>
              <div class="col"> <button class="btn btn-default btn-block btn-sm border border-info text-info_ " id="btn-editar-cita">Editar cita</button></div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

