//evento para abrir modal visor de archivos
function visor_show(tipo,contenido,titulo) {
	$('#contenido').html(" ");
	$('#txtTitulo').html(`<i class="far fa-file"></i> ${titulo} `);
	console.log(contenido); 
	if(tipo=='IMG'){
		contenido=` <img class="product-image img-fluid mb-3" src="${contenido}" alt="img">`;
		$('#contenido').html(contenido);
	}else{
		contenido=`<embed src="${contenido}" width="100%" height="770" 
 						type="application/pdf">`;
		$('#contenido').html(contenido); 
	}

	$('#modal-visor').modal('show');
}

//eliminara archivo
function btn_eliminar_archivo(btn){
  //ejecucion de mensaje de advertencia
    Swal.fire({
      title: '¿Quiere eliminar el registro?',
      text: "¡Recuerda que no podrás revertir los cambios!",
      icon: 'question', //question ,info, warning, success, error
      showCancelButton: true,
      confirmButtonColor: '#007bff',
      cancelButtonColor: '#dc3545',
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Canelar'
    }).then((result) => {
      if (result.isConfirmed) {
          $(btn).parents('.frm_eliminar').submit();
      }
    })
}

//obtener datos del archivo 
function editar_archivo(id) {
	$.get("/biblioteca/show/" + id +'/edit', function (data) {
	    console.log(data);
 		$('#titulo').val(data.request.titulo);
 		$('#descripcion').val(data.request.descripcion);
 		$('#file_txt').val(data.request.ruta);
 		$("#idespecialidades").val(data.request.idespecialidades).trigger("change");
 		
 		$('.file_txt').removeClass('d-none');
 		$('.file_img').addClass('d-none');
		$('#method_bibli').val('PUT'); // decimo que sea un metodo put Actualizar
		$('#for_archivo').attr('action','/biblioteca/show/'+id);
		$('#btnsave').html(`<i class="fa fa-save"></i> Actualizar`); // cambiamos nombre del boton

	}).fail(function (data) {
	    var data = data.responseJSON;
	    mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
	});
}

 $('#btn_cancelar').click(function(){
    $('#descripcion').val('');
    $('#titulo').val('');
    $('#idespecialidades').val(null).trigger('change');
		$('#file_txt').val("");
		$('#img').val("");
		$('.file_txt').addClass('d-none');
 		$('.file_img').removeClass('d-none');
    $('#method_bibli').val('POST');
    $('#for_archivo').attr('action','/biblioteca/show'); // agregamos la ruta post (ruta por defecto)
    $('#btnsave').html(`<i class="fa fa-save"></i> Guardar`);
});

 //habilitar input file
 function addinputFile() {
 	  $('.file_txt').addClass('d-none');
 		$('.file_img').removeClass('d-none');
 		$('.icon-input').removeClass('d-none');
 }
function minusInputFile() {
	
	$('.file_txt').removeClass('d-none');
	$('.file_img').addClass('d-none');
 	$('.icon-input').addClass('d-none');
}


//////////////////////funciones del menu show biblioteca ///////////////////

//variable globales para obtener direccion raiz del server
var url=window.location.protocol+'//'+window.location.host;

//obtener archivo especialidad
$('#idespecialidades_filtro').change( function () {
	var id=$('#idespecialidades_filtro').val();
	$.get("/biblioteca/show/" + id , function (data) {
	    var div_class=$('#contetResulFiltro').children('div').prop('class');
	    if(div_class===undefined){
	    		div_class='col text-center m-auto ';
	    }
	    
 			mostrarArchivosFiltro(data.request,div_class);
	  

	}).fail(function (data) {
	    var data = data.responseJSON;
	    mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
	});
});

//funcion para mostrar resultado del filtro y del search
function mostrarArchivosFiltro(data,div_class) {
	$('#contetResulFiltro').html("");

	

	$.each(data, function (i, item) { 
		let titulo = item['titulo'].substring(0, 27);
		if(item['tipo']=='IMG'){
			var con=`
					<img class="card-img-top objetfit btn btn-outline-light p-0" src="${item['ruta']}" alt="Card image "  onclick="showModal('${item['ruta']}','${item['titulo']}')">
					<div class="card-footer text-muted p-2">
					    <a href="${item['ruta']}" onclick="eventDocumeto('${item['idbibliotecavirtual_encryp']}')" target="_blank" class="mailbox-attachment-size text-muted clearfix"><i class="fas fa-camera"></i> ${titulo}</a>
					  <span class="mailbox-attachment-size clearfix mt-0 ">
					    <span>${item['especialidad']['descripcion']}</span>
					    <a href="${item['ruta']}" download="proposed_file_name" class="btn bgz-info btn-sm float-right"><i class="fas fa-cloud-download-alt "></i></a>
					  </span>
					</div>`;
			
		}else{
			var con=`
				<a href="${item['ruta']}" onclick="eventDocumeto('${item['idbibliotecavirtual_encryp']}')" target="_blank" class=" btn fa-i">
				  <span class="mailbox-attachment-icon mb-2"><i class="far fa-file-pdf fa-2x"></i></span>
				</a>
				
				<div class="card-footer mt-2 p-2">
				    <a href="${item['ruta']}" onclick="eventDocumeto('${item['idbibliotecavirtual_encryp']}')" target="_blank" class="mailbox-attachment-size text-muted "><i class="fas fa-paperclip"></i> ${titulo}.pdf</a>
				    <span class="mailbox-attachment-size clearfix mt-0">
				      <span>${item['especialidad']['descripcion']}</span>
				      <a href="${item['ruta']}" download="proposed_file_name" class="btn bgz-info btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
				    </span>
				</div>
				
			`;
		}

		var items=`
			<div class="${div_class}">
			    <div class="card " >
			      ${con}
			    </div>
			</div>

			
		`;


		$('#contetResulFiltro').append(items);
	});
}

$("#form_search_filtro").on("submit", function (e) {
    e.preventDefault();
     var FrmData = {
           id: $("#idespecialidades_filtro").val(),
           value:$("#search_archivo").val(),
         };
    $.ajaxSetup({
           headers: {
               "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
           },
    }); 
    $.ajax({
    	    url: "/biblioteca/search", 
    	    method: "POST", 
    	    data: FrmData, 
    	    dataType: "json",
    	    success: function (data) {
    	       // console.log($('#contetResulFiltro').children('div').prop('class'));
    	       var div_class=$('#contetResulFiltro').children('div').prop('class');
    	       if(div_class===undefined){
    	       		div_class='col text-center m-auto ';
    	       }
    	      	mostrarArchivosFiltro(data.request,div_class);

    	    },

    	    error: function (data) {
    	        var statusText = data.statusText;
    	        var data = data.responseJSON;
	   					mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)

    	    },
    	});	
 });


//evento de biblioteca virtual
function eventDocumeto(id) {
 $.get("/actividades/eventDocumentBiblioteca/"+id, function (data) {
      console.log(data);
  }).fail(function(data){
     console.log(data);
  });
}

// funcion para descargar archivos
function downloade(ste,id) {
		 
		var doc= window.location.href = url+'/biblioteca/download_documento/'+id;
		$(ste).html(` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`);
		 fetch(doc)
		   .then(resp => resp.blob())
		   .then(blob => {
		    
		   	$(ste).html(`<i class="fas fa-cloud-download-alt"></i>`);
		 }).catch(() => alert('oh no!'));
}

// funcion para abrir imagen el biblioteca
function showModal(doc,titulo){
	console.log(doc);
  $('#modal-image-content').html(" ");
  $('#modal-image-content').html(`<img src="${doc}" class="modal-content-img img-fluid"> <div class="modal-nav">
  <button id="close" class="btn btn-info btn-sm mt-3">Cerrar</button>
  </div>`);

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
}


