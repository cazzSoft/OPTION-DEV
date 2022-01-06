@extends('layouts.baseLogin')

@section('content')

 <div class="container-fluid px-1 px-md-2 px-lg-1 px-xl-4 py-3 mx-auto" >
    <div class="card" >
        <div class="row d-2">
            <div class="col-lg-9">
                <div class="card-body  px-xl-4 text-center">
                  <!-- slider -->
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators ">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="img/s4.jpg" alt="...">
                          <div class="card-img-overlay d-flex flex-column justify-content-first">
                            <h5 class=" text-primary h3 titulos"><u>Beneficios al registrarte  </u> | Paciente <i class="fa fa-user"></i></h5>
                            <p class="card-text text-info pb-1 pt-2 pl-2 tt bg-light">
                              <i class="fa fa-check-double"></i>
                              Encontrar al profesional de la salud indicado para ti y tus necesidades. <br>
                              <i class="fa fa-check-double"></i>
                              Conocer mas acerca de la carrera y el perfil de tu médico mediante la visualización de sus publicaciones informativas en el área de salud subidas en nuestras plataformas. <br>
                              <i class="fa fa-check-double"></i>
                              Mantenerte informado/a mediante el acceso a información profesional y científica sobre temas de salud de tu interés. <br>
                              <i class="fa fa-check-double"></i>
                              Ganar coinsults e intercambiarlos por consultas médicas o incluso donarlos a un familiar o amigo. <br>
                            </p> 
                          </div> 
                        </div>
                        <div class="carousel-item ">
                          <img class="d-block w-100" src="img/s1.jpg" alt="...">
                          <div class="card-img-overlay d-flex flex-column justify-content-end">
                            <h5 class=" text-primary h3 titulos"><u>Beneficios al registrarte  </u> | Médico  <i class="fa fa-user-md"></i></h5>
                            <p class="card-text text-info pb-1 pt-2 pl-2 tt bg-light">
                              <i class="fa fa-check-double"></i>
                              Posicionar tu carrera profesional como médico especialista y ofrecer tus servicios profesionales en nuestra plataforma. <br>
                              <i class="fa fa-check-double"></i>
                              Potenciar la relación médico-paciente, mediante la cual el paciente conozca el perfil profesional y trayectoria laboral de su médico tratante.  <br>
                              <i class="fa fa-check-double"></i>
                              Acceder a promoción y publicidad gratuita o pautada dentro de la plataforma que te permita llegar a pacientes que realmente requieren tus servicios médicos. <br>
                              <i class="fa fa-check-double"></i>
                              Expandir tu networking dentro de la comunidad de médicos profesionales. <br>
                              <i class="fa fa-check-double"></i>
                              Ser parte de nuestra red de crowdsourcing a fin de aprender, colaborar u obtener apoyo profesional en casos médicos especiales. <br>
                            </p> 
                          </div> 
                        </div>
                        <div class="carousel-item ">
                          <img class="d-block w-100" src="img/s5.jpg" alt="slider">
                          <div class="card-img-overlay d-flex flex-column justify-content-end">
                            <h5 class=" text-primary h3 titulos"><u>Beneficios al registrarte  </u> | Empresa  <i class="fa fa-building"></i></h5>
                            <p class="card-text text-info pb-1 pt-2 pl-2 tt bg-light">
                              <i class="fa fa-check-double"></i>
                              Posicionar su marca empresarial y promocionar sus servicios y/o productos de salud en nuestra plataforma. <br>
                            
                              <i class="fa fa-check-double"></i>
                              Llegar a segmentos de mercado específicos y definidos de comportamientos, hábitos y perfiles clínicos.  <br>
                              <i class="fa fa-check-double"></i>
                              Contactar con potenciales clientes. <br>
                              <i class="fa fa-check-double"></i>
                              Expandir su networking con diferentes empresas en el sector de la salud. <br>
                              <i class="fa fa-check-double"></i>
                              Contribuir en causas sociales que impacten positivamente en la salud de la sociedad.  <br>
                            </p> 
                          </div> 
                        </div>
                      
                      </div>
                      <a class="carousel-control-prev " href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                        <!-- <span class="sr-only bg-dark">Previous</span> -->
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon " aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                  </div>
                  
                  <!-- slider -->
                </div>
                <div class="card-footer">
                  <strong><i class="fas fa-book mr-1"></i> ¿Eres un médico o empresa de salud interesada en trabajar con nosotros?</strong>
                  <p class="text-muted">
                    Contactanos: <br> 
                    <strong><i class="fas fa-envelope"></i> Email:</strong>  
                    <a href="mailto:mike.cardenas@option2health.com?Subject=Option2health">mike.cardenas@option2health.com</a>
                    <strong><i class="fa fa-mobile"></i> Telf:</strong>
                    <a target="_blank" href="https://api.whatsapp.com/send/?phone=5930969331727&text=Me+interesa+in+el+auto+que+vendes&app_absent=0">0969331727</a>
                  </p>
                </div>
            </div>
            <div class="col-lg-3 ">
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle i" width="40%"  src="acroxa.png" alt="User profile picture">
                  </div>
                  <h3 class="profile-username text-center">Iniciar sesión.</h3>
                  <p class="text-muted text-center text-gray">Software Option2health</p>
                    <form method="POST" action="{{ route('login') }}" method="post">
                      @csrf
                      <div class="input-group mb-3">
                        <input type="email"  id="email"  name="email" class="form-control  @error('email') is-invalid @enderror" placeholder="E-Mail Address"  autocomplete="Email" required>
                        <div class="input-group-append">
                          <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
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
                      </div>
                      <div class="row">
                        <div class="col-xl-8 col-sm-12">
                          <div class="icheck-primary">
                              <p class="mb-1">
                                <a class="btn btn-link ml-auto mb-0 text-sm" href="{{ route('password.request') }}"> {{ __('Olvidaste tu contraseña?') }} </a>
                              </p>
                          </div>
                        </div>
                      
                        <div class="col-xl-4 col-md-12 col-sm-12">
                          <button type="submit" class="btn btn-primary btn-block text-light">Sign In</button>
                        </div>
                        
                      </div>
                    </form>
                    <p class="mb-0">
                      No tienes una cuenta?
                      <a disabled="false" href="{{ url('sis/register/user') }}" class="text-center btn btn-link ml-auto mb-0 text-sm"> Crear una</a>
                    </p>
                    <div class="social-auth-links text-center mt-2 mb-3">
                      <p>-Deseas ser uno de nuestros medicós?-</p>
                      <a disabled="false" href="{{ url('sis/register/medico') }}" class="btn btn-block btn-primary">
                        <i class="fas fa-user-md mr-2"></i> Registro Médico
                      </a>
                      <p  class="mb-2 mt-4">-Deseas ofrecer algún producto o servicio?-</p>
                      <a disabled="false"  href="{{ url('sis/register/emp') }}" class="btn btn-block btn-warning">
                        <i class="fas fa-building mr-2"></i> Registro servicios
                      </a>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="bg-primary py-4 text-light">
            <div class="row px-3 text-light"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2021 todos los derechos reservado.</small>
                <div class="social-contact ml-4 ml-sm-auto">
                  <a href="https://www.facebook.com/Option2health"  target="_blank">
                    <span class="fa fa-facebook mr-4 text-sm"></span>
                  </a>
                   <span class="fa fa-google-plus mr-4 text-sm"></span> 
                   <span class="fa fa-linkedin mr-4 text-sm"></span> 
                   <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> 
                </div>
            </div>
        </div>
    </div>
</div> 

   
   
@endsection
