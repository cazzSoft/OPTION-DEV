//Este archivo es para definir funciones globales

//las modales no están cerrando, por esta razon cree una funcion que cierre las modales
//si eres pila simplifica el codigo o encuentra el problema de las modales
function cerrar_modal(idmodal) {
    console.log("cerrar_modal");
    var myModalEl = document.getElementById(idmodal)
    $('#' + idmodal).modal('hide');
}
