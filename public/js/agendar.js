
 var url=window.location.protocol+'//'+window.location.host;
 
 	// iniciar funciones o eventos
 $(function () {
 		$('.select2').select2();

 		$('#datepicker').datepicker({
    	    language: "es",
	       	inline: true,
	       	format: 'yyyy-mm-dd',
	       	todayBtn: false
    });

 		// evento mini calendar
    $('#datepicker').on('changeDate', function() {
	    $('#fecha_calendar').val(
	      $('#datepicker').datepicker('getFormattedDate')    	    	 
	    );

	    $.get("/agenda/horario_cita/"+$('#fecha_calendar').val(), function (data) {
	        $('.cal_msm').html('');
	        $('.seccion_horarios').html('');
	        $('.seccion_horarios').html(data.request);
	        console.log(data);
	    }).fail(function (data) {
	        var data = data.responseJSON;
	        // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
	        $('.seccion_horarios').html('');
	        $('.cal_msm').html(`
	        		<div class="col-md-8 col-sm-12 m-auto text-center ">
	        			 <img class="img_gris text-center mt-5 p-2" src="${url}/img/o2h_gris.png" alt="img_o2h">	
	        		</div>
	        		<div class="col-md-6 col-sm-12 text-center m-auto p-2 ">
	        			 <p class="font-msm ">
	        			 	${data.jsontxt.msm}
	        			 </p>
	        		</div>	
	        `);
	    });

    });

 });

 	

  // BS-Stepper Init
 	document.addEventListener('DOMContentLoaded', function () {
 	  window.stepper = new Stepper(document.querySelector('.bs-stepper'))
 	})
 	
   

// actualizacion de datos del paciente
	$('#name').blur(function(e){
		var dato=$('#name').val();
		function_update(dato,'name',$('#idp').val());
	});

	$('#cedula').blur(function(e){
		var dato=$('#cedula').val();
		function_update(dato,'cedula',$('#idp').val());
	});

	
	$('#apellido').blur(function(e){
		var dato=$('#apellido').val();
		function_update(dato,'apellido',$('#idp').val());
	});
	
	$('#edad').keyup(function(e){
		var dato=$('#edad').val();
		if(dato!="" && dato.length!=0){
			$('#edad').addClass('is-valid');
			$('#edad').removeClass('is-invalid');
		}else{
			$('#edad').addClass('is-invalid');
			$('#edad').removeClass('is-valid');
		}
	});

	$('#sexo').change(function(e){
		var dato=$('#sexo').val();
		function_update(dato,'sexo',$('#idp').val());
	});
	
	// datos medicos de la seccion de usuarios
	$('#peso').keyup(function(e){
		var dato=$('#peso').val();
		if(dato!=0 && dato!=" "){
			function_update_dm(dato,'peso',$('#idp').val());
		}else{
			$('#peso').addClass('is-invalid');
		}
		
	});

	$('#talla').keyup(function(e){
		var dato=$('#talla').val();
		var lg= dato.length;
		if(dato!=0 && dato!=" " && dato >1){
			function_update_dm(dato,'talla',$('#idp').val());

		}else{
			$('#talla').addClass('is-invalid');
		}
	});


	

	// evento para activar el boton siguiente
	$('#name').keyup(function(e){
		var dato=$('#name').val();
		if( dato!=" "){
			siguiente();
			$('#name').removeClass('is-valid');
		}else{
			$('#name').addClass('is-invalid');
		}	
	});

	$('#apellido').keyup(function(e){
		var dato=$('#apellido').val();
		if( dato!=" "){
			siguiente();
			$('#apellido').removeClass('is-valid');
		}else{
			$('#apellido').addClass('is-invalid');
		}	
	});
	
	$('#edad').keyup(function(e){
		var dato=$('#edad').val();
		if( dato!=" "){
			siguiente();
			$('#edad').removeClass('is-valid');
		}else{
			$('#edad').addClass('is-invalid');
		}	
	});
	$('#cedula').keyup(function(e){
		var dato=$('#cedula').val();
		if( dato!=" "){
			siguiente();
			$('#cedula').removeClass('is-valid');
		}else{
			$('#cedula').addClass('is-invalid');
		}	
	});
	$('#detalle').keyup(function(e){
		var dato=$('#detalle').val();
		if( dato!=" "){
			siguiente();
			$('#detalle').removeClass('is-valid');
		}else{
			$('#detalle').addClass('is-invalid');
		}	
	});
	
	// $('#peso').keyup(function(e){
	// 	var dato=$('#peso').val();
	// 	if( dato!=" "){
	// 		siguiente();
	// 		$('#peso').removeClass('is-valid');
	// 	}else{
	// 		$('#peso').addClass('is-invalid');
	// 	}	
	// });

	// $('#talla').keyup(function(e){
	// 	var dato=$('#talla').val();
	// 	if( dato!=" "){
	// 		siguiente();
	// 		$('#talla').removeClass('is-valid');
	// 	}else{
	// 		$('#talla').addClass('is-invalid');
	// 	}	
	// });

	// funcion para actualizar datos generales
	function function_update(data, campo, idp) {
		
		if(data.length==0){
			$(`#${campo}`).addClass('is-invalid');
			return 0;
		}
		$(`#${campo}`).removeClass('is-invalid');
		$.ajaxSetup({
		    headers: {
		        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		    },
		});
		 var FrmData = {
	        valor:data,
	        campo:campo,
	        idp:idp
	     };

		$.ajax({
		    url: "/cita/pacienteUpdate", 
		    method: "POST", 
		    data: FrmData, 
		    dataType: "json",
		    success: function (data) {
		    	
		    	 if(data.jsontxt.estado=='success'){
		    	 	$(`#${campo}`).addClass('is-valid');
		    	 }
		      	
		      	siguiente()
		    },

		    error: function (data) {
		       var statusText = data.statusText;
		       var data = data.responseJSON;
		       if (statusText == "Not Implemented") {
		           //error 501
		           $.each(data.request, function (i, item) {
		           		
		               // mostrar_toastr(item+' y no puede estar vacío', data.jsontxt.estado,9000);
		               sweetalert(item+' y no puede estar vacío', data.jsontxt.estado);
		           });
		       } else {
		           mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);

		       }

		       siguiente();
		    },
		});

	}

	// funcion para actualizar datos medicos
	function function_update_dm(data, campo, idp) {
		
		if(data.length==0 && data==0){
			$(`#${campo}`).addClass('is-invalid');
			return 0;
		}
		$(`#${campo}`).removeClass('is-invalid');
		$.ajaxSetup({
		    headers: {
		        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		    },
		});
		 var FrmData = {
	        valor:data,
	        campo:campo,
	        idp:idp
	     };

		$.ajax({
		    url: "/cita/pacienteUpdate_dm", 
		    method: "POST", 
		    data: FrmData, 
		    dataType: "json",
		    success: function (data) {
		    	
		    	 if(data.jsontxt.estado=='success'){
		    	 	$(`#${campo}`).addClass('is-valid');
		    	 }
		    	 siguiente();
		      // sweetalert(data.jsontxt.msm, data.jsontxt.estado);
		    },

		    error: function (data) {
		       var statusText = data.statusText;
		       var data = data.responseJSON;
		       if (statusText == "Not Implemented") {
		           //error 501
		           $.each(data.request, function (i, item) {
		           		
		               // mostrar_toastr(item+' y no puede estar vacío', data.jsontxt.estado,9000);
		               sweetalert(item+' y no puede estar vacío', data.jsontxt.estado);
		           });
		       } else {
		           mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);

		       }
		       siguiente()
		    },
		});

	}


	// $("#form_cita_paciente").on("submit", function (e) {
	//     e.preventDefault();
	//     alert(123);
	//  });
	// evento para validar cita_medica
	$("#form_cita_paciente").on("submit", function (e) {
  		e.preventDefault();

		$.ajaxSetup({
		    headers: {
		        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		    },
		}); 
		
		var formData = new FormData(this);
			formData.append('idmedico', $('#idm').val());
			formData.append('fecha', $('#fecha_calendar').val());
			formData.append('detalle', $('#detalle').val());
			formData.append('horas', $('#hora_select').val());
			 
		if($('#img_examenes').val() === undefined){
			
		}else{
			$avatarInput = $('#img_examenes');
			
			var TotalImages = $('#img_examenes')[0].files.length; //Total Images
			var images = $('#img_examenes')[0];
			
			for (let i = 0; i < TotalImages; i++) {
				formData.append('img_examenes' + i, images.files[i]);
			}
			
			formData.append('TotalImages',TotalImages);
		}
		
		$('.atenuar-horarios').addClass('overlay');
		$('.atenuar-horarios').html(`<div class="spinner-grow text-info " style="width: 3rem; height: 3rem;" role="status"></div>
	            		<span class="visually-hidden text-muted">Espere...</span>`);
		document.getElementById(`btn_save_cita`).disabled = true;
  		$.ajax({
  		    url: "/agenda/save", 
  		    method: "POST", 
  		    data: formData, 
  		    cache:false,
  		    dataType: "json",
  		    processData: false,
        	contentType: false,

  		    success: function (data) {	
  		    	document.getElementById(`btn_save_cita`).disabled = false;
  		    		$('.atenuar-horarios').removeClass('overlay ');
  		    		$('.atenuar-horarios').html('');
  		    		if(data.jsontxt.estado=='success'){
  		    	  	
  		    	  	//ejecucion de mensaje de advertencia
  		    	  	  Swal.fire({
  		    	  	    title: 'Información Option2health',
  		    	  	    text: data.jsontxt.msm,
  		    	  	    icon: 'success', //question ,info, warning, success, error
  		    	  	    // showCancelButton: true,
  		    	  	    confirmButtonColor: '#0FADCE',
  		    	  	   
  		    	  	    confirmButtonText: 'Aceptar',
  		    	  	    
  		    	  	  }).then((result) => {
  		    	  	    if (result.isConfirmed) {
  		    	  	    	 window.location.href = `${url}/agenda/cita`;
  		    	  	    }
  		    	  	  }) 	
  		    	   		
  		    	   		
  		    		}else{
  		    			 sweetalert(data.jsontxt.msm, data.jsontxt.estado);
  		    		}
  		    },

  		    error: function (data) {
  		    	document.getElementById(`btn_save_cita`).disabled = false;
  		    	$('.atenuar-horarios').removeClass('overlay ');
  		    	$('.atenuar-horarios').html('');
  		       var statusText = data.statusText;
  		       var data = data.responseJSON;
  		       if (statusText == "Not Implemented") {
  		           //error 501
  		           $.each(data.request, function (i, item) {
  		           		
  		               // mostrar_toastr(item+' y no puede estar vacío', data.jsontxt.estado,9000);
  		               sweetalert(item, data.jsontxt.estado);
  		           });
  		       } else {
  		           mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);

  		       }
  		    },
  		});

  });

   
 	// funcion para avanzar en el registro agendamiento
 	function siguiente() {
 		
 			// if($('#detalle').val() != "" && $('#name').val() != "" && $('#apellido').val() != "" && $('#edad').val() != "" && $('#sexo').val() != "" && $('#peso').val() != "" && $('#talla').val() != "" && $('#talla').val() != "0" && $('#peso').val() != "0"){
 		if($('#detalle').val() != "" && $('#name').val() != "" && $('#apellido').val() != "" && $('#edad').val() != "" && $('#sexo').val() != "" &&  $('#cedula').val() != ""){
 			// stepper.next();
 			document.getElementById(`sig_cp`).disabled = false;
 			$('#sig_cp').removeClass('btn-secondary');
 			$('#sig_cp').attr('onclick','stepper.next()');
 			$('#sig_cp').addClass('btn-info');
 		}else{
 			document.getElementById(`sig_cp`).disabled = true;
 			$('#sig_cp').addClass('btn-secondary');
 			$('#sig_cp').removeClass('btn-info');
 		}
 		 
 	}

 
   // visualizar la img
   function previewImage(event, querySelector){

		//Recuperamos el input que desencadeno la acción
		const input = event.target;
		
		//Recuperamos la etiqueta img donde cargaremos la imagen
		$imgPreview = document.querySelector(querySelector);

		// Verificamos si existe una imagen seleccionada
		if(!input.files.length) return
		
		//Recuperamos el archivo subido
		file = input.files[0];

		//Creamos la url
		objectURL = URL.createObjectURL(file);
		
		//Modificamos el atributo src de la etiqueta img
		$imgPreview.src = objectURL;
	    
	   $('#imgPreview').removeClass('d-none');   	         
	}

	
	// funcion para seleccionar cita
	function select_cita(hora,idm,este) {
		$('.selected_').removeClass('selected_');
		$(este).addClass('selected_');
		$('#hora_select').val(hora);
		$('#idm').val(idm);
	
	}

	// evento para obtener name de file selected
	function processSelectedFiles(fileInput) {
	  var files = fileInput.files;
	   $('.list-file').html('');
	  for (var i = 0; i < files.length; i++) {
	   
	     $('.list-file').append(`<li><u>${files[i].name}</u></li>`);
	  }
	}