$("form").submit(function (e) {
    e.preventDefault();
});

function guardar_datos() {
    var data_form = $("#form-autor").serialize();
    $.ajax({
        type: "POST",
        url: base_url + "Autores/guardar_autor",
        data: data_form
    }).done(function (resultado) {
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
            setTimeout(function () {
                location.reload();
            }, 2000);
        }
    })
}


function get_autor(id) {
    $.ajax({
        type: "POST",
        url: base_url + "Autores/obtener_autor",
        data: 'id_autor=' + id
    }).done(function (resultado) {
        resultado = JSON.parse(resultado);
        if (!resultado[0]) {
            swal({
                title: "Parece que algo salio mal!",
                html: resultado[1],
                type: "warning"
            });
        } else {
            $('#id_autor').val(resultado[1][0]['id']);
            $('#nombre_autor').val(resultado[1][0]['nombre']);
            $('#apellido_autor').val(resultado[1][0]['apellido']);
            $('#fecha_nacimiento').val(resultado[1][0]['fecha_nacimiento']);
            $('#url_bio').val(resultado[1][0]['link']);
        }
    })
}

function eliminar_autor(id) {
    $.ajax({
        type: "POST",
        url: base_url + "Autores/eliminar_autor",
        data: 'id_autor=' + id
    }).done(function (resultado) {
        resultado = JSON.parse(resultado);
        if (!resultado[0]) {
            swal({
                title: "Parece que algo salio mal!",
                html: resultado[1],
                type: "warning"
            });
        } else {
            var autor = 'tr_autor_' + id;
            $('#' + autor).remove();
            swal({
                title: "Exito!",
                html: resultado[1],
                type: "success"
            });
        }
    });
}

function limpiar_campos() {
    $('#nombre_autor').val('');
    $('#apellido_autor').val('');
    $('#id_autor').val('');
    $('#url_bio').val('');
}
