<?php 
	defined('BASEPATH') OR exit('No se permiten scripts directos');

class Autores extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['usuario']) || !$_SESSION['activo']){
			redirect('login');
		}
		$permisos = $this->permisos->get_permiso_modulo('autores',$_SESSION['id_perfil']);
		if(!$permisos[0]['activo']){
			show_error('Usted no tiene permisos para estar aca',403,'Alto ahi loca!');
		}
	}

	public function index()
	{
		$this->load->view('templates/header_view',array('title' => 'Autores'));
		$this->load->view('autores/autores_view');		
		$this->load->view('templates/footer_view');
	}
}

?>
