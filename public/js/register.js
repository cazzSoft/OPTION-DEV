
//funcion para previsualizar img user
$('#imgU').change(function () {
	if (this.files && this.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      // Asignamos el atributo src a la tag de imagen
	      $('#preViewImg').attr('src', e.target.result);
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