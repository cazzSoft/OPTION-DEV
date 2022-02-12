function putLike_poin(id,est) {
       
    var con=$(est).children('span').html();
    // var con2=$(est).children('i').attr('class','fa fa-heartbeat icon-info');
    // console.log(con2);
    $.get("/verificarLike/" + id , function (data) {
        
       if(data.jsontxt.estado=='info' || data.jsontxt.estado=='success'){
            $(est).children('i').attr('class','fa fa-heartbeat icon-info');  
            
            $(est).children('span').html(parseInt(con)+1);
            
       }
       if(data.jsontxt.estado=='warning'){
            $(est).children('i').attr('class','fa fa-heartbeat ');  
            $(est).children('span').html(parseInt(con)-1);
       }
       
        mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
    
    }).fail(function (data) {
        var data = data.responseJSON;
        // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
    });
}

