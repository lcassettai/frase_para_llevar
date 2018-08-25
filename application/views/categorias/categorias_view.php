<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-md-6">
        <h3 class="text-center">Listado de categorias</h3>
        <div class="box box-danger">
            <table  id="table_historico" class="table table-striped"> 
            <thead> 
                <th>#</th>
                <th>Categoria</th>
                <th style="width:100px;">Opciones</th>
            </thead>
            <tbody> 
               <?php foreach($categorias as $cat):?>
                 <tr id="tr_categoria_<?php echo $cat['id']?>">
                    <td><?=$cat['id'];?></td>
                    <td><?=$cat['nombre'];?></td>
                    <td>
                        <a href="#"  onclick="get_categoria(<?=$cat['id'];?>)" class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i> Editar</a>
                        <a href="#" onclick="eliminar_categoria(<?=$cat['id'];?>)" class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a>
                    </td>
                </tr>
               <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-center">
            <?php echo $this->pagination->create_links();?>
        </div>
        </div>
    </div>

    <div class="col-md-6">
    <h3 class="text-center">Edicion</h3>
        <div class="box box-danger">
            <div class="box-body">
                <form id="datos_categoria">
                <input type="hidden" name="id_categoria" id="id_categoria" class="form-control">
                <div class="form-group">
                    <label for='categoria'>Categoria</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                 <div class="form-group">
                    <label for='descripcion'>Descripcion</label>
                    <textarea class="form-control" rows="5" id="descripcion" name="descripcion" style="resize: none;"></textarea>
                </div>
                 <a href="#" class="btn btn-success pull-right" onclick="guardar_datos()">Guardar</a>
                 <a href="#" class="btn btn-danger" onclick="limpiar_campos()">Cancelar</a>
            </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var base_url = "<?=base_url()?>";
</script>
<script type="text/javascript" src="<?php echo assets_url('assets');?>js/gestion_categorias.js"></script>
