<?php


use Phinx\Migration\AbstractMigration;

class FrasesInicial extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {	
    	$table = $this->table('tipo_usuarios');
    	$table->addColumn('descripcion','string',array('limit' => 200))
    		  ->create();

    	$table = $this->table('usuarios');
        $table->addColumn('usuario', 'string', array('limit' => 200))
              ->addColumn('password', 'string', array('limit' => 1000))
              ->addColumn('nombre', 'string', array('limit' => 200))
              ->addColumn('apellido', 'string', array('limit' => 200))
              ->addColumn('tipo_usuario','integer')
              ->addColumn('activo','boolean')
              ->addForeignKey('tipo_usuario','tipo_usuarios','id')
              ->create();

    	$table = $this->table('categorias');
        $table->addColumn('nombre', 'string', array('limit' => 100))
              ->addColumn('descripcion', 'string', array('limit' => 1000))
              ->create();

        $table = $this->table('autores');
        $table->addColumn('nombre', 'string', array('limit' => 150))
              ->addColumn('apellido', 'string', array('limit' => 150))
              ->addColumn('fecha_nacimiento', 'date',array('null' => true))
              ->addColumn('link', 'string', array('limit' => 400,'null' => true))
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


        //-----------------------------------------------------------------------------------
        //---- Datos Basicos-----------------------------------------------------------------
        //-----------------------------------------------------------------------------------

        $tipo_usuarios = [
            [
              'descripcion'  => 'Administrador'
            ],
            [
              'descripcion'  => 'Participante'
            ]
        ];

		$this->table('tipo_usuarios')->insert($tipo_usuarios)->save();

    $tipo_usuarios = [
            [
              'id'  => '1',
              'usuario' => 'lcassettai',
              'password' => '$2y$10$r060nWfKZviJNCRTWhwVZOb36jYgIHHzm8ZiY8MtCBQ6pwuZPF36a',
              'nombre' => 'luciano',
              'apellido' => 'cassettai',
              'tipo_usuario' => 1,
              'activo' => 1
             ]
        ];

    $this->table('usuarios')->insert($tipo_usuarios)->save();


    }
}
