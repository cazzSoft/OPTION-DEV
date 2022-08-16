<div class="row  @movil pt-3 @else p-3 @endmovil ">
	<div class="col-12">
		@movil
			<p class="content-text mb-3 imc-texto">
				<b>Indice de masa corporal:</b> El índice de masa corporal (IMC) es un número que se calcula con base en el peso y la estatura de la persona. Para la mayoría de las personas. <span class="imc_ver text-info_">ver más</span>
			</p>
		@else
			<p class="content-text mb-3  @movil @else p-4 @endmovil">
				<b>Indice de masa corporal:</b> El índice de masa corporal (IMC) es un número que se calcula con base en el peso y la estatura de la persona. Para la mayoría de las personas, el IMC es un indicador confiable de la gordura y se usa para identificar las categorías de peso que pueden llevar a problemas de salud.
			</p>
		@endmovil
		
	</div>
	<div class="col-md-3 col-sm-12 text-center col-xs-12">
		<p class="text-titulo-imc"><b>Selecciona una opción</b></p>
		<div class="row">
		  	<div class="col-6 col-sm-6  text-center"> 
		  		<img src="{{asset('img/empoderate/masa_infante.png')}}" class="img-infante" alt="">
		  	</div>
		  	<div class="col-6 col-sm-6 ">
		  		<img src="{{asset('img/empoderate/masa_adulto.png')}}" class="img-adulto"  alt="">
		  	</div>
		  	<div class="col-6 col-sm-6 text-center">
		  		<p class="text-img-imc mt-2 inft">Infantes</p>
		  		<input type="radio" class="d-none " id="inf" value="infante" name="tipo_imc">
		  	</div>
		  	<div class="col-6 col-sm-6 text-center">
		  		<p class="text-img-imc text-img-imc-select adl mt-2">Adultos</p>
		  		<input type="radio" class="d-none " checked id="adl" value="adulto" name="tipo_imc">
		  	</div>
		</div>
	</div>
	<div class="col-md-9 m-auto text-center insert-valores " >
		<form id="form-content-imc" >
			
			@movil
				{{-- datos imc para infantes --}}
				<div class="form-group row infantes d-none">
			        <label for="edad_imc" class="col-6 col-form-label  text-right">Ingresa la edad en años:</label>
			        <div class="col-6 ">
			          <input type="number" max="19" min="2" class="form-control " id="edad_imc"  placeholder="2 - 18" required>
			        </div>
		      	</div>
		      	<div class="form-group row infantes d-none">
			        <label for="meses_imc" class="col-6 col-form-label  text-right">Ingresa los meses:</label>
			        <div class="col-6 ">
			          <input type="number" max="11" min="0" class="form-control " id="meses_imc"  placeholder="0 - 11" required>
			        </div>
		      	</div>

		      	<div class="form-group row infantes d-none">
			        <label for="mtr" class="col-6 col-form-label  text-right"> </label>
			        <div class="col-6 text-center">
			        	<input type="radio" value="niño" class="text-right" name="infante_imc" id="niño_imc" required>
			        	<label for="niño_imc" class="col-3 col-form-label p-0 text-truncate"> Niño</label>
			          	<input type="radio" value="niña" class=" text-right"  name="infante_imc" id="niña_imc" required>
			          	<label for="niña_imc" class="col-3 col-form-label text-truncate  p-0"> Niña</label> 
			        </div>
		      	</div>

				{{-- datos imc para adultos --}}
				<div class="form-group row ">
			        <label for="mtr" class="col-6 col-form-label  text-right txt-alt">Ingresa tu altura en metros:</label>
			        <div class="col-6 col-sm-5 col">
			          <input type="number" type="number" step="0.01" class="form-control altura_imc" id="altura_imc"  placeholder="1.70" required>
			        </div>
		      	</div>

				<div class="form-group row">
			        <label for="kg" class="col-6 col-form-label text-right txt-peso">Ingresa tu peso en kilogramos:</label>
			        <div class="col-6 col-sm-5 ">
			          <input type="number" step="0.01" class="form-control kg_imc" id="kg_imc"  placeholder="70" required>
			        </div>
		      	</div>
		      	<div class=" row mt-4">
			        <div class="col-10 text-center m-auto">
			        	<button type="submit" class="btn bgz-info btn-block">Calcular</button>
			        </div>
		      	</div>
			@else
				{{-- datos imc para infantes --}}
				<div class="form-group row infantes d-none">
			        <label for="edad_imc" class="col-4 col-form-label  text-right">Ingresa la edad en años:</label>
			        <div class="col-lg-2 col-md-4 col-sm-5 ">
			          <input type="number" max="19" min="2" class="form-control " id="edad_imc"  placeholder="2 - 18" required>
			        </div>
		      	</div>
		      	<div class="form-group row infantes d-none">
			        <label for="meses_imc" class="col-4 col-form-label  text-right">Ingresa los meses:</label>
			        <div class="col-lg-2 col-md-4 col-sm-5 ">
			          <input type="number" max="11" min="0" class="form-control " id="meses_imc"  placeholder="0 - 11" required>
			        </div>
		      	</div>

		      	<div class="form-group row infantes d-none">
			        <label for="mtr" class="col-4 col-form-label  text-right"> </label>
			        <div class="col-lg-2 col-md-4 col-sm-5 text-center">
			        	<input type="radio" value="niño" class="text-right" name="infante_imc" id="niño_imc" required>
			        	<label for="niño_imc" class="col-3 col-form-label p-0 text-truncate"> Niño</label>
			          	<input type="radio" value="niña" class=" text-right"  name="infante_imc" id="niña_imc" required>
			          	<label for="niña_imc" class="col-3 col-form-label text-truncate  p-0"> Niña</label> 
			        </div>
		      	</div>
		      	

		      	{{-- datos imc para adultos --}}
				<div class="form-group row ">
			        <label for="mtr" class="col-4 col-form-label  text-right txt-alt">Ingresa tu altura en metros:</label>
			        <div class="col-lg-2 col-md-4 col-sm-5 col">
			          <input type="number" type="number" step="0.01" class="form-control altura_imc" id="altura_imc"  placeholder="1.70" required>
			        </div>
		      	</div>

				<div class="form-group row">
			        <label for="kg" class="col-4 col-form-label text-right txt-peso">Ingresa tu peso en kilogramos:</label>
			        <div class="col-lg-2 col-md-4 col-sm-5 ">
			          <input type="number" step="0.01" class="form-control kg_imc" id="kg_imc"  placeholder="70" required>
			        </div>
		      	</div>
		      	<div class=" row  justify-content-end col-6  p-0">
			        <div class="col-6  p-0 m-0">
			        	<button type="submit" class="btn bgz-info btn-block  btn-sm">Calcular</button>
			        </div>
		      	</div>
		    @endmovil  	
      	</form>
	</div>
	<div class="col-md-8 tabla-resul d-none">
		<div class="row">
			<div class="col-12 text-center  text-titulo-resultado"><b>SU RESULTADO ES: <span class="text-info_ text-imc"></span></b> </div>
			<div class="@movil col-12 @else col-6  @endmovil">
				<div class="text-info-valores mt-4  text-justify @movil p-2 @else p-3 @endmovil">
					<p>Para la información que ingresó:</p>
					<p>Estatura: 1.7 metros</p>
					<p>Peso: 70 kilogramos</p>			

					<p>
						Su IMC es 24 , lo que indica que su peso está en la categoría Normal para adultos de su misma estatura.
						Para su estatura, un peso normal variaría entre 53.5  a  72 kilogramos.
					</p>

					<p>Mantener un peso saludable puede reducir el riesgo de enfermedades crónicas asociadas al sobrepeso y la obesidad.</p>
				</div>
			</div>
			<div class=" @movil col-12 justify-content-center @else col-6 mt-3 p-3 @endmovil">
				<div class="resul-imc text-center">
					<table class="table_  text-center" >
						<tr class="title-table">
							<td class="br"><b>IMC</b></td>
							<td class=""><b>Nivel de Peso</b></td>
						</tr>
						<tr >
							<td class="bz-info1 br  bt ">Por debajo de 18.5</td>
							<td class="bz-info1 bt"> Bajo peso</td>
						</tr>
						<tr >
							<td class="bz-info br bt">18.5—24.9</td>
							<td class="bz-info bt">Normal</td>
						</tr>
						<tr class="bt">
							<td class=" br bt">25.0—29.9</td>
							<td class="bt">Sobrepeso</td>
						</tr>
						<tr>
							<td class=" br bt">30.0 o más</td>
							<td class="bt"> Obeso</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="  @movil col-12  @else col-6 m-auto @endmovil">
		      	<div class=" row   @movil mt-4 @else justify-content-end col-6  p-0 @endmovil">
			        <div class=" @movil col-10 m-auto @else col-12  p-0 m-0 @endmovil">
			        	<button type="button" class="btn bgz-info btn-block   rounded btn-otro-imc">Realizar otro calcúlo</button>
			        </div>
		      	</div>
			</div>

		</div>
			
	</div>
</div>

