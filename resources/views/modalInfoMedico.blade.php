<div class="modal fade" id="modal-info-medico">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title text-center"> 
          Cristhian alfredo zambrano zambrano
        </h4>
       
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
        <div class="card-body box-profile">
          <div class="text-center mb-5">
            <img class="profile-user-img img-fluid img-circle i" width="40%"  src="{{asset('/img/user1-128x128.jpg')}}" alt="User profile picture">
          </div>
         
          <spam class="text-justify description"> <small>Medico Cirujano . Especialista Oncologo . IESS</small></spam><br>
          <spam class="text-muted text-justify text-gray"><small>Teléfono: 099 999 9999</small></spam><br>
          <spam class="text-muted text-justify text-gray"><small>Email: juan.medico@correo.com</small></spam><br>  
          <spam class="text-muted text-justify text-gray"><small>Dirección: calle 1 y calle 2 entre esquina NE 123</small></spam><br>  
           
          <div class="form-group row mb-0 mt-5">
              <div class="col-md-12 offset-md-12">
                  <a href="{{url('medico/info/'.encrypt('1'))}}" type="submit" class="btn btn-info btn-block" style="background-color:#0FADCE;">
                      {{ __('Visitar perfil') }}
                  </a>
              </div>
          </div>   
              {{-- <div class="input-group mb-3">
                <input type="password" id="password" class="form-control  @error('password') is-invalid @enderror"  name="password" required autocomplete="current-password" placeholder="Password" >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    @error('password')
                      <span class=" invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div> 
              </div> --}}
           
        </div>
      </div>
    </div>
  </div>
</div>