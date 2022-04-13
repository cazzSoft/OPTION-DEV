
//funcion para previsualizar img user
$('#file-upload').change(function () {
	if (this.files && this.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      // Asignamos el atributo src a la tag de imagen
	      $('#preViewImg2').attr('src', e.target.result);
	      var img=$('#preViewImg2').prop('src');
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
function change(input) {
  
}

// El listener va asignado al input
$("#imagen").change(function() {
  readURL(this);
});

//evento para asginar input en la vista de preguntas de interes
function get_input(idt,ste) {
	$('.poner_input').html(" ");
	var con=$(ste).children('.poner_input').html(`
					<input class="custom-control-input" type="checkbox" id="idtema" value="${idt}" checked>
					<label for="idtema" class="custom-control-label"></label>
			`);
	
}

//evento para continuar el proceso al seleccionar un tema
$('#btn_sig').click(function (e) {
	var input=$('#idtema').val();
	if(typeof  input != 'undefined'){
		//se registra tema seleccionado
			$.ajaxSetup({
			    headers: {
			        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
			    },
			});
			var FrmData = {
        idtemas: $("#idtema").val(),
    	};
    	$.ajax({
	 	    url: "/interes", 
	 	    method: "POST", 
	 	    data: FrmData, 
	 	    dataType: "json",
	 	    success: function (data) {
	 	    	console.log(data.jsontxt.estado);
	 	    	if(data.jsontxt.estado=='success'){
	 	    			window.location.href = "/home";
	 	    	}
 	      
 	    	},
 	    	error: function (data) {
 	        var statusText = data.statusText;
 	        var data = data.responseJSON;
 	        if (statusText == "Not Implemented") {
 	            //error 501
 	           alert(data.jsontxt.msm);
 	        } else {
 	            // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
 	            alert(data.jsontxt.msm);
 	        }
 	       
 	      },
 			});
	}else{
			Swal.fire({
  				title: 'Por favor, verifica tus datos',
  		    text: "¡Por favor verifica que tengas al menos 1 tema seleccionado!",
  		    icon: 'error', //question ,info, warning, success, error
  		    showCancelButton: false,
  		});
	}
});


/////REGISTRO DE EVENTO HISTORIAL USER//////////////

$('#btnOmitir').click(function (e) {
		//se llama para insertar el evento de Ver mas
    $.get("/actividades/Preguntasomitir/", function (data) {
        	window.location.href = "/home";
       
    }).fail(function(data){
       console.log(data);
    });
		
});


function acctionVermasdd(idar) {
    
}

//evento para ingresar por email
$('#btn_ingreso_email').click(function (e) {
		//ocultar botones sociales
		$('.btn_sociales').addClass('d-none');
		//mostrar form login email
		$('.form_login').removeClass('d-none');

		
});

//evento para mostrar registro paciente
$('.btn_registrate').click(function (e) {
		//ocultar botones sociales
		$('.btn_sociales').addClass('d-none');
		//mostrar form login email
		$('.form_login').addClass('d-none');
		$('.form_register').removeClass('d-none');

		

		$('.alertError').remove();
		$('#email').removeClass('is-invalid');

		//para cambiar el icono al cambiar al form registrarse
		let usert = document.querySelector('.btn_registrate').dataset.user;
		if(usert=='P'){
				$('.txt_log').html('<i class="fas fa-user-plus"></i> '+txt_tit);
		}
		if(usert=='M'){
				$('.txt_log').html('<i class="fa fa-user-md"></i> '+txt_tit);
		}
		if(usert=='E'){
				$('.txt_log').html('<i class="fas fa-briefcase-medical"></i> '+txt_tit);
		}
	
});



