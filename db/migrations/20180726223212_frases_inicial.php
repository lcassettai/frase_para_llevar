<?php


use Phinx\Migration\AbstractMigration;

class FrasesInicial extends AbstractMigration
{
    public function change()
    {	
    	$table = $this->table('perfiles');
      $table->addColumn('descripcion','string',array('limit' => 200))
    	     ->addColumn('activo','boolean')
    		    ->create();

      $table = $this->table('modulos');
      $table->addColumn('descripcion','string',array('limit' => 200))
            ->create();

    	$table = $this->table('usuarios');
        $table->addColumn('usuario', 'string', array('limit' => 200))
              ->addColumn('password', 'string', array('limit' => 1000))
              ->addColumn('nombre', 'string', array('limit' => 200))
              ->addColumn('apellido', 'string', array('limit' => 200))
              ->addColumn('id_perfil','integer',array('null' => true))
              ->addColumn('activo','boolean')
              ->addForeignKey('id_perfil','perfiles','id')
              ->create();

      $table = $this->table('permisos');
      $table->addColumn('id_modulo','integer')
            ->addColumn('id_perfil','integer')
            ->addColumn('crear','boolean')
            ->addColumn('leer','boolean')
            ->addColumn('actualizar','boolean')
            ->addColumn('borrar','boolean')
            ->addForeignKey('id_modulo','modulos','id')
            ->addForeignKey('id_perfil','perfiles','id')
            ->create();

    	$table = $this->table('categorias');
        $table->addColumn('nombre', 'string', array('limit' => 100))
              ->addColumn('descripcion', 'string', array('limit' => 1000))
              ->addColumn('activo','boolean')
              ->create();

        $table = $this->table('autores');
        $table->addColumn('nombre', 'string', array('limit' => 150))
              ->addColumn('apellido', 'string', array('limit' => 150))
              ->addColumn('fecha_nacimiento', 'date',array('null' => true))
              ->addColumn('link', 'string', array('limit' => 400,'null' => true))
              ->addColumn('activo','boolean')
              ->create();

        $table = $this->table('frases');
        $table->addColumn('frase', 'string', array('limit' => 500))
              ->addColumn('fecha_alta', 'date', array('null' => true))
              ->addColumn('imagen', 'string',array('limit' => 200))
              ->addColumn('likes', 'integer')
              ->addColumn('activo', 'boolean')
              ->addColumn('id_usuario', 'integer')
              ->addColumn('id_autor', 'integer')
              ->addForeignKey('id_usuario', 'usuarios', 'id')
              ->addForeignKey('id_autor', 'autores', 'id')
              ->create();

        $table = $this->table('categorias_frases');
        $table->addColumn('id_categoria', 'integer')
              ->addColumn('id_frase', 'integer')
              ->addForeignKey('id_categoria', 'categorias', 'id')
              ->addForeignKey('id_frase', 'frases', 'id')
              ->create();

        $table = $this->table('control_usuarios');
        $table->addColumn('id_usuario', 'integer')
              ->addColumn('fecha_hora', 'datetime')
              ->addColumn('operacion', 'string', array('limit' => 100))
              ->addColumn('detalle', 'string', array('null' => true,'limit' => 300))
              ->addForeignKey('id_usuario', 'usuarios', 'id')
              ->create();
    }
}
