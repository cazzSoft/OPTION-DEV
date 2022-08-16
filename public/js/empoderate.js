
//variable globales para obtener direccion raiz del server
var url=window.location.protocol+'//'+window.location.host;

// evento para mostrar detalle de las temperatura
$('.temp').click(function (e) {
	var text=$(this).html();
	$('#descripcion-temp').html(" ");
	
	// restauramos stilos de los btn
	$('.bgz-info-select').removeClass('bgz-info-select');
	$('.btn-outline-success-select').removeClass('btn-outline-success-select');
	$('.btn-outline-olive-select').removeClass('btn-outline-olive-select');
	$('.btn-outline-pink-select').removeClass('btn-outline-pink-select');
	$('.btn-outline-orange-select').removeClass('btn-outline-orange-select');
	$('.btn-outline-danger-int-select').removeClass('btn-outline-danger-int-select');


	if(text.substr(0,5)=='35º C'){ 
		
		// 35º C Hipotermia
		var contenido=`	<b>¿Que hacer en caso de Hipotermia?</b><br>
						<p>En estos casos lo primero es proteger a la víctima del frío, trasladarla a un lugar cálido, quitarle la ropa húmeda, abrigarla y proporcionarle bebidas calientes para recuperar los líquidos perdidos. Es importante procurar no mover las áreas descongeladas para evitar lesiones mayores</p>
						`;

		$('#image-temp').html(`<img src="${url}/img/empoderate/temp1.png" class="img-temp " alt="o2h">`);
		$('#descripcion-temp').html(contenido);
		
		$(this).addClass('bgz-info-select');	
		
	
	}else if(text.substr(0,5)=='37º C'){ 
		// 37º C Temperatura normal
		var contenido=`	<p><b>¿Que hacer en caso de Temperatura normal? </b></p>
						<p>La temperatura corporal normal cambia según la persona, la edad, las actividades y el momento del día. La temperatura corporal normal promedio aceptada es generalmente de 37 °C  (98.6 °F). Consejo: Recuerda tomar abundante agua con frecuencia durante el transcurso del día, usar protector solar  y evitar salir desprotegido cuando el sol está muy fuerte.</p>
						`;
		$('#descripcion-temp').html(contenido);				
		$('#image-temp').html(`<img src="${url}/img/empoderate/temp2.png" class="img-temp " alt="o2h">`);
		
		$(this).addClass('btn-outline-success-select');	

	}else if(text.substr(0,7)=='37.9º C'){

		// 37.9º C Febrícula
		var contenido=`	<p><b>¿Que hacer en caso de Febrícula?  </b></p>
						<p>Asegúrese de beber mucha agua y evite abrigarse demasiado. En los niños, para evitar una subida excesiva de la temperatura, puede ser aconsejable desnudarlos, sobre todo si son menores de 6 años. Si no logra controlar la temperatura, puede bañarlos en agua templada (nunca los deje solos en el baño).
						</p>
						`;
		$('#descripcion-temp').html(contenido);
		$('#image-temp').html(`<img src="${url}/img/empoderate/temp3.png" class="img-temp " alt="o2h">`);
		
		$(this).addClass('btn-outline-olive-select');
		

	}else if(text.substr(0,5)=='38º C'){
		// 38º C Fiebre moderada
		var contenido=`	<p><b>¿Que hacer en caso de Fiebre moderada? </b></p>
						<p>
							Es recomendable darle a la persona afectada algún medicamento contra la fiebre (llamado también antipirético) o un analgésico que también esté indicado para bajar la temperatura.
						</p>
						`;
		$('#descripcion-temp').html(contenido);
		$('#image-temp').html(`<img src="${url}/img/empoderate/temp4.png" class="img-temp " alt="o2h">`);
		
		$(this).addClass('btn-outline-pink-select');
		
	}else if(text.substr(0,7)=='39.6º C'){
		// 39.6º C Fiebre grave
		var contenido=`	<p><b>¿Que hacer en caso de Fiebre moderada?</b></p>
						<p>
							El aumento en la temperatura del cuerpo o fiebre puede ser debido a alguna enfermedad, lo más común es que se deba a una infección, pero pueden ser muchas las causas que la ocasionen.
						</p>
						<p>
							Es recomendable darle a la persona afectada algún medicamento contra la fiebre (llamado también antipirético) o un analgésico que también esté indicado para bajar la temperatura. Si la fiebre se acompaña de tos se puede elegir un antitusivo que alivie ambas molestias.

						</p>
						`;
		$('#descripcion-temp').html(contenido);
		$('#image-temp').html(`<img src="${url}/img/empoderate/temp5.png" class="img-temp " alt="o2h">`);
		
		$(this).addClass('btn-outline-orange-select');
	}else if(text.substr(0,5)=='41º C'){
		// 41º C Hipertermia
		var contenido=`	<p><b>¿Que hacer en caso de Hipertermia?</b></p>
						<p>
							1) llamar a la línea de emergencia de tu pais 
						</p>
						<p>
							2) trasladar a la victima a un sitio fresco y retirar el exceso de ropa
						</p>
						<p>
							3) iniciar un enfriamiento intensivo: rociar con abundante cantidad de agua tibia (ayuda en la evaporación y no produce vasoconstricción cutánea, la cual limita la eliminación del calor), luego enérgicamente abanicar para aumentar el movimiento del aire o (si está disponible) encender un ventilador
						</p>
						<p>
							4) en caso de necesidad mantener la permeabilidad de las vías respiratorias y (si es posible) introducir una cánula intravenosa.
						</p>
						`;
		$('#descripcion-temp').html(contenido);
		$('#image-temp').html(`<img src="${url}/img/empoderate/temp6.png" class="img-temp " alt="o2h">`);
		
		$(this).addClass('btn-outline-danger-int-select');

	}
	
});

// evento de IMC y gestión
	$('.img-adulto').click(function (argument) {
		$('.text-img-imc-select').removeClass('text-img-imc-select');
		$('.adl').addClass('text-img-imc-select');
		document.querySelector('#adl').checked = true;
		$('.infantes').addClass('d-none');
		$('.txt-alt').html('Ingresa tu altura en metros:');
		$('#altura_imc').attr('placeholder','1.70');
		
		activar_input('adulto');
		limpiar_input();
	});

	$('.img-infante').click(function (argument) {
		$('.text-img-imc-select').removeClass('text-img-imc-select');
		$('.inft').addClass('text-img-imc-select');
		document.querySelector('#inf').checked = true;
		$('.infantes').removeClass('d-none');
		$('.txt-alt').html('Ingresa la estatura en centimetros:');
		$('#altura_imc').attr('placeholder','78');
		

		activar_input('infante');
		limpiar_input();
	});

	$('.btn-otro-imc').click(function (argument) {
		$('.insert-valores').removeClass('d-none');
		$('.tabla-resul').addClass('d-none');
		limpiar_input();
	});
	// validacion de form typo infantes or adultos
	$(function(){
		let activo= $('input[name="tipo_imc"]:checked').val();
		activar_input(activo);
	});

	// calculo del IMC
	$("#form-content-imc").on("submit", function (e) { 
	    e.preventDefault();
	    var altura=$('#altura_imc').val();
	    var peso=$('#kg_imc').val();
	    var imc= peso / (altura * altura);
	   	imc=imc.toFixed(1);
	    
	    $('.text-imc').html(imc);
	    $('.insert-valores').addClass('d-none');
	    $('.tabla-resul').removeClass('d-none');

	    let opt= $('input[name="tipo_imc"]:checked').val();
	    if(opt=='adulto'){
	    	$('.text-info-valores').html('');
	    	
	    	if(imc<=18.5){
	    		var b_peso='bz-info';
	    		var nivel='Bajo peso';
	    	}else if(imc>=18.5 && imc<=24.9){
	    		var normal='bz-info';
	    		var nivel='Normal';
	    	}else if(imc>=25 && imc<=29.9){
	    		var sobre_p='bz-info';
	    		var nivel='Sobrepeso';
	    	}else if(imc>=30 ){
	    		var obeso='bz-info';
	    		var mivel='Obeso';
	    	}

	    	$('.text-info-valores').html(`
	    		<p>Para la información que ingresó:</p>
	    		<p>Estatura: ${altura} metros</p>
	    		<p>Peso: ${peso} kilogramos</p>			

	    		<p>
	    			Su IMC es ${imc} , lo que indica que su peso está en la categoría ${nivel} para adultos de su misma estatura.
	    		</p>

	    		<p>Mantener un peso saludable puede reducir el riesgo de enfermedades crónicas asociadas al sobrepeso y la obesidad.</p>
	    	`);

	    	$('.resul-imc').html(`
	    		<table class="table_  text-center" >
	    			<tr class="title-table">
	    				<td class="br"><b>IMC</b></td>
	    				<td class=""><b>Nivel de Peso</b></td>
	    			</tr>
	    			<tr >
	    				<td class="${b_peso}  br  bt ">Por debajo de 18.5</td>
	    				<td class="${b_peso} bt"> Bajo peso</td>
	    			</tr>
	    			<tr >
	    				<td class="${normal}  br bt">18.5 - 24.9</td>
	    				<td class="${normal} bt">Normal</td>
	    			</tr>
	    			<tr class="bt">
	    				<td class="${sobre_p} br bt">25.0 - 29.9</td>
	    				<td class="${sobre_p} bt">Sobrepeso</td>
	    			</tr>
	    			<tr>
	    				<td class="${obeso} br bt">30.0 o más</td>
	    				<td class="${obeso} bt"> Obeso</td>
	    			</tr>
	    		</table>
	    	`);
	    }else if(opt=='infante'){
	    	
	    	var edad=$('#edad_imc').val();
	    	var meses=$('#meses_imc').val();
	    	var sexo= $('input[name="infante_imc"]:checked').val();
	    	var imc=0;
	    	// peso kg en libras
	    	var libras=peso * 2.2;
	    	
	    	// centimetros a pulgadas
	    	var pulgadas=altura * 0.39370;

	    	console.log('libras='+libras.toFixed(1)+"pulgadas="+pulgadas.toFixed(1));
	    	// imc infantes
	    	imc= (libras.toFixed(1)* 703)  / (pulgadas.toFixed(1) * pulgadas.toFixed(1));
	   		imc=imc.toFixed(1);
	   		 console.log('imc'+imc); ;
	   		$('.text-imc').html(imc);
	    	$('.text-info-valores').html("");
	    	 
	    	// calculo imc infantes
	    	if(sexo=='niño'){

	    		if(edad==2){
	    			var v_bp='14.8';
	    			var v_n='14.9 - 18.1';
	    			var v_sp='18.2 - 19.2';
	    			var v_ob='19.3';
	    			
	    			if(imc<=14.8){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14.9 && imc<=18.1){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=18.2 && imc<=19.2){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=19.3 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==3){
	    			var v_bp='14.6';
	    			var v_n='14.6 - 17.3';
	    			var v_sp='17.4 - 18.1';
	    			var v_ob='18.2';
	    			
	    			if(imc<=14.6){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14.6 && imc<=17.3){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=17.4 && imc<=18.1){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=18.2 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==4){
	    			var v_bp='14.0';
	    			var v_n='14.1 - 16.8';
	    			var v_sp='16.9 - 17.7';
	    			var v_ob='17.8';
	    			
	    			if(imc<=14.0){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14.1 && imc<=16.8){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=16.9 && imc<=17.7){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=17.8 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==5){
	    			var v_bp='13.8';
	    			var v_n='13.9 - 16.7';
	    			var v_sp='16.8 - 17.9';
	    			var v_ob='18';
	    			
	    			if(imc<=13.8){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=13.9 && imc<=16.7){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=16.8 && imc<=17.9){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=18 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==6){
	    			var v_bp='13.8';
	    			var v_n='13.9 - 16.9';
	    			var v_sp='17 - 18.3';
	    			var v_ob='18.4';
	    			
	    			if(imc<=13.8){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=13.9 && imc<=16.9){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=17.0 && imc<=18.3){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=18.4 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==7){
	    			var v_bp='13.7';
	    			var v_n='13.8 - 17.3';
	    			var v_sp='17.4 - 19.1';
	    			var v_ob='19.2';
	    			
	    			if(imc<=13.7){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=13.8 && imc<=17.3){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=17.4 && imc<=19.1){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=19.2 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==8){
	    			var v_bp='13.8';
	    			var v_n='13.9 - 17.8';
	    			var v_sp='17.9 - 19.9';
	    			var v_ob='20';
	    			
	    			if(imc<=13.8){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=13.9 && imc<=17.8){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=17.9 && imc<=19.9){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=20 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==9){
	    			var v_bp='13.9';
	    			var v_n='14 - 18.5';
	    			var v_sp='18.6 - 20.9';
	    			var v_ob='21';
	    			
	    			if(imc<=13.9){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14 && imc<=18.5){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=18.6 && imc<=20.9){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=21 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==10){
	    			var v_bp='14.2';
	    			var v_n='14.3 - 19.3';
	    			var v_sp='19.4 - 22';
	    			var v_ob='22.1';
	    			
	    			if(imc<=14.2){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14.3 && imc<=19.3){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=19.4 && imc<=22){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=22.1 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==11){
	    			var v_bp='14.5';
	    			var v_n='14.6 - 20.1';
	    			var v_sp='20.2 - 23.1';
	    			var v_ob='23.2';
	    			
	    			if(imc<=14.5){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14.6 && imc<=20.1){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=20.2 && imc<=23.1){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=23.2 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==12){
	    			var v_bp='15.0';
	    			var v_n='15.1 - 20.9';
	    			var v_sp='21.0 - 24.1';
	    			var v_ob='24.2';
	    			
	    			if(imc<=15.0){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=15.1 && imc<=20.9){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=21.0 && imc<=24.1){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=24.2 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==13){
	    			var v_bp='15.4';
	    			var v_n='15.5 - 21.7';
	    			var v_sp='21.8 - 25.0';
	    			var v_ob='25.1';
	    			
	    			if(imc<=15.4){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=15.5 && imc<=21.7){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=21.8 && imc<=25.0){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=25.1 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}	
	    		}
	    		if(edad==14){
	    			var v_bp='16.0';
	    			var v_n='16.1 - 22.5';
	    			var v_sp='22.6 - 25.9';
	    			var v_ob='26';
	    			
	    			if(imc<=16.0){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=16.1 && imc<=22.5){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=22.6 && imc<=25.9){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=26 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}		
	    		}
	    		if(edad==15){
	    			var v_bp='16.5';
	    			var v_n='16.6 - 23.3';
	    			var v_sp='23.4 - 26.7';
	    			var v_ob='26.8';
	    			
	    			if(imc<=16.5){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=16.6 && imc<=23.3){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=23.4 && imc<=26.7){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=26.8 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}			
	    		}
	    		if(edad==16){
	    			var v_bp='17.1';
	    			var v_n='17.2 - 24.1';
	    			var v_sp='24.2 - 27.4';
	    			var v_ob='27.5';
	    			
	    			if(imc<=17.1){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=17.2 && imc<=24.1){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=24.2 && imc<=27.4){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=27.5 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}		
	    		}
	    		if(edad==17){
	    			var v_bp='17.6';
	    			var v_n='17.7 - 24.8';
	    			var v_sp='24.9 - 28.1';
	    			var v_ob='28.2';
	    			
	    			if(imc<=17.6){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=17.7 && imc<=24.8){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=24.9 && imc<=28.1){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=28.2 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}		
	    		}
	    		if(edad==18){
	    			var v_bp='18.2';
	    			var v_n='18.3 - 25.5';
	    			var v_sp='25.6 - 28.8';
	    			var v_ob='28.9';
	    			
	    			if(imc<=18.2){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=18.3 && imc<=25.5){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=25.6 && imc<=28.8){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=28.9 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}		
	    		}else if(edad>18){
	    			var v_bp='18.5';
	    			var v_n='18.6 - 24.9';
	    			var v_sp='25.0 - 29.9';
	    			var v_ob='30';
	    			
	    			if(imc<=18.5){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=18.6 && imc<=24.9){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=25.0 && imc<=29.9){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=30 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}

	    		
	    	}else if(sexo=='niña'){
	    		if(edad==2){
	    			var v_bp='14.4';
	    			var v_n='14.5 - 17.9';
	    			var v_sp='18.0 - 19.0';
	    			var v_ob='19.1';
	    			
	    			if(imc<=14.4){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14.5 && imc<=17.9){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=18.0 && imc<=19.0){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=19.1 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==3){
	    			var v_bp='14.0';
	    			var v_n='14.1 - 17.1';
	    			var v_sp='17.2 - 18.1';
	    			var v_ob='18.2';
	    			
	    			if(imc<=14.0){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14.1 && imc<=17.1){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=17.2 && imc<=18.1){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=18.2 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==4){
	    			var v_bp='13.7';
	    			var v_n='13.8 - 16.7';
	    			var v_sp='16.8 - 17.9';
	    			var v_ob='18';
	    			
	    			if(imc<=13.7){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=13.8 && imc<=16.7){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=16.8 && imc<=17.9){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=18 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==5){
	    			var v_bp='13.5';
	    			var v_n='13.6 - 16.7';
	    			var v_sp='16.8 - 18.1';
	    			var v_ob='18.2';
	    			
	    			if(imc<=13.5){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=13.6 && imc<=16.7){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=16.8 && imc<=18.1){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=18.2 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==6){
	    			var v_bp='13.4';
	    			var v_n='13.5 - 17';
	    			var v_sp='17.1 - 18.7';
	    			var v_ob='18.8';
	    			
	    			if(imc<=13.4){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=13.5 && imc<=17){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=17.1 && imc<=18.7){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=18.8 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==7){
	    			var v_bp='13.4';
	    			var v_n='13.5 - 17.7';
	    			var v_sp='17.8 - 19.5';
	    			var v_ob='19.6';
	    			
	    			if(imc<=13.4){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=13.5 && imc<=17.7){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=17.8 && imc<=19.5){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=19.6 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==8){
	    			var v_bp='13.6';
	    			var v_n='13.7 - 18.2';
	    			var v_sp='18.3 - 20.5';
	    			var v_ob='20.6';
	    			
	    			if(imc<=13.6){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=13.7 && imc<=18.2){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=18.3 && imc<=20.5){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=20.6 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==9){
	    			var v_bp='13.8';
	    			var v_n='13.9 - 19';
	    			var v_sp='19.1 - 21.7';
	    			var v_ob='21.8';
	    			
	    			if(imc<=13.8){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=13.9 && imc<=19.0){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=19.1 && imc<=21.7){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=21.8 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==10){
	    			var v_bp='14.0';
	    			var v_n='14.1 - 19.9';
	    			var v_sp='20 - 22.9';
	    			var v_ob='23';
	    			
	    			if(imc<=14.0){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14.1 && imc<=19.9){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=20 && imc<=22.9){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=23 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==11){
	    			var v_bp='14.4';
	    			var v_n='14.5 - 20.7';
	    			var v_sp='20.8 - 23.9';
	    			var v_ob='24';
	    			
	    			if(imc<=14.4){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14.5 && imc<=20.7){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=20.8 && imc<=23.9){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=24 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==12){
	    			var v_bp='14.8';
	    			var v_n='14.9 - 21.7';
	    			var v_sp='21.8 - 25.1';
	    			var v_ob='25.2';
	    			
	    			if(imc<=14.8){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=14.9 && imc<=21.7){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=21.8 && imc<=25.1){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=25.2 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    		if(edad==13){
	    			var v_bp='15.3';
	    			var v_n='15.4 - 22.5';
	    			var v_sp='22.6 - 26.2';
	    			var v_ob='26.3';
	    			
	    			if(imc<=15.3){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=15.4 && imc<=22.5){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=22.6 && imc<=26.2){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=26.3 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}	
	    		}
	    		if(edad==14){
	    			var v_bp='15.8';
	    			var v_n='15.9 - 23.2';
	    			var v_sp='23.3 - 27.1';
	    			var v_ob='27.2';
	    			
	    			if(imc<=15.8){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=15.9 && imc<=23.2){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=23.3 && imc<=27.1){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=267.2 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}		
	    		}
	    		if(edad==15){
	    			var v_bp='16.3';
	    			var v_n='16.4 - 23.9';
	    			var v_sp='24 - 27.9';
	    			var v_ob='28';
	    			
	    			if(imc<=16.3){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=16.4 && imc<=23.9){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=24 && imc<=27.9){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=28 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}			
	    		}
	    		if(edad==16){
	    			var v_bp='16.8';
	    			var v_n='16.9 - 24.5';
	    			var v_sp='24.6 - 28.7';
	    			var v_ob='28.8';
	    			
	    			if(imc<=16.8){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=16.9 && imc<=24.5){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=24.6 && imc<=28.7){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=28.8 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}		
	    		}
	    		if(edad==17){
	    			var v_bp='17.2';
	    			var v_n='17.3 - 25.1';
	    			var v_sp='25.2 - 29.5';
	    			var v_ob='29.6';
	    			
	    			if(imc<=17.2){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=17.3 && imc<=25.1){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=24.2 && imc<=29.5){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=29.6 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}		
	    		}
	    		if(edad==18){
	    			var v_bp='17.2';
	    			var v_n='17.3 - 25.1';
	    			var v_sp='25.2 - 29.5';
	    			var v_ob='29.6';
	    			
	    			if(imc<=17.2){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=17.3 && imc<=25.1){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=25.2 && imc<=29.5){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=29.6 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}		
	    		}else if(edad>18){
	    			var v_bp='18.5';
	    			var v_n='18.6 - 24.9';
	    			var v_sp='25.0 - 29.9';
	    			var v_ob='30';
	    			
	    			if(imc<=18.5){
	    				var b_peso='bz-info';
	    				var nivel='Bajo peso';
	    			}else if(imc>=18.6 && imc<=24.9){
	    				var normal='bz-info';
	    				var nivel='Normal';
	    			}else if(imc>=25.0 && imc<=29.9){
	    				var sobre_p='bz-info';
	    				var nivel='Sobrepeso';
	    			}else if(imc>=30 ){
	    				var obeso='bz-info';
	    				var nivel='Obeso';
	    			}
	    		}
	    	}
	    	
	    	$('.text-info-valores').html(`
	    		<p>Para la información que ingresó:</p>
	    		<p>Edad : ${edad} años</p>
	    		<p>Sexo : ${sexo} </p>
	    		<p>Estatura: ${altura} centímetros</p>
	    		<p>Peso: ${peso} kilogramos</p>			

	    		<p>
	    			Su IMC es ${imc} , lo que indica que su peso está en la categoría ${nivel} para niños de su misma estatura.
	    			
	    		</p>

	    		<p>Mantener un peso saludable puede reducir el riesgo de enfermedades crónicas asociadas al sobrepeso y la obesidad.</p>
	    	`);
	    	$('.resul-imc').html(`
	    		<table class="table_  text-center" >
	    			<tr class="title-table">
	    				<td class="br"><b>IMC</b></td>
	    				<td class=""><b>Nivel de Peso</b></td>
	    			</tr>
	    			<tr >
	    				<td class="${b_peso}  br  bt ">Por debajo de ${v_bp}</td>
	    				<td class="${b_peso} bt"> Bajo peso</td>
	    			</tr>
	    			<tr >
	    				<td class="${normal}  br bt"> ${v_n} </td>
	    				<td class="${normal} bt">Normal</td>
	    			</tr>
	    			<tr class="bt">
	    				<td class="${sobre_p} br bt">${v_sp}</td>
	    				<td class="${sobre_p} bt">Sobrepeso</td>
	    			</tr>
	    			<tr>
	    				<td class="${obeso} br bt">${v_ob} o más</td>
	    				<td class="${obeso} bt"> Obeso</td>
	    			</tr>
	    		</table>
	    	`);
	    }
	});

	// activar imputs para infante
	function activar_input(activo) {
		if(activo=='adulto'){
			$('#edad_imc').prop('required',false);
			$('#meses_imc').prop('required',false);
			$('#niño_imc').prop('required',false);
			$('#niña_imc').prop('required',false);
			console.log(activo+1);
		}else if(activo=='infante'){
			$('#edad_imc').prop('required',true);
			$('#meses_imc').prop('required',true);
			$('#niño_imc').prop('required',true);
			$('#niña_imc').prop('required',true);
			console.log(activo+0);
		}
		
	}

	$('.imc_ver').click(function (e) {
		$('.imc-texto').html(`
			<b>Indice de masa corporal:</b> El índice de masa corporal (IMC) es un número que se calcula con base en el peso y la estatura de la persona. Para la mayoría de las personas, el IMC es un indicador confiable de la gordura y se usa para identificar las categorías de peso que pueden llevar a problemas de salud.
			`);
	});

	// funcion para limpiar input
	function limpiar_input() {
		$('#edad_imc').val("");
		$('#meses_imc').val("");
		$('#altura_imc').val("");
		$('#kg_imc').val("");
	}

// funciones de saturacion de oxigeno
	$("#form-content-st-ox").on("submit", function (e) {
		 e.preventDefault();
		var st_spo= $('#st_spo').val();
		var st_pr= $('#st_pr').val();
		

		if(st_spo>=95){
			var rango='Normal';
			var select_rango_n='bz-info ';
		}else if(st_spo>=91 && st_spo<=94 ){
			var rango='Hipoxia leve';
			var select_rango_nl='bz-info ';
		}else if(st_spo>=86 && st_spo<=90 ){
			var rango='Hipoxia moderada';
			var select_rango_nm='bz-info ';
		}else if(st_spo<=85){
			var rango='Hipoxia grave'; 
			var select_rango_ng='bz-info ';
		}

		// $('.text-oxi').html(rango);
		$('.text-titulo-rango').html(`SU RESULTADO ES: <b class="text-info_ ">${rango}</b>`);
		$('.resul-oxi').removeClass('d-none');


		$('.resul-oxi').html(`
			<table class="table_  text-center m-auto" >
				<tr class="title-table">
					<td class="br"><b>Rango</b></td>
					<td class="" style="width:118px;"><b>Valores</b></td>
				</tr>
				<tr >
					<td class="${select_rango_n} br  bt ">Normal</td>
					<td class="${select_rango_n}  bt"> 95% al 100%</td>
				</tr>
				<tr >
					<td class="${select_rango_nl} br bt">Hipoxia leve</td>
					<td class="${select_rango_nl}  bt">91% al 94%</td>
				</tr>
				<tr class="bt">
					<td class="${select_rango_nm}  br bt">Hipoxia moderada</td>
					<td class="${select_rango_nm}  bt">86% al 90%</td>
				</tr>
				<tr>
					<td class="${select_rango_ng}  br bt">Hipoxia grave</td>
					<td class="${select_rango_ng} bt"> menor a 85%</td>
				</tr>
			</table>
		`);
		$('.content-btn-ox').html(`
			<button type="reset" class="btn bgz-info btn-block " onclick="otro_calculo()" >Ingresar otro valor</button>
		`);

		$('#st_spo').prop('readonly',true);
		$('#st_pr').prop('readonly',true);

	});

	function otro_calculo(argument) {
		$('.text-titulo-rango').html(' ');
		$('.resul-oxi').addClass('d-none');
		$('.content-btn-ox').html(`
			<button type="submit" class="btn bgz-info btn-block " >Calcular</button>
		`);

		$('#st_spo').val(" ");
		$('#st_pr').val(" ");

		$('#st_spo').prop('readonly',false);
		$('#st_pr').prop('readonly',false);
	}

	// evento para cambiar la img Soxigeno
	$('.img-oxi-hand').mouseenter(function (e) {
		$(this).attr('src',`${url}/img/empoderate/satu_oxi2.png`);
	});

	// evento para cambiar la img Soxigeno
	$('.img-oxi-hand').mouseleave(function (e) {
		$(this).attr('src',`${url}/img/empoderate/satu_oxi.png`);
	});

	$('.so_ver').click(function (e) {
		$('.so-texto').html(`
			<b>¿Qué es la saturación de oxígeno en sangre?:</b> La saturación de oxígeno es la medida que indica la cantidad que hay en nuestra sangre de este elemento respecto a la que podría llevar. Se trata, entonces, de un indicador de cuán bien se está distribuyendo el oxígeno desde los pulmones a las células y, por tanto, al resto de órganos. Este valor puede cambiar a lo largo del día.	
		`);
	});

// funciones de frecuencia cardiaca
	$('.fc-img-adl').click(function (argument) {
		$('.text-img-imc-select').removeClass('text-img-imc-select');
		$('.fc-adl').addClass('text-img-imc-select');
		document.querySelector('#fc-adl').checked = true;
		$('#fc-edad').attr('placeholder','18 - 70 años');
		$('#fc-lmp').attr('placeholder','62 lmp');
		$('#fc-edad').attr('max','120');
		$('#fc-edad').attr('min','18');
		$('.input-sexo-fc').removeClass('d-none');
		$('#fc-mujer').prop('required',true);
		$('#fc-hombre').prop('required',true);
		$('#fc-edad').val("");
		$('#fc-lmp').val("");
	});

	$('.fc-img-inf').click(function (argument) {
		$('.text-img-imc-select').removeClass('text-img-imc-select');
		$('.fc-inft').addClass('text-img-imc-select');
		document.querySelector('#fc-inf').checked = true;
		$('#fc-edad').attr('placeholder','1 - 17 años');
		$('#fc-edad').attr('min','1');
		$('#fc-edad').attr('max','17');
		$('#fc-lmp').attr('placeholder','42 lmp');
		$('.input-sexo-fc').addClass('d-none');
		$('#fc-mujer').prop('required',false);
		$('#fc-hombre').prop('required',false);
		$('#fc-edad').val("");
		$('#fc-lmp').val("");
		
	});

	$("#form-content-fc").on("submit", function (e) {
		e.preventDefault();
		// efecto de imagen
		 $('.img-cardiaca').attr('src',`${url}/img/empoderate/medidor.gif`);
		
		var fc_edad= $('#fc-edad').val();
		var fc_lmp= $('#fc-lmp').val();
		var fc_sexo= $('input[name="fc-sexo"]:checked').val();
		var tipo_fc= $('input[name="tipo_fc"]:checked').val();
		
		if(tipo_fc=='infante'){
			
			// calculo de frecuencia cardiaca para niños
			// verificacion de edades
				if(fc_edad <= 1 ){
					
					// ipm min y max
						var max_baja=79;

						var min_buena=80;
						var max_buena=160;

						var min_alta=161;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min) 
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						
						}else if(fc_lmp >= min_buena && fc_lmp <= max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
							
						}else if(fc_lmp > min_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
							
						}
				}else if(fc_edad == 2 ){
					
					// ipm min y max
						var max_baja=79;

						var min_buena=80;
						var max_buena=130;

						var min_alta=131;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}
				}else if(fc_edad > 2 && fc_edad <= 4 ){
					
					// ipm min y max
						var max_baja=79;

						var min_buena=80;
						var max_buena=120;

						var min_alta=121;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}
				}else if(fc_edad > 4 && fc_edad <= 6 ){
					
					// ipm min y max
						var max_baja=74;

						var min_buena=75;
						var max_buena=115;

						var min_alta=116;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}
				}else if(fc_edad > 6 && fc_edad <= 12 ){
					
					// ipm min y max
						var max_baja=69;

						var min_buena=70;
						var max_buena=110;

						var min_alta=111;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}
				}else if(fc_edad > 12 && fc_edad <= 17 ){
					
					// ipm min y max
						var max_baja=59;

						var min_buena=60;
						var max_buena=110;

						var min_alta=111;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}
				}
			// Tabla de resultado FC
			  	$('.resul-fc').html(`
				  	<div class=" ">
						<table class="table_ table-sm text-center m-auto"style="width: 310px;">
							<tr class="title-table">
								<td class="br" ><b>Condición</b></td>
								<td class="br" ><b>Mínimo</b></td>
								<td class=""   ><b>Máximo</b></td>
							</tr>
							<tr >
								<td class="${select_fc_baja} br  bt ">Baja</td>
								<td class="${select_fc_baja} bt br"> .....</td>
								<td class="${select_fc_baja} bt">${max_baja}</td>
							</tr>
							<tr >
								<td class="${select_fc_buena} br bt">Buena</td>
								<td class="${select_fc_buena} bt br">${min_buena}</td>
								<td class="${select_fc_buena} bt">${max_buena}</td>
							</tr>
							
							<tr>
								<td class="${select_fc_alta} br bt">Alta</td>
								<td class="${select_fc_alta} bt br"> ${min_alta}</td>
								<td class="${select_fc_alta} bt "> ... </td>
							</tr>
							
						</table>
					</div>
			  	`);
		}else if(tipo_fc =='adulto'){
			
			// calculo de frecuencia cardiaca para adultos
			if(fc_sexo=='mujer'){	
				
				// verificacion de edades
				if(fc_edad >= 18 && fc_edad <= 25 ){
					// ipm min y max
						var max_baja=65;

						var min_buena=66;
						var max_buena=69;

						var min_normal=70;
						var max_normal=78;

						var min_alta=79;
						var max_alta=84;

						var min_muy_alta=85;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}
				}else if(fc_edad > 25 && fc_edad<=35 ){
					// ipm min y max
						var max_baja=64;

						var min_buena=65;
						var max_buena=68;

						var min_normal=69;
						var max_normal=76;

						var min_alta=77;
						var max_alta=82;

						var min_muy_alta=83;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}	
				}else if(fc_edad >35 && fc_edad<=45 ){
					// ipm min y max
						var max_baja=64;

						var min_buena=65;
						var max_buena=69;

						var min_normal=70;
						var max_normal=78;

						var min_alta=79;
						var max_alta=84;

						var min_muy_alta=85;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}			
				}else if(fc_edad >45 && fc_edad<=55){
					// ipm min y max
						var max_baja=65;

						var min_buena=66;
						var max_buena=69;

						var min_normal=70;
						var max_normal=77;

						var min_alta=79;
						var max_alta=83;

						var min_muy_alta=84;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}	
				}else if(fc_edad >55 && fc_edad<=65){
					// ipm min y max
						var max_baja=64;

						var min_buena=65;
						var max_buena=68;

						var min_normal=69;
						var max_normal=77;

						var min_alta=78;
						var max_alta=83;

						var min_muy_alta=84;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}		
				}else if(fc_edad > 65){
					// ipm min y max
						var max_baja=64;

						var min_buena=65;
						var max_buena=68;

						var min_normal=69;
						var max_normal=77;

						var min_alta=78;
						var max_alta=83;

						var min_muy_alta=84;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}	
				}
			}
			if(fc_sexo=='hombre'){

				// verificacion de edades
				if(fc_edad >= 18 && fc_edad <= 25 ){
					// ipm min y max
						var max_baja=61;

						var min_buena=62;
						var max_buena=65;

						var min_normal=66;
						var max_normal=73;

						var min_alta=74;
						var max_alta=81;

						var min_muy_alta=82;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}
				}else if(fc_edad > 25 && fc_edad<=35 ){
					// ipm min y max
						var max_baja=61;

						var min_buena=62;
						var max_buena=65;

						var min_normal=66;
						var max_normal=74;

						var min_alta=75;
						var max_alta=81;

						var min_muy_alta=82;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}	
				}else if(fc_edad >35 && fc_edad<=45 ){
					// ipm min y max
						var max_baja=62;

						var min_buena=63;
						var max_buena=66;

						var min_normal=67;
						var max_normal=75;

						var min_alta=76;
						var max_alta=82;

						var min_muy_alta=83;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}			
				}else if(fc_edad >45 && fc_edad<=55){
					// ipm min y max
						var max_baja=63;

						var min_buena=64;
						var max_buena=67;

						var min_normal=68;
						var max_normal=76;

						var min_alta=77;
						var max_alta=83;

						var min_muy_alta=84;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}	
				}else if(fc_edad >55 && fc_edad<=65){
					// ipm min y max
						var max_baja=61;

						var min_buena=62;
						var max_buena=67;

						var min_normal=69;
						var max_normal=75;

						var min_alta=76;
						var max_alta=81;

						var min_muy_alta=82;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}		
				}else if(fc_edad > 65){
					// ipm min y max
						var max_baja=61;

						var min_buena=62;
						var max_buena=67;

						var min_normal=69;
						var max_normal=75;

						var min_alta=76;
						var max_alta=81;

						var min_muy_alta=82;
					
					// verificacion de ipm
						if(fc_lmp<=max_baja){ // baja (lat/min)
							var condicion='Baja';
							var select_fc_baja='bz-info ';
						}else if(fc_lmp>=min_buena && fc_lmp<=max_buena){ // Buena (lat/min)
							var condicion='Buena';
							var select_fc_buena='bz-info ';
						}else if(fc_lmp>=min_normal && fc_lmp<=max_normal){ // Normal (lat/min)
							var condicion='Normal';
							var select_fc_normal='bz-info ';
						}else if(fc_lmp>=min_alta && fc_lmp<=max_alta){ // Alta (lat/min)
							var condicion='Alta';
							var select_fc_alta='bz-info ';
						}else if(fc_lmp>=min_muy_alta ){ // Muy alta (lat/min)
							var condicion='Muy alta';
							var select_fc_muy_alta='bz-info ';
						}	
				}
			}

			// Tabla de resultado FC
			  	$('.resul-fc').html(`
				  	<div class=" ">
						<table class="table_ table-sm text-center m-auto" style="width: 310px;">
							<tr class="title-table">
								<td class="br" ><b>Condición</b></td>
								<td class="br" ><b>Mínimo</b></td>
								<td class=""   ><b>Máximo</b></td>
							</tr>
							<tr >
								<td class="${select_fc_baja} br  bt ">Baja</td>
								<td class="${select_fc_baja} bt br"> .....</td>
								<td class="${select_fc_baja} bt">${max_baja}</td>
							</tr>
							<tr >
								<td class="${select_fc_buena} br bt">Buena</td>
								<td class="${select_fc_buena} bt br">${min_buena}</td>
								<td class="${select_fc_buena} bt">${max_buena}</td>
							</tr>
							<tr class="bt">
								<td class="${select_fc_normal} br bt">Normal</td>
								<td class="${select_fc_normal} bt br">${min_normal}</td>
								<td class="${select_fc_normal} bt ">${max_normal}</td>
							</tr>
							<tr>
								<td class="${select_fc_alta} br bt">Alta</td>
								<td class="${select_fc_alta} bt br"> ${min_alta}</td>
								<td class="${select_fc_alta} bt "> ${max_alta}</td>
							</tr>
							<tr>
								<td class="${select_fc_muy_alta} br bt">Muy alta</td>
								<td class="${select_fc_muy_alta} bt br"> ${min_muy_alta}</td>
								<td class="${select_fc_muy_alta} bt "> ... </td>
							</tr>
						</table>
					</div>
			  	`);
				
		}
		if($('#fc-app').val()==1){
			$('#fc-edad').prop('readonly',true);
			$('#fc-lmp').prop('readonly',true);
			$('.text_res_fc').html(` SU RESULTADO ES: <b class="text-info_"> ${condicion} </b>`);
			$('.resul-fc').removeClass('d-none');
			$('.btn-fc').html(`<button type="reset" onclick="otro_calculo_fc()" class="btn bgz-info btn-block " >Ingresar otro valor</button>`);
			return;
		}
		setTimeout(function(){
			$('#fc-edad').prop('readonly',true);
			$('#fc-lmp').prop('readonly',true);
			$('.text_res_fc').html(` SU RESULTADO ES: <b class="text-info_"> ${condicion} </b>`);
			$('.resul-fc').removeClass('d-none');
			$('.btn-fc').html(`<button type="reset" onclick="otro_calculo_fc()" class="btn bgz-info btn-block " >Ingresar otro valor</button>`);	  
		},2200);	
	});

	function otro_calculo_fc() {
		$('.btn-fc').html(`<button type="submit" class="btn bgz-info btn-block " >Calcular</button>`);
		document.getElementById("form-content-fc").reset();

		$('.text_res_fc').html(' ');
		$('.resul-fc').addClass('d-none');
		$('#fc-edad').prop('readonly',false);
		$('#fc-lmp').prop('readonly',false);
	}
	
	$('.ver_fr').click(function (e) {
		$('.fr-texto').html(`
			<b>¿Qué es la frecuencia cardiaca?: </b> La frecuencia cardiaca es el número de veces que se contrae el corazón durante un minuto (latidos por minuto).  Para el correcto funcionamiento del organismo es necesario que el corazón actúe bombeando la sangre hacia todos los órganos, pero además lo debe hacer a una determinada presión (presión arterial) y a una determinada frecuencia. Dada la importancia de este proceso, es normal que el corazón necesite en cada latido un alto consumo de energía.
			`);
	});

// funcioones de presion arterial
	$("#form-content-pa").on("submit", function (e) {
		e.preventDefault();

		var pa_edad= $('#pa-edad').val();
		var pa_sintotica= $('#pa-sintotica').val();
		var pa_diastolica= $('#pa-diastolica').val();
		var pa_sexo= $('input[name="pa_sexo"]:checked').val();
		
		 if(pa_sexo=='hombre' || pa_sexo=='mujer'){
			// verificacion de edades
				if(pa_edad >= 15 && pa_edad <= 19 ){
						
					// valores Sistólica
						var sis_min_normal=90;
						var sis_max_normal=120;

						var sis_min_hiper_leve=120;
						var sis_max_hiper_leve=159;

					// valores Diastólica
						var di_min_normal=60;
						var di_max_normal=81;

						var di_min_hiper_leve=81;
						var di_max_hiper_leve=99;
						
					// verificacion de Precion Sistólica
						if(pa_sintotica <= 90){ // baja 
							var pa_resultado_text='Baja';
							var sis_select_baja	 ='bz-info';
						}else if(pa_sintotica > sis_min_normal && pa_sintotica <= sis_max_normal){ // Normal 
							var pa_resultado_text='Normal';
							var sis_select_normal='bz-info ';
						}else if(pa_sintotica > sis_min_hiper_leve && pa_sintotica <= sis_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text='Hipertensión Leve';
							var sis_select_hipert_leve='bz-info ';
						}else if(pa_sintotica > 160 && pa_sintotica <= 180){ // Hipertensión Moderada
							var pa_resultado_text='Hipertensión Moderada';
							var sis_select_hipert_moderada='bz-info ';
						}else if(pa_sintotica > 180){
							var pa_resultado_text='Hipertensión Severa';
							var sis_select_hipert_severa='bz-info ';
						}
					// verificacion de Precion Diastólica
						if(pa_diastolica <= 60){ // baja 
							var pa_resultado_text_di='Baja';
							var dia_select_baja='bz-info ';
						}else if(pa_diastolica > di_min_normal && pa_diastolica <= di_max_normal){ // Normal 
							var pa_resultado_text_di='Normal';
							var dia_select_normal='bz-info ';
						}else if(pa_diastolica > di_min_hiper_leve && pa_diastolica <= di_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text_di='Hipertensión Leve';
							var dia_select_hipert_leve='bz-info ';
						}else if(pa_diastolica >= 100 && pa_diastolica <= 120){ // Hipertensión Moderada
							var pa_resultado_text_di='Hipertensión Moderada';
							var dia_select_hipert_moderada='bz-info ';
						}else if(pa_diastolica > 120){// Hipertensión Severa
							var pa_resultado_text_di='Hipertensión Severa';
							var dia_select_hipert_severa='bz-info ';
						}
				}else if(pa_edad >= 20 && pa_edad <= 24){
					// valores Sistólica
						var sis_min_normal=90;
						var sis_max_normal=132;

						var sis_min_hiper_leve=132;
						var sis_max_hiper_leve=159;

					// valores Diastólica
						var di_min_normal=60;
						var di_max_normal=83;

						var di_min_hiper_leve=83;
						var di_max_hiper_leve=99;
						
					// verificacion de Precion Sistólica
						if(pa_sintotica <= 90){ // baja 
							var pa_resultado_text='Baja';
							var sis_select_baja	 ='bz-info';
						}else if(pa_sintotica > sis_min_normal && pa_sintotica <= sis_max_normal){ // Normal 
							var pa_resultado_text='Normal';
							var sis_select_normal='bz-info ';
						}else if(pa_sintotica > sis_min_hiper_leve && pa_sintotica <= sis_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text='Hipertensión Leve';
							var sis_select_hipert_leve='bz-info ';
						}else if(pa_sintotica > 160 && pa_sintotica <= 180){ // Hipertensión Moderada
							var pa_resultado_text='Hipertensión Moderada';
							var sis_select_hipert_moderada='bz-info ';
						}else if(pa_sintotica > 180){
							var pa_resultado_text='Hipertensión Severa';
							var sis_select_hipert_severa='bz-info ';
						}
					// verificacion de Precion Diastólica
						if(pa_diastolica <= 60){ // baja 
							var pa_resultado_text_di='Baja';
							var dia_select_baja='bz-info ';
						}else if(pa_diastolica > di_min_normal && pa_diastolica <= di_max_normal){ // Normal 
							var pa_resultado_text_di='Normal';
							var dia_select_normal='bz-info ';
						}else if(pa_diastolica > di_min_hiper_leve && pa_diastolica <= di_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text_di='Hipertensión Leve';
							var dia_select_hipert_leve='bz-info ';
						}else if(pa_diastolica >= 100 && pa_diastolica <= 120){ // Hipertensión Moderada
							var pa_resultado_text_di='Hipertensión Moderada';
							var dia_select_hipert_moderada='bz-info ';
						}else if(pa_diastolica > 120){// Hipertensión Severa
							var pa_resultado_text_di='Hipertensión Severa';
							var dia_select_hipert_severa='bz-info ';
						}
				}else if(pa_edad >= 25 && pa_edad <= 29){
					// valores Sistólica
						var sis_min_normal=90;
						var sis_max_normal=133;

						var sis_min_hiper_leve=133;
						var sis_max_hiper_leve=159;

					// valores Diastólica
						var di_min_normal=60;
						var di_max_normal=84;

						var di_min_hiper_leve=84;
						var di_max_hiper_leve=99;
						
					// verificacion de Precion Sistólica
						if(pa_sintotica <= 90){ // baja 
							var pa_resultado_text='Baja';
							var sis_select_baja	 ='bz-info';
						}else if(pa_sintotica > sis_min_normal && pa_sintotica <= sis_max_normal){ // Normal 
							var pa_resultado_text='Normal';
							var sis_select_normal='bz-info ';
						}else if(pa_sintotica > sis_min_hiper_leve && pa_sintotica <= sis_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text='Hipertensión Leve';
							var sis_select_hipert_leve='bz-info ';
						}else if(pa_sintotica > 160 && pa_sintotica <= 180){ // Hipertensión Moderada
							var pa_resultado_text='Hipertensión Moderada';
							var sis_select_hipert_moderada='bz-info ';
						}else if(pa_sintotica > 180){
							var pa_resultado_text='Hipertensión Severa';
							var sis_select_hipert_severa='bz-info ';
						}
					// verificacion de Precion Diastólica
						if(pa_diastolica <= 60){ // baja 
							var pa_resultado_text_di='Baja';
							var dia_select_baja='bz-info ';
						}else if(pa_diastolica > di_min_normal && pa_diastolica <= di_max_normal){ // Normal 
							var pa_resultado_text_di='Normal';
							var dia_select_normal='bz-info ';
						}else if(pa_diastolica > di_min_hiper_leve && pa_diastolica <= di_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text_di='Hipertensión Leve';
							var dia_select_hipert_leve='bz-info ';
						}else if(pa_diastolica >= 100 && pa_diastolica <= 120){ // Hipertensión Moderada
							var pa_resultado_text_di='Hipertensión Moderada';
							var dia_select_hipert_moderada='bz-info ';
						}else if(pa_diastolica > 120){// Hipertensión Severa
							var pa_resultado_text_di='Hipertensión Severa';
							var dia_select_hipert_severa='bz-info ';
						}		
				}else if(pa_edad >= 30 && pa_edad <= 34){
					// valores Sistólica
						var sis_min_normal=90;
						var sis_max_normal=134;

						var sis_min_hiper_leve=134;
						var sis_max_hiper_leve=159;

					// valores Diastólica
						var di_min_normal=60;
						var di_max_normal=85;

						var di_min_hiper_leve=85;
						var di_max_hiper_leve=99;
						
					// verificacion de Precion Sistólica
						if(pa_sintotica <= 90){ // baja 
							var pa_resultado_text='Baja';
							var sis_select_baja	 ='bz-info';
						}else if(pa_sintotica > sis_min_normal && pa_sintotica <= sis_max_normal){ // Normal 
							var pa_resultado_text='Normal';
							var sis_select_normal='bz-info ';
						}else if(pa_sintotica > sis_min_hiper_leve && pa_sintotica <= sis_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text='Hipertensión Leve';
							var sis_select_hipert_leve='bz-info ';
						}else if(pa_sintotica > 160 && pa_sintotica <= 180){ // Hipertensión Moderada
							var pa_resultado_text='Hipertensión Moderada';
							var sis_select_hipert_moderada='bz-info ';
						}else if(pa_sintotica > 180){
							var pa_resultado_text='Hipertensión Severa';
							var sis_select_hipert_severa='bz-info ';
						}
					// verificacion de Precion Diastólica
						if(pa_diastolica <= 60){ // baja 
							var pa_resultado_text_di='Baja';
							var dia_select_baja='bz-info ';
						}else if(pa_diastolica > di_min_normal && pa_diastolica <= di_max_normal){ // Normal 
							var pa_resultado_text_di='Normal';
							var dia_select_normal='bz-info ';
						}else if(pa_diastolica > di_min_hiper_leve && pa_diastolica <= di_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text_di='Hipertensión Leve';
							var dia_select_hipert_leve='bz-info ';
						}else if(pa_diastolica >= 100 && pa_diastolica <= 120){ // Hipertensión Moderada
							var pa_resultado_text_di='Hipertensión Moderada';
							var dia_select_hipert_moderada='bz-info ';
						}else if(pa_diastolica > 120){// Hipertensión Severa
							var pa_resultado_text_di='Hipertensión Severa';
							var dia_select_hipert_severa='bz-info ';
						}				
				}else if(pa_edad >= 35 && pa_edad <= 39){
					// valores Sistólica
						var sis_min_normal=90;
						var sis_max_normal=135;

						var sis_min_hiper_leve=135;
						var sis_max_hiper_leve=159;

					// valores Diastólica
						var di_min_normal=60;
						var di_max_normal=86;

						var di_min_hiper_leve=86;
						var di_max_hiper_leve=99;
						
					// verificacion de Precion Sistólica
						if(pa_sintotica <= 90){ // baja 
							var pa_resultado_text='Baja';
							var sis_select_baja	 ='bz-info';
						}else if(pa_sintotica > sis_min_normal && pa_sintotica <= sis_max_normal){ // Normal 
							var pa_resultado_text='Normal';
							var sis_select_normal='bz-info ';
						}else if(pa_sintotica > sis_min_hiper_leve && pa_sintotica <= sis_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text='Hipertensión Leve';
							var sis_select_hipert_leve='bz-info ';
						}else if(pa_sintotica > 160 && pa_sintotica <= 180){ // Hipertensión Moderada
							var pa_resultado_text='Hipertensión Moderada';
							var sis_select_hipert_moderada='bz-info ';
						}else if(pa_sintotica > 180){
							var pa_resultado_text='Hipertensión Severa';
							var sis_select_hipert_severa='bz-info ';
						}
					// verificacion de Precion Diastólica
						if(pa_diastolica <= 60){ // baja 
							var pa_resultado_text_di='Baja';
							var dia_select_baja='bz-info ';
						}else if(pa_diastolica > di_min_normal && pa_diastolica <= di_max_normal){ // Normal 
							var pa_resultado_text_di='Normal';
							var dia_select_normal='bz-info ';
						}else if(pa_diastolica > di_min_hiper_leve && pa_diastolica <= di_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text_di='Hipertensión Leve';
							var dia_select_hipert_leve='bz-info ';
						}else if(pa_diastolica >= 100 && pa_diastolica <= 120){ // Hipertensión Moderada
							var pa_resultado_text_di='Hipertensión Moderada';
							var dia_select_hipert_moderada='bz-info ';
						}else if(pa_diastolica > 120){// Hipertensión Severa
							var pa_resultado_text_di='Hipertensión Severa';
							var dia_select_hipert_severa='bz-info ';
						}				
				}else if(pa_edad >= 40 && pa_edad <= 44){
					// valores Sistólica
						var sis_min_normal=90;
						var sis_max_normal=137;

						var sis_min_hiper_leve=137;
						var sis_max_hiper_leve=159;

					// valores Diastólica
						var di_min_normal=60;
						var di_max_normal=87;

						var di_min_hiper_leve=87;
						var di_max_hiper_leve=99;
						
					// verificacion de Precion Sistólica
						if(pa_sintotica <= 90){ // baja 
							var pa_resultado_text='Baja';
							var sis_select_baja	 ='bz-info';
						}else if(pa_sintotica > sis_min_normal && pa_sintotica <= sis_max_normal){ // Normal 
							var pa_resultado_text='Normal';
							var sis_select_normal='bz-info ';
						}else if(pa_sintotica > sis_min_hiper_leve && pa_sintotica <= sis_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text='Hipertensión Leve';
							var sis_select_hipert_leve='bz-info ';
						}else if(pa_sintotica > 160 && pa_sintotica <= 180){ // Hipertensión Moderada
							var pa_resultado_text='Hipertensión Moderada';
							var sis_select_hipert_moderada='bz-info ';
						}else if(pa_sintotica > 180){
							var pa_resultado_text='Hipertensión Severa';
							var sis_select_hipert_severa='bz-info ';
						}
					// verificacion de Precion Diastólica
						if(pa_diastolica <= 60){ // baja 
							var pa_resultado_text_di='Baja';
							var dia_select_baja='bz-info ';
						}else if(pa_diastolica > di_min_normal && pa_diastolica <= di_max_normal){ // Normal 
							var pa_resultado_text_di='Normal';
							var dia_select_normal='bz-info ';
						}else if(pa_diastolica > di_min_hiper_leve && pa_diastolica <= di_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text_di='Hipertensión Leve';
							var dia_select_hipert_leve='bz-info ';
						}else if(pa_diastolica >= 100 && pa_diastolica <= 120){ // Hipertensión Moderada
							var pa_resultado_text_di='Hipertensión Moderada';
							var dia_select_hipert_moderada='bz-info ';
						}else if(pa_diastolica > 120){// Hipertensión Severa
							var pa_resultado_text_di='Hipertensión Severa';
							var dia_select_hipert_severa='bz-info ';
						}				
				}else if(pa_edad >= 45 && pa_edad <= 49){
					// valores Sistólica
						var sis_min_normal=90;
						var sis_max_normal=139;

						var sis_min_hiper_leve=139;
						var sis_max_hiper_leve=159;

					// valores Diastólica
						var di_min_normal=60;
						var di_max_normal=88;

						var di_min_hiper_leve=88;
						var di_max_hiper_leve=99;
						
					// verificacion de Precion Sistólica
						if(pa_sintotica <= 90){ // baja 
							var pa_resultado_text='Baja';
							var sis_select_baja	 ='bz-info';
						}else if(pa_sintotica > sis_min_normal && pa_sintotica <= sis_max_normal){ // Normal 
							var pa_resultado_text='Normal';
							var sis_select_normal='bz-info ';
						}else if(pa_sintotica > sis_min_hiper_leve && pa_sintotica <= sis_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text='Hipertensión Leve';
							var sis_select_hipert_leve='bz-info ';
						}else if(pa_sintotica > 160 && pa_sintotica <= 180){ // Hipertensión Moderada
							var pa_resultado_text='Hipertensión Moderada';
							var sis_select_hipert_moderada='bz-info ';
						}else if(pa_sintotica > 180){
							var pa_resultado_text='Hipertensión Severa';
							var sis_select_hipert_severa='bz-info ';
						}
					// verificacion de Precion Diastólica
						if(pa_diastolica <= 60){ // baja 
							var pa_resultado_text_di='Baja';
							var dia_select_baja='bz-info ';
						}else if(pa_diastolica > di_min_normal && pa_diastolica <= di_max_normal){ // Normal 
							var pa_resultado_text_di='Normal';
							var dia_select_normal='bz-info ';
						}else if(pa_diastolica > di_min_hiper_leve && pa_diastolica <= di_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text_di='Hipertensión Leve';
							var dia_select_hipert_leve='bz-info ';
						}else if(pa_diastolica >= 100 && pa_diastolica <= 120){ // Hipertensión Moderada
							var pa_resultado_text_di='Hipertensión Moderada';
							var dia_select_hipert_moderada='bz-info ';
						}else if(pa_diastolica > 120){// Hipertensión Severa
							var pa_resultado_text_di='Hipertensión Severa';
							var dia_select_hipert_severa='bz-info ';
						}				
				}else if(pa_edad >= 50 && pa_edad <= 54){
					// valores Sistólica
						var sis_min_normal=90;
						var sis_max_normal=142;

						var sis_min_hiper_leve=142;
						var sis_max_hiper_leve=159;

					// valores Diastólica
						var di_min_normal=60;
						var di_max_normal=89;

						var di_min_hiper_leve=89;
						var di_max_hiper_leve=99;
						
					// verificacion de Precion Sistólica
						if(pa_sintotica <= 90){ // baja 
							var pa_resultado_text='Baja';
							var sis_select_baja	 ='bz-info';
						}else if(pa_sintotica > sis_min_normal && pa_sintotica <= sis_max_normal){ // Normal 
							var pa_resultado_text='Normal';
							var sis_select_normal='bz-info ';
						}else if(pa_sintotica > sis_min_hiper_leve && pa_sintotica <= sis_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text='Hipertensión Leve';
							var sis_select_hipert_leve='bz-info ';
						}else if(pa_sintotica > 160 && pa_sintotica <= 180){ // Hipertensión Moderada
							var pa_resultado_text='Hipertensión Moderada';
							var sis_select_hipert_moderada='bz-info ';
						}else if(pa_sintotica > 180){
							var pa_resultado_text='Hipertensión Severa';
							var sis_select_hipert_severa='bz-info ';
						}
					// verificacion de Precion Diastólica
						if(pa_diastolica <= 60){ // baja 
							var pa_resultado_text_di='Baja';
							var dia_select_baja='bz-info ';
						}else if(pa_diastolica > di_min_normal && pa_diastolica <= di_max_normal){ // Normal 
							var pa_resultado_text_di='Normal';
							var dia_select_normal='bz-info ';
						}else if(pa_diastolica > di_min_hiper_leve && pa_diastolica <= di_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text_di='Hipertensión Leve';
							var dia_select_hipert_leve='bz-info ';
						}else if(pa_diastolica >= 100 && pa_diastolica <= 120){ // Hipertensión Moderada
							var pa_resultado_text_di='Hipertensión Moderada';
							var dia_select_hipert_moderada='bz-info ';
						}else if(pa_diastolica > 120){// Hipertensión Severa
							var pa_resultado_text_di='Hipertensión Severa';
							var dia_select_hipert_severa='bz-info ';
						}				
				}else if(pa_edad >= 55 && pa_edad <= 59){
					// valores Sistólica
						var sis_min_normal=90;
						var sis_max_normal=144;

						var sis_min_hiper_leve=144;
						var sis_max_hiper_leve=159;

					// valores Diastólica
						var di_min_normal=60;
						var di_max_normal=90;

						var di_min_hiper_leve=90;
						var di_max_hiper_leve=99;
						
					// verificacion de Precion Sistólica
						if(pa_sintotica <= 90){ // baja 
							var pa_resultado_text='Baja';
							var sis_select_baja	 ='bz-info';
						}else if(pa_sintotica > sis_min_normal && pa_sintotica <= sis_max_normal){ // Normal 
							var pa_resultado_text='Normal';
							var sis_select_normal='bz-info ';
						}else if(pa_sintotica > sis_min_hiper_leve && pa_sintotica <= sis_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text='Hipertensión Leve';
							var sis_select_hipert_leve='bz-info ';
						}else if(pa_sintotica > 160 && pa_sintotica <= 180){ // Hipertensión Moderada
							var pa_resultado_text='Hipertensión Moderada';
							var sis_select_hipert_moderada='bz-info ';
						}else if(pa_sintotica > 180){
							var pa_resultado_text='Hipertensión Severa';
							var sis_select_hipert_severa='bz-info ';
						}
					// verificacion de Precion Diastólica
						if(pa_diastolica <= 60){ // baja 
							var pa_resultado_text_di='Baja';
							var dia_select_baja='bz-info ';
						}else if(pa_diastolica > di_min_normal && pa_diastolica <= di_max_normal){ // Normal 
							var pa_resultado_text_di='Normal';
							var dia_select_normal='bz-info ';
						}else if(pa_diastolica > di_min_hiper_leve && pa_diastolica <= di_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text_di='Hipertensión Leve';
							var dia_select_hipert_leve='bz-info ';
						}else if(pa_diastolica >= 100 && pa_diastolica <= 120){ // Hipertensión Moderada
							var pa_resultado_text_di='Hipertensión Moderada';
							var dia_select_hipert_moderada='bz-info ';
						}else if(pa_diastolica > 120){// Hipertensión Severa
							var pa_resultado_text_di='Hipertensión Severa';
							var dia_select_hipert_severa='bz-info ';
						}			
				}else if(pa_edad >= 60 ){
					// valores Sistólica
						var sis_min_normal=90;
						var sis_max_normal=147;

						var sis_min_hiper_leve=147;
						var sis_max_hiper_leve=159;

					// valores Diastólica
						var di_min_normal=60;
						var di_max_normal=91;

						var di_min_hiper_leve=91;
						var di_max_hiper_leve=99;
						
					// verificacion de Precion Sistólica
						if(pa_sintotica <= 90){ // baja 
							var pa_resultado_text='Baja';
							var sis_select_baja	 ='bz-info';
						}else if(pa_sintotica > sis_min_normal && pa_sintotica <= sis_max_normal){ // Normal 
							var pa_resultado_text='Normal';
							var sis_select_normal='bz-info ';
						}else if(pa_sintotica > sis_min_hiper_leve && pa_sintotica <= sis_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text='Hipertensión Leve';
							var sis_select_hipert_leve='bz-info ';
						}else if(pa_sintotica > 160 && pa_sintotica <= 180){ // Hipertensión Moderada
							var pa_resultado_text='Hipertensión Moderada';
							var sis_select_hipert_moderada='bz-info ';
						}else if(pa_sintotica > 180){
							var pa_resultado_text='Hipertensión Severa';
							var sis_select_hipert_severa='bz-info ';
						}
					// verificacion de Precion Diastólica
						if(pa_diastolica <= 60){ // baja 
							var pa_resultado_text_di='Baja';
							var dia_select_baja='bz-info ';
						}else if(pa_diastolica > di_min_normal && pa_diastolica <= di_max_normal){ // Normal 
							var pa_resultado_text_di='Normal';
							var dia_select_normal='bz-info ';
						}else if(pa_diastolica > di_min_hiper_leve && pa_diastolica <= di_max_hiper_leve){ // Hipertensión leve
							var pa_resultado_text_di='Hipertensión Leve';
							var dia_select_hipert_leve='bz-info ';
						}else if(pa_diastolica >= 100 && pa_diastolica <= 120){ // Hipertensión Moderada
							var pa_resultado_text_di='Hipertensión Moderada';
							var dia_select_hipert_moderada='bz-info ';
						}else if(pa_diastolica > 120){// Hipertensión Severa
							var pa_resultado_text_di='Hipertensión Severa';
							var dia_select_hipert_severa='bz-info ';
						}			
				}
		}

		// mensaje de analisis
			if(pa_sintotica < 90 && pa_diastolica < 60){
				
				var text_analisis=`Sus valores de presión arterial son demasiado bajos.`;
				
			}else if(pa_sintotica > 180 && pa_diastolica > 120){

				var text_analisis=`Sus lecturas de Presión Arterial son demasiado altas lo cual puede ser peligroso para su salud, por lo que debe acudir de inmediato a su médico.`;
			
			}else if(pa_resultado_text =='Baja' && pa_resultado_text_di=='Baja'){
			 
			 	var text_analisis=`Su presión sistólica (número máximo) es bastante baja mientras que su presión diastólica (número mínimo) es un poco más baja que el rango normal, aunque dentro de unos límites aceptables.`;		
			
			}else if(pa_resultado_text =='Baja' && pa_resultado_text_di=='Normal'){
			
				var text_analisis='Algo más bajos de lo que sería deseable, aunque dentro de unos límites aceptables.';
			
			}else if(pa_resultado_text =='Normal' && pa_resultado_text_di=='Normal'){
			
				var text_analisis='¡En hora buena! Su Presión Arterial está dentro de los rangos normales para su grupo de edad.';
			
			}else if(pa_resultado_text =='Hipertensión Leve' && pa_resultado_text_di=='Hipertensión Leve'){
			
				var text_analisis='Sus lecturas de la Presión Arterial arrojan valores superiores a los límites considerados aceptables lo que, a la larga, es malo para su salud. Puede poner en práctica medidas sencillas para reducir sus niveles de presión arterial como, por ejemplo, reducir la ingesta de sal y dar pequeños paseos, todos los días, de 15 minutos de duración.';
			
			}else if(pa_resultado_text =='Hipertensión Moderada' && pa_resultado_text_di=='Hipertensión Moderada'){
			
				var text_analisis= `Sus lecturas de Presión Arterial son bastante altas y debe usted controlar su tensión com medicación.`;
			
			}else{
				var text_analisis=`Si sus lecturas de presión arterial son correctas nuestra interpretación es que tiene usted una Presión Arterial Sistólica (número máximo) ${pa_resultado_text} y una Presión Diastólica ${pa_resultado_text_di} (número mínimo). Esta patología se denomina Hipertensión Sistólica Aislada. HSA.`;
			}

		// texto resultado
		$('.text_res_pa').html(`SU RESULTADO ES: <b><span class="text-info_"> ${pa_resultado_text} | ${pa_resultado_text_di} </span></b>`);
		$('.valores-pa').html(`${pa_sintotica} / ${pa_diastolica} mmHg`);
		$('.content-text-pa').removeClass('d-none');
		

		$('.pa-resultado-analisis').html(text_analisis);
		// Tabla de resultado FC
		  	$('.resul-pa').html(`
				<div class=" d-flex justify-content-center  mt-3 d-none">
				  	<table class="table_ table-sm text-center mr-2" style="width: 243px;" >
				  		<tr>
				  			<td width="100px" class="br"><b>Sistólica</b></td>
				  			<td width="100px"><b>Valores</b></td>
				  		</tr>
				  		<tr>
				  			<td class="${sis_select_baja} br bt">Baja</td>
				  			<td class="${sis_select_baja} bt"> por debajo de 90</td>
				  		</tr>
				  		<tr>
				  			<td class="${sis_select_normal} bt br">Normal</td>
				  			<td class="${sis_select_normal} bt"> ${sis_min_normal} - ${sis_max_normal}</td>
				  		</tr>
				  		<tr>
				  			<td class="${sis_select_hipert_leve} br bt">Hipertensión Leve	</td>
				  			<td class="${sis_select_hipert_leve} bt"> ${sis_min_hiper_leve} - ${sis_max_hiper_leve}</td>
				  		</tr>
				  		<tr>
				  			<td class="${sis_select_hipert_moderada} br bt">Hipertensión Moderada</td>
				  			<td class="${sis_select_hipert_moderada} bt"> 160 - 180</td>
				  		</tr>
				  		<tr>
				  			<td class="${sis_select_hipert_severa} br bt">Hipertensión Severa</td>
				  			<td class="${sis_select_hipert_severa}  bt"> arriba 180</td>
				  		</tr>
				  	</table>
				  	<table class="table_ table-sm text-center  " style="width: 243px;" >
				  		<tr>
				  			<td width="100px" class="br"><b>Diastólica</b></td>
				  			<td width="100px" ><b>Valores</b></td>
				  		</tr>
				  		<tr>
				  			<td class="${dia_select_baja} br bt">Baja</td>
				  			<td class="${dia_select_baja} bt"> por debajo de 60</td>
				  		</tr>
				  		<tr>
				  			<td class="${dia_select_normal}  br bt">Normal</td>
				  			<td class="${dia_select_normal} bt"> ${di_min_normal} - ${di_max_normal}</td>
				  		</tr>
				  		<tr>
				  			<td class="${dia_select_hipert_leve} br bt">Hipertensión Leve	</td>
				  			<td class="${dia_select_hipert_leve} bt"> ${di_min_hiper_leve} - ${di_max_hiper_leve}</td>
				  		</tr>
				  		<tr>
				  			<td class="${dia_select_hipert_moderada} br bt">Hipertensión Moderada</td>
				  			<td class="${dia_select_hipert_moderada} bt"> 100 - 120</td>
				  		</tr>
				  		<tr>
				  			<td class="${dia_select_hipert_severa} br bt">Hipertensión Severa</td>
				  			<td class="${dia_select_hipert_severa} bt"> arriba 120</td>
				  		</tr>
				  	</table>
				</div>
		  	`);
		  	$('.resul-pa').removeClass('d-none');

		$('#pa-edad').prop('readonly',true);
		$('#pa-diastolica').prop('readonly',true);
		$('#pa-sintotica').prop('readonly',true);

		$('.btn-pa').html(`<button type="reset" onclick="otro_calculo_pa()" class="btn bgz-info btn-block " >Ingresar otro valor</button>`);

	});
	
	// evento para controlar que los valores Diastólica no sean mayores a los Sistólica
	$('#pa-diastolica').keydown( function () {
		var valor= $('#pa-sintotica').val();
		valor=valor-15;
		$('#pa-diastolica').attr('max',valor);
	});

	function otro_calculo_pa() {
		$('.btn-pa').html(`<button type="submit" class="btn bgz-info btn-block "> Calcular </button>`);
		document.getElementById("form-content-pa").reset();

		$('.text_res_pa').html(' ');
		$('.resul-pa').addClass('d-none');
		$('.pa-resultado-analisis').html(' ');
		$('.content-text-pa').addClass('d-none');
		
		$('#pa-edad').prop('readonly',false);
		$('#pa-diastolica').prop('readonly',false);
		$('#pa-sintotica').prop('readonly',false);	
	}

	$('.pa_ver').click(function (e) {
		$('.pa-texto').html(`
			<b>¿Qué es la presión arterial?:</b> La presión arterial es la fuerza que la sangre ejerce sobre la pared de las arterias. La presión arterial incluye dos mediciones: la presión sistólica, que se mide durante el latido del corazón (momento de presión máxima), y la presión diastólica, que se mide durante el descanso entre dos latidos (momento de presión mínima). Primero se registra la presión sistólica y luego la presión diastólica, por ejemplo: 120/80. También se llama presión sanguínea arterial y tensión arterial.
		`);
	});