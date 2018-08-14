<?php 
	defined('BASEPATH') or exit('No se puede acceder al script de manera directa');

	class Permisos extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('permisos_model');
		}

		public function index($id_perfil = 1){
			$datos = array(
				'permisos' => $this->permisos_model->get_all_permisos($id_perfil),
				'modulos' => $this->permisos_model->get_all_modulos(),
				'perfiles' => $this->permisos_model->get_all_perfiles(),
				'perfil_seleccionado' => $id_perfil
				);
			
			$this->load->view('templates/header_view',array('title' => 'Permisos'));
			$this->load->view('permisos/permisos_view',$datos);
			$this->load->view('templates/footer_view');
		}

	}
?>
