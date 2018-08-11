<div class="row">
    <div class="col-md-6">
        <h3 class="text-center">Listado de categorias</h3>
        <div class="box">
            <table  id="table_historico" class="table table-striped"> 
            <thead> 
                <th>#</th>
                <th>Categoria</th>
                <th>Opciones</th>
            </thead>
            <tbody> 
               <?php foreach($categorias as $cat):?>
                 <tr>
                     <td><?php echo $cat['id']?></td>
                    <td><?php echo $cat['nombre']?></td>
                    <td>
                        <a href="#" class='btn btn-primary btn-xs'>Editar</a>
                        <a href="#" class='btn btn-danger btn-xs'>Eliminar</a>
                    </td>
                </tr>
               <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>

    <div class="col-md-6">
    <h3 class="text-center">Edicion</h3>
        <div class="box">
            <div class="box-body">
                <form>
                <div class="form-group">
                    <label for='categoria'>Categoria</label>
                    <input type="text" name="categoria" id="categoria" class="form-control">
                </div>
                 <div class="form-group">
                    <label for='descripcion'>Descripcion</label>
                    <textarea class="form-control" rows="5" id="descripcion" name="descripcion" style="resize: none;"></textarea>
                </div>
                 <a href="#" class="btn btn-success pull-right" onclick="guardar_datos_usuario()">Guardar</a>
            </form>
            </div>
        </div>
    </div>
</div>
