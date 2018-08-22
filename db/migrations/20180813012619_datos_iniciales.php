<?php
use Phinx\Migration\AbstractMigration;

class DatosIniciales extends AbstractMigration
{
    public function up()
    {
        $perfiles = [
              [
                'id' => 1,
                'descripcion' => 'Administrador',
                'activo' => true
              ],
              [
                'id' => 2,
                'descripcion' => 'Ayudante',
                'activo' => true
              ]
    ];

    $this->table('perfiles')->insert($perfiles)->save();

    $modulos = [
      [
        'id' => 1,
        'descripcion' => 'frases'
      ],
      [
        'id' => 2,
        'descripcion' => 'autores'
      ],
      [
        'id' => 3,
        'descripcion' => 'usuarios'
      ],
      [
        'id' => 4,
        'descripcion' => 'categorias'
      ],
      [
        'id' => 5,
        'descripcion' => 'permisos'
      ]
    ];

    $this->table('modulos')->insert($modulos)->save();


    $permisos = [
      [
        'id_modulo' => 1,
        'id_perfil' => 1,
        'activo' => true
      ],
       [
        'id_modulo' => 2,
        'id_perfil' => 1,
        'activo' => true
      ],
       [
        'id_modulo' => 3,
        'id_perfil' => 1,
         'activo' => true
      ],
       [
        'id_modulo' => 4,
        'id_perfil' => 1,
        'activo' => true
      ],
       [
        'id_modulo' => 5,
        'id_perfil' => 1,
        'activo' => true
      ],      
      [
        'id_modulo' => 1,
        'id_perfil' => 2,
        'activo' => true
      ],
       [
        'id_modulo' => 2,
        'id_perfil' => 2,
        'activo' => false
      ],
       [
        'id_modulo' => 3,
        'id_perfil' => 2,
        'activo' => false
      ],
       [
        'id_modulo' => 4,
        'id_perfil' => 2,
        'activo' => falses
      ],
       [
        'id_modulo' => 5,
        'id_perfil' => 2,
        'activo' => false
      ]
    ];

    $this->table('permisos')->insert($permisos)->save();

    $usuario = [
            [
              'id'  => 1,
              'usuario' => 'lcassettai',
              'password' => '$2y$10$r060nWfKZviJNCRTWhwVZOb36jYgIHHzm8ZiY8MtCBQ6pwuZPF36a',
              'nombre' => 'luciano',
              'apellido' => 'cassettai',
              'id_perfil' => 1,
              'activo' => 1
             ]
        ];

    $this->table('usuarios')->insert($usuario)->save();

    }

    public function down(){
        $this->execute('DELETE FROM control_usuarios'); 
        $this->execute('DELETE FROM usuarios');         
        $this->execute('DELETE FROM permisos'); 
        $this->execute('DELETE FROM perfiles'); 
        $this->execute('DELETE FROM modulos');       
  
    }
}
