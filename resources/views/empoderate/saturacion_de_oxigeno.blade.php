<div class="row  @movil p-1 @else p-3 @endmovil">
	<div class="col-12">
		@movil
			<p class="content-text mb-3  p-1 mt-2 so-texto">
				<b>¿Qué es la saturación de oxígeno en sangre?:</b> La saturación de oxígeno es la medida que indica la cantidad que hay en nuestra sangre de este elemento respecto a la que podría llevar. <span class="so_ver text-info_">ver más</span> 
			</p>
		@else
			<p class="content-text mb-3   ">
				<b>¿Qué es la saturación de oxígeno en sangre?:</b> La saturación de oxígeno es la medida que indica la cantidad que hay en nuestra sangre de este elemento respecto a la que podría llevar. Se trata, entonces, de un indicador de cuán bien se está distribuyendo el oxígeno desde los pulmones a las células y, por tanto, al resto de órganos. Este valor puede cambiar a lo largo del día.
			</p>	
		@endmovil
	</div>
	<div class="col-12  col-xs-12 @movil text-center text-muted @else @endmovil">
		<p class="text-titulo-imc  @movil pt-2 @else pt-4 pl-4 @endmovil "><b>Ingresa tus datos:</b></p>
	</div>
</div>

<div class="row justify-content-md-center ">
	@movil
		<div class="col-4  text-center">
			<div class="content-img-ox ml-1 ">
				<img src="{{asset('img/empoderate/satu_oxi.png')}}" class="img-oxi-hand " alt="">
				<p class="tooltiptext_ox1  text-center ">
					<span class="text-justify">Valor 1</span>
				</p>
				<p class="tooltiptext_ox2  text-center ">
					<span class="text-justify">Valor 2</span>
				</p>
					
			</div>
			<p class="text-img-oxi p-0 text-info_ ">Lleva el dedo indice <br> hasta el Oximetro</p>
		</div>
		<div class="col-8  ">
			<div class="row">
				
				<div class="col-12 mt-3 te">
					<form id="form-content-st-ox" >
						{{-- datos para calcular saturacion de oxigeno --}}
						<div class="form-group row text-right">
					        <label for="inputEmail3" class="col-6 col-form-label">Ingresa el valor 1: <br>%SpO2</label>
					        <div class="col-6">
					          <input type="number" max="100" min="0" class="form-control" id="st_spo"  placeholder="98" required>
					        </div>
				      	</div>
						<div class="form-group row text-right">
					        <label for="inputEmail3" class="col-6 col-form-label">Ingresa el valor 2:<br>PRbpm</label>
					        <div class="col-6">
					          <input type="number" max="100" min="0" class="form-control" id="st_pr"  placeholder="59" required>
					        </div>
				      	</div>

				      	<div class="form-group row mt-2">
					        <div class="col-10 content-btn-ox m-auto" >
					        	<button type="submit" class="btn bgz-info btn-block " >Calcular</button>
					        </div>
				      	</div>
				    </form>
				</div>
				
			</div>
		</div>
		<div class="col-12">
			<div class="row">
				<div class="col-12 text-center text-titulo-rango text-titulo-resultado ">
					{{-- SU RESULTADO ES: <b><span class="text-info_ text-oxi">Normal</span></b> --}}
				</div>
				<div class="col-12 mt-1 p-3 text-center resul-oxi d-none">
					<div class=" ">
						<table class="table_  text-center m-auto" >
							<tr class="title-table">
								<td class="br"><b>Rango</b></td>
								<td class=""><b>Valores</b></td>
							</tr>
							<tr >
								<td class="bz-info1 br  bt ">Normal</td>
								<td class="bz-info1 bt"> 95% al 100%</td>
							</tr>
							<tr >
								<td class="bz-info br bt">Hipoxia leve</td>
								<td class="bz-info bt">91% al 94%</td>
							</tr>
							<tr class="bt">
								<td class=" br bt">Hipoxia moderada</td>
								<td class="bt">86% al 90%</td>
							</tr>
							<tr>
								<td class=" br bt">Hipoxia grave</td>
								<td class="bt"> menor a 85%</td>
							</tr>
						</table>
					</div>
				</div>
			</div>	
		</div>
	@else
		<div class="col-1 col-sm-1  text-center">
			<div class="content-img-ox ml-1 ">
				<img src="{{asset('img/empoderate/satu_oxi.png')}}" class="img-oxi-hand " alt="">
				<p class="tooltiptext_ox1  text-center ">
					<span class="text-justify">Valor 1</span>
				</p>
				<p class="tooltiptext_ox2  text-center ">
					<span class="text-justify">Valor 2</span>
				</p>
					
			</div>
			<p class="text-img-oxi p-0 text-info_ ">Lleva el dedo indice <br> hasta el Oximetro</p>
		</div>
		<div class="col-md-10  ">
			<div class="row">
				<div class="col-12 text-center text-titulo-rango text-titulo-resultado ">
					{{-- SU RESULTADO ES: <b><span class="text-info_ text-oxi">Normal</span></b> --}}
				</div>
				<div class="col-6 mt-3 te">
					<form id="form-content-st-ox" >
						{{-- datos para calcular saturacion de oxigeno --}}
						<div class="form-group row text-right">
					        <label for="inputEmail3" class="col-5 col-form-label">Ingresa el valor 1: <br>%SpO2</label>
					        <div class="col-lg-4 col-md-4 col-sm-5">
					          <input type="number" max="100" min="0" class="form-control" id="st_spo"  placeholder="98" required>
					        </div>
				      	</div>
						<div class="form-group row text-right">
					        <label for="inputEmail3" class="col-5 col-form-label">Ingresa el valor 2:<br>PRbpm</label>
					        <div class="col-lg-4 col-md-4 col-sm-5">
					          <input type="number" max="100" min="0" class="form-control" id="st_pr"  placeholder="59" required>
					        </div>
				      	</div>

				      	<div class="form-group row mt-2">
					        <div class="col-6 content-btn-ox text-left  m-auto" >
					        	<button type="submit" class="btn bgz-info btn-block " >Calcular</button>
					        </div>
				      	</div>
				    </form>
				</div>
				<div class="col-6 mt-1 p-3 text-center resul-oxi d-none">
					<div class=" ">
						<table class="table_  text-center m-auto" >
							<tr class="title-table">
								<td class="br"><b>Rango</b></td>
								<td class=""><b>Valores</b></td>
							</tr>
							<tr >
								<td class="bz-info1 br  bt ">Normal</td>
								<td class="bz-info1 bt"> 95% al 100%</td>
							</tr>
							<tr >
								<td class="bz-info br bt">Hipoxia leve</td>
								<td class="bz-info bt">91% al 94%</td>
							</tr>
							<tr class="bt">
								<td class=" br bt">Hipoxia moderada</td>
								<td class="bt">86% al 90%</td>
							</tr>
							<tr>
								<td class=" br bt">Hipoxia grave</td>
								<td class="bt"> menor a 85%</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	@endmovil	
</div>

