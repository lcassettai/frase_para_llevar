<?php 
    defined('BASEPATH') or exit('No se puede acceder al script de manera directa');

    class Permisos extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            verificar_permisos('permisos');
            $this->load->model('usuarios_model');
        }

        public function index($id_perfil = 1)
        {
            $datos = array(
                'permisos' => $this->permisos->get_all_permisos($id_perfil),
                'modulos' => $this->permisos->get_all_modulos(),
                'perfiles' => $this->permisos->get_all_perfiles(),
                'perfil_seleccionado' => $id_perfil
                );
            
            $this->load->view('templates/header_view', array('title' => 'Permisos'));
            $this->load->view('permisos/permisos_view', $datos);
            $this->load->view('templates/footer_view');
        }

        public function actualizar_permisos()
        {
            $gump = new GUMP('es');
            $_POST = $gump->sanitize($_POST);

            $gump->validation_rules(array(
                'id_perfil' => 'required|integer'
            ));

            $validated_data = $gump->run($_POST);

            if ($validated_data === false) {
                exit(json_encode(array(false,$gump->get_readable_errors(true))));
            }
            
            $modulos = $this->permisos->get_all_modulos();
            $id_perfil = $_POST['id_perfil'];

            foreach ($modulos as $m) {
                $estado = isset($_POST['estado_perfil_'.$m['id']]); //Crear

                $this->permisos->update_permisos($id_perfil, $m['id'], $estado);
            }
            $this->usuarios_model->registrar_operacion($_SESSION['id'], 'logout', 'Modifico los permisos del perfil '.$id_perfil);
            exit(json_encode(array(true,'Se actualizo con exito')));
        }
    }
