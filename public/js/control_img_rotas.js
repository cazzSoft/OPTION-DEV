//variable globales para obtener direccion raiz del server
    var url=window.location.protocol+'//'+window.location.host;

// control de imagen rotan se reemplazan con otra img predefinida
   
    function ImagenOk(img) {
       if (!img.complete) return false;
       if (typeof img.naturalWidth != 'undefined' && img.naturalWidth == 0) return false;
      
       return true;
    }

    function RevisarImagenesRotas() {
       
        var replacementImg = `${url}/img/error.png`;
        for (var i = 0; i < document.images.length; i++) {
            if (!ImagenOk(document.images[i])) {
              document.images[i].src = replacementImg;
            }
        }
    }
   
   window.onload=RevisarImagenesRotas(); 