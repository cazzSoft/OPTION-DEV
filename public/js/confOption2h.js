    //control del back del navegador
    // window.history.forward();
    // function noBack()
    // {  
    //     window.history.forward();
    // }

    
	// configuraciones globales
    $(function () {

        // activar stylo select2
        // $('.select2').select2();
        // stilos de table
        cargar_stilos_table('.data_table');
        //  para aplicar el dataRange de fechas  
        // $('.daterange').daterangepicker();

       
      
    });

    {/*  funcion para mostrar alertas toast - */}
    function mostrar_toastr(msm,estado,  time=4000) {

        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "timeOut": time,
        }

        toastr[estado](msm,"Información:")

    }

    //  funcion general para validar campo de un form
    function validarCampos(inputs,estado){//inputs=array de campos form, estado= invalid - valid - warning
        valor=false;
        if(inputs.length!=0){
            $.each(inputs, function(i, item) {
                if($(`#${item}`).val().length<=0){
                    $(`#${item}`).addClass(`is-${estado}`)
                    valor=true;
                }else{
                    $(`#${item}`).removeClass(`is-${estado}`)
                }
            })
        }
        return valor;
    }

    // funcion para mostrar o quitar requerido de campos form
    function requerirCampos(inputs,estado,option){//marcar y quitar efecto requerido M=mostrar B=borrar
        if(inputs.length!=0){
            $.each(inputs, function(i, item) {
                if(option=='B'){//borrar efecto
                    $(`#${item}`).removeClass(`is-${estado}`)
                }else if(option=='M'){// valida y marca requerido
                    $(`#${item}`).addClass(`is-${estado}`)
                }
            })
        }
    }

   

    //funcion para cargar stilos de la tabla desde js
    function cargar_stilos_table(name_table) {//NAME CLASE DE LA TABLE
           $(`${name_table}`).DataTable({
             "language": {
             "lengthMenu": "Mostrar _MENU_ registro por página",
             "paginate":{'next':'Sig','previous':'Ant'},
             "infoFiltered": "(filtrar from _MAX_ total registros)",
             "processing": "Procesando...",
             "lengthMenu": "Mostrar _MENU_ registros",
             "zeroRecords": "No se encontraron resultados",
             "emptyTable": "Ningún dato disponible en esta tabla",
             "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
             "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
             "infoFiltered": "(filtrado de un total de _MAX_ registros)",
             "search": "Buscar:",
             "infoThousands": ",",
             "loadingRecords": "Cargando"
           },
           })
    }

    //evento para obtener datos del medico
    function getMedicoTop(id,img) {
        $.get("/medico/getMedico/"+id , function (data) {
            
            // console.log(data.request); return ;
            if(data.request['idtitulo_profesional']!=null){
                var descrip=data.request['titulo']['descripcion'];
            }else{
                var descrip='Sin datos..';
            }

            var expe=' ';
            if(data.request['detalle_experiencia']){
                var expe=data.request['detalle_experiencia'];
            }

            var desc_titulo=`${descrip}. ${expe}`;
             desc_titulo=desc_titulo.substr(0,30);
            $('.txt_name').html( data.request['name']);
            $('.txt_titulo').html(` ${desc_titulo}`);
            $('.txt_telf').html(`<i class="fas fa-mobile-alt"></i> Teléfono: ${data.request['telefono']}`);
            $('.txt_email').html(`<i class="far fa-envelope"></i>: ${data.request['email']}`);
            $('.txt_direc').html(`<i class="far fa-address-book"></i> Dirección: ${data.request['direccion']}`);
            var url=window.location.protocol+'//'+window.location.host;
            $('.text_url').attr('href',`${ data.request['url']}`);
            $('.img_txt').attr('src',`${ data.request['img']}`);
            
            
            console.log(data);

            $('#modal-info-medico').modal('show');
        }).fail(function (data) {
            var data = data.responseJSON;
            mostrar_toastr(data.jsontxt.msm, data.jsontxt.estado)
        });
    }


   