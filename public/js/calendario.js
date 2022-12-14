var url=window.location.protocol+'//'+window.location.host;
var calendar;
document.addEventListener('DOMContentLoaded', function() {
  
  var initialLocaleCode = 'es';
  var calendarEl = document.getElementById('agenda');
  var fff=0;
  

   calendar = new FullCalendar.Calendar(calendarEl, {
    
    timeZone: 'GMT-5',
    locale:initialLocaleCode,
    initialView: 'timeGridWeek',
    // nowIndicator: true,

   
    headerToolbar: {
      left: 'prev,next today',
      // center: 'title',
      right: 'dayGridMonth,timeGridWeek',
      
    },

     
    navLinks: true, // can click day/week names to navigate views
    selectable: true,
    selectMirror: false,
    dayMaxEvents: false,
    editable: false,


    select: function(arg) {
      
       limpiarCampos();
      // validacion de fecha actual
      moment.locale('es');
      var fecha_actual=new Date();
      var fecha_select = new Date(arg.start);
     
      var fecha_actual_=moment(fecha_actual).format('Y-M-D');
      var fecha_select_=moment(fecha_select).format('Y-M-D');
   
      // control de registro de citas
      if(fecha_select.getTime() >= fecha_actual.getTime()){
        
      }else{
        if(fecha_select_ >= fecha_actual_){
          
        }else{
          sweetalert('Lo sentimos, solo puedes registrar citas en fechas actuales o superiores','error');
          return 0;
        }
      }

      
      // fecha seleccionada
      const text_dia = moment(arg.start, ["Y-m-d"]).format('dddd');
      const num_dia = moment(arg.start, ["Y-m-d"]).format('D');
      const text_mes = moment(arg.start, ["Y-m-d"]).format('MMMM');
     
      const h_ini = moment(arg.start, ["h:mm A"]).format("HH:mm A");
      const h_fin = moment(arg.end, ["h:mm A"]).format("HH:mm A");

      $('#fecha_text').addClass('d-none');
      $('#hora_select').addClass('d-none');
      $('.fecha').removeClass('d-none');
      $('.hora').removeClass('d-none');
      
      $('#fecha_text').html(`
          <small class="text-capitalize" > <i class="fa-regular fa-clock mr-2"></i> ${text_dia}, ${num_dia} de</small> 
          <small class="text-capitalize" >${text_mes} </small>
        `);

      $('#hora_select').html(`${h_ini} - ${h_fin}`);

      var today = new Date(arg.start).toISOString().split('T')[0];
      $("#fecha").val(today);

      $('#hora').val(`${moment(arg.start).format('HH:mm')} ${moment(arg.end).format('HH:mm')}`).trigger("change");
      // console.log(`${moment(arg.start).format('HH:mm')} ${moment(arg.end).format('HH:mm')}`);
       // $('#hora').val(`06:00 06:30`).trigger("change");

      // $('#hora_fin').val(moment(arg.end).format('HH:mm'));

      
      $('#modal-form-cita').modal('show');
      var fecha=$('#fecha').val();
      get_horarios(fecha);

    },
    
    eventClick: function(info) {
     
      // actualizar select de horarios
      const fecha = moment(info.event.start, ["Y-m-d"]).format('Y-M-D');
      get_horarios(fecha);
      


      var evento=info.event; 
      $('.title-cita').html("");
      $('.title-cita').html(`${evento._def.title}`);

      // fecha y hora
      moment.locale('es');
      const text_dia = moment(info.event.start, ["Y-m-d"]).format('dddd');
      const num_dia = moment(info.event.start, ["Y-m-d"]).format('D');
      const text_mes = moment(info.event.start, ["Y-m-d"]).format('MMMM');
      
      const h_ini = moment(info.event.start, ["h:mm A"]).format("HH:mm A");
      const h_fin = moment(info.event.end, ["h:mm A"]).format("HH:mm A");

      
      
      $('#text-fecha-info').html(`
          <small class="text-capitalize" > <i class="fa-regular fa-clock mr-2"></i> ${text_dia}, ${num_dia} de</small> 
          <small class="text-capitalize" >${text_mes} </small>
        `);

      
      
      $('#modal-info-cita').modal('show');

      // cargamos datos al boton iniciar cita
      $('#btn-iniciar-cita').attr('onclick',`iniciar_cita("${info.event.id}")`);


      
      
      $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
      });



      $.ajax({
          url: "/calendario/edit/"+info.event.id , 
          method: "GET", 
          dataType: "json",
          success: function (data) {
            // sweetalert(data.jsontxt.estado, data.jsontxt.estado);
            limpiarCampos();
            $('#modal-info-cita').modal('hide');
            $('#idcita').val(info.event.id);

            


            let array=data.request;
            if( array.length!=0){ 
              
              const h_ini = moment(array.hora_inicio, ["h:mm A"]).format("HH:mm A");
              const h_fin = moment(array.hora_fin, ["h:mm A"]).format("HH:mm A");
              
              $('#text-hora-info').html(` <small>${h_ini} - ${h_fin}  </small>`);

              setTimeout(function(){
                $('#hora').val(`${array.hora_inicio} ${array.hora_fin}`).trigger('change');
              }, 1000);

              $('#fecha_text').addClass('d-none');
              $('#hora_select').addClass('d-none');
              $('.fecha').removeClass('d-none');
              $('.hora').removeClass('d-none');
              
               // validamos si el medico puede editar datos del paciente
               if(array.nuevo_paciente){
                  $('#telefono').prop('readonly',false);
                  $('#name').prop('readonly',false);
                  $('#email').prop('readonly',false);
               }else{
                  $('#telefono').prop('readonly',true);
                  $('#name').prop('readonly',true);
                  $('#email').prop('readonly',true);
               }
                
               
                $('#idpaciente').val(array.idpaciente_encryp);
                $('#titulo').val(array.titulo);
                $('.search-usuario').addClass('d-none');
                $('#name').val(array.usuario[0].name);
                $('#telefono').val(array.usuario[0].telefono);
                $('#email').val(array.usuario[0].email);
                $('#detalle').val(array.detalle);
                $('#tipo_cita').val(array.tipo_cita).trigger('change');
                $('#idmedio_reserva').val(array.idmedio_reserva).trigger('change');
                

               
                var today = new Date(array.fecha).toISOString().split('T')[0];
                $("#fecha").val(today);

                $("#method_cita").val('PUT');
                $("#btn-save-cita-form").html('Guardar cambios');
                $('#btn-cancelar-cita-form').removeClass('d-none');   


            }
          },

          error: function (data) {
              var statusText = data.statusText;
              var data = data.responseJSON;
              console.log(statusText);
          },
      });

      // evento boton eliminar
      $('#btn-eliminar-cta').click(function(){

        //ejecucion de mensaje de advertencia
          Swal.fire({
            title: 'Eliminar cita',
            text: "¿Estas seguro de querer eliminar la cita de tu calendario?",
            icon: 'question', //question ,info, warning, success, error
            showCancelButton: true,
            confirmButtonColor: '#0FADCE',
            cancelButtonColor: '##FFFFFF',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Canelar'
          }).then((result) => {
            if (result.isConfirmed) {

                // atenuar modal info cita bloqueo
                $('.atenuar-modal-info').addClass('overlay ');
                $('#btn-eliminar-cta').addClass('d-none');
                $('.efect-eliminar').removeClass('d-none');
                
                // $.ajaxSetup({
                //     headers: {
                //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                //     },
                // });
                $.ajax({
                    url: "/calendario/delete/"+info.event.id , 
                    method: "GET", 
                    dataType: "json",
                    success: function (data) {
                      calendar.refetchEvents();
                      sweetalert(data.jsontxt.msm, data.jsontxt.estado);
                       $('#modal-info-cita').modal('hide');

                       // atenuar modal info cita bloqueo
                       $('.atenuar-modal-info').removeClass('overlay ');
                       $('#btn-eliminar-cta').removeClass('d-none');
                       $('.efect-eliminar').addClass('d-none');
                    },

                    error: function (data) {
                        var statusText = data.statusText;
                        var data = data.responseJSON;
                        console.log(statusText);
                    },
                });
               
                 // info.event.remove();
                
            }
          })
        
      });
      
      // evento boton editar
      $('#btn-editar-cita').click(function(){
        $('#modal-info-cita').modal('hide');
        $('#modal-form-cita').modal('show');
        
      });

      
    },

    events:`${url}/calendario/citas`,
    eventColor: '#0FADCE',
    eventTextColor:'ff0000',
    eventBackgroundColor:'#c3eaf3',
      
    slotLabelFormat:{
             hour: 'numeric',
             minute: '2-digit',
             meridiem: 'short'
           },
     

  });

   
  calendar.render();
  // calendar.setOption('locale',initialLocaleCode );
  calendar.setOption('themeSystem', 'bootstrap');
  // calendar.setOption('timeZone','local');

 
});


