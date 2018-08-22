<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="box box-danger">
			<div class="box-body">
				<form action="Permisos/actualizar_permisos" method="POST" id="actualizar_permisos">
				<div class="form-group">
					<label>Perfiles</label>
					<select id="lista_perfiles" class="form-control" name="id_perfil">
						<?php foreach($perfiles as $p):?>
							<option value="<?php echo $p['id']?>" 
								<?php echo ($perfil_seleccionado ==  $p['id']) ? 'selected' : '' ?>>
								<?php echo $p['descripcion']?>								
							</option>
						<?php endforeach; ?>
					</select>
				</div>
				<table  id="table_historico" class="table">
					<thead>
						<th class="text-center">Modulos</th>
						<th class="text-center">Permitir</th>
					</thead>
					<tbody>
						<?php foreach($permisos as $per):?>
						<tr>
							<td>
								<?php echo strtoupper($per['modulo_descrip']);?>
							</td>
							<td class="text-center">
								<label class="switch">
								  <input type="checkbox" name="estado_perfil_<?php echo $per['id_modulo'];?>" <?php echo $per['activo']? 'checked' : ''; ?>>
								  <span class="slider round"></span>
								</label>

							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<hr>
				<a  class='btn btn-primary pull-right' href="#" onclick="modificar_permisos()">Guardar</a>
			 </form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo assets_url('assets');?>js/permisos.js"></script>

<script type="text/javascript" >
	

$(function(){
 $('#lista_perfiles').on('click',function(){
 	var perfil_seleccionado = $('#lista_perfiles').val();
    window.location.href = "<?php echo site_url('permisos/index/'); ?>" + perfil_seleccionado;
 });
});

function modificar_permisos(){
	var data_form = $("#actualizar_permisos").serialize();
	 $.ajax({
      type: "POST",
      url: "<?php echo site_url(); ?>/Permisos/actualizar_permisos",
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
    		swal(
			  'Excelente!',
			  'Se cargaron los datos con exito!',
			  'success'
			);		
    	} 	
    }) 
}


</script>
