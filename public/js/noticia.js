//evento para abrir modal visor de archivos
function visor_show_nt(contenido,titulo) {
	$('#contenido').html(" ");
	$('#txtTitulo').html(`<i class="far fa-image"></i> ${titulo} `);
	
	contenido=` <img class="product-image img-fluid mb-3" src="${contenido}" alt="img">`;
	$('#contenido').html(contenido);
	
	$('#modal-visor').modal('show');
}

//eliminara archivo
function btn_eliminar_archivo_nt(btn){
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
          $(btn).parents('.frm_eliminar_nt').submit();
      }
    })
}
//evento para controlar el collase del formulario
var collapse=0;
$('#collapse_form').click(function (e) {
	// var collapse=0;
	if(collapse==1){
		collapse=0;
	}else{
		collapse=1;
	}
	//obtener ultimo orden para mostrar
	if($('#orden').val()==""){
		$.get("/noticia/lastOrden/", function (data) {
			$('#orden').val(data.request);
		});
	}
	
});

//obtener datos del archivo 
function editar_archivo_nt(id) {

	//control del collapse
	if(collapse==0){
		$('.card-control').CardWidget('toggle');
		collapse=1;
	}else{
		collapse=1;
	}
	
	$.get("/noticia/new/" + id +'/edit', function (data) {
	   console.log(data);
 		$('#titulo').val(data.request.titulo);
 		$('#descripcion').val(data.request.descripcion);
 		$('#autor').val(data.request.autor);
 		$('#orden').val(data.request.orden);
 		$('#fuente').val(data.request.fuente);
 		$('#file_txt').val(data.request.img);
 		$("#idespecialidades").val(data.request.idespecialidades).trigger("change");
 		$("#estado").val(data.request.estado).trigger("change");
 		
 		$('.file_txt').removeClass('d-none');
 		$('.file_img').addClass('d-none');
		$('#method_noticia').val('PUT'); // decimo que sea un metodo put Actualizar
		$('#for_noticia').attr('action','/noticia/new/'+id);
		$('#btnsave').html(`<i class="fa fa-save"></i> Actualizar`); // cambiamos nombre del boton

		
		// $('.card-control').removeClass('collapsed-card');
		$('.fas-control').removeClass('fa-plus');
		$('.fas-control').addClass('fa-minus');
	}).fail(function (data) {
	    var data = data.responseJSON;
	    mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
	});
}

 $('#btn_cancelar').click(function(){
    $('#descripcion').val('');
    $('#titulo').val('');
    $('#orden').val('');
    $('#autor').val('');
 		$('#fuente').val('');
    $('#idespecialidades').val(null).trigger('change');
    $('#estado').val(null).trigger('change');
		$('#file_txt').val("");
		$('#img').val("");
		$('.file_txt').addClass('d-none');
 		$('.file_img').removeClass('d-none');
    $('#method_noticia').val('POST');
    $('#for_noticia').attr('action','/noticia/new'); // agregamos la ruta post (ruta por defecto)
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


// funciones para cambiar estado de la noticia
function aprobar_nt(id,std,col) {
		$.get(`/noticia/estadoNoticia/${id}/${std}`, function (data) {
			console.log(data); 
			$(col).parents('tr').find('td').eq(5).html(`${data.request.text}`);
			$(col).attr('onclick',`aprobar_nt('${id}','${data.request.valor}',this)`);
			$(col).html(`${data.request.txt_btn}`);
			mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
		}).fail(function (data) {
		    var data = data.responseJSON;
		    mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
		});
}

//////////////////////funciones del menu show biblioteca ///////////////////

//variable globales para obtener direccion raiz del server
var url=window.location.protocol+'//'+window.location.host;

//obtener archivo especialidad
$('#idespecialidades_filtro').change( function () {
	var id=$('#idespecialidades_filtro').val();
	$.get("/biblioteca/show/" + id , function (data) {
 		mostrarArchivosFiltro(data.request);
	}).fail(function (data) {
	    var data = data.responseJSON;
	    mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
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

//evento para validar dato de estado
function changeInput() {
	var est=$("#estado:checked").val() ? 1 : 0;
	$("#estado").val(est);
}
