// inicializacion del select
$(document).ready(function() {
   $('.select2').select2();
});
 
//eliminara archivo
function btn_eliminar_horario(btn){
  //ejecucion de mensaje de advertencia
    Swal.fire({
      title: '¿Estás seguro de eliminar este horario?',
      text: "¡Recuerda que no podrás revertir los cambios!",
      icon: 'question', //question ,info, warning, success, error
      showCancelButton: true,
      confirmButtonColor: '#606060',
      cancelButtonColor: '#0FADCE',
      confirmButtonText: 'Eliminar',
       confirmColorText: 'red',
      cancelButtonText: 'Canelar'
    }).then((result) => { 
      if (result.isConfirmed) {
          $(btn).parents('.frm_eliminar_horario').submit();
      }
    })
}


//obtener datos del archivo 
function editar_horario(id) {

  
  $.get("/horario/gestion/" + id +'/edit', function (data) {
    
    // limpiar formulario
    let formulario = document.getElementById('form_horario');
    formulario.reset();

    // asignacion de datos del form
    $('#hora_fin').val(data.request.hora_fin).trigger('change');
    $('#hora_inicio').val(data.request.hora_inicio).trigger('change');
   
    $('#method_horario').val('PUT'); // decimo que sea un metodo put Actualizar
    $('#form_horario').attr('action','/horario/gestion/'+id);
    $('#btn_horario_save').html(` Guardar cambios`); // cambiamos nombre del boton

    $('.cancel').removeClass('d-none');
  
    // marcar check dias 
    $.each(data.check, function (i, item) { 
        document.getElementById(`${item['iddias']}_dia`).checked = true;
    });
   
  }).fail(function (data) {
      var data = data.responseJSON;
      sweetalert(data.jsontxt.msm, data.jsontxt.estado)
  });
}

// funciones para havilitar alerta en caso del estado del horario
function estado_horario(id,std,col) {
    if(std==0){
     Swal.fire({
          title: 'Desactivar horario',
          text: "¿Estás seguro de desactivar este horario? Al desactivar el horario no se podrá agendar citas en los días de ese horario.",
          icon: 'question', //question ,info, warning, success, error
          showCancelButton: true,
          confirmButtonColor: '#606060',
          cancelButtonColor: '#0FADCE',
          confirmButtonText: 'Aceptar',
           confirmColorText: 'red',
          cancelButtonText: 'Canelar'
        }).then((result) => { 
          if (result.isConfirmed) {
              activate_horario(id,std,col);
          }
        })
    }else{
      activate_horario(id,std,col);
    }

   
      
}

// funciones para cambiar estado del horario
function activate_horario(id,std,col) {
  $.get(`/horario/estado/${id}/${std}`, function (data) {
    
    if(data.jsontxt.estado=='error'){
       sweetalert(data.jsontxt.msm, data.jsontxt.estado);
       return 0;
    }

    if(data.request.valor){
      $(col).parents('.bg_col').addClass(`text-light_`);
    }else{
       $(col).parents('.bg_col').removeClass(`text-light_`);
    }

    
    $(col).parents('tr').find('td').eq(2).html(`${data.request.text}`);
    $(col).attr('onclick',`estado_horario('${id}','${data.request.valor}',this)`);
    $(col).html(`${data.request.txt_btn}`);
    sweetalert(data.jsontxt.msm, data.jsontxt.estado);
  
  }).fail(function (data) {
      var data = data.responseJSON;
      sweetalert(data.jsontxt.msm, data.jsontxt.estado);
  });
}

// Evento pra tomar valor de horas
$('#hora_fin').change(function (e) {
    validar_horas();
});

$('#hora_inicio').change(function (e) {
   validar_horas();
});

// funcion validar horas
function validar_horas() {

  var hora_inicio=$('#hora_inicio').val();
  var hora_fin=$('#hora_fin').val();
  var horaInicio = moment(hora_inicio, 'h:mma');
  var horaFin = moment(hora_fin, 'h:mma');
  console.log(horaFin); // deberá aparecer true



  if(hora_inicio!="" && hora_fin!=''){
   
    if(hora_inicio>hora_fin || hora_fin<hora_inicio){
      $('#hora_fin').addClass('is-invalid')
      $('#hora_inicio').addClass('is-invalid')
      document.getElementById("btn_horario_save").disabled = true;
    }else{
       $('#hora_fin').removeClass('is-invalid')
       $('#hora_inicio').removeClass('is-invalid')
        document.getElementById("btn_horario_save").disabled = false;
    }  


  }
 
}

$('#btn_horario_cancelar').click(function(){
    // $('#descripcion').val('');
    // $('#titulo').val('');
    $('#method_horario').val('POST');
    $('#form_horario').attr('action','/horario/gestion'); // agregamos la ruta post (ruta por defecto)
    $('#btn_horario_save').html(` Guardar`);
    $('.cancel').addClass('d-none');
});