function guardar_datos() {
    var data_form = $("#datos_categoria").serialize();
    $.ajax({
        type: "POST",
        url: base_url+"Categorias/guardar_categoria",
        data: data_form
    }).done(function(resultado) {
        resultado = JSON.parse(resultado);
        if (!resultado[0]) {
            swal({
                title: "Parece que algo salio mal!",
                html: resultado[1],
                type: "warning"
            });
        } else {
            limpiar_campos();
            swal(
                'Excelente!',
                'Se cargaron los datos con exito!',
                'success'
            );
            setTimeout(function() {
                location.reload();
            }, 2000);
        }
    })
}

function get_categoria(id) {
    $.ajax({
        type: "POST",
        url: base_url+"Categorias/obtener_categoria",
        data: 'id_categoria=' + id
    }).done(function(resultado) {
        resultado = JSON.parse(resultado);
        if (!resultado[0]) {
            swal({
                title: "Parece que algo salio mal!",
                html: resultado[1],
                type: "warning"
            });
        } else {
            $('#id_categoria').val(resultado[1][0]['id']);
            $('#nombre').val(resultado[1][0]['nombre']);
            $('#descripcion').val(resultado[1][0]['descripcion']);
        }
    })
}

function eliminar_categoria(id) {
    $.ajax({
        type: "POST",
        url: base_url+"Categorias/eliminar_categoria",
        data: 'id_categoria=' + id
    }).done(function(resultado) {
        resultado = JSON.parse(resultado);
        if (!resultado[0]) {
            swal({
                title: "Parece que algo salio mal!",
                html: resultado[1],
                type: "warning"
            });
        } else {
            var categoria = 'tr_categoria_' + id;
            $('#' + categoria).remove();
            swal({
                title: "Exito!",
                html: resultado[1],
                type: "success"
            });
        }
    });
}

function limpiar_campos() {
    $('#nombre').val('');
    $('#descripcion').val('');
    $('#id_categoria').val('');
}
