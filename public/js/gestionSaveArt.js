
function quitarArt(idart, este) {
   
	$.get("articulo_user/"+ idart , function (data) {
        
        if(data.jsontxt.estado=='success'){
             $(este).parents('.borrar').remove();
        }
        mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
    
    }).fail(function (data) {
       alert("No se pudo completar la acción");
    });   
}

function saveArtUser(idart) {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //se crea la data
    var FrmData = {
        idart: idart,  
    };

    $.ajax({
        url: "gestion/articulo_user", 
        method: "POST", 
        data: FrmData, 
        dataType: "json",
        success: function (data ) {
            mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
           
        },

    });
  
}

//funcion para seguir usuario medico
function gestionSeguir(idm,ste) {
   $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //se crea la data
    var FrmData = {
        idmedico: idm,  
    };

    $.ajax({
        url: "/medico/seguir", 
        method: "POST", 
        data: FrmData, 
        dataType: "json",
        success: function (data ) {
            if(data.jsontxt.estado=='success'){
                $(ste).html('<i class="fa fa-check"></i> Dejar de seguir.');
            }
            if(data.jsontxt.estado=='info'){
                $(ste).html('<i class="fa fa-check-circle"></i> Seguir.');
            }
            mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
           
        },

    });

}

function dejarS(idm) {
     $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //se crea la data
    var FrmData = {
        idmedico: idm,  
    };

    $.ajax({
        url: "/medico/seguir", 
        method: "POST", 
        data: FrmData, 
        dataType: "json",
        success: function (data ) {
            mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado);
           
        },

    });
}

//funcion modal
$('#btnModalSg').click(function () {
    $.get("/profile/show_info", function (data) {
        console.log(data);
        $('#asingSe').html("");
        $('#asingSe').html(data);
       
    }).fail(function(data){
      // var data=data.responseJSON;
      // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
    });
    $('#modalSg').modal("show");
});


//evento para controlar la informacion de perfil
//variavle control
var show=0;
$('#btn_action').click(function () {
    if(show==0){
        $('.form_p').removeClass('d-none');
        $('.info_p').addClass('d-none');
        $('#btn_action').html('<i class="fas fa-arrow-left text-ligth"></i>');
        show=1;
    }else{
        $('.form_p').addClass('d-none');
        $('.info_p').removeClass('d-none');
        $('#btn_action').html('<i class="fas fa-pen-alt text-ligth"></i>');
        show=0;
    }
   
});

//evento para actulizar perfil
