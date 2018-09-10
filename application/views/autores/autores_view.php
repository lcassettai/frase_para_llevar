<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-md-6">
        <h3 class="text-center">Autores</h3>
        <div class="box box-danger">
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <th style="width:10px;">#</th>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th style="width:100px;">Opciones</th>
                    </thead>
                    <tbody>
                        <?php foreach ($autores as $a):?>
                        <tr id="tr_autor_<?=$a['id'];?>">
                            <td><?=$a['id'];?></td>
                            <td><?=$a['apellido'];?></td>
                            <td><?=$a['nombre'];?></td>
                            <td>
                                <a href="#" class="btn btn-primary btn-xs" onclick="get_autor(<?=$a['id'];?>)"><i class="fa fa-pencil"></i> Editar </a>
                                <a href="#" class="btn btn-danger btn-xs" onclick="eliminar_autor(
                                <?=$a['id'];?>)"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="text-center">
                    <?php echo $this->pagination->create_links();?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <h3 class="text-center">Edicion</h3>
        <div class="box box-danger">
            <div class="box-body">
                <form id="form-autor">
                    <input type="hidden" id="id_autor" name="id_autor">
                    <div class="form-group">
                        <label for="apellido_autor">Apellido</label>
                        <input type="text" name="apellido_autor" id="apellido_autor" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nombre_autor">Nombre</label>
                        <input type="text" name="nombre_autor" id="nombre_autor" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Fecha de nacimiento:</label>                    
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right" id="fecha_nacimiento" name="fecha_nacimiento">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url_bio">Link biografia</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-link"></i>
                            </div>
                            <input type="url" name="url_bio" id="url_bio" class="form-control" placeholder="http://www.ejemplo.com">
                        </div>
                    </div>
                    <div class="botonera-form">
                        <a href="#" class="btn btn-success pull-right" onclick="guardar_datos()">Guardar</a>
                        <button type="reset" class="btn btn-danger pull-left" onclick="limpiar_campos()">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var base_url = "<?=base_url()?>";
</script>
<script type="text/javascript" src="<?php echo assets_url('assets');?>js/gestion_autores.js"></script>


