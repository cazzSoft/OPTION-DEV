var idagenda='';
// inicializacion del select
	$(document).ready(function() {
	   $('.select2').select2();
	   idagenda=$(`#idcita_medica`).val();
	});

	// evento para obtener el focus de idcita
	$('#custom-tabs-paciente').click(function (e) {
		  idagenda=$(`#idcita_medica`).val();
	});
	$('#custom-tabs-historial').click(function (e) {
		  idagenda=$(`#idcita_medica_last`).val();
	});

// actualizacion de datos del paciente
	function obtener_datos_blur(este) {
		var idelement=$(este).prop('name');
		var dato=$(este).val();
		actulizar_datos_paciente(dato,idelement,$('#idp').val(),este,'blur');
	}
	function obtener_datos_change(este) {
		var idelement=$(este).prop('name');
		var dato=$(este).val();
		actulizar_datos_paciente(dato,idelement,$('#idp').val(),este);
	}

// funcion para actualizar datos
	function actulizar_datos_paciente(data, campo, idp,este='',tipo_m='') {
		if(data.length==0){
			sweetalert('El campo esta vacío ', 'error');
			return 0;
		}
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
		    	 	$('.edad').html(data.jsontxt.edad);
		    	 	if(tipo_m=='blur'){
		    	 		$(este).addClass('is-valid');
		    	 	}else{
		    	 		sweetalert(data.jsontxt.msm, data.jsontxt.estado);
		    	 	}
		    	 }
		     
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
		    },
		});

	}

function atenuarView() {
	$('.atenuar-datos').addClass('overlay');
    			$('.atenuar-datos').html(`<div class="spinner-grow text-info " style="width: 3rem; height: 3rem;" role="status"></div>
    		            		<span class="visually-hidden text-muted">Espere...</span>`);
}

// evento para validar cita_medica
	$('#form_cita_medica').on("submit", function (e) {
    	 $("#basic-form_cita_medica").validate();
    	
    	try {
    			$('.atenuar-datos').addClass('overlay');
    			$('.atenuar-datos').html(`<div class="spinner-grow text-info " style="width: 3rem; height: 3rem;" role="status"></div>
    		   <span class="visually-hidden text-muted">Espere...</span>`);
    		var eje= document.all["form_cita_medica"].submit();
    	
    	} catch (exception) {
    	  	console.log('error');
    	}
   });

   // evento para actulizar historial medico
	$('#btn_historial').click(function (e) {
    	 var FrmData = {
    	       diagnostico_presuntivo: $("#diagnostico_presuntivo_h").val(),
    	       motivo_cita:$("#motivo_cita_h").val(),
    	     };
    	$.ajaxSetup({
    	       headers: {
    	           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    	       },
    	}); 
    	var ruta=$('#form_cita_medica_historial').prop('action');
	   $.ajax({
	    	    url: ruta, 
	    	    method: "PUT", 
	    	    data: FrmData, 
	    	    dataType: "json",
	    	    success: function (data) {
	    	      sweetalert(data.jsontxt.msm, data.jsontxt.estado);
	    	    },

	    	    error: function (data) {
	    	      var statusText = data.statusText;
	    	      var data = data.responseJSON;
		   		if (statusText == "Not Implemented") {
		   		    //error 501
		   		    $.each(data.request, function (i, item) {
		   		        mostrar_toastr(item, data.jsontxt.estado);
		   		    });
		   		}else{
		   			 sweetalert(data.jsontxt.msm, data.jsontxt.estado);
		   		}
	    	    },
	   });
   });



// funcion para guardar pregunta en la cita
   function save_pregunta_cita(idc,idp,ids,este='') {
		
   	$.ajaxSetup({
           headers: {
               "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
           },
      }); 
   	
   	if($(este).val().length==0){
   		return 0;
   	}
   	
   	var FrmData = {
   	 	valor: $(este).val(),
   	 	// valor: $(`#${idc}`).val(),
   	 	idp: idp,
   	 	ids: ids,
   	 	idagenda:idagenda
   	};
		
     	$.ajax({
     	    url: "/cita/savePreguntas", 
     	    method: "POST", 
     	    data: FrmData, 
     	    dataType: "json",
     	    success: function (data) {
     	      console.log(data); 
     	      sweetalert(data.jsontxt.msm, data.jsontxt.estado);
     	      console.log(FrmData); 
     	    },
     	    error: function (data) {
     	    	 
     	      var statusText = data.statusText;
     	      var data = data.responseJSON;
     	        
     	         if (statusText == "Not Implemented") {
     	             //error 501
     	             $.each(data.request, function (i, item) {
     	                 mostrar_toastr(item, data.jsontxt.estado);
     	             });
     	         }else{
     	         	 sweetalert(data.jsontxt.msm, data.jsontxt.estado);
     	         }
     	    },
     	});

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

// funcion para abrir imagen el biblioteca
	function showModal(doc,title,ext){
		
	  $('#modal-image-content').html(" "); 
	  if(ext=='pdf'){
				contenido=`<embed src="${doc}" width="100%" height="770" 
		 						type="application/pdf">`;
				$('#modal-image-content').html(`
					  	<div class="row">
					  		<div class="col-md-12  text-center">
					  			<small class="text-info">${title}</small>
					  			<div id='contenedor_doc' class="text-center "> 
					  				${contenido}
					  			</div>
					  		</div>
						  	<div class="row m-auto">
						  	 	<div class="col-4 ml-2"><button id="close" class="btn btn-info btn-sm ">Cerrar</button></div>
						  	  </div>
					  	</div>
				`);
	  }else{
	  		$('#modal-image-content').html(`
			  	<div class="row">
			  		<div class="col-md-12  text-center">
			  			<small class="text-info">${title}</small>
			  			<div id='contenedor_img' class="text-center "> 
			  				<img src="${doc}" class="modal-content-img " id="img_exa" GFG="250">
			  			</div>
			  		</div>
				  	<div class="row m-auto">
				  	 	<div class="col-4 ml-2"><button id="close" class="btn btn-info btn-sm ">Cerrar</button></div>
				  	  	<div class="col-2"><button id="zoom-in" onclick="zoomin()" class=" btn btn-info btn-sm" > <i class="fas fa-search-plus text-light"></i></button></div>
				  	  	<div class="col-2"><button  onclick="zoomout()" class=" btn btn-info btn-sm"> <i class="fas fa-search-minus text-light"></i></button></div>
				  	</div>
			  	</div>
			`);
	  }
	  

	  var modal = document.getElementById('modalImage');
	  var close = document.getElementById('close');
	  var img = document.getElementById('img');

	  modal.style.display = "flex";
	  modal.style.flexDirection = "column";
	  modal.style.justifyContent = "center";
	  modal.style.alignItems = "center";
	  modal.style.alignContent = "center";

	  close.addEventListener('click', hideModal);
	  modal.addEventListener('click', hideModal);
	  document.addEventListener('keydown', hideModal);

	  function hideModal(e){
	      e.stopPropagation();
	    // <!-- Si el evento fue lanzado por el modal (this) -->
	    if(e.target == this || e.key == 'Escape'){
	      modal.style.display = "none";
	      close.removeEventListener('click', hideModal);
	      modal.removeEventListener('click', hideModal);
	      document.removeEventListener('keydown', hideModal);
	    }
	  }
	  // RevisarImagenesRotas();
	}

	function zoomin() {
	    var GFG = document.getElementById("img_exa");
	    var currWidth = GFG.clientWidth;
	    GFG.style.width = (currWidth + 100) + "px";

	}
	
	
	function zoomout() {
        var GFG = document.getElementById("img_exa");
        var currWidth = GFG.clientWidth;
        GFG.style.width = (currWidth - 100) + "px";
    }
// historial pacientre

	function update_datos_p(this_) {
		var dato=$(this_).val();
		console.log(dato);
	}