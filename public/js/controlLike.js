function putLike_poin(id,est) {
       
    var con=$(est).children('span').html();
    $.get("/verificarLike/" + id , function (data) {
        
       if(data.jsontxt.estado=='info' || data.jsontxt.estado=='success'){
            $(est).removeClass('btn btn-outline-info btn-block');  
            $(est).addClass('btn btn-block bg-gradient-info ');  
            $(est).children('span').html(parseInt(con)+1);
            
       }
       if(data.jsontxt.estado=='warning'){
            $(est).removeClass('btn btn-block bg-gradient-info ');
            $(est).addClass('btn btn-outline-info btn-block ');  
            $(est).children('span').html(parseInt(con)-1);
       }
       
        mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
    
    }).fail(function (data) {
        var data = data.responseJSON;
        // mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
    });
}

