//Este archivo es para definir funciones globales

//variable globales para obtener direccion raiz del server
var url=window.location.protocol+'//'+window.location.host;


//evento para cambiar el idioma a la vista
$('#language').change(function (e) {
    $('#form-language').submit();
});

//evento para ejecutar el enter o clich al buscar
$("#form_searc_general").on("submit", function (e) {
    e.preventDefault(); 
    getSearch();    
});

//evento para ejecutar el enter o clich al buscar movil
$("#form_searc_general_app").on("submit", function (e) {
    e.preventDefault();
    getSearch_app();    
});

function obtenerResulSearch() {
    var text=$('#inputSearch_').val();
    var valor = document.getElementById("inputSearch_").value; 
    console.log(valor+'11');
    console.log(text);
}

// evento de busquedad 

 $('#inputSearch_').keyup(function (argument) { 
    $('#buscar_txt').html('');
     var text=$('#inputSearch_').val();
     var input=text.length;
     
     if(input>2){
       getSearch(); 
     }
     
    $('#buscar_txt').html(text);
    $('#dropdown-menu1').addClass('show');
    $('#form_searc_general').addClass('show');
    
 });


 // evento de busquedad app
 $('#inputSearch_app').keyup(function (argument) { 
    $('#buscar_txt').html('');
     var text=$('#inputSearch_app').val();
     var input=text.length;
     
     if(input>2){
       getSearch_app(); 
     }
     
    $('#buscar_txt_app').html(text);
    $('#dropdown-menu1_app').addClass('show');
    $('#form_searc_general_app').addClass('show');
    
 });


//funcion para obtener resultado del search
function getSearch() {
    var rute=$('#tpch').val();
    if(rute==1){
        rute=`/gestion/search`;
        
    }else{
        rute=`/search`;
    }
    
     $.ajaxSetup({
         headers: {
             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
         },
     }); 
     
     var FrmData = {
         q: $("#inputSearch_").val(),
     };
     
     // return 0;
      $.ajax({
          url: rute,  
          method: "POST", 
          data: FrmData, 
          dataType: "json",
          success: function (data) {
             console.log(data);
              $('#dropdown-menu1').html("");
              $('#dropdown-menu1').append(data['listMedicos']);
              $('#dropdown-menu1').append(data['listaPublicaciones']);  

               // $('#dropdown-menu1').append(`<a href="#" class="dropdown-item dropdown-footer text-left p-2 text-info"><i class="fa fa-search bgz-info p-2 img-circle img-bordered-xs" ></i> Buscar <span id="buscar_txt"></span></a>`);
          },

          error: function (data) {
              var statusText = data.statusText;
              var data = data.responseJSON;
              if (statusText == "Not Implemented") {
                  //error 501
                  console.log('Not Implemented');
                  
              } else {
                  console.log('Error revisar log');
              }

          },
      });   
}

//funcion para obtener resultado del search app
function getSearch_app() {
    var rute=$('#tpch_app').val();
    if(rute==1){
        rute=`/gestion/search`; 
    }else{
        rute=`/search`;
    }
    
     $.ajaxSetup({
         headers: {
             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
         },
     }); 
     
     var FrmData = {
         q: $("#inputSearch_app").val(),
     };
     
     // return 0;
      $.ajax({
          url: rute,  
          method: "POST", 
          data: FrmData, 
          dataType: "json",
          success: function (data) {
             console.log(data);
              $('#dropdown-menu1_app').html("");
              $('#dropdown-menu1_app').append(data['listMedicos']);
              $('#dropdown-menu1_app').append(data['listaPublicaciones']);  

               // $('#dropdown-menu1').append(`<a href="#" class="dropdown-item dropdown-footer text-left p-2 text-info"><i class="fa fa-search bgz-info p-2 img-circle img-bordered-xs" ></i> Buscar <span id="buscar_txt"></span></a>`);
          },

          error: function (data) {
              var statusText = data.statusText;
              var data = data.responseJSON;
              if (statusText == "Not Implemented") {
                  //error 501
                  console.log('Not Implemented');
                  
              } else {
                  console.log('Error revisar log');
              }

          },
      });   
}

 //funcion para recorrer resultado del search
 function verResul(rul) {
    // console.log(rul);
    window.location.href=rul;
 }

//obtener noticicaciones refresh
function upNotify() {
    $.get("/notify/getNotify", function (data) {
       if( data.jsontxt.estado=='success'){
            // activamos icon notificacion
            if(data.request['count_notify']!=0){
               $('#badgeNoty').html(data.request['count_notify']); 
               $('#badgeNoty').removeClass('d-none');
            }else{
                $('#badgeNoty').html("");  
            
            }

            // actualizamos la lista de notificaciones
            $('#listNotify').html(data.request['listaNotify']);
            $('.idcoins').html(data.request['t_coins']);
            // data.request['t_coins'] 
       }
       
    }).fail(function (data) {
        var data = data.responseJSON;
        console.log(data.jsontxt.msm);
        // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
    });
}

 // funcion para cambiar el estado de visto a las notificaciones
 function notyfyEstado() {
    $.get("/notify/estado/"+0+'/edit', function (data) {
      $('#badgeNoty').html("");  
    }).fail(function(data){
       console.log(data);
    });
 }

 // funcion para cambiar el estado de visto a las notificaciones
 // function notyfyEstado_app() {
 //    $.get("/notify/estado/"+0+'/edit', function (data) {
 //      $('#badgeNoty_app').remove();
       
 //    }).fail(function(data){
 //       console.log(data);
 //    });
 // }

 //funcion de acciones de la notificaion
 function notify(code) {
    if(code==1){
        window.location.href='/';
        $('#modal-default').modal('show');
    }
 }


 //funcion para abrir modal de terminos y condiciones
 function openInfoTermiCondiciones() {
     $('#modal-termino-condiciones').modal('show');
 }

 // politicas de privacidad home
 function openInfoPoliticas() {

     $('#modal-politica-privacidad').modal('show');
 }
 

 // funcion para cerrar secion del usuario
 function logout_session() {
    $('#modalLogout').modal('show');
 }

 //traducir los mensajes de los input 
 function InvalidMsg(textbox) { 
    if (textbox.value == '') {
        textbox.setCustomValidity('please fill in the field'); 
     } else if (textbox.validity.typeMismatch){
         textbox.setCustomValidity('please enter a valid email address');
     } else { 
        textbox.setCustomValidity(''); 
    }
      return true; 
}

// $('.item_input').hide();
// $('.btn_search').show();
var item_input=0;
// evento del search app
$('.btn_search_in').click(function (argument) {
    if(item_input){
        $(".item_input").css("display:block");
        $('.item_input').hide(40);
        $('.item_input').addClass('d-none');
        $('.btn_search').removeClass('d-none');
       
        item_input=0;
    }else{
        $('.item_input').show(40);
        $('.item_input').removeClass('d-none');
        $('.btn_search').addClass('d-none');
      
        item_input=1;   
    }
   
});

// empiesa a cargar
$(document).ready(function(){
      $("#dropdownMenuLink").css("display:none");
      $("#dropdownMenuLink").addClass("d-none");
      
      $('.main-carousel-dr').addClass('main-carousel-dr-on');
});
// termina la carga
window.onload = function(){
    $("#dropdownMenuLink").css("display:block");
    $("#dropdownMenuLink").removeClass("d-none");

    $('.footer_sidebar').removeClass('d-none');
    // $('.nav_content').removeClass('d-none');
    // $('.history').removeClass('d-none');
    // $('.history').css('height:123px');

    // top medicos
    
   
};  