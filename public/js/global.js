//Este archivo es para definir funciones globales

//evento para ejecutar el enter o clich al buscar
$("#form_searc_general").on("submit", function (e) {
    e.preventDefault();
    getSearch();    
});

function obtenerResulSearch() {
    var text=$('#inputSearch_').val();
    var valor = document.getElementById("inputSearch_").value; 
    console.log(valor+'11');
    console.log(text);
}



 $('#inputSearch_').keyup(function (argument) {
    $('#buscar_txt').html('');
     var text=$('#inputSearch_').val();
     var input=text.length;
     console.log(input);
     if(input>2){
       getSearch(); 
     }
     
    $('#buscar_txt').html(text);
    $('#dropdown-menu1').addClass('show');
    $('#form_searc_general').addClass('show');
    
 });


 //funcion para obtener resultado del search
 function getSearch() {
    var rute=$('#tpch').val();
    if(rute==1){
        rute=`/gestion/search`;
        
    }else{
        rute=`/search`;
    }
    console.log(rute);

     $.ajaxSetup({
         headers: {
             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
         },
     }); 
     
     var FrmData = {
         q: $("#inputSearch_").val(),
     };
     console.log(FrmData)
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


 //funcion para recorrer resultado del search
 function verResul(rul) {
    console.log(rul);
    window.location.href=rul;
 }


 // funcion para cambiar el estado de visto a las notificaciones
 function notyfyEstado() {
    $.get("/notify/estado/"+0+'/edit', function (data) {
      $('#badgeNoty').remove();
       
    }).fail(function(data){
       console.log(data);
    });
 }

 //funcion de acciones de la notificaion
 function notify(code) {
    if(code==1){
        window.location.href='/';
        $('#modal-default').modal('show');
    }
 }