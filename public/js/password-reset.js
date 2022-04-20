//evento para reenviar codigo
function resend_code(email) {
	$('#spinner-code').html(` <div class="spinner-border text-info_  ml-3 "  style="width: 1rem; height: 1rem;"  role="status"> </div> `);
	  //se llama para insertar el evento de Conoceme view informacion medico
    $.get("/reenviar/"+email, function (data) {
       if(data){
       		$('#spinner-code').html(" ");
       }
       
    }).fail(function(data){
    	$('#spinner-code').html(" ");
       console.log(data);
    });
}
