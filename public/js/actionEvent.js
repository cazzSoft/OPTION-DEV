function acctionSociales(idm,des) {
     //se llama para insertar el evento de Conoceme view informacion medico
    $.get("/actividades/redessociales/"+idm+'/'+des, function (data) {
        console.log(data);
       
    }).fail(function(data){
       console.log(data);
    });
}