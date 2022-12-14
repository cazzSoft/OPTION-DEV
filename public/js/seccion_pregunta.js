class ValidationError extends Error {
    constructor(message) {
        super(message);
        this.name = "ValidationError";
    }
}
// Control de colapsar  para la session
var info=0;
var info_h=0;
function traer_p(idss,idclass,este) {

	if(info==0){
    	  Swal.fire({
    			title: 'Información Option2health',
    		    text: "Te recomendamos que llenes todas las preguntas requeridas (*), caso contrario no podras guardar los datos de la cita",
    		    icon: 'info', //question ,info, warning, success, error
    		    // showCancelButton: true,
    		    confirmButtonColor: '#13c6ef',
    		    // cancelButtonColor: '#cbcdcd',
    		    // cancelButtonText: 'Aceptar',
    		    confirmButtonText: 'Aceptar',
    		}).then((result) => {
			    if (result.isConfirmed) {
			    	 
			    }
    		});
		info=1;
	}

	$('.seccion_'+idclass).removeClass('d-none');
	$(este).html('<u>Ver menos</u>');
	$(este).attr('onclick',`traer_p_none('${idss}','${idclass}',this)`);
	$('.scecion_'+idclass).html(" ");

	var cargado=$(`.seccion_${idclass}`).val();
	// if(cargado!=1){
		var idcita=$('#idcita_medica').val();
		getPreguntaSeccion(idss,idclass,'.seccion_',`${idcita}`);
	// }
	
}

// pregunta secciones historial
function traer_p_h(idss,idclass,este) {

	if(info_h==0){
    	Swal.fire({
    			title: 'Información Option2health',
    		    text: "Te recomendamos que llenes todas las preguntas requeridas (*), caso contrario no podras guardar los datos de la cita",
    		    icon: 'info', //question ,info, warning, success, error
    		    // showCancelButton: true,
    		    confirmButtonColor: '#13c6ef',
    		    // cancelButtonColor: '#cbcdcd',
    		    // cancelButtonText: 'Aceptar',
    		    confirmButtonText: 'Aceptar',
    		}).then((result) => {
			    if (result.isConfirmed) {
			    	 
			    }
    		});
		info_h=1;
	}

	$('.seccion_h'+idclass).removeClass('d-none');
	$(este).html('<u>Ver menos</u>');
	$(este).attr('onclick',`traer_p_none_h('${idss}','${idclass}',this)`);
	$('.scecion_'+idclass).html(" ");

	var cargado=$(`.seccion_${idclass}`).val();
	// if(cargado!=1){
		var idcita_h=$('#idcita_medica_last').val();
		getPreguntaSeccion(idss,idclass,'.seccion_h',`${idcita_h}`);
	// }
	
}
	
function traer_p_none(idss,idclass,este) {
	$('.seccion_'+idclass).addClass('d-none');
	$('.seccion_'+idclass).html('');
	$(este).html('<u>Ver más</u>');
	$(este).attr('onclick',`traer_p('${idss}','${idclass}',this)`);
}

function traer_p_none_h(idss,idclass,este) {
	$('.seccion_h'+idclass).addClass('d-none');
	$('.seccion_h'+idclass).addClass('d-none');
	$(este).html('<u>Ver más</u>');
	$(este).attr('onclick',`traer_p_h('${idss}','${idclass}',this)`);
}

	
// obtener pregunta para la seccion
function getPreguntaSeccion(idss,idclass,seccion='.seccion_',idcita='') {

		$.get(`/cita/get_ps/${idss}/${idcita}`  , function (data) {
			if(data.jsontxt.estado=='success'){
				$(`${seccion}${idclass}`).html(' ');
				
		   		$(`${seccion}${idclass}`).html(data.request);
		   		$('.select2').select2();
		   		// seteo valor cargado a la session
		   		$(`${seccion}${idclass}`).val(1);
		   	}

		   		// $(`.seccion_${idclass}`).html(data);
	 		
		}).fail(function (data) {
			console.log(data);
		    // var data = data.responseJSON;
		    // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
		});
}

// funcion para procesar calculo
function calculo_resultado(idp1,idp2,idr) {
	var dato1= $(`#${idp1}`).val();
	var dato2= $(`#${idp2}`).val();

	var imc= dato1 / (dato2 * dato2);
	imc=imc.toFixed(1);
	
	$(`#${idr}`).val(imc);


}

// para mostrar si tienen sub prungas 
function sub_pregunta(class_ ,idp) {
	$('.'+class_).removeClass('d-none');
		$(`.${class_}`).html(' ');
	$.get("/cita/get_pregunta/" +idp , function (data) {
	   
		if(data.jsontxt.estado=='success'){
			$(`.${class_}`).html(data.request);
	   		$('.select2').select2();
	   	}
			
	}).fail(function (data) {
		console.log(data);
	});
}

// para ocultar sub seccion
function sub_pregunta_hide(class_) {
	$('.'+class_).addClass('d-none');
}

