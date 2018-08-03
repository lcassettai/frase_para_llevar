<div class="row">
	<!-- Listado de todos los usuarios -->

	<div class="col-md-6"> 
	<h3 class="text-center">Listado de usuarios</h3>
	<div class="box table-responsive">
		<table class="table table-striped"> 
			<thead> 
				<th>#</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Usuario</th>
				<th style='text-align: center'>Opciones</th>
			</thead>
			<tbody> 
				<?php 
				foreach($usuarios as $us){
					echo "<tr id='tr_usuario_".$us['id']."'>";
					echo "<td>". $us['id'] ."</td>";
					echo "<td>". $us['nombre'] ."</td>";
					echo "<td>". $us['apellido'] ."</td>";
					echo "<td>". $us['usuario'] ."</td>";
					echo "
					<td class='text-center'>
						<a href='#' class='btn btn-info btn-xs' data-toggle='tooltip' title='Editar' onclick='obtener_usuario(".$us['id'].")'>
							<i class='fa fa-pencil'></i> Editar
						</a>
						<a href='#' class='btn btn-danger btn-xs' data-toggle='tooltip' title='Eliminar' onclick='eliminar_usuario(".$us['id'].")'>
							<i class='fa fa-trash'></i>
						</a>
					<td>";
					echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
	</div>
		<div class="col-md-6"> 
		<h3 class="text-center">Datos del usuario</h3>
		<div class="box"> 
		  	<?php 
		  	$attributes = array('id' => 'datos_usuario');
			echo form_open('login/verificar_credenciales', $attributes); 
			?>
		  		 <div class="box-body">
		  		 <input type="hidden" name="id_usuario" class="form-control" id="id_usuario">
		  		<div class="form-group">
                  <label for="usuario">Usuario</label>
                  <input type="text" name="usuario" class="form-control" id="usuario">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nombre</label>
                  <input type="text" name="nombre" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                  <label for="apellido">Apellido</label>
                  <input type="text" name="apellido" class="form-control" id="apellido">
                </div>  
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="password">
                </div>   
                 <div class="form-group">
                  <label for="tipo_usuario">Tipo de usuario</label>
                   <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                   <?php foreach($tipo_usuarios as $tu):?>
				    <option value="<?php echo $tu['id'];?>"><?php echo $tu['descripcion'];?></option>
				    <?php endforeach;?>
				  </select>
                </div>              
              </div>
              <div class="box-footer">
               <a href="#" class="btn btn-danger" onclick="limpiar_campos()">Cancelar</a>
                <a href="#" class="btn btn-success pull-right" onclick="guardar_datos_usuario()">Guardar</a>
              </div>
		  	</form>
		</div>
	</div>

<script type="text/javascript" src="<?php echo assets_url('assets');?>js/gestion_usuario.js"></script>







</div>