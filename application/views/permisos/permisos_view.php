<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="box box-danger">
			<div class="box-body">
				<div class="form-group">
					<label>Perfiles</label>
					<select id="lista_perfiles" class="form-control">
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
						<th>Modulos</th>
						<th>Crear</th>
						<th>Leer</th>
						<th>Actualizar</th>
						<th>Borrar</th>
					</thead>
					<tbody>
						<?php foreach($permisos as $per):?>
						<tr class="text-center">
							<td>
								<?php echo $per['modulo_descrip'];?>
							</td>
							<td>
								<input type="checkbox" name="c_<?php echo $per['id_permiso'];?>" <?php echo $per['crear']? 'checked' : ''; ?>>
							</td>
							<td>
								<input type="checkbox" name="" <?php echo $per['leer']? 'checked' : ''; ?>>
							</td>
							<td>
								<input type="checkbox" name="" <?php echo $per['actualizar']? 'checked' : ''; ?>>
							</td>
							<td>
								<input type="checkbox" name="" <?php echo $per['borrar']? 'checked' : ''; ?>>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<hr>
				<a href="#" class='btn btn-primary pull-right'>Guardar</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" >
	

$(function(){
 $('#lista_perfiles').on('change',function(){
 	var perfil_seleccionado = $('#lista_perfiles').val();
    window.location.href = "<?php echo site_url('permisos/index/'); ?>" + perfil_seleccionado;
 });
});

</script>
