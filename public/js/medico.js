//variable globales para obtener direccion raiz del server
var url=window.location.protocol+'//'+window.location.host;

var idart;
var title='';
var embed='https://www.youtube.com/embed/';

//evento para redireccionar informacion medico
$('#btn_editArt').click(function () {
	window.location=url+"/medico/show";
});

$('#btn_addtArt').click(function () {

	//registro de evento add publicacion
	$.get("/actividades/eventMedicoPerfil", function (data) {
	    console.log(data);
	    window.location=url+"/gestion/articulo";
	}).fail(function(data){
	   console.log(data);
	});
	
});


//funcion para abrir modal del articulo editar y cargar informacion a la modal
function getModalInfo(idar,ste) {
	idart="";
	idart=idar;
	title=`title${ste}`;
	 
	//api par obtener dato del articulo
	 $.get("/gestion/articulo/" + idar +'/edit', function (data) {
	 		//datos de la modal de articulos edit
	 		$('#titulo').val(data.request.titulo);
	 		$('#descripcion').val(data.request.descripcion);
	 		$('#vinculo_art').val(data.request.vinculo_art);
	 		$('#url_video').val(data.request.url_video);
	 		$('#area_desc').val(data.request.area_desc);
	 		$('#afecta_desc').val(data.request.afecta_desc);
	 		$('#edad_inicial').val(data.request.edad_inicial);
	 		$('#edad_final').val(data.request.edad_final);
	 		$('#sintoma').val(data.request.sintoma);
	 		$('#causas').val(data.request.causas);
	 		$('#tratamiento').val(data.request.tratamiento);
	 		$('#diagnostico').val(data.request.diagnostico);
	 		$('#enfermedades').val(data.request.enfermedades);
	 	//abrir modal edit articulo	
	 	$('#modal_edit').modal('show');
	 }).fail(function (data) {
        var data = data.responseJSON;
        console.log(data);
         mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
    });		
}

//evento para actulizar datos del articulo en el modulo perfil medico
$("#form_art").on("submit", function (e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //se crea la data
    var FrmData = {
        
        descripcion: $("#descripcion").val(),
        titulo: $("#titulo").val(),
        vinculo_art: $("#vinculo_art").val(),
        url_video: $("#url_video").val(),
        area_desc: $("#area_desc").val(),
        afecta_desc: $("#afecta_desc").val(),
        edad_inicial: $("#edad_inicial").val(),
        edad_final: $("#edad_final").val(),
        sintoma: $("#sintoma").val(),
        causas: $("#causas").val(),
        tratamiento: $("#tratamiento").val(),
        diagnostico: $("#diagnostico").val(),
        enfermedades: $("#enfermedades").val(),
    };

 	$.ajax({
 	    url: "/gestion/articulo/"+idart, 
 	    method: "PUT", 
 	    data: FrmData, 
 	    dataType: "json",
 	    success: function (data) {

 	        mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
 	        if(data.jsontxt.estado=='success'){
 	        	$(`#${title}`).html(`<b>${FrmData['titulo']}</b>`)
 	        	limpiarFormArt();
 	        }	
 	        
 	       	$('#modal_edit').modal('hide');
 	    },

 	    error: function (data) {
 	        var statusText = data.statusText;
 	        var data = data.responseJSON;
 	        if (statusText == "Not Implemented") {
 	            //error 501
 	            $.each(data.request, function (i, item) {
 	                mostrar_toastr(item, data.jsontxt.estado);
 	            });
 	        } else {
 	            mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
 	        }

 	       
 	    },
 	});

});

//funcion para limpiar datos de modal
function limpiarFormArt() {
	$('#titulo').val("");
	$('#descripcion').val("");
	$('#vinculo_art').val("");
	$('#url_video').val("");
	$('#area_desc').val(" ");
	$('#afecta_desc').val("");
	$('#edad_inicial').val("");
	$('#edad_final').val("");
	$('#sintoma').val("");
	$('#tratamiento').val("");
	$('#diagnostico').val("");
	$('#enfermedades').val("");
	idart='';
	title='';
}

//:::::::::gestión para ingresar un articulo INICIO:::::::::::::::::::

	//validacion de cambos por medio del evento submit Principal
	$("#form_1").on("submit", function (e) {
		//validamos info
	    e.preventDefault();
	    //validar url
	    if(!validURL($('#vinculo_art').val())){
	     	$('#vinculo_art').val(" ");
	     	$('#vinculo_art').removeClass('is-invalid');
	    }

	    if($('#url_video').prop('class')=='form-control'){
	    	stepper.next();
	    }
	    return 0;
	});
	//validacion de cambos por medio del evento submit Complementaria
	$("#form_2").on("submit", function (e) {
		//validamos info
	    e.preventDefault();
	    //validar edades antes de pasar al siguiente
	    var edi=$('#edad_inicial').val();
		var edf=$('#edad_final').val();
	    if(edf!="" && edi!="" ){
			if(edi>edf && edf<edi ){
				$('#edad_final').addClass('is-invalid');
				return 0;
			}else if(edf<edi && edi>edf){
				$('#edad_inicial').addClass('is-invalid');
				return 0;
			}else{
				stepper.next();
			}
		}  
	});
	//validacion de cambos por medio del evento submit Complementaria Final y guardar todos los datos anteriores
	$("#form_3").on("submit", function (e) {
	    e.preventDefault();

	       $.ajaxSetup({
	           headers: {
	               "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
	           },
	       });
	       
	       var FrmData = {
	           descripcion: $("#descripcion").val(),
	           titulo: $("#titulo").val(),
	           vinculo_art: $("#vinculo_art").val(),
	           url_video: $("#url_video").val(),
	           area_desc: $("#area_desc").val(),
	           afecta_desc: $("#afecta_desc").val(),
	           edad_inicial: $("#edad_inicial").val(),
	           edad_final: $("#edad_final").val(),
	           sintoma: $("#sintoma").val(),
	           causas: $("#causas").val(),
	           tratamiento: $("#tratamiento").val(),
	           diagnostico: $("#diagnostico").val(),
	           enfermedades: $("#enfermedades").val(),
	       };

	    	$.ajax({
	    	    url: "/gestion/articulo", 
	    	    method: "POST", 
	    	    data: FrmData, 
	    	    dataType: "json",
	    	    success: function (data) {
	    	        // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
	    	        if(data.jsontxt.estado=='success'){
    	        	   	Swal.fire({
    	        			title: 'Guardado correctamente',
    	        		    text: "¡Te informamos que tu publicación paso a un proceso de verificación.! Una vez validada la información tendras acceso a publicarla.",
    	        		    icon: 'success', //question ,info, warning, success, error
    	        		    showCancelButton: false,
    	        		    confirmButtonColor: '#007bff',
    	        		    cancelButtonColor: '#dc3545',
    	        		    confirmButtonText: 'Aceptar',
    	        		}).then((result) => {
	        			    if (result.isConfirmed) {
	        			      location.reload();
	        			    }
    	        		});
	    	        }	
	    	    },

	    	    error: function (data) {
	    	        var statusText = data.statusText;
	    	        var data = data.responseJSON;
	    	        if (statusText == "Not Implemented") {
	    	            //error 501
	    	            $.each(data.request, function (i, item) {
	    	                mostrar_toastr(item, data.jsontxt.estado);
	    	            });
	    	        } else {
	    	            mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
	    	        }

	    	    },
	    	});
	   
	});



	//evento para validar url que sea url embed
	$('#url_video').blur(function(e) {

		var inpu=$('#url_video').val();
		if(validateURL_you(inpu)){
			$('#url_video').removeClass('is-invalid');
		}else{
			$('#url_video').addClass('is-invalid');
		}
	});
	//evento para validad url
	$('#vinculo_art').blur(function(e) {

		var inpu=$('#vinculo_art').val();
		if(validURL(inpu)){
			$('#vinculo_art').removeClass('is-invalid');
		}else{
			$('#vinculo_art').addClass('is-invalid');
		}
	});
	//validar url para videos
	function validateURL_you(textval) {
		const tx=textval.substr(0,30);
		if(tx==embed){
			return true;
		}else{
			return false;
		}
	}
	//validar url en general
	function validURL(str) {
	  var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
	    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
	    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
	    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
	    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
	    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
	  return !!pattern.test(str);
	}


	//evento para validar las edad inicial
	$('#edad_inicial').blur(function(e) {
		var edi=$('#edad_inicial').val();
		var edf=$('#edad_final').val();
		if(edf!=""){
			if(edi>edf && edf<edi ){
				$('#edad_final').addClass('is-invalid');
			}else{
				console.log('ed1 es menor ed2');
				$('#edad_final').removeClass('is-invalid');
			}
			if(edf<edi && edi>edf){
				$('#edad_inicial').addClass('is-invalid');
			}else{
				$('#edad_inicial').removeClass('is-invalid');
			}
		}
	});
	//evento para validar las edad final
	$('#edad_final').blur(function(e) {
		var edi=$('#edad_inicial').val();
		var edf=$('#edad_final').val();
		if(edi!=""){

			if(edf<edi && edi>edf){
				$('#edad_inicial').addClass('is-invalid');
				
			}else{
				$('#edad_inicial').removeClass('is-invalid');
			}
			if(edi>edf && edf<edi ){
				console.log('ed1 es mayor ed2');
				$('#edad_final').addClass('is-invalid');
			
			}else{
				console.log('ed1 es menor ed2');
				$('#edad_final').removeClass('is-invalid');
			}
		}
	});

	
	//funcion para publicar articulo 
	function confi_pub(idar,ste,pub) {
		//validar para mostrar mensaje adecuado
		if(pub==0){
			var tx=`¿Estás seguro que deseas publicar esta información?`;
			var des=`¡Te informamos  que todos los usuarios registrados en Option2health verán tu publicación!`;

		}else{
			var tx=`¿Estás seguro que deseas ocultar la publicación?`;
			var des=`¡Te informamos que los usuarios de Option2health no podrán ver esta información!`;
		}
		//token
		$.ajaxSetup({
		       headers: {
		           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		       },
		   });
		//mensaje de alerta
		Swal.fire({
		     title: `${tx}`,
		     text: `${des}`,
		     icon: 'question', //question ,info, warning, success, error
		     showCancelButton: true,
		     confirmButtonColor: '#007bff',
		     cancelButtonColor: '#dc3545',
		     confirmButtonText: 'Aceptar',
		     cancelButtonText: 'Canelar'
	   	}).then((result) => {
		    if (result.isConfirmed) {
    		    var FrmData = {
    		       id: idar,
    		    };
    			$.ajax({
    			    url: "/gestion/publicar", 
    			    method: "POST", 
    			    data: FrmData, 
    			    dataType: "json",
    			    success: function (data) {

    	    			var btn=`<button type="button" class="btn btn-sm ${data.request.clr}"
    	    	            	    onclick="confi_pub('${idar}', this,${data.request.p})">
    	    	    	       		<i class="${data.request.icon}"></i> ${data.request.txt}        
    	    	            	</button>`; 
    			        mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
    			        $(ste).parents('tr').find('td').eq(5).html(btn); 
    			    }, error: function (data) {
    			        var statusText = data.statusText;
    			        var data = data.responseJSON;
    			        if (statusText == "Not Implemented") {
    			            //error 501
    			            $.each(data.request, function (i, item) {
    			                mostrar_toastr(item, data.jsontxt.estado);
    			            });
    			        } else {
    			            mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
    			        } 
    			    },
    			});  
		    }
		});	 
	}



//:::::::::gestión para ingresar un articulo FIN:::::::::::::::::::	
var show=0;
//evento para mostrar formulario editar medico
$('#btn_action_m').click(function function_name(argument) {
	
	if(show==0){
		console.log(0);
	    $('.form_medic').removeClass('d-none');
	    $('.info_m').addClass('d-none');
	    $('#btn_action_m').html('<i class="fas fa-arrow-left text-ligth"></i>');
	    show=1;
	}else{
		console.log(1);
	    $('.form_medic').addClass('d-none');
	    $('.info_m').removeClass('d-none');
	    $('#btn_action_m').html('<i class="fas fa-pen-alt text-ligth"></i>');
	    show=0;
	}
});


//funcion para mostrar el menu del perfil medico 
function menu_perfil() {
	 document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
var controlDrop=0;
window.onclick = function(event) {

	if(controlDrop!=0){
		$('#myDropdown').removeClass('show');
		controlDrop=0;
		
	}else{
		
		controlDrop=1;
	}
	
	
}


//funcion para previsualizar img user
$('#file-upload').change(function () {
	
	if (this.files && this.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      // Asignamos el atributo src a la tag de imagen
	      $('#preViewImg').attr('src', e.target.result);
	      var img=$('#preViewImg').prop('src');
	     	// mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
    	    if(img){
	        	  Swal.fire({
	        			title: 'Aptualizacion de foto de perfil',
	        		    text: "Estas seguro que deseas ejecutar los cambios",
	        		    icon: 'question', //question ,info, warning, success, error
	        		    showCancelButton: true,
	        		    confirmButtonColor: '#13c6ef',
	        		    cancelButtonColor: '#cbcdcd',
	        		    cancelButtonText: 'Abortar',
	        		    confirmButtonText: 'Aceptar',
	        		}).then((result) => {
        			    if (result.isConfirmed) {
        			    	 $('#update_img_perfil').submit();
        			      
        			    }
	        		});
    	     }	
	    }
    	reader.readAsDataURL(this.files[0]);

  	}
});

//funcion para previsualizar img user portada
$('#file2').change(function () {
	
	if (this.files && this.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      // Asignamos el atributo src a la tag de imagen
	      $('#preViewPortada').attr('style', `background: url('${e.target.result}') center center;`);
	      // var img=$('#preViewImg').prop('src');
	     	// mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
    	    if(e.target.result){
	        	  Swal.fire({
	        			title: 'Aptualizacion de foto de portada',
	        		    text: "Estas seguro que deseas ejecutar los cambios",
	        		    icon: 'question', //question ,info, warning, success, error
	        		    showCancelButton: true,
	        		    confirmButtonColor: '#13c6ef',
	        		    cancelButtonColor: '#cbcdcd',
	        		    cancelButtonText: 'Abortar',
	        		    confirmButtonText: 'Aceptar',
	        		}).then((result) => {
        			    if (result.isConfirmed) {
        			    	 $('#update_img_portada').submit();
        			      
        			    }
	        		});
    	     }	
	    }
    	reader.readAsDataURL(this.files[0]);

  	}
});