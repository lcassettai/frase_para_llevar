function obtener_usuario(id){
	 $.ajax({
      type: "POST",
      url: "usuarios/obtener_usuario",
      data: 'id='+id
    }).done(function( resultado ) { 
    	resultado = JSON.parse(resultado);
    	$('#nombre').val(resultado[0].nombre);
    	$('#usuario').val(resultado[0].usuario);
    	$('#apellido').val(resultado[0].apellido);
    	$("#tipo_usuario").val(resultado[0].tipo_usuario);
    	$("#id_usuario").val(resultado[0].id);
    }) 
}

function guardar_datos_usuario(){
	var data_form = $("#datos_usuario").serialize();
	 $.ajax({
      type: "POST",
      url: "usuarios/guardar_datos",
      data: data_form
    }).done(function( resultado ) { 
    	resultado = JSON.parse(resultado);
    	if(!resultado[0]){
    	  	swal({
              title: "Parece que algo salio mal!",
              html: resultado[1],
              type: "warning"
            });
    	}else{
    		limpiar_campos();
    		swal(
			  'Excelente!',
			  'Se cargaron los datos con exito!',
			  'success'
			);
			setTimeout(function(){
			  location.reload();
			}, 2000);			
    	} 	
    }) 
}

function eliminar_usuario(id){
	swal({
	  title: 'Esta seguro?',
	  text: "Una vez eliminado el usuario no se podra recuprar mas la informacion",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d69e',
	  cancelButtonColor: '#ce5142',
	  confirmButtonText: 'Si, borralo!',
	  cancelButtonText: 'Cancelar!',
	}).then((result) => {
	  if (result.value) {
	    	 $.ajax({
			      type: "POST",
			      url: "usuarios/eliminar_usuario",
			      data: 'id='+id
			    }).done(function( resultado ) { 
			    	resultado = JSON.parse(resultado);
			    	if(!resultado[0]){
			    	  	swal({
			              title: "Parece que algo salio mal!",
			              html: resultado[1],
			              type: "warning"
			            });
			    	}else{
			    		var usuario = 'tr_usuario_' + id;
				    	$('#'+usuario).remove();
				    	limpiar_campos();
				    	swal(
						  'Excelente!',
						  'Se elimino el usuario con exito!',
						  'success'
						)
			    	}
			    }) 
	  }
	})
}

function ver_historico(id){
	 $.ajax({
	      type: "POST",
	      url: "usuarios/obtener_historial_usuario",
	      data: 'id_usuario='+id
	    }).done(function( resultado ) { 
	    	resultado = JSON.parse(resultado);
	    	$("#table_historico > tbody").html("");

	    	for(var i = 0; i < resultado.length ; i++){
	    		console.log(resultado[i]);
	    		var tr = '<tr><td>'+resultado[i]["id"]+'</td><td>'+resultado[i]["operacion"]+'</td><td>'+resultado[i]["fecha_hora"]+'</td></tr>';
	    		$('#table_historico').append(tr);
	    	}
	    	
	    	$("#modal").modal();
	    }) 
}

function limpiar_campos(){
    $('#nombre').val('');
    $('#apellido').val('');
    $('#usuario').val('');
    $('#password').val('');
    $('#id_usuario').val('');


}
