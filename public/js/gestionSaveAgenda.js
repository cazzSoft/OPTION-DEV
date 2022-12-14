// inicializacion del select
$(document).ready(function() {
   $('.select2').select2();
});
 
var url=window.location.protocol+'//'+window.location.host;

// evento para obtener usuario paciente
  $('#search-user').keyup(function (e) {
  	var input_search=$('#search-user').val();
  	$('#dropdownCita').html("");
  	$('.dropdown-menu-cita').removeClass('show');
  	if(input_search.length > 2){

  		// ëfecto cargando lista de resultado
  		$('#dropdownCita').html(`
  			<a  class="dropdown-item-user-cita">
  			  <p class="mt-2 text-name-user text-center" >
  			     <button class="btn " type="button" disabled>
  			       <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  			       Loading...
  			     </button>
  			  </p>
  			</a>
  		`); 

  		//obtenemos usuarios
  		$.get("/calendario/getuser/"+input_search, function (data) {
          
          let array=data.request;
  		    if( array.length!=0){ 
            // mostramos resultados
             $('#dropdownCita').html(array);
  		    }
          
  		   if(array.length===0 ){
           
            $('#dropdownCita').html(`
              <a  class="dropdown-item-user-cita">
                <p class="mt-2 text-name-user text-center" >
                   No se ha encontrado ningun paciente
                </p>
              </a>
            `);
         }

  		}).fail(function (data) {
  		    var data = data.responseJSON;
  		    console.log(data.jsontxt.msm);
  		    $('.dropdown-menu-cita').removeClass('show');
  		});

     
  		$('#dropdownCita').removeClass('d-none');
  		$('.dropdown-menu-cita').addClass('show');
  		
  	}
  });

  
$('#search-user').click(function (e) {
  	$('.dropdown-menu-cita').removeClass('show');
  	$('#dropdownCita').addClass('d-none');
});


// evento para obtener horario de acuerdo a la fecha
$('#fecha').change(function (e) {
    const fecha=$('#fecha').val();
    get_horarios(fecha);
});

//consulta usuario
function obtenerUsuario(user) {

    $('.dropdown-menu-cita').removeClass('show');
    $('#dropdownCita').addClass('d-none');
    $.get("/calendario/usuario/"+user, function (data) {
        let user=data.request;
        $('#name').val(user.name);
        $('#idpaciente').val(user.id);
        $('#telefono').val(user.telefono);
        $('#email').val(user.email);

        $('#search-user').val(user.name);
       
        $('#telefono').prop('required',false);
        $('#name').prop('required',false);
        $('#email').prop('required',false);
    }).fail(function (data) {
        var data = data.responseJSON;
        // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
        sweetalert(data.jsontxt.msm, data.jsontxt.estado);
    });    
}

// funcion para obtener horarios de acuerdo a la fecha seleccionada
function get_horarios(fecha) {
   
    // $("#hora").empty();
    $('#hora').html('').select2({data: [{id: '', text: ''}]})
    $.get("/calendario/get_horario/"+fecha, function (data) {

        // actualizacion de select hora
        const dat=[];
        $.each(data.request, function (i, item) {
            
            $items={'id':item['valor_h'],'text':item['text_h']}; 
             dat.push( $items);
        });
       
        $("#hora").select2({
          data: dat
        });

    }).fail(function (data) {
        var data = data.responseJSON;
        sweetalert(data.jsontxt.msm, data.jsontxt.estado);
    });    
}


// evento mostrar campo de direccion en el form cita 
$('#tipo_cita').change(function (e) {
    var tipo_cita=$('#tipo_cita').val();
    if (tipo_cita=='precencial') {
      $('#detalle').removeClass('d-none');
      $('#edad_imc').prop('required',true);

    }else{
      $('#detalle').addClass('d-none');
      $('#edad_imc').prop('required',false);
      $('#detalle').val('');
    }
});

// evento para registrar datos del form cita
  $("#formCita").on("submit", function (e) {
     e.preventDefault(); 

    if($('#method_cita').val()=='POST'){
        let paciente=$('#idpaciente').val();
        var formulario = document.getElementById("formCita");

        if(paciente==""){
          //ejecucion de mensaje de advertencia
            Swal.fire({
              title: 'Paciente nuevo',
              text: "Este paciente no se encuentra registrado en nuestra plataforma, se actualizara la información del mismo una vez finalizada la cita médica.",
              icon: 'question', //question ,info, warning, success, error
              showCancelButton: true,
              confirmButtonColor: '#0FADCE',
              cancelButtonColor: '#dc3545',
              confirmButtonText: 'Aceptar',
              cancelButtonText: 'Canelar'
            }).then((result) => {
              if (result.isConfirmed) {
                registroCita();
              }else{
                // efecto deshavilitar modal form
                $('.atenuar-modal-form ').removeClass('overlay ');
                $('.cerrar-form').removeClass('d-none');
                $('.efect-cerrar').addClass('d-none');
              }
            })
        }else{
          registroCita();
        }   
      }else if($('#method_cita').val()=='PUT'){
           actualizaCita();
    }

  });

// funcion registro cita
function registroCita() {

    // efecto deshavilitar modal form
    $('.atenuar-modal-form ').addClass('overlay ');
    $('.cerrar-form').addClass('d-none');
    $('.efect-cerrar').removeClass('d-none');

     $.ajaxSetup({
         headers: {
             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
         },
     });

     //se crea la data
     var FrmData = {
        iden: $("#iden").val(),
        titulo: $("#titulo").val(),
        fecha: $("#fecha").val(),
        hora: $("#hora").val(),
        idpaciente: $("#idpaciente").val(),
        name: $("#name").val(),
        telefono: $("#telefono").val(),
        email: $("#email").val(),
        tipo_cita: $("#tipo_cita").val(),
        detalle: $("#detalle").val(),
        idmedio_reserva: $("#idmedio_reserva").val(),
        text_hora:  $('select[name="hora"] option:selected').text()
     };
      
    $.ajax({
        url: "/calendario", 
        method: "POST", 
        data: FrmData, 
        dataType: "json",
        success: function (data) {

          // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
          calendar.refetchEvents();
          sweetalert(data.jsontxt.msm, data.jsontxt.estado);
          

          // en caso que registre una cita en la misma fecha en la misma hora
          if(data.jsontxt.estado!='error'){
            $('#modal-form-cita').modal('hide');
          }

          // efecto deshavilitar modal form
          $('.atenuar-modal-form ').removeClass('overlay ');
          $('.cerrar-form').removeClass('d-none');
          $('.efect-cerrar').addClass('d-none');
        },

        error: function (data) {
            var statusText = data.statusText;
            var data = data.responseJSON;
            console.log(data.jsontxt.msm);

            if (statusText == "Not Implemented") {
                //error 501
                $.each(data.request, function (i, item) {
                    mostrar_toastr(item, data.jsontxt.estado,9000);
                    // sweetalert(item, data.jsontxt.estado);
                });
                sweetalert(data.jsontxt.msm, data.jsontxt.estado);
            } else {
                mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
                
            }

           // efecto deshavilitar modal form
           $('.atenuar-modal-form ').removeClass('overlay ');
           $('.cerrar-form').removeClass('d-none');
           $('.efect-cerrar').addClass('d-none');
        },
    });
}

// funcion actualizar cita
function actualizaCita() {

    // efecto deshavilitar modal form
    $('.atenuar-modal-form').addClass('overlay ');
    $('.cerrar-form').addClass('d-none');
    $('.efect-cerrar').removeClass('d-none');

     $.ajaxSetup({
         headers: {
             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
         },
     });

     //se crea la data
     var FrmData = {
        iden: $("#iden").val(),
        titulo: $("#titulo").val(),
        fecha: $("#fecha").val(),
        hora: $("#hora").val(),
        idpaciente: $("#idpaciente").val(),
        name: $("#name").val(),
        telefono: $("#telefono").val(),
        email: $("#email").val(),
        tipo_cita: $("#tipo_cita").val(),
        detalle: $("#detalle").val(),
        idmedio_reserva: $("#idmedio_reserva").val(),
        text_hora: $('#hora').find('option:selected').text()
     };


    $.ajax({
        url: "/calendario/update/"+$("#idcita").val(), 
        method: "PUT", 
        data: FrmData, 
        dataType: "json",
        success: function (data) {

          // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
          calendar.refetchEvents();
          sweetalert(data.jsontxt.msm, data.jsontxt.estado);
          
          // en caso que registre una cita en la misma fecha en la misma hora
          if(data.jsontxt.estado!='error'){
            $('#modal-form-cita').modal('hide');
          }

          // efecto deshavilitar modal form
          $('.atenuar-modal-form ').removeClass('overlay ');
          $('.cerrar-form').removeClass('d-none');
          $('.efect-cerrar').addClass('d-none');
        },

        error: function (data) {
            var statusText = data.statusText;
            var data = data.responseJSON;
            if (statusText == "Not Implemented") {
                //error 501
                $.each(data.request, function (i, item) {
                    mostrar_toastr(item, data.jsontxt.estado,9000);
                    // sweetalert(item, data.jsontxt.estado);
                });
            } else {
                sweetalert(data.jsontxt.msm, data.jsontxt.estado);
            }
            
            // efecto deshavilitar modal form
            $('.atenuar-modal-form ').removeClass('overlay ');
            $('.cerrar-form').removeClass('d-none');
            $('.efect-cerrar').addClass('d-none');
           
        },
    });
}

// funcion para limpiar campos del form cita
function limpiarCampos() {
  $('#titulo').val('');
  $('#idpaciente').val('');
  $('#search-user').val('');
  $('#name').val('');
  $('#telefono').val('');
  $('#email').val('');
  $('#detalle').val('');
  $('#tipo_cita').val(null).trigger('change');
  $('#idmedio_reserva').val(null).trigger('change');

  $('#telefono').prop('required',true);
  $('#name').prop('required',true);
  $('#email').prop('required',true);

  $('#detalle').prop('required',false);


  $('#fecha_text').removeClass('d-none');
  // $('#hora_select').removeClass('d-none');
  $('.fecha').addClass('d-none');
  // $('.hora').addClass('d-none');
  $('#hora_select').addClass('d-none');
  $('.search-usuario').removeClass('d-none');
  $("#method_cita").val('POST');
  $("#btn-save-cita-form").html('Guardar cita');
  $('#btn-cancelar-cita-form').addClass('d-none'); 


  $('#telefono').prop('readonly',false,);
  $('#name').prop('readonly',false);
  $('#email').prop('readonly',false);
}

// funcion para iniciar cita
function iniciar_cita(id) { 
    window.location.href = `${url}/cita/get/${id}`;
}