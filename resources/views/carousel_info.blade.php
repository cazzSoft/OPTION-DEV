@movil
  <div id="sliderInfo" class="carousel slide  border-bottom " data-ride="carousel">
    <ol class="carousel-indicators  ">
      <li data-target="#sliderInfo" data-slide-to="0" class="active bg-info rounded-circle"></li>
      <li data-target="#sliderInfo" data-slide-to="1" class=" bg-info rounded-circle"></li>
      <li data-target="#sliderInfo" data-slide-to="2" class=" bg-info rounded-circle"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active ">
        <div class="card  shadow-none " >
          <div class="card-body row text-dark border-white card-info">
            <div class="col-12  text-center div-info ">
                <img class="img-info" src="{{asset('/img/slider/s1doctor.png')}}" alt="Photo">
            </div>
            <div class="col-12 " >
              <div class="div_conten_info m-auto">
                <h2 class=" text-info-s1 mt-1"> ¿Listo para tomar el control de tu salud y de tu Familia?  
                  <br><span class="text-info-s1 text-info_ text-calibri"><b>INGRESA AQUÍ</b></span>
                </h2>
              </div>
              <div class="form-group  text-center ">
                <a class="btn bgz-info rounded  shadow-sm  btn-sm btn-block"    href="session" >
                  <b class="text-calibri">Regístrate</b>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item ">
        <div class="card  shadow-none "   >
          <div class="card-body row text-dark border-white card-info" >
            <div class="col-12  text-center div-info" >
              <img class="img-info" src="{{asset('/img/slider/s2.png')}}" alt="Photo"> 
            </div>
            <div class="col-12  ">
              <div class="text-left div_conten_info"> 
                <span class="text-s2 ">Mantente fuerte, vive mucho.</span><br>
                <span class="text-cuida-s2 text-left"> Cuida tu cuerpo y él  cuidara de ti. </span> <br>
                <span class="text-s2  ">Podrás monitorear los signos vitales de ti y tu familia desde cualquier dispositivo</span> 
              </div>
              <div class="form-group  text-center">
                <a class="btn bgz-info rounded  shadow-sm  btn-sm btn-block"    href="session" >
                  <b class="text-calibri">Regístrate </b>
                </a>
              </div> 
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item ">
        <div class="card  shadow-none" >
          <div class="card-body row text-dark border-white card-info" >
            <div class="col-12  text-center div-info">
              <img class="img-info text-info" src="{{asset('/img/slider/s3.png')}}" alt="Photo">
            </div>
            
            <div class="col-12">
              <div class=" text-left div_conten_info">
                <p class="text-cuida-s2 text-left"> Miles de <span class="text-info_">Médicos</span> especialistas a tu alcance en cualquier momento </p>
                <span class="text-s2 text-left">Tendrás a tu disposición médicos de cualquier especialidad.</span>
              </div>
              <div class="form-group ">
                <a class="btn bgz-info rounded shadow-sm btn-sm text-center btn-block"  href="session" >
                 Regístrate 
                </a>
              </div>   
            </div>
          </div>
        </div> 
      </div>
    </div>
    <a class="carousel-control-prev " href="#sliderInfo" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next  bg-info" href="#sliderInfo" role="button" data-slide="next">
      <span class="carousel-control-next-icon " aria-hidden="true"></span>
    </a>
  </div>
@else
  <div id="sliderInfo" class="carousel slide  border-bottom ml-5 mr-5 mb-5" data-ride="carousel">
    <ol class="carousel-indicators  ">
      <li data-target="#sliderInfo" data-slide-to="0" class="active bg-info rounded-circle"></li>
      <li data-target="#sliderInfo" data-slide-to="1" class=" bg-info rounded-circle"></li>
      <li data-target="#sliderInfo" data-slide-to="2" class=" bg-info rounded-circle"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active ">
        <div class="card  shadow-none card-info " >
          <div class="card-body row text-dark  border-white mb-2">
            <div class="col-md-6 m-auto">
              <div class="ml-5  mt-1 ">
                <h2 class="h1 text-info-s1 mb-5"> ¿Listo para tomar el control de tu salud y de tu Familia?  
                  <br><span class="text-info-s1 mb-5 h1 text-info_ text-calibri pt-4 mt-3"><b>INGRESA AQUÍ</b></span>
                </h2>
                <div class="form-group   bt_register_carrosel text-center ">
                  <a class="btn pr-5 pl-5  bgz-info rounded  shadow-sm mt-5 btn-s3 btn-sm "    href="session" >
                    <b class="h4 text-calibri">Regístrate </b>
                  </a>
                </div>  
              </div>
            </div>
            <div class="col-md-6  text-center  m-auto">
              <img class="mb-3 mr-4 img-info" src="{{asset('/img/slider/s1doctor.png')}}" alt="Photo">
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item ">
        <div class="card  shadow-none "   >
          <div class="card-body row text-dark   border-white card-info" >
            <div class="col-md-6 col-sm-12 pl-5  m-auto">
              <div class="  mt-1  div-info-2 ">
               <div class="content_div_info ">
                 <span class="text-calibri text-info_ h4 text-info-s2">Mantente fuerte, vive mucho.</span>
                 <h2 class="h1 text-info-s1 div_2_text"> Cuida tu cuerpo y él  cuidara de ti. </h2> <br>
                 <span class="text-info-s2 h3 mb-4">Podras monitorear los signos vitales de ti y tu familia desde cualquier dispositivo</span>
                 <div class="form-group   bt_register_carrosel text-center">
                   <a class="btn pr-5 pl-5  bgz-info rounded  shadow-sm mt-5 btn btn-s3 btn-sm" Width="308px"    href="session" >
                     <b class="h4 text-calibri">Regístrate </b>
                   </a>
                 </div>  
               </div>
              </div>    
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 m-auto text-center">
              <img class=" mr-4 img-info" src="{{asset('/img/slider/s2.png')}}" alt="Photo">
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item ">
        <div class="card  shadow-none" >
          <div class="card-body row text-dark card-info   border-white" >
            <div class="col-md-6 col-sm-12 order-last m-auto  ">
              <div class="  text-right  ">
                <div class=" text-right div_3_text">
                  <h2 class=" text-info-s1"> Miles de <span class="text-info_">Médicos</span> especialistas a tu alcance en cualquier momento </h2><br>
                  <span class="text-right text-info_"><b>Tendrás a tu disposición médicos de cualquier especialidad.</b></span>
                  <div class="form-group ml-5  mt-5 text-left bt_register_carrosel">
                    <a class="btn   bgz-info rounded  shadow-sm mt-5  btn-sm btn-s3 text-center teca" Width="308px"    href="session" >
                     Regístrate 
                    </a>
                  </div>  
                </div>
              </div>    
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 m-auto text-center ">
              <img class=" mr-4 img-info text-info" src="{{asset('/img/slider/s3.png')}}" alt="Photo">
            </div>
          </div>
        </div> 
      </div>
    </div>
    <a class="carousel-control-prev " href="#sliderInfo" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next  " href="#sliderInfo" role="button" data-slide="next">
      <span class="carousel-control-next-icon " aria-hidden="true"></span>
    </a>
  </div>
@endmovil