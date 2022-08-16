<div class="row  @movil p-1 @else p-3 @endmovil">
	<div class="col-12">
		<p class="content-text mb-3  @movil p-0 mt-2 fr-texto @else p-4 @endmovil">
			@movil
				<b>¿Qué es la frecuencia cardiaca?: </b> La frecuencia cardiaca es el número de veces que se contrae el 
				corazón durante un minuto (latidos por minuto). <span class="ver_fr text-info_"> ver más</span>
				<span class="mosrtra_fr"></span>

			@else
				<b>¿Qué es la frecuencia cardiaca?: </b> La frecuencia cardiaca es el número de veces que se contrae el corazón durante un minuto (latidos por minuto).  Para el correcto funcionamiento del organismo es necesario que el corazón actúe bombeando la sangre hacia todos los órganos, pero además lo debe hacer a una determinada presión (presión arterial) y a una determinada frecuencia. Dada la importancia de este proceso, es normal que el corazón necesite en cada latido un alto consumo de energía.
			@endmovil
		</p>
	</div>
	@movil
		<div class="row">
			<div class="col-12 text-center text-titulo-resultado text_res_fc ">
			</div>
			<div class="col-12 order-1 mt-1 p-3 text-center resul-fc d-none ">
			</div>
		</div>
	@endmovil

	<div class="col-md-3 col-sm-12 text-center col-xs-12">
		<p class="text-titulo-imc"><b>Selecciona una opción</b></p>
		<div class="row  @movil @else mt-5 @endmovil">
		  	<div class="col-6 col-sm-6  text-center fc-img-inf"> 
		  		<img src="{{asset('img/empoderate/masa_infante.png')}}" class="img-infante" alt="">
		  	</div>
		  	<div class="col-6 col-sm-6 fc-img-adl">
		  		<img src="{{asset('img/empoderate/masa_adulto.png')}}" class="img-adulto"  alt="">
		  	</div>
		  	<div class="col-6 col-sm-6 text-center">
		  		<p class="text-img-imc mt-2 fc-inft">Infantes</p>
		  		<input type="radio" class="d-none " id="fc-inf" value="infante" name="tipo_fc">
		  	</div>
		  	<div class="col-6 col-sm-6 text-center">
		  		<p class="text-img-imc text-img-imc-select fc-adl mt-2">Adultos</p>
		  		<input type="radio" class="d-none " checked id="fc-adl" value="adulto" name="tipo_fc">
		  	</div>
		</div>
	</div>
	@movil
		<div class="col-12 text-center  m-auto ">
			<div class="row">
				<div class="col-12  text-center ">
					<form id="form-content-fc" class=" text-center mt-3" >
						<input  type="hidden" id="fc-app"  value="1" >
						<div class="form-group row text-center input-sexo-fc">
							<label for="inputEmail3" class="col-6 c text-right col-form-label">Sexo</label>
					        <div class="form-check ">
					          <input class="form-check-input  " type="radio" id="fc-mujer" name="fc-sexo" value="mujer" required>
					          <label class="form-check-label mt-0">Mujer</label>
					        </div>
					        
					        <div class="form-check ml-3 ">
					          <input class="form-check-input" type="radio" id="fc-hombre" name="fc-sexo" value="hombre" required>
					          <label class="form-check-label">Hombre</label>
					        </div>
					    </div>
						<div class="form-group row text-center">
					        <label for="inputEmail3" class="col-6 col-form-label  text-right">Ingresa la edad:</label>
					        <div class="col-6">
					          <input type="number" min="18"  class="form-control" id="fc-edad"  placeholder="18 - 70 años" required>
					        </div>
				      	</div>

						<div class="form-group row">
					        <label for="inputEmail3" class="col-6 col-form-label  text-right">Frecuencia cardíaca:</label>
					        <div class="col-6">
					          <input type="number" min="42" max="250" class="form-control" id="fc-lmp"  placeholder="62 lmp" required>
					        </div>
				      	</div>

				      	<div class="form-group row mt-2 row justify-content-md-center">
					        <div class="col-10  btn-fc m-auto" >
					        	<button type="submit" class="btn bgz-info btn-block " >Calcular</button>
					        	{{-- <button type="reset" class="btn bgz-info btn-block " >Ingresar otro valor</button> --}}
					        </div>
				      	</div>
					</form>
				</div>
			</div>
		</div>
	@else
		<div class="col-md-9 col-xs-12 text-center  m-auto ">
			<div class="row">
				<div class="col-12 text-center text-titulo-resultado text_res_fc ">
					{{-- SU RESULTADO ES: <b><span class="text-info_ text-fc">Normal</span></b>  --}}
				</div>
				<div class="col-6 mt-3 text-center ">
					<div class="form-group text-center">
						<img src="{{asset('img/empoderate/frecuencia_card.png')}}" class="img-cardiaca" alt="">
					</div>
					<form id="form-content-fc" class=" text-center mt-3" >
						<input  type="hidden" id="fc-app"  value="0" >
						<div class="form-group row text-center input-sexo-fc">
							<label for="inputEmail3" class="col-5 col-form-label  text-right">Sexo</label>
					        <div class="form-check mt-1 ml-2">
					          <input class="form-check-input  " type="radio" id="fc-mujer" name="fc-sexo" value="mujer" required>
					          <label class="form-check-label mt-0">Mujer</label>
					        </div>
					        
					        <div class="form-check ml-3 mt-1">
					          <input class="form-check-input" type="radio" id="fc-hombre" name="fc-sexo" value="hombre" required>
					          <label class="form-check-label">Hombre</label>
					        </div>
					    </div>
						<div class="form-group row text-center">
					        <label for="inputEmail3" class="col-5 col-form-label  text-right">Ingresa la edad:</label>
					        <div class="col-lg-4 col-md-4 col-sm-5">
					          <input type="number" min="18"  class="form-control" id="fc-edad"  placeholder="18 - 70 años" required>
					        </div>
				      	</div>

						<div class="form-group row">
					        <label for="inputEmail3" class="col-5 col-form-label  text-right">Frecuencia cardíaca:</label>
					        <div class="col-lg-4 col-md-4 col-sm-5">
					          <input type="number" min="42" max="250" class="form-control" id="fc-lmp"  placeholder="62 lmp" required>
					        </div>
				      	</div>
				      	<div class="form-group row mt-2 row justify-content-md-center">
					        <div class="col-lg-6 col-md-10 col-sm-12  col-xs-12  btn-fc" >
					        	<button type="submit" class="btn bgz-info btn-block " >Calcular</button>
					        	{{-- <button type="reset" class="btn bgz-info btn-block " >Ingresar otro valor</button> --}}
					        </div>
				      	</div>
					</form>
				</div>
				<div class="col-6 order-1 mt-1 p-3 text-center resul-fc d-none ">
					<div class=" ">
						<table class="table_ table-sm text-center m-auto"style="width: 310px;">
							<tr class="title-table">
								<td class="br" ><b>Condición</b></td>
								<td class="br" ><b>Mínimo</b></td>
								<td class="" ><b>Máximo</b></td>
							</tr>
							<tr >
								<td class="bz-info1 br  bt ">Baja</td>
								<td class="bz-info1 bt br"> .....</td>
								<td class="bz-info1 bt "> 64</td>
							</tr>
							<tr >
								<td class="bz-info br bt">Buena</td>
								<td class="bz-info bt br">65</td>
								<td class="bz-info bt ">68</td>
							</tr>
							<tr class="bt">
								<td class=" br bt">Normal</td>
								<td class="bt br">69</td>
								<td class="bt ">76</td>
							</tr>
							<tr>
								<td class=" br bt">Alta</td>
								<td class="bt br"> 77</td>
								<td class="bt "> 82</td>
							</tr>
							<tr>
								<td class=" br bt">Muy alta</td>
								<td class="bt br"> 83</td>
								<td class="bt "> ...</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	@endmovil
	
</div>

