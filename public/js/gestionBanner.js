//evento para abrir modal visor de archivos
function visor_show_banner(contenido,titulo) {
	$('#contenido').html(" ");
	$('#txtTitulo').html(`<i class="far fa-image"></i> ${titulo} `);
	
	contenido=` <img class="product-image img-fluid mb-3" src="${contenido}" alt="img">`;
	$('#contenido').html(contenido);
	
	$('#modal-visor').modal('show');
}

// evento para mostrar form banner
$('.btn_nuevo_banner').click(function (argument) {
	$('#card_banner_form').removeClass('d-none');
	$('#card_banner_table').addClass('d-none');

	//obtener ultimo orden para mostrar
	if($('#orden').val()==""){
		$.get("/banner/lastOrden/", function (data) {
			$('#orden').val(data.request);
		});
	}
	
});

// evento para ocultar form banner
$('#btn_cancelar_banner').click(function (argument) {
	$('#card_banner_form').addClass('d-none');
	$('#card_banner_table').removeClass('d-none');
	
	$('#nombre_banner').val('');
    $('#text_opcional1').val('');
    $('#text_opcional2').val('');
    $('#text_opcional1_en').val('');
 	$('#text_opcional2_en').val('');
    $('#aling_img').val(null).trigger('change');
    $('#text_principal').val('');
    $('#text_principal_en').val('');
    $('#text_btn').val('');
    $('#text_btn_en').val('');
	$('#file_txt').val("");
	$('#img').val("");
	$('.file_txt').addClass('d-none');
 	$('.file_img').removeClass('d-none');
    $('#method_banner').val('POST');
    $('#form_banner').attr('action','/noticia/new'); // agregamos la ruta post (ruta por defecto)
    $('#btnsave').html(`<i class="fa fa-save"></i> Guardar`);
});

//habilitar input file img
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