<div class="row mt-1">
	<div class="col-md-12 mb-4">
		<p class="m-0 "> 
		 <i class="fas fa-angle-down text-info_ mr-2 fa-lg"></i> 
		  <span class="text-info_ text-mes text-capitalize">@if(isset($dato_fecha)) {{$dato_fecha['mes']}} @endif </span> 
		  <span class="text-muted text-year ml-2">@if(isset($dato_fecha)) {{$dato_fecha['año']}} @endif</span> 
		  <span class="text-semana ml-5"> <i class="fas fa-angle-left fa-md"></i> Semana @if(isset($dato_fecha)) {{$dato_fecha['semana']}} @endif <i class="fas fa-angle-right fa-md"></i> </span>
		</p>
	</div>
</div>

<div class="row ">
  	
	<div class="col-md-3 ">
		{{-- mini calendario --}}
		
		<!-- Calendar -->
		<div class="card m-auto shadow-sm p-1" style="width: 15rem;">
		  <div class="card-body ">
		    <!--The calendar -->
		    {{-- <div id="calendar" class="datepicker datepicker-inline " data-toggle="calendar" data-target="#calendar"></div> --}}
		  	<div id="datepicker" class="" data-date="@if(isset($fehca_calendar)) {{$fehca_calendar}} @endif"></div>
			<input type="hidden" id="fecha_calendar" value="@if(isset($fehca_calendar)) {{$fehca_calendar}} @endif">
			             
		  </div>
		</div> 
		
		{{-- semaforos --}}
		<div class="form-group mt-3">
			{{-- <div class="atenuar-horarios overlay"></div> --}}
			<div class="card card-success shadow-none m-auto" style="width: 15rem;">

	          <div class="card-body ">

	            <!-- Minimal style -->
	            <div class="row">
	              
	              <div class="col-sm-12">
	                <!-- radio -->
	                <div class="form-group clearfix">
	                  <div class="icheck-white d-inline ">
	                    <input type="radio" id="dispo" name="dispo" checked>
	                    <label class="text-muted mb-3" for="dispo">Disponible
	                    </label>
	                  </div>
	                  <div class="icheck-info d-inline p-2">
	                    <input type="radio" id="select" name="select" checked>
	                    <label class="text-muted mb-3"  for="select">Selecionada
	                    </label>
	                  </div>
	                  <div class="icheck-primary d-inline p-2 no_d">
	                    <input type="radio" id="nodisponible" name="nodisponible" checked>
	                    <label class="text-muted"  for="nodisponible" >
	                     No disponible
	                    </label>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div> 
	        </div>
		</div>
		
	</div>
	<div class="col-md-9">

		{{-- horario disponibles --}}
		<div class="row">
			<input type="hidden" id="hora_select" value="">
			<input type="hidden" id="idm" value="">
			<input type="hidden" name="idtargeta_cita" value="@if(isset($idtargeta_cita)) {{$idtargeta_cita}} @endif">
			
			<div class="col-12 row seccion_horarios">

				@if(isset($lista))
					{!!$lista!!}
				@endif
			</div>
			
			{{-- mensaje de informacion --}}
			<div class="col-12 row	cal_msm">
				@if(isset($cal_msm))
					<div class="col-md-8 col-sm-12 m-auto text-center ">
						 <img class="img_gris text-center mt-5 p-2" src="{{asset('img/o2h_gris.png')}}" alt="img_o2h">	
					</div>
					<div class="col-md-6 col-sm-12 text-center m-auto p-2 ">
						 <p class="font-msm ">
						 	Lo sentimos, no tenemos horarios disponibles para esa fecha.
							Por favor selecciona otra horario
						 </p>
					</div>	
				@endif
			</div>
			

		</div>
	</div>
</div>
