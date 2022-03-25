<div class="modal fade" id="modal-info-medico">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header ">
        <h6 class="modal-title text-center "> 
          <b class="txt_name text-center"></b>
        </h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="far fa-times-circle"></i>
          </button>
      </div>
      <div class="modal-body">
        <div class="card-body box-profile">
          <div class="text-center mb-4">
            <img class="profile-user-img img-fluid img-circle border-0 img_txt"   src="{{asset('/img/user1-128x128.jpg')}}" alt="User-profile">
          </div>
          <small class="txt_titulo text-muted text-center"></small><br>
          <small class="txt_telf  text-muted text-center"></small><br>
          <small class="txt_email"></small><br>
          <small class="txt_direc"></small><br>  
          <spam class="text-muted text-justify text-gray"></spam><br>  
           
          <div class="form-group row mb-0 mt-2">
              <div class="col-md-12 offset-md-12">
                  <a href="{{url('medico/info/'.encrypt('1'))}}" type="submit" class="btn btn-info btn-block text_url" style="background-color:#0FADCE;">
                      {{ __('Visitar perfil') }}
                  </a>
              </div>
          </div>            
        </div>
      </div>
    </div>
  </div>
</div>