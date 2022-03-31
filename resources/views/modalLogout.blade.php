<!-- Modal -->
<div class="modal fade " id="modalLogout" tabindex="-1" role="dialog"  aria-hidden="true" >
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <i class="far fa-times-circle"></i>
        </button> <br>
        <div class=" text-center ml-5">
            <img src="{{asset('/img/logout.png')}}" class="text-center">
        </div>
         <p class="text-info_ h5 text-center mt-3">
             Recordarme en este navegador
         </p>
         <p class="text-center">
             No tendrás que introducir tus datos la próxima vez que visites Option2health.
         </p>
         
         <div class="form-group">
             <button class="btn btn-block btn-default btn-lg" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</button>
         </div>
         <div class="form-group">
             <button class="btn btn-block bgz-info btn-lg lead" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Recordarme y Cerrar sesión</button>
         </div>


      </div>
      
    </div>
  </div>
</div>
