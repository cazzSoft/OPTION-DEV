<div class="row  @movil p-1 @else pl-3 pr-3 @endmovil">
	<div class="col-12">
		@movil
			<p class="content-text   @movil p-0 mt-2 pa-texto @else mb-3 p-4 @endmovil">
				<b>¿Qué es la presión arterial?:</b> La presión arterial es la fuerza que la sangre ejerce sobre la pared de las arterias. La presión arterial incluye dos medi. <span class="pa_ver text-info_">ver más</span>
			</p>
		@else
			<p class="content-text   @movil p-0 mt-2 @else mb-3 p-4 @endmovil">
				<b>¿Qué es la presión arterial?:</b> La presión arterial es la fuerza que la sangre ejerce sobre la pared de las arterias. La presión arterial incluye dos mediciones: la presión sistólica, que se mide durante el latido del corazón (momento de presión máxima), y la presión diastólica, que se mide durante el descanso entre dos latidos (momento de presión mínima). Primero se registra la presión sistólica y luego la presión diastólica, por ejemplo: 120/80. También se llama presión sanguínea arterial y tensión arterial.
			</p>
		@endmovil
	</div>
</div>

<div class="row ">
	@movil
		<div class="col-12 text-center text-titulo-resultado text_res_pa p-2 ">
		</div>
		<div class="col-12 text-center mt-4  text-center m-auto resul-pa d-none">	
			<div class=" d-flex justify-content-center  mt-3 d-none">	
			</div>
		</div>
		<div class="col-12">	
			<div class="p-1 content-text d-none content-text-pa mt-2">
				<b>Valores ingresados: <span class="text-info_ valores-pa"> 89/60 mmHg</span></b><br>
				<p class="pa-resultado-analisis">
					Su presión sistólica (número máximo) es bastante baja mientras que su presión diastólica (número mínimo) es un poco más baja que el rango normal, aunque dentro de unos límites aceptables.	
	           </p>
	           	<p>	
	           		Repita la medición un par de veces para obtener valores consistentemente similares. Compruebe que el instrumento/aparato 
	           		está correctamente calibrado. 
					No debe tomar las lecturas tras comer, hacer ejercicio o hacer cualquier actividad física. Cuando se tome la tensión, el manguito debe estar correctamente colocado y fijado en el brazo.
				</p>
				
			</div>
		</div>

		<div class="col-12 text-center">
			<p class=" text-titulo-resultado text-muted mt-3"><b>Ingresa tus datos:</b></p>
		</div>
		<div class="col-12 text-center  mt-1 ">	
			<form id="form-content-pa">
				<div class="form-group row text-right">
					 <label for="inputEmail3" class="col-6  text-right text-muted">Sexo :</label>
			        <div class="form-check col-2 text-left">
			          <input class="form-check-input" type="radio" id="pa-mujer" name="pa_sexo" value="mujer" required>
			          <label class="form-check-label ">Mujer</label>
			        </div>
			        
			        <div class="form-check ml-1 col-2">
			          <input class="form-check-input" type="radio" id="pa-hombre" name="pa_sexo" value="hombre" required>
			          <label class="form-check-label ">Hombre</label>
			        </div>
			    </div>
				<div class="form-group row text-center">
			        <label for="inputEmail3" class="col-6 col-form-label text-right">Ingresa la edad :</label>
			        <div class="col-6">
			          <input type="number" class="form-control" id="pa-edad" min="15" max="90" placeholder="15 - 90 años" required>
			        </div>
		      	</div>
				<div class="form-group row">
			        <label for="inputEmail3" class="col-6 col-form-label text-right">Valores :</label>
			        <div class="col-3">
			          <input type="number" class="form-control" id="pa-sintotica" max="250" min="80"  placeholder="90 - 134" required>
			        </div>
			        <div class="col-3">
			           <input type="number" class="form-control" id="pa-diastolica" min="50" placeholder="60 - 85 " required>
			        </div>
		      	</div>
		      	<div class="form-group row justify-content-end mt-3 pl-2  ">
			     	<div class="col-10 m-auto btn-pa" >
			     		<button type="submit" class="btn bgz-info btn-block " >Calcular</button>
			     	</div>
		      	</div>
			</form>
		</div>
			
	@else
		<div class="col-lg-3 col-sm-12   text-center ">
			<div class="row">
				<div class="col-12  col-xs-12 text-left mb-4 ">
					<p class=" text-titulo-resultado ml-3 pl-4"><b>Ingresa tus datos:</b></p>
				</div>	
				<div class="col-12  col-xs-12 text-left">
					<img src="{{asset('img/empoderate/precion_arterial.png')}}" class="img-precion-art ml-4" alt="">
				</div>
			</div>
		</div>

		<div class="col-lg-9 col-sm-12 ">
			<div class="row">
				<div class="col-12 text-center text-titulo-resultado text_res_pa p-2 ">
					{{-- SU RESULTADO ES: <b><span class="text-info_ text-fc">Normal</span></b>  --}}
				</div>
				<div class="col-md-4 col-sm-12 text-center  mt-4 ">	
					<form id="form-content-pa">
						<div class="form-group row text-right">
							 <label for="inputEmail3" class="col-4 col-form-label text-right">Sexo :</label>
					        <div class="form-check mt-1 col-2 text-left">
					          <input class="form-check-input" type="radio" id="pa-mujer" name="pa_sexo" value="mujer" required>
					          <label class="form-check-label ">Mujer</label>
					        </div>
					        
					        <div class="form-check ml-3 mt-1 col-2">
					          <input class="form-check-input" type="radio" id="pa-hombre" name="pa_sexo" value="hombre" required>
					          <label class="form-check-label ">Hombre</label>
					        </div>
					    </div>
						<div class="form-group row text-center">
					        <label for="inputEmail3" class="col-4 col-form-label text-right">Ingresa la edad :</label>
					        <div class="col-lg-8 col-md-8 col-sm-8">
					          <input type="number" class="form-control" id="pa-edad" min="15" max="90" placeholder="15 - 90 años" required>
					        </div>
				      	</div>
						<div class="form-group row">
					        <label for="inputEmail3" class="col-4 col-form-label text-right">Valores :</label>
					        <div class="col-lg-4 col-md-4 col-sm-4">
					          <input type="number" class="form-control" id="pa-sintotica" max="250" min="80"  placeholder="90 - 134" required>
					        </div>
					        <div class="col-lg-4 col-md-4 col-sm-4">
					           <input type="number" class="form-control" id="pa-diastolica" min="50" placeholder="60 - 85 " required>
					        </div>
				      	</div>
				      	<div class="form-group row justify-content-end mt-3 pl-2  ">
					     	<div class="col-lg-10 col-md-11 col-sm-11 align-self-end btn-pa" >
					     		<button type="submit" class="btn bgz-info btn-block " >Calcular</button>
					     	</div>
				      	</div>
					</form>
				</div>
				<div class="col-md-8 col-sm-12 text-center mt-4  text-center m-auto resul-pa d-none">	
					<div class=" d-flex justify-content-center  mt-3 d-none">
						<table class="table_ table-sm text-center mr-2" style="width: 243px;" >
							<tr>
								<td width="100px" class="br"><b>Sistólica</b></td>
								<td width="100px"><b>Valores</b></td>
							</tr>
							<tr>
								<td class="bz-info1 br bt">Baja</td>
								<td class="bz-info1 bt"> por debajo de 90</td>
							</tr>
							<tr>
								<td class="bz-info bt br">Normal</td>
								<td class="bz-info bt"> 90 - 134</td>
							</tr>
							<tr>
								<td class="bz-info1 br bt">Hipertensión Leve	</td>
								<td class="bz-info1 bt"> 134 - 159</td>
							</tr>
							<tr>
								<td class="bz-info1 br bt">Hipertensión Moderada</td>
								<td class="bz-info1 bt"> 160 - 180</td>
							</tr>
							<tr>
								<td class="bz-info1 br bt">Hipertensión Severa</td>
								<td class="bz-info1 bt"> arriba 180</td>
							</tr>
						</table>
						<table class="table_ table-sm text-center  " style="width: 243px;" >
							<tr>
								<td width="100px" class="br"><b>Diastólica</b></td>
								<td width="100px" ><b>Valores</b></td>
							</tr>
							<tr>
								<td class="bz-info1 br bt">Baja</td>
								<td class="bz-info1 bt"> por debajo de 60</td>
							</tr>
							<tr>
								<td class="bz-info  br bt">Normal</td>
								<td class="bz-info bt"> 60 - 85</td>
							</tr>
							<tr>
								<td class="bz-info1 br bt">Hipertensión Leve	</td>
								<td class="bz-info1 bt"> 85 - 99</td>
							</tr>
							<tr>
								<td class="bz-info1 br bt">Hipertensión Moderada</td>
								<td class="bz-info1 bt"> 100 - 120</td>
							</tr>
							<tr>
								<td class="bz-info1 br bt">Hipertensión Severa</td>
								<td class="bz-info1 bt"> arriba 120</td>
							</tr>
						</table>
					</div>
				</div>		
			</div>
		</div>
	
		<div class="col-12">
			
			<div class="p-4 content-text d-none content-text-pa">
				<p><b>Valores ingresados: <span class="text-info_ valores-pa"> 89/60 mmHg</span></b></p>
				<p class="pa-resultado-analisis">
					Su presión sistólica (número máximo) es bastante baja mientras que su presión diastólica (número mínimo) es un poco más baja que el rango normal, aunque dentro de unos límites aceptables.	
	           </p>
	           	<p>	
	           		Repita la medición un par de veces para obtener valores consistentemente similares. Compruebe que el instrumento/aparato 
	           		está correctamente calibrado. 
					No debe tomar las lecturas tras comer, hacer ejercicio o hacer cualquier actividad física. Cuando se tome la tensión, el manguito debe estar correctamente colocado y fijado en el brazo.
				</p>
				
			</div>
		</div>
	@endmovil
</div>

