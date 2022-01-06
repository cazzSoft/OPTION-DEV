//evento para habilitar la modal para registrar caso
$('#btn_casos').click(function () {
	$('#modal_caso_ex').modal('show');
});

//funcio para obtener los datos del caso
var idcaso;
function get_caso(idc,ste) {
	idcaso=idc;
	// var con=$(ste).children('span').html();
	$.get("/gestion/caso/" + idc +'/edit', function (data) {
	    
	   //datos de la modal de articulos edit
 		$('#titulo_').val(data.request.titulo);
 		$('#descripcion_').val(data.request.descripcion);
 		$('#url_video_').val(data.request.url_video);
 		$('#afecta_desc_').val(data.request.afecta_desc);
 		$('#edad_inicial_').val(data.request.edad_inicial);
 		$('#edad_final_').val(data.request.edad_final);
 		$('#sintoma_').val(data.request.sintoma);
 		$('#causas_').val(data.request.causas);
 		$('#tratamiento_').val(data.request.tratamiento);
 		$('#diagnostico_').val(data.request.diagnostico);
 		$('#medico_visitado_').val(data.request.medico_visitado);
 		//abrir modal edit articulo	
	   	 $('#modal_caso_ex_edit').modal('show');
	
	}).fail(function (data) {
	    var data = data.responseJSON;
	    mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
	});
}

//registro de casos excepcionales
$("#form_caso").on("submit", function (e) {
    e.preventDefault();

       $.ajaxSetup({
           headers: {
               "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
           },
       }); 
       
       var FrmData = {
           descripcion: $("#descripcion").val(),
           titulo: $("#titulo").val(),
           url_video: $("#url_video").val(),
           afecta_desc: $("#afecta_desc").val(),
           edad_inicial: $("#edad_inicial").val(),
           edad_final: $("#edad_final").val(),
           sintoma: $("#sintoma").val(),
           causas: $("#causas").val(),
           tratamiento: $("#tratamiento").val(),
           diagnostico: $("#diagnostico").val(),
           medico_visitado: $("#medico_visitado").val(),
       };

    	$.ajax({
    	    url: "/gestion/caso", 
    	    method: "POST", 
    	    data: FrmData, 
    	    dataType: "json",
    	    success: function (data) {
    	        // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
    	        if(data.jsontxt.estado=='success'){
	        	   	Swal.fire({
	        			title: 'Guardado correctamente',
	        		    text: "¡Te informamos que tu caso excepcional paso a un proceso de verificación.! Una vez validada la información se mostrar en la lista de casos.",
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

//actulizar caso
$("#form_caso_ac").on("submit", function (e) {
    e.preventDefault();

       $.ajaxSetup({
           headers: {
               "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
           },
       }); 
       
       var FrmData = {
           descripcion: $("#descripcion_").val(),
           titulo: $("#titulo_").val(),
           url_video: $("#url_video_").val(),
           afecta_desc: $("#afecta_desc_").val(),
           edad_inicial: $("#edad_inicial_").val(),
           edad_final: $("#edad_final_").val(),
           sintoma: $("#sintoma_").val(),
           causas: $("#causas_").val(),
           tratamiento: $("#tratamiento_").val(),
           diagnostico: $("#diagnostico_").val(),
           medico_visitado: $("#medico_visitado_").val(),
       };

    	$.ajax({
    	    url: "/gestion/caso/"+idcaso, 
    	    method: "PUT", 
    	    data: FrmData, 
    	    dataType: "json",
    	    success: function (data) {
    	        // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
    	        if(data.jsontxt.estado=='success'){
	        	   	Swal.fire({
	        			title: 'Actualizado correctamente',
	        		    text: "¡Los datos fueron actualizado correctamente¡",
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


////////////GESTIÓN DE COMENTARIOS//////////////////
	//evento para habilitar coment
	var crt=0;
	$('#btn_coment').click(function (e) {
		if(crt==0){
			console.log(0);
			$('.f_coment').removeClass('d-none');
			crt=1;	
		}else{
			console.log(1);
			$('.f_coment').addClass('d-none');
			crt=0;
		}	
	});

	

	//registro de comentarios 
	$('#form_coment').on("submit",function (e) {
		e.preventDefault();
		var n_coment=$('#t_coment').html();
		$.ajaxSetup({
		   headers: {
		       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		   },
		}); 
		var FrmData = {
		        comentario: $("#comentario").val(),
		        idart:$("#idart").val()
		    };

		$.ajax({
		    url: "/gestion/coment", 
		    method: "POST", 
		    data: FrmData, 
		    dataType: "json",
		    success: function (data) {
		        // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
		        if(data.jsontxt.estado=='success'){
		        	//creamos el comentario
		        	var new_coment=coment(data);
					//agregamos comentario 
					$('#list_comets').append(new_coment);
					$("#comentario").val("");
					$('.f_coment').addClass('d-none');
					$('#t_coment').html(parseInt(n_coment)+1);
					crt=0;
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

	//funcion para construir el coment
	function coment(data) {

		//formato de fecha
		const date = new Date(data.request.created_at);
		const months = ["ene", "feb", "mar","apr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "dic"];
		const formatDate = (date)=>{
		    let formatted_date = date.getDate() + " de " + months[date.getMonth()] + ". de " + date.getFullYear() + " "+date.getHours() +":"+date.getMinutes()
		    return formatted_date;
		}

		//construcción del comentario
		var coment=`<div class="card-comment">
	                  <img class="img-circle img-sm" src="${data.request['usuario'][0]['img']}" alt="User Image">
	                  <div class="comment-text">
	                    <span class="username">
	                      ${data.request['usuario'][0]['name']}
	                      <span class="badge  btn badge-light float-right rounded text-primwary mr-1 border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                        <i class="fa fa-ellipsis-h"></i>  
	                      </span>
	                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
	                        <a class="dropdown-item cursor" onclick="edit_coment('${data.request.idaportaciones_encryp}',this)"> editar</a>
	                        <a class="dropdown-item cursor" onclick="delete_coment('${data.request.idaportaciones_encryp}',this)"> eliminar</a>
	                      </div>
	                    </span>
	                    <small class="users-list-date ">${formatDate(date)}</small>
	                     <p class="input_coment">${data.request.comentario}</p> 
	                  </div>
	                </div>`;
		return coment;
	}

	//funcion para habilitar edit comentario
	function edit_coment(idc,est) {
		
		//obteniendo contenido de coment
		var come=$(est).parents('.comment-text').find('.input_coment');
		var n_coment=$('#t_coment').html();
		//preparando input edit
		var input=`<form id="form_coment_" >  
						<input type="text" id="comentario_" class="form-control form-control-sm" name="comentario_" value="${come.html()}" placeholder="Press enter to post comment">
					</form>`;
		
		//asignamos el input edit coment
		come.html(input);

		//evento para actulizar coment
		$('#form_coment_').on("submit",function (e) {
			e.preventDefault();
			$.ajaxSetup({
			   headers: {
			       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
			   },
			}); 
			var FrmData = {
			        comentario: $("#comentario_").val(),
			        idart:$("#idart").val()
			    };
			$.ajax({
			    url: "/gestion/coment/"+idc, 
			    method: "PUT", 
			    data: FrmData, 
			    dataType: "json",
			    success: function (data) {
			        if(data.jsontxt.estado=='success'){
			        	//creamos el comentario
			        	if(FrmData.comentario!=""){
			        		come.html(FrmData.comentario);
			        	}else{
			        		$(est).parents('.card-comment').remove();
			        		$('#t_coment').html(parseInt(n_coment)-1);
			        			
			        	}
			        	
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
	}

	//funcion para eliminar comentario
	function delete_coment(idc,est) {
		var n_coment=$('#t_coment').html();
		$.ajaxSetup({
		   headers: {
		       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		   },
		}); 
		$.ajax({
		    url: "/gestion/coment/"+idc, 
		    method: "DELETE", 
		    dataType: "json",
		    success: function (data) {
		        if(data.jsontxt.estado=='success'){
		        	$(est).parents('.card-comment').remove();
		        	$('#t_coment').html(parseInt(n_coment)-1);
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
	}
	
	


////////////GESTIÓN DE COMENTARIOS FIN//////////////////