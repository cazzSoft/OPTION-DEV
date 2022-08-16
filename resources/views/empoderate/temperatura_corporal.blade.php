<div class="row  @movil  @else ml-2 @endmovil">
	<div class="col-md-12">
		<p class="title-tabs mt-3">Comprueba tu salud</p>
	</div>
	<div class="@movil col-6 @else col-md-3 @endmovil text-center">
		<div class="m-4" id="image-temp">
			<img src="{{asset('img/empoderate/temp0.png')}}" class="img-temp" alt="">
		</div>
	</div>
	<div class=" @movil col-6 @else col-md-3 @endmovil">
		<div class="mb-4 pb-1 text-btn">
			<button type="button" class="temp btn btn-block btn-outline-danger-int">41º C Hipertermia</button>
			<button type="button" class="temp btn btn-block btn-outline-orange">39.6º C Fiebre moderada</button>
			<button type="button" class="temp btn btn-block btn-outline-pink">38º C Fiebre moderada</button>
			<button type="button" class="temp btn btn-block btn-outline-olive">37.9º C Febrícula</button>
			<button type="button" class="temp btn btn-block btn-outline-success">37º C Temperatura normal</button>
			<button type="button" class="temp btn btn-block btn-outline-info">35º C Hipotermia</button>
		</div>
	</div>
	<div class="col-md-5">
		<div class="text-justify content-text @movil @else pl-3 @endmovil " id="descripcion-temp">
			
		</div>
	</div>
</div>
<div class="@movil @else mt-5  @endmovil">
	<p class="text-justify content-text">
	<b>Temperatura corporal normal:</b> La temperatura corporal normal cambia según la persona, la edad, las actividades y el momento del día. La temperatura corporal normal promedio aceptada es generalmente de 98.6°F (37°C). Algunos estudios han mostrado que la temperatura corporal "normal" puede tener un amplio rango que va desde los 97°F (36.1°C) hasta los 99°F (37.2°C).</p>  

	<p class="text-justify content-text">	Una temperatura de más de 100.4°F (38°C) casi siempre indica que usted tiene fiebre a causa de una infección o enfermedad.</p>
	<p>Normalmente, la temperatura corporal cambia a lo largo del día.</p>
	
	<p  class="text-justify content-text"><b>	Nombres alternativos:</b> Temperatura normal del cuerpo; Temperatura - normal</p>
</div>